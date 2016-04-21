<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\TaxBaseTax;
use AppBundle\Entity\VendorPolicyOptions;
use AppBundle\Entity\BaseTax;
use AppBundle\Entity\CurrencyRate;
use AppBundle\Entity\TaxAmount;
use AppBundle\Entity\FileUpload;
use AppBundle\Entity\PolicyHistory;
use AppBundle\Form\SearchFormType;
use AppBundle\Form\BaseTaxType;
use AppBundle\Form\InsurancePolicyType;
use AppBundle\Form\FileUploadType;

class DefaultController extends Controller
{

    /**
     * 
     * @param type $array
     * @return type
     */
    private function arrayFlatten($array)
    {
        $return = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, $this->arrayFlatten($value));
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }

    /**
     * 
     * @return type
     */
    private function getCurrencySelectorAsJson()
    {
        $em = $this->getDoctrine()->getManager();
        $currencyRates = $em->getRepository(CurrencyRate::class)->findBy(array(
            "currencyRateProvider" => "3"
        ));
        $toJson = [];
        foreach ($currencyRates as $currencyRate) {
            $toJson[$currencyRate->getCurrencyCode()] = $currencyRate->getReverseRate();
        }
        return json_encode($toJson);
    }

    /**
     * 
     * @param type $insurancePolicy
     * @param type $fileUpload
     * @param type $calculator
     */
    private function createNewPolicy($insurancePolicy, $fileUpload, $calculator)
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($insurancePolicy->getTaxes() as $tax) {
            $policyHistoryTax = new PolicyHistory;
            $policyHistoryTax->setTax($tax->getTax());
            $policyHistoryTax->setPolicy($insurancePolicy);

            if ($calculator->isPercentage($tax->getAmount())) {
                $tax->setAmount($calculator->getFlatSum($insurancePolicy->getBaseTax()->getAmount(), $tax->getAmount()));
            }
            if ($tax->getDirection() == true) {
                $policyHistoryTax->setAmount('-' . $tax->getAmount());
            } else {
                $policyHistoryTax->setAmount($tax->getAmount());
            }
            $em->persist($policyHistoryTax);
        }
        $insurancePolicy->setTaxes(null);
        $insurancePolicy->setCreatedOn(time());
        $fileUpload->setPolicy($insurancePolicy);
        $em->persist($fileUpload);
        $em->flush();
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $this->get('session')->set('searchFormArguments', $request->query->get("search_form"));
            $formData = $form->getData();
            if (isset($formData['others'])) {
                $formData['others'] = $formData['others']->toArray();
            }
            $formDataToFlatArray = $this->arrayFlatten($formData);
            $baseTaxes = $this->getDoctrine()->getManager()->getRepository(BaseTax::class)->getBaseTaxes($formDataToFlatArray);
            $allRequestedTaxes = $this->getDoctrine()->getManager()->getRepository(TaxAmount::class)->findByTax($formDataToFlatArray);
            $searchResult = $this->get('app.calculator')->calculatePoliciesPrices($baseTaxes, $allRequestedTaxes);
            $selectedCurrency = $request->query->get('currency');
            $currencySelector = $this->getCurrencySelectorAsJson();
            if ($selectedCurrency === null) {
                //1 = BGN
                $selectedCurrency = '1';
            }
            return $this->render('AppBundle:default:index.html.twig', array(
                        'form' => $form->createView(),
                        'searchResult' => $searchResult,
                        'currencyRates' => $currencySelector,
                        'selectedCurrency' => $selectedCurrency,
            ));
        }
        return $this->render('AppBundle:default:index.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function dashboardAction(Request $request)
    {
        $baseTax = new BaseTax();
        $company = $this->getUser()->getCompany()->getValues()[0];
        $baseTax->setVendor($company);

        $tax1 = new TaxBaseTax();
        $tax2 = new TaxBaseTax();
        $tax1->setBaseTax($baseTax);
        $tax2->setBaseTax($baseTax);

        $baseTax->addBaseTaxProperty($tax1);
        $baseTax->addBaseTaxProperty($tax2);
        $baseTaxForm = $this->createForm(new BaseTaxType(), $baseTax);
        $baseTaxForm->handleRequest($request);
        if ($baseTaxForm->isSubmitted() && $baseTaxForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($baseTax->getBaseTaxProperties()->toArray() as $tax) {
                $tax->setBaseTax($baseTax);
                $em->persist($tax);
            }
            $em->persist($baseTax);
            $em->flush($baseTax);
            return $this->redirectToRoute('basetax_index');
        }

        return $this->render('AppBundle:default:dashboard.html.twig', array(
                    "baseTaxForm" => $baseTaxForm->createView(),
        ));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function newPolicyAction(Request $request)
    {
        //store/get vendor,currency in/from session 
        if (isset(array_values($request->request->all())[1]["vendor"])) {
            $selectedCurrency = array_values($request->request->all())[0];
            $vendorId = array_values($request->request->all())[1]["vendor"];
            $this->get('session')->set('vendorId', $vendorId);
            $this->get('session')->set('selectedCurrency', $selectedCurrency);
        } else {
            $vendorId = $this->get('session')->get('vendorId');
            $selectedCurrency = $this->get('session')->get('selectedCurrency');
        }
        if (!$this->getUser()) {
            return $this->redirectToRoute('fos_user_security_login', array());
        }
        $sessionData = $this->arrayFlatten($this->get('session')->get('searchFormArguments'));
        $em = $this->getDoctrine()->getManager();
        $baseTaxes = $em->getRepository(BaseTax::class)->getBaseTaxes($sessionData);
        $allTaxes = $em->getRepository(TaxAmount::class)->findByTax($sessionData);
        $calculator = $this->get('app.calculator');
        $searchResult = $calculator->calculatePoliciesPrices($baseTaxes, $allTaxes, $vendorId);
        $insurancePolicy = $searchResult[$vendorId]["policy"];
        $insurancePolicy->setUser($this->getUser());
        $insurancePolicyForm = $this->createForm(InsurancePolicyType::class, $insurancePolicy);
        $insurancePolicyForm->handleRequest($request);
        $policyOptions = $em->getRepository(VendorPolicyOptions::class)->findOneBy(array('vendor' => $vendorId));
        $fileUpload = new FileUpload();
        $uploadForm = $this->createForm(FileUploadType::class, $fileUpload, array("read_only" => array('policy' => $policyOptions)));
        $uploadForm->handleRequest($request);
        if ($uploadForm->isSubmitted() && $uploadForm->isValid()) {
            $this->createNewPolicy($insurancePolicy, $fileUpload, $calculator);
            return $this->redirectToRoute('insurancepolicy_show', array('id' => $insurancePolicy->getId()));
        }
        return $this->render('AppBundle:default:new_policy.html.twig', array(
                    'policyDetails' => $insurancePolicy,
                    'fileUploadForm' => $uploadForm->createView(),
                    'form' => '',
                    'selectedCurrency' => $selectedCurrency,
        ));
    }

}

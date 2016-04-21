<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\CurrencyRateProvider;
use AppBundle\Entity\CurrencyRateHistory;
use AppBundle\Entity\CurrencyRate;

class CurrencyController extends Controller
{

    /**
     * 
     * @param type $codesWithRates
     * @param type $em
     * @param type $currencyRateProvider
     */
    private function submitRates($codesWithRates, $em, $currencyRateProvider)
    {
        foreach ($codesWithRates as $currencyCode => $reverseRate) {
            $currencyRateHistory = new CurrencyRateHistory();

            $currencyRateHistory->setCurrencyRateProvider($currencyRateProvider);
            $currencyRateHistory->setCurrencyCode($currencyCode);
            $currencyRateHistory->setReverseRate($reverseRate);

            $currencyRate = $em->getRepository(CurrencyRate::class)->findOneBy(array(
                'currencyCode' => $currencyCode, 'currencyRateProvider' => $currencyRateProvider
            ));
            if ($currencyRate === null) {
                $currencyRate = new CurrencyRate();

                $currencyRate->setCurrencyRateProvider($currencyRateProvider);
                $currencyRate->setCurrencyCode($currencyCode);
                $currencyRate->setReverseRate($reverseRate);

                $em->persist($currencyRate);
            } else {
                $currencyRate->setReverseRate($reverseRate);
            }

            $em->persist($currencyRateHistory);
        }
        $em->flush();
    }

    /**
     * 
     * @param type $em
     */
    private function refreshBnBCurrencyRates($em)
    {
        $currencyRateProvider = $em->getRepository(CurrencyRateProvider::class)->findOneBy(array('name' => 'БНБ'));
        $data = file_get_contents($currencyRateProvider->getLink());
        $currencyRatesFromXml = simplexml_load_string($data);

        $codesWithRates = [];
        foreach ($currencyRatesFromXml as $currencyRate) {
            if ((string) $currencyRate->REVERSERATE != '' && (string) $currencyRate->REVERSERATE != 'Обратен курс за 1 лев') {
                $codesWithRates[(string) $currencyRate->CODE] = (string) $currencyRate->REVERSERATE;
            }
        }
        $this->submitRates($codesWithRates, $em, $currencyRateProvider);
    }

    /**
     * 
     * @param type $em
     */
    private function refreshYahooCurrencyRates($em)
    {
        $currencyRateProvider = $em->getRepository(CurrencyRateProvider::class)->findOneBy(array('name' => 'Yahoo '));
        $currencyCodes = $em->getRepository(CurrencyRate::class)->getAvailableCurrencyRateCodes();
        $requestLink = $currencyRateProvider->getLink();
        $requestString = '';
        foreach ($currencyCodes as $currencyCode) {
            $requestString.='"BGN' . $currencyCode['currencyCode'] . '",';
        }
        $requestString = substr($requestString, 0, -1);
        $requestLink = str_replace("%rates here%", $requestString, $requestLink);

        $data = file_get_contents($requestLink);
        $currencyRatesFromXml = simplexml_load_string($data);
        $codesWithRates = [];
        foreach ($currencyRatesFromXml->results->rate as $currencyRate) {
            if ((string) $currencyRate->Rate != 'N/A') {
                $codesWithRates[substr((string) $currencyRate->Name, -3)] = (string) $currencyRate->Rate;
            }
        }

        $this->submitRates($codesWithRates, $em, $currencyRateProvider);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function getCurrencyAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lastUpdate = $em->getRepository(CurrencyRate::class)->getLastest();
        $form = $this->createFormBuilder(array(), array())
                ->add('submit', 'submit', [
                    "label" => "Refresh rates"
                ])
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->refreshBnBCurrencyRates($em);
            $this->refreshYahooCurrencyRates($em);
        }

        return $this->render('AppBundle:default:refresh_currencies.html.twig', array(
                    "lastUpdate" => $lastUpdate,
                    "form" => $form->createView()
        ));
    }

    /**
     * 
     * @param Request $request
     * @param Request $page
     * @return type
     */
    public function currencyHistoryAction($page)
    {
        $limit = 20;

        $em = $this->getDoctrine()->getManager();
        $currencyRatesHistoryPaginator = $em->getRepository(CurrencyRateHistory::class)->getCurrencyRateHistory($page, $limit); // Returns 5 posts out of 20
        $totalCurrencyRates = $currencyRatesHistoryPaginator->count(); # Count of ALL posts (ie: `20` posts)
        $currencyRatesHistory = $currencyRatesHistoryPaginator->getIterator();
        //    dump($currencyRatesHistory);

        $maxPages = ceil($totalCurrencyRates / $limit);
        $thisPage = $page;


        return $this->render('AppBundle:default:currency_history.html.twig', array(
                    'currencyRatesHistory' => $currencyRatesHistory,
                    'maxPages' => $maxPages,
                    'thisPage' => $thisPage
        ));
    }

    public function filterHistoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $request->query->get('q');
        $page = ($request->query->get('page'));
        $limit = 20;
        $paginator = $em->getRepository(CurrencyRateHistory::class)->getCurrencyRateHistoryLike($query, $page, $limit);

        $totalCurrencyRates = $paginator->count(); # Count of ALL posts (ie: `20` posts)
        $currentResults = $paginator->getIterator();

        $maxPages = ceil($totalCurrencyRates / $limit);
        $thisPage = $page;

        $jsonFrendlyArray = [];
        for ($i = 0; $i < count($currentResults); $i++) {
            $jsonFrendlyArray[$i]['currencyCode'] = $currentResults[$i]->getCurrencyCode();
            $jsonFrendlyArray[$i]['reverseRate'] = $currentResults[$i]->getReverseRate();
            $jsonFrendlyArray[$i]['currencyRateProvider'] = $currentResults[$i]->getCurrencyRateProvider()->getName();
            $jsonFrendlyArray[$i]['createdAt'] = $currentResults[$i]->getCreatedAt()->format('d/m/Y H:i:s');
        }
//        dump($jsonFrendlyArray,$currentResults);exit;

        return new JsonResponse(array(
            'results' => $jsonFrendlyArray,
            'pagination' => ['totalCurrencyRates' => $totalCurrencyRates, 'maxPages' => $maxPages, 'thisPage' => $thisPage]
        ));
    }

}

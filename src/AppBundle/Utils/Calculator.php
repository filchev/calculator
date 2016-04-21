<?php

namespace AppBundle\Utils;

use AppBundle\Form\BuyPolicyType;

class Calculator
{

    private $policy;
    private $vendor;
    private $currentSum;
    private $result;

    /**
     * 
     * @param type $baseTaxes
     * 
     * returns array
     */
    private function getVendorsFromBaseTaxes($baseTaxes)
    {
        $result = [];
        $arrayLength = count($baseTaxes);
        for ($i = 0; $arrayLength > $i; $i++) {
            $result[] = $baseTaxes[$i]->getVendor();
        }
        return $result;
    }

    /**
     * 
     * @param type $vendors
     * @param type $allTaxes
     * @return type
     */
    private function arrangeArgumentsByVendor($vendors, $allTaxes)
    {
        $arrayLength = count($vendors);
        $output = [];

        for ($i = 0; $arrayLength > $i; $i++) {
            foreach ($allTaxes as $tax) {
                $taxVendor = $tax->getVendor()->getId();
                $vendorId = $vendors[$i]->getId();

                if ($vendorId == $taxVendor) {
                    $output[$vendorId][] = $tax;
                } else {
                    //this should never happen
//                    $newTax = clone $tax;
//                    $newTax->setAmount(0);
//                    $output[$vendorId][]=$newTax;
                }
            }
        }
        return $output;
    }

    /**
     * 
     * @param type $current
     * @param type $amount
     * @param type $baseAmount
     * @param type $isPercentage
     * @return type
     */
    private function addition($current, $amount, $baseAmount, $isPercentage = false)
    {
        if (!$isPercentage) {
            return bcadd($current, $amount, 2);
        } else {

            $amount = str_replace('%', '', $amount);

            return bcadd($current, bcdiv(bcmul($baseAmount->getAmount(), $amount, 4), 100, 4), 2);
        }
    }

    /**
     * 
     * @param type $current
     * @param type $amount
     * @param type $baseAmount
     * @param type $isPercentage
     * @return type
     */
    private function substraction($current, $amount, $baseAmount, $isPercentage = false)
    {
        if (!$isPercentage) {
            return bcsub($current, $amount, 2);
        } else {
            $amount = str_replace('%', '', $amount);
            return bcsub($current, bcdiv(bcmul($baseAmount->getAmount(), $amount, 4), 100, 4), 2);
        }
    }

    /**
     * 
     * @return type
     */
    private function createForms()
    {
        $orderForm = $this->formFactory
                ->createNamedBuilder("form{$this->vendor->getName()}", BuyPolicyType::class, ["vendor" => $this->vendor->getId()])
                ->getForm();
        $orderForm->handleRequest($this->request);
        if ($orderForm->isSubmitted()) {
            return $this->redirectToRoute('app_new_policy', array("order" => $this->policy), 301);
        }
        $this->result[$this->vendor->getId()]["orderForm"] = $orderForm->createView();
    }

    private function calculateTaxesWithBaseTaxes($taxesArrangedByVendors, $baseTax)
    {
        if (isset($taxesArrangedByVendors[$baseTax->getVendor()->getId()])) {
            $taxesArrangedByVendors[$baseTax->getVendor()->getId()] = array_udiff(
                    $taxesArrangedByVendors[$baseTax->getVendor()->getId()], $baseTax->getBaseTaxProperties()->toArray(), function ($objectA, $objectB)
            {
                return $objectA->getId() - $objectB->getId();
            });

            foreach ($taxesArrangedByVendors[$baseTax->getVendor()->getId()] as $tax) {
                $taxAmount = $tax->getAmount();

                $isPercentige = $this->isPercentage($taxAmount);
                if ($tax->getDirection() == false) {
                    $this->currentSum = $this->addition($this->currentSum, $taxAmount, $baseTax, $isPercentige);
                } else {
                    $this->currentSum = $this->substraction($this->currentSum, $taxAmount, $baseTax, $isPercentige);
                }
                $this->vendor->policyPrice = $this->currentSum;
            }
            $this->policy->setTaxes($taxesArrangedByVendors[$this->vendor->getId()]);
        } else {
            $this->vendor->policyPrice = $this->currentSum;
        }
    }

    
    /**
     * 
     * @param type $formFactory
     */
    public function __construct($formFactory, $request)
    {
        $this->formFactory = $formFactory;
        $this->request = $request;
    }
    
    /**
     * 
     * @param type $sum
     * @param type $percentige
     * @return type
     */
    public function getFlatSum($sum, $percentige)
    {
        $percentige = str_replace('%', '', $percentige);
        return bcdiv(bcmul($sum, $percentige, 4), 100, 2);
    }
    
    /**
     * 
     * @param type $value
     * @return boolean
     */
    public function isPercentage($value)
    {
        if (strpos($value, '%') !== false) {

            return true;
        }
        return false;
    }


    /**
     * 
     * @param type $baseTaxes
     * @param type $allTaxes
     * @return type
     */
    public function calculatePoliciesPrices($baseTaxes, $allTaxes, $vendorId = null)
    {
        $vendors = $this->getVendorsFromBaseTaxes($baseTaxes);
        $taxesArrangedByVendors = $this->arrangeArgumentsByVendor($vendors, $allTaxes);
        $this->result = [];
        foreach ($baseTaxes as $baseTax) {
            $baseTaxAmount = $baseTax->getAmount();
            $this->currentSum = $baseTaxAmount;
            $this->vendor = $baseTax->getVendor();
            $this->policy = new \AppBundle\Entity\InsurancePolicy();
            $this->calculateTaxesWithBaseTaxes($taxesArrangedByVendors, $baseTax);
            $this->policy->setVendor($this->vendor);
            $this->policy->setBaseTax($baseTax);
            $this->policy->setPrice($this->currentSum);
            $this->result[$this->vendor->getId()]["vendorName"] = $this->vendor->getName();
            $this->result[$this->vendor->getId()]["policyPrice"] = $this->vendor->policyPrice;
            $this->result[$this->vendor->getId()]["policy"] = $this->policy;
            if ($vendorId == null) {
                $this->createForms();
            }
        }

        //order taxes by price
        uasort($this->result, function($a, $b)
        {
            return $a['policyPrice'] - $b['policyPrice'];
        });

        return $this->result;
    }



}

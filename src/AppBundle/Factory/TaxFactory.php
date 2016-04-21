<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Driver;

class TaxFactory
{

    public function createNewTax($category)
    {
        if ($category == null) {
            exit(':)');
        }
        $categoryId = $category->getId();
        switch ($categoryId) {
            case 1:
                $tax = new \AppBundle\Entity\EngineCapacity();
                $tax->setCategory($category);
                return $tax;
            case 2:
                $tax = new \AppBundle\Entity\VehicleUsedFor();
                $tax->setCategory($category);
                return $tax;
            case 3:
                $tax = new Driver();
                $tax->setCategory($category);
                return $tax;
            case 8:
                $tax = new \AppBundle\Entity\Region();
                $tax->setCategory($category);
                return $tax;
            case 9:
                $tax = new \AppBundle\Entity\DamageInsurance();
                $tax->setCategory($category);
                return $tax;
            case 10:
                $tax = new \AppBundle\Entity\OtherTax();
                $tax->setCategory($category);
                return $tax;

            default:
                throw new \Exception();
                break;
        }
    }

}

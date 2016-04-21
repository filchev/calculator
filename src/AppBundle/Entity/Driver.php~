<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DriverRepository")
 */

class Driver extends Tax
{
//    /**
//     * Get getLabelFromTo
//     *
//     * @return string 
//     */
//    public function getLabelFromTo()
//    {
//        return $this->name .' '. $this->valueFrom .' - '. $this->valueTo;
//    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baseTaxes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add baseTaxes
     *
     * @param \AppBundle\Entity\BaseTax $baseTaxes
     * @return Driver
     */
    public function addBaseTax(\AppBundle\Entity\BaseTax $baseTaxes)
    {
        $this->baseTaxes[] = $baseTaxes;

        return $this;
    }

    /**
     * Remove baseTaxes
     *
     * @param \AppBundle\Entity\BaseTax $baseTaxes
     */
    public function removeBaseTax(\AppBundle\Entity\BaseTax $baseTaxes)
    {
        $this->baseTaxes->removeElement($baseTaxes);
    }

    /**
     * Get baseTaxes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBaseTaxes()
    {
        return $this->baseTaxes;
    }

    /**
     * Add tax
     *
     * @param \AppBundle\Entity\TaxBaseTax $tax
     * @return Driver
     */
    public function addTax(\AppBundle\Entity\TaxBaseTax $tax)
    {
        $this->tax[] = $tax;

        return $this;
    }

    /**
     * Remove tax
     *
     * @param \AppBundle\Entity\TaxBaseTax $tax
     */
    public function removeTax(\AppBundle\Entity\TaxBaseTax $tax)
    {
        $this->tax->removeElement($tax);
    }

    /**
     * Get tax
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTax()
    {
        return $this->tax;
    }
    
    
}

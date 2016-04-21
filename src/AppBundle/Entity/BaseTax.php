<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaseTax
 *
 * @ORM\Table(name="base_tax")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BaseTaxRepository")
 */
class BaseTax
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\OneToMany(targetEntity="TaxBaseTax", mappedBy="baseTax", fetch="EAGER")
     */
    protected $baseTaxProperties;


    /**
     *
     * @ORM\ManyToOne(targetEntity="InsuranceCompany")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    protected $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="string", length=255)
     */
    protected $amount;

    public function __toString()
    {
        return (string) $this->amount;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baseTaxProperties = new \Doctrine\Common\Collections\ArrayCollection();
    }


        /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return BaseTax
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Add baseTaxProperties
     *
     * @param \AppBundle\Entity\TaxBaseTax $baseTaxProperties
     * @return BaseTax
     */
    public function addBaseTaxProperty(\AppBundle\Entity\TaxBaseTax $baseTaxProperties)
    {
        $this->baseTaxProperties[] = $baseTaxProperties;

        return $this;
    }

    /**
     * Remove baseTaxProperties
     *
     * @param \AppBundle\Entity\TaxBaseTax $baseTaxProperties
     */
    public function removeBaseTaxProperty(\AppBundle\Entity\TaxBaseTax $baseTaxProperties)
    {
        $this->baseTaxProperties->removeElement($baseTaxProperties);
    }

    /**
     * Get baseTaxProperties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBaseTaxProperties()
    {
        return $this->baseTaxProperties;
    }

    /**
     * Set vendor
     *
     * @param \AppBundle\Entity\InsuranceCompany $vendor
     * @return BaseTax
     */
    public function setVendor(\AppBundle\Entity\InsuranceCompany $vendor = null)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return \AppBundle\Entity\InsuranceCompany 
     */
    public function getVendor()
    {
        return $this->vendor;
    }
}

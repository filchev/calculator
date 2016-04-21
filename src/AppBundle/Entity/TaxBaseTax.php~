<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxBaseTax
 * 
 * @ORM\Table(name="base_tax_properties_taxes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxBaseTaxRepository")
 */
class TaxBaseTax
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
     * @ORM\ManyToOne(targetEntity="BaseTax", inversedBy="baseTaxProperties")
     * @ORM\JoinColumn(name="base_tax_id", referencedColumnName="id")
     */
    private $baseTax;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Tax", inversedBy="tax")
     * @ORM\JoinColumn(name="tax_id", referencedColumnName="id")
     */
    private $tax;

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
     * Set baseTax
     *
     * @param string $baseTax
     * @return TaxBaseTax
     */
    public function setBaseTax($baseTax)
    {
        $this->baseTax = $baseTax;

        return $this;
    }

    /**
     * Get baseTax
     *
     * @return string 
     */
    public function getBaseTax()
    {
        return $this->baseTax;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return TaxBaseTax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string 
     */
    public function getTax()
    {
        return $this->tax;
    }
    
    

}

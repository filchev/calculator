<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxAmount
 *
 * @ORM\Table(name="taxes_amount")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxAmountRepository")
 */
class TaxAmount
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
     * @ORM\ManyToOne(targetEntity="Tax")
     * @ORM\JoinColumn(name="tax_id", referencedColumnName="id")
     */
    protected $tax;

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

    /**
     * @var bool
     *
     * @ORM\Column(name="direction", type="boolean")
     */
    protected $direction;

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
     * Set tax
     *
     * @param string $tax
     * @return TaxAmount
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

    /**
     * Set vendor
     *
     * @param string $vendor
     * @return TaxAmount
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return TaxAmount
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
     * Set direction
     *
     * @param boolean $direction
     * @return TaxAmount
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return boolean 
     */
    public function getDirection()
    {
        return $this->direction;
    }

    public function __toString()
    {
        return (string) $this->getAmount();
    }
}

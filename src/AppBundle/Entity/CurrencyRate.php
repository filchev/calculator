<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations

/**
 * Category
 *
 * @ORM\Table(name="currency_rates")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CurrencyRateRepository")
 */

class CurrencyRate
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
     * @var string
     * @ORM\Column(name="currency_code", type="string", length=255)
     */
    protected $currencyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="reverse_rate", precision=10, scale=6 )
     */
    protected $reverseRate;

   
    
    /**
     * @ORM\ManyToOne(targetEntity="CurrencyRateProvider", inversedBy="currencyRate")
     * @ORM\JoinColumn(name="currency_rate_provider_id", referencedColumnName="id")
     */
    protected $currencyRateProvider;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * 
     * @return type
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return type
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * 
     * @return type
     */
    public function getReverseRate()
    {
        return $this->reverseRate;
    }

    /**
     * 
     * @param type $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * 
     * @param type $reverseRate
     */
    public function setReverseRate($reverseRate)
    {
        $this->reverseRate = $reverseRate;
    }
    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    

    /**
     * Set currencyRateProvider
     *
     * @param \AppBundle\Entity\CurrencyRateProvider $currencyRateProvider
     * @return CurrencyRate
     */
    public function setCurrencyRateProvider(\AppBundle\Entity\CurrencyRateProvider $currencyRateProvider = null)
    {
        $this->currencyRateProvider = $currencyRateProvider;

        return $this;
    }

    /**
     * Get currencyRateProvider
     *
     * @return \AppBundle\Entity\CurrencyRateProvider 
     */
    public function getCurrencyRateProvider()
    {
        return $this->currencyRateProvider;
    }
}

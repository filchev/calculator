<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations

/**
 * Category
 *
 * @ORM\Table(name="currency_rates_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CurrencyRateHistoryRepository")
 */

class CurrencyRateHistory
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
     * @ORM\ManyToOne(targetEntity="CurrencyRateProvider", inversedBy="currencyRateHistory")
     * @ORM\JoinColumn(name="currency_rate_provider_id", referencedColumnName="id")
     */
    protected $currencyRateProvider;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

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
     * @return type
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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

    /**
     * 
     * @param type $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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

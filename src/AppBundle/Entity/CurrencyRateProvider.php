<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CurrencyRateProvider
 *
 * @ORM\Table(name="currency_rate_provider")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CurrencyRateProviderRepository")
 */
class CurrencyRateProvider
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="CurrencyRate", mappedBy="currencyRateProvider")
     */
    protected $currencyRate;

    /**
     * @ORM\OneToMany(targetEntity="CurrencyRateHistory", mappedBy="currencyRateProvider")
     */
    protected $currencyRateHistory;

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
     * Set name
     *
     * @param string $name
     * @return CurrencyRateProvider
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return CurrencyRateProvider
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->currencyRate = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add currencyRate
     *
     * @param \AppBundle\Entity\CurrencyRate $currencyRate
     * @return CurrencyRateProvider
     */
    public function addCurrencyRate(\AppBundle\Entity\CurrencyRate $currencyRate)
    {
        $this->currencyRate[] = $currencyRate;

        return $this;
    }

    /**
     * Remove currencyRate
     *
     * @param \AppBundle\Entity\CurrencyRate $currencyRate
     */
    public function removeCurrencyRate(\AppBundle\Entity\CurrencyRate $currencyRate)
    {
        $this->currencyRate->removeElement($currencyRate);
    }

    /**
     * Get currencyRate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCurrencyRate()
    {
        return $this->currencyRate;
    }
}

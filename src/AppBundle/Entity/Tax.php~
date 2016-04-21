<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tax
 * @ORM\Table(name="taxes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaxRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"engine" = "EngineCapacity", "region" = "Region", 
 *                        "driver" = "Driver", "other" = "OtherTax","wheelDirection" = "WheelDirection",
 *                        "vehiclePurpose" = "VehicleUsedFor","damageInsurance" = "DamageInsurance"})
 */
class Tax
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
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Category" ,inversedBy="tax")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="value_from", type="string", length=255, nullable=true)
     */
    protected $valueFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="value_to", type="string", length=255, nullable=true)
     */
    protected $valueTo;

    /**
     *
     * @ORM\OneToMany(targetEntity="TaxBaseTax", mappedBy="tax")
     */
    protected $tax;

    protected $translations;
 
    public function getTranslations()
    {
        return $this->translations;
    }

    public function setTranslations($translations)
    {
        $this->translations= $translations;
    }

    public function addTranslation($translation)
    {
        $this->translations[] = $translation;
    }

    
    public function __toString()
    {
        return (string) $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Tax
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
     * Set category
     *
     * @param string $category
     * @return Tax
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set valueFrom
     *
     * @param string $valueFrom
     * @return Tax
     */
    public function setValueFrom($valueFrom)
    {
        $this->valueFrom = $valueFrom;

        return $this;
    }

    /**
     * Get valueFrom
     *
     * @return string 
     */
    public function getValueFrom()
    {
        return $this->valueFrom;
    }

    /**
     * Set valueTo
     *
     * @param string $valueTo
     * @return Tax
     */
    public function setValueTo($valueTo)
    {
        $this->valueTo = $valueTo;

        return $this;
    }
    


    /**
     * Get valueTo
     *
     * @return string 
     */
    public function getValueTo()
    {
        return $this->valueTo;
    }

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
     * @return Tax
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
     * @return Tax
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

    /**
     * Get getLabelFromTo
     *
     * @return string 
     */
    public function getLabelFromTo()
    {
        $label = $this->name . ' ' . $this->valueFrom;
        if ($this->valueTo != '') {

            $label.=' - ' . $this->valueTo;
        }
        return $label;
    }

}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsurancePolicy
 *
 * @ORM\Table(name="insurance_policy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurancePolicyRepository")
 */
class InsurancePolicy
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
     * @ORM\OneToMany(targetEntity="FileUpload", mappedBy="policy", fetch="EAGER")
     */
    protected $fileUploadImage;

    /**
     *
     * @ORM\ManyToOne(targetEntity="InsuranceCompany")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    protected $vendor;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    protected $price;

    /**
     *
     * @ORM\ManyToOne(targetEntity="BaseTax")
     * @ORM\JoinColumn(name="base_tax_id", referencedColumnName="id")
     */
    protected $baseTax;

    /**
     * @var string
     *
     * @ORM\Column(name="created_on", type="string", length=255)
     */
    protected $createdOn;

    /**
     *
     * @ORM\OneToMany(targetEntity="PolicyHistory" ,mappedBy="policy")
     */
    protected $taxes;

    function setTaxes($taxes)
    {
        $this->taxes = $taxes;
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
     * Set title
     *
     * @param string $title
     * @return InsurancePolicy
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set vendor
     *
     * @param string $vendor
     * @return InsurancePolicy
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
     * Set user
     *
     * @param string $user
     * @return InsurancePolicy
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return InsurancePolicy
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set baseTax
     *
     * @param string $baseTax
     * @return InsurancePolicy
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
     * Set createdOn
     *
     * @param string $createdOn
     * @return InsurancePolicy
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return string 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->taxes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add taxes
     *
     * @param \AppBundle\Entity\PolicyHistory $taxes
     * @return InsurancePolicy
     */
    public function addTax(\AppBundle\Entity\PolicyHistory $taxes)
    {
        $this->taxes[] = $taxes;

        return $this;
    }

    /**
     * Remove taxes
     *
     * @param \AppBundle\Entity\PolicyHistory $taxes
     */
    public function removeTax(\AppBundle\Entity\PolicyHistory $taxes)
    {
        $this->taxes->removeElement($taxes);
    }

    /**
     * Get taxes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaxes()
    {
        return $this->taxes;
    }


    /**
     * Add fileUploadImage
     *
     * @param \AppBundle\Entity\FileUpload $fileUploadImage
     * @return InsurancePolicy
     */
    public function addFileUploadImage(\AppBundle\Entity\FileUpload $fileUploadImage)
    {
        $this->fileUploadImage[] = $fileUploadImage;

        return $this;
    }

    /**
     * Remove fileUploadImage
     *
     * @param \AppBundle\Entity\FileUpload $fileUploadImage
     */
    public function removeFileUploadImage(\AppBundle\Entity\FileUpload $fileUploadImage)
    {
        $this->fileUploadImage->removeElement($fileUploadImage);
    }

    /**
     * Get fileUploadImage
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFileUploadImage()
    {
        return $this->fileUploadImage;
    }
}

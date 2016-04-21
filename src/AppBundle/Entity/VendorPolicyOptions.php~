<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VendorPolicyOptions
 *
 * @ORM\Table(name="vendor_policy_options")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VendorPolicyOptionsRepository")
 */
class VendorPolicyOptions
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
     * @ORM\OneToOne(targetEntity="InsuranceCompany")
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="hasDriverLicensePhoto", type="boolean")
     */
    private $hasDriverLicensePhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="hasCarDocumentsPhoto", type="boolean")
     */
    private $hasCarDocumentsPhoto;

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
     * Set vendor
     *
     * @param string $vendor
     * @return VendorPolicyOptions
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
     * Set hasDriverLicensePhoto
     *
     * @param string $hasDriverLicensePhoto
     * @return VendorPolicyOptions
     */
    public function setHasDriverLicensePhoto($hasDriverLicensePhoto)
    {
        $this->hasDriverLicensePhoto = $hasDriverLicensePhoto;

        return $this;
    }

    /**
     * Get hasDriverLicensePhoto
     *
     * @return string 
     */
    public function getHasDriverLicensePhoto()
    {
        return $this->hasDriverLicensePhoto;
    }

    /**
     * Set hasCarDocumentsPhoto
     *
     * @param string $hasCarDocumentsPhoto
     * @return VendorPolicyOptions
     */
    public function setHasCarDocumentsPhoto($hasCarDocumentsPhoto)
    {
        $this->hasCarDocumentsPhoto = $hasCarDocumentsPhoto;

        return $this;
    }

    /**
     * Get hasCarDocumentsPhoto
     *
     * @return string 
     */
    public function getHasCarDocumentsPhoto()
    {
        return $this->hasCarDocumentsPhoto;
    }

}

<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_company", type="boolean")
     */
    protected $isCompany;

    
    /**
     *
     * @ORM\OneToMany(targetEntity="InsuranceCompany", mappedBy = "userOwner")
     */
    protected $company;
    
    
    function getId()
    {
        return $this->id;
    }

    function getIsCompany()
    {
        return $this->isCompany;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setIsCompany($isCompany)
    {
        $this->isCompany = $isCompany;
    }

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Add company
     *
     * @param \AppBundle\Entity\InsuranceCompany $company
     * @return User
     */
    public function addCompany(\AppBundle\Entity\InsuranceCompany $company)
    {
        $this->company[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \AppBundle\Entity\InsuranceCompany $company
     */
    public function removeCompany(\AppBundle\Entity\InsuranceCompany $company)
    {
        $this->company->removeElement($company);
    }

    /**
     * Get company
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompany()
    {
        return $this->company;
    }
}

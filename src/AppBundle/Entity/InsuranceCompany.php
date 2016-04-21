<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsuranceCompany
 *
 * @ORM\Table(name="insurance_companies")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsuranceCompanyRepository")
 */
class InsuranceCompany
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
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy = "company")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $userOwner;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return InsuranceCompany
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
     * Set userOwner
     *
     * @param \AppBundle\Entity\User $userOwner
     * @return InsuranceCompany
     */
    public function setUserOwner(\AppBundle\Entity\User $userOwner = null)
    {
        $this->userOwner = $userOwner;

        return $this;
    }

    /**
     * Get userOwner
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUserOwner()
    {
        return $this->userOwner;
    }

}

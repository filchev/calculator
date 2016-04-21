<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InsurancePolicy
 *
 * @ORM\Table(name="languages")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsurancePolicyRepository")
 */
class Language
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
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="prefix", type="string")
     */
    protected $prefix;

    
    /**
     * 
     * @return type
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return type
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @return type
     */
    function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * 
     * @param type $name
     */
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 
     * @param type $prefix
     */
    function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

}

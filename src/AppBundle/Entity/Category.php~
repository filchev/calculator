<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="Tax" ,mappedBy="category")
     */
    protected $tax;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    protected $parent;

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
     * @return Category
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
     * Set parent
     *
     * @param string $parent
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tax = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tax
     *
     * @param \AppBundle\Entity\Tax $tax
     * @return Category
     */
    public function addTax(\AppBundle\Entity\Tax $tax)
    {
        $this->tax[] = $tax;

        return $this;
    }

    /**
     * Remove tax
     *
     * @param \AppBundle\Entity\Tax $tax
     */
    public function removeTax(\AppBundle\Entity\Tax $tax)
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

}

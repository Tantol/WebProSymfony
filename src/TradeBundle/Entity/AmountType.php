<?php

namespace TradeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TradeBundle\Entity\Product;

/**
 * AmountType
 *
 * @ORM\Table(name="amount_type")
 * @ORM\Entity(repositoryClass="TradeBundle\Repository\AmountTypeRepository")
 */
class AmountType
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="shortcut", type="string", length=20, nullable=true)
     */
    private $shortcut;
    
    /**
     * @var Product
     * @ORM\OneToMany(targetEntity="TradeBundle\Entity\Product", mappedBy="amountType")
     */
    private $products;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AmountType
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
     * Set shortcut
     *
     * @param string $shortcut
     *
     * @return AmountType
     */
    public function setShortcut($shortcut)
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * Get shortcut
     *
     * @return string
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productAmountType = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productAmountType
     *
     * @param \TradeBundle\Entity\Product $productAmountType
     *
     * @return AmountType
     */
    public function addProductAmountType(\TradeBundle\Entity\Product $productAmountType)
    {
        $this->productAmountType[] = $productAmountType;

        return $this;
    }

    /**
     * Remove productAmountType
     *
     * @param \TradeBundle\Entity\Product $productAmountType
     */
    public function removeProductAmountType(\TradeBundle\Entity\Product $productAmountType)
    {
        $this->productAmountType->removeElement($productAmountType);
    }

    /**
     * Get productAmountType
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductAmountType()
    {
        return $this->productAmountType;
    }

    /**
     * Add product
     *
     * @param \TradeBundle\Entity\Product $product
     *
     * @return AmountType
     */
    public function addProduct(\TradeBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \TradeBundle\Entity\Product $product
     */
    public function removeProduct(\TradeBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    public function __toString(){
        return $this->shortcut;
        // return $this->id;
    }
}

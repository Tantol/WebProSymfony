<?php

namespace TradeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;
use TradeBundle\Entity\AmountType;
use TradeBundle\Entity\MoneyType;
use TradeBundle\Entity\Category;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="TradeBundle\Repository\ProductRepository")
 */
class Product
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
     * @var int
     *
     * @ORM\Column(name="purchasePrice", type="integer")
     */
    private $purchasePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="estimatePrice", type="integer", nullable=true)
     */
    private $estimatePrice;

    /**
     * @var int
     *
     * @ORM\Column(name="sellingPrice", type="integer", nullable=true)
     */
    private $sellingPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;
    
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="product")
     */
    private $user;
    
    /**
     * @var AmountType
     * @ORM\ManyToOne(targetEntity="TradeBundle\Entity\AmountType", inversedBy="products")
     */
    private $amountType;
    
    /**
     * @var MoneyType
     * @ORM\ManyToOne(targetEntity="TradeBundle\Entity\MoneyType", inversedBy="products")
     */
    private $moneyType;
    
    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="TradeBundle\Entity\Category", inversedBy="products")
     */
    private $category;


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
     * @return Product
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
     * Set purchasePrice
     *
     * @param integer $purchasePrice
     *
     * @return Product
     */
    public function setPurchasePrice($purchasePrice)
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    /**
     * Get purchasePrice
     *
     * @return int
     */
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }

    /**
     * Set estimatePrice
     *
     * @param integer $estimatePrice
     *
     * @return Product
     */
    public function setEstimatePrice($estimatePrice)
    {
        $this->estimatePrice = $estimatePrice;

        return $this;
    }

    /**
     * Get estimatePrice
     *
     * @return int
     */
    public function getEstimatePrice()
    {
        return $this->estimatePrice;
    }

    /**
     * Set sellingPrice
     *
     * @param integer $sellingPrice
     *
     * @return Product
     */
    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;

        return $this;
    }

    /**
     * Get sellingPrice
     *
     * @return int
     */
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Product
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Product
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set amountType
     *
     * @param \TradeBundle\Entity\AmountType $amountType
     *
     * @return Product
     */
    public function setAmountType(\TradeBundle\Entity\AmountType $amountType = null)
    {
        $this->amountType = $amountType;

        return $this;
    }

    /**
     * Get amountType
     *
     * @return \TradeBundle\Entity\AmountType
     */
    public function getAmountType()
    {
        return $this->amountType;
    }

    /**
     * Set moneyType
     *
     * @param \TradeBundle\Entity\MoneyType $moneyType
     *
     * @return Product
     */
    public function setMoneyType(\TradeBundle\Entity\MoneyType $moneyType = null)
    {
        $this->moneyType = $moneyType;

        return $this;
    }

    /**
     * Get moneyType
     *
     * @return \TradeBundle\Entity\MoneyType
     */
    public function getMoneyType()
    {
        return $this->moneyType;
    }

    /**
     * Set category
     *
     * @param \TradeBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\TradeBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \TradeBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function __toString(){
        return $this->name;
        // return $this->id;
    }
}

<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillingPlan
 *
 * @ORM\Table(name="billing_plans")
 * @ORM\Entity
 */
class BillingPlan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Operator", mappedBy="billingPlan")
     */
    private $operators;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="autorenew", type="boolean")
     */
    private $autorenew;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="active_from", type="datetime")
     */
    private $activeFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="active_to", type="datetime")
     */
    private $activeTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer")
     */
    private $sortOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="length_in_days", type="integer")
     */
    private $lengthInDays;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_aircraft", type="integer")
     */
    private $numberOfAircraft;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->operators = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->getName();
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
     * @return BillingPlan
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
     * Set price
     *
     * @param string $price
     * @return BillingPlan
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
     * Set description
     *
     * @param string $description
     * @return BillingPlan
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set autorenew
     *
     * @param boolean $autorenew
     * @return BillingPlan
     */
    public function setAutorenew($autorenew)
    {
        $this->autorenew = $autorenew;

        return $this;
    }

    /**
     * Get autorenew
     *
     * @return boolean
     */
    public function getAutorenew()
    {
        return $this->autorenew;
    }

    /**
     * Set activeFrom
     *
     * @param \DateTime $activeFrom
     * @return BillingPlan
     */
    public function setActiveFrom($activeFrom)
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    /**
     * Get activeFrom
     *
     * @return \DateTime
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * Set activeTo
     *
     * @param \DateTime $activeTo
     * @return BillingPlan
     */
    public function setActiveTo($activeTo)
    {
        $this->activeTo = $activeTo;

        return $this;
    }

    /**
     * Get activeTo
     *
     * @return \DateTime
     */
    public function getActiveTo()
    {
        return $this->activeTo;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     * @return BillingPlan
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * Set lengthInDays
     *
     * @param integer $lengthInDays
     * @return BillingPlan
     */
    public function setLengthInDays($lengthInDays)
    {
        $this->lengthInDays = $lengthInDays;

        return $this;
    }

    /**
     * Get lengthInDays
     *
     * @return integer
     */
    public function getLengthInDays()
    {
        return $this->lengthInDays;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return BillingPlan
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set numberAircraft
     *
     * @param integer $numberAircraft
     * @return BillingPlan
     */
    public function setNumberOfAircraft($numberAircraft)
    {
        $this->numberOfAircraft = $numberAircraft;

        return $this;
    }

    /**
     * Get numberAircraft
     *
     * @return integer
     */
    public function getNumberOfAircraft()
    {
        return $this->numberOfAircraft;
    }

    /**
     * Add operators
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $operators
     * @return BillingPlan
     */
    public function addOperator(\JetCharters\AppBundle\Entity\OperatorUser $operators)
    {
        $this->operators[] = $operators;

        return $this;
    }

    /**
     * Remove operators
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $operators
     */
    public function removeOperator(\JetCharters\AppBundle\Entity\OperatorUser $operators)
    {
        $this->operators->removeElement($operators);
    }

    /**
     * Get operators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOperators()
    {
        return $this->operators;
    }
}

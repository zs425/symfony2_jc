<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperatorBillingInformation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OperatorBillingInformation
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
     * @var integer
     *
     * @ORM\Column(name="aircraft_fleet", type="integer")
     */
    private $aircraftFleet;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_code", type="string", length=50)
     */
    private $couponCode;

    /**
     * @var string
     *
     * @ORM\Column(name="bill_cycle", type="string", length=20)
     */
    private $billCycle;

    /**
     * @var float
     *
     * @ORM\Column(name="total_cost", type="float")
     */
    private $totalCost;

    /**
     * @var string
     *
     * @ORM\Column(name="card_type", type="string", length=50)
     */
    private $cardType;

    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=255)
     */
    private $cardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="expire_date", type="string", length=10)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ccv_number", type="string", length=50)
     */
    private $ccvNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="renewal_term", type="string", length=20)
     */
    private $renewalTerm;

    /**
    * @ORM\ManyToOne(targetEntity="Operator", inversedBy="OperatorBillingInformation")
    * @ORM\JoinColumn(onDelete="CASCADE")
    */
    private $operator;


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
     * Set aircraftFleet
     *
     * @param integer $aircraftFleet
     * @return OperatorBillingInformation
     */
    public function setAircraftFleet($aircraftFleet)
    {
        $this->aircraftFleet = $aircraftFleet;

        return $this;
    }

    /**
     * Get aircraftFleet
     *
     * @return integer 
     */
    public function getAircraftFleet()
    {
        return $this->aircraftFleet;
    }

    /**
     * Set couponCode
     *
     * @param string $couponCode
     * @return OperatorBillingInformation
     */
    public function setCouponCode($couponCode)
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    /**
     * Get couponCode
     *
     * @return string 
     */
    public function getCouponCode()
    {
        return $this->couponCode;
    }

    /**
     * Set billCycle
     *
     * @param string $billCycle
     * @return OperatorBillingInformation
     */
    public function setBillCycle($billCycle)
    {
        $this->billCycle = $billCycle;

        return $this;
    }

    /**
     * Get billCycle
     *
     * @return string 
     */
    public function getBillCycle()
    {
        return $this->billCycle;
    }

    /**
     * Set totalCost
     *
     * @param float $totalCost
     * @return OperatorBillingInformation
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    /**
     * Get totalCost
     *
     * @return float 
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * Set cardType
     *
     * @param string $cardType
     * @return OperatorBillingInformation
     */
    public function setCardType($cardType)
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * Get cardType
     *
     * @return string 
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     * @return OperatorBillingInformation
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set expireDate
     *
     * @param string $expireDate
     * @return OperatorBillingInformation
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;

        return $this;
    }

    /**
     * Get expireDate
     *
     * @return string 
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set ccvNumber
     *
     * @param string $ccvNumber
     * @return OperatorBillingInformation
     */
    public function setCcvNumber($ccvNumber)
    {
        $this->ccvNumber = $ccvNumber;

        return $this;
    }

    /**
     * Get ccvNumber
     *
     * @return string 
     */
    public function getCcvNumber()
    {
        return $this->ccvNumber;
    }

    /**
     * Set renewalTerm
     *
     * @param string $renewalTerm
     * @return OperatorBillingInformation
     */
    public function setRenewalTerm($renewalTerm)
    {
        $this->renewalTerm = $renewalTerm;

        return $this;
    }

    /**
     * Get renewalTerm
     *
     * @return string 
     */
    public function getRenewalTerm()
    {
        return $this->renewalTerm;
    }

    /**
     * Set user
     *
     * @param \JetCharters\AppBundle\Entity\Operator $user
     * @return OperatorBillingInformation
     */
    public function setUser(\JetCharters\AppBundle\Entity\Operator $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \JetCharters\AppBundle\Entity\Operator 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set operator
     *
     * @param \JetCharters\AppBundle\Entity\Operator $operator
     * @return OperatorBillingInformation
     */
    public function setOperator(\JetCharters\AppBundle\Entity\Operator $operator = null)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return \JetCharters\AppBundle\Entity\Operator 
     */
    public function getOperator()
    {
        return $this->operator;
    }
}

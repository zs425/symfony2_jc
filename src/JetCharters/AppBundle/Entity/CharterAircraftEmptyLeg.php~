<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharterAircraftEmptyLeg
 *
 * @ORM\Table(name="charter_aircraft_empty_legs")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\CharterAircraftEmptyLegRepository")
 */
class CharterAircraftEmptyLeg
{
    /**
     * @ORM\ManyToOne(targetEntity="CharterAircraft", inversedBy="emptylegs")
     */
    private $aircraft;

    /**
     * @ORM\ManyToOne(targetEntity="Operator", inversedBy="emptylegs")
     */
    private $operator;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="emptyLegOrigin")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="emptyLegDestination")
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="datetime")
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="datetime")
     */
    private $toDate;


    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=100, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;


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
     * Set origin
     *
     * @param string $origin
     * @return CharterAircraftEmptyLeg
     */
    public function setOrigin(Airport $origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return CharterAircraftEmptyLeg
     */
    public function setDestination(Airport $destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     * @return CharterAircraftEmptyLeg
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime 
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     * @return CharterAircraftEmptyLeg
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime 
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return CharterAircraftEmptyLeg
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }


    /**
     * Set phone
     *
     * @param string $phone
     * @return CharterAircraftEmptyLeg
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return CharterAircraftEmptyLeg
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return CharterAircraftEmptyLeg
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set aircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $aircraft
     * @return CharterAircraftEmptyLeg
     */
    public function setAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $aircraft = null)
    {
        $this->aircraft = $aircraft;

        return $this;
    }

    /**
     * Get aircraft
     *
     * @return \JetCharters\AppBundle\Entity\CharterAircraft 
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }


    /**
     * Set operator
     *
     * @param \JetCharters\AppBundle\Entity\Operator $operator
     * @return CharterAircraftEmptyLeg
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

<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="states")
 * @ORM\Entity
 */
class State
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
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", length=2)
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="full", type="string", length=255)
     */
    private $full;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=5)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="boundries", type="string", length=255)
     */
    private $boundries;


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
     * Set abbreviation
     *
     * @param string $abbreviation
     * @return State
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string 
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set full
     *
     * @param string $full
     * @return State
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get full
     *
     * @return string 
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return State
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set boundries
     *
     * @param string $boundries
     * @return State
     */
    public function setBoundries($boundries)
    {
        $this->boundries = $boundries;

        return $this;
    }

    /**
     * Get boundries
     *
     * @return string 
     */
    public function getBoundries()
    {
        return $this->boundries;
    }
}

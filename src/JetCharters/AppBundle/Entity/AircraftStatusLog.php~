<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AircraftStatusLog
 *
 * @ORM\Table(name="aircraft_status_logs")
 * @ORM\Entity
 */
class AircraftStatusLog
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
     * @ORM\Column(name="status", type="string", length=10)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="CharterAircraft", inversedBy="statuslog")
     * @ORM\JoinColumn(name="aircraft_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $aircraft;

    /**
     * @var array
     *
     * @ORM\Column(name="state_info", type="array")
     */
    private $stateInfo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;


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
     * Set status
     *
     * @param string $status
     * @return AircraftStatusLog
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set stateInfo
     *
     * @param array $stateInfo
     * @return AircraftStatusLog
     */
    public function setStateInfo($stateInfo)
    {
        $this->stateInfo = $stateInfo;

        return $this;
    }

    /**
     * Get stateInfo
     *
     * @return array
     */
    public function getStateInfo()
    {
        return $this->stateInfo;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return AircraftStatusLog
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set aircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $aircraft
     * @return AircraftStatusLog
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
}

<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * CharterAircraft
 *
 * @ORM\Table(name="charter_aircrafts")
 * @ORM\Entity
 * @ORM\EntityListeners({"JetCharters\AppBundle\EventListener\AircraftLogListener"})
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\CharterAircraftRepository")
 * @Vich\Uploadable
 */
class CharterAircraft
{

    /**
     * @ORM\ManyToOne(targetEntity="Operator", inversedBy="aircraft")
     */
    private $operator;

    /**
     * @ORM\OneToMany(targetEntity="AircraftStatusLog", mappedBy="aircraft")
     * @ORM\JoinColumn(name="statuslog_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $statuslog;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraftEmptyLeg", mappedBy="aircraft")
     */
    private $emptylegs;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraftImage", mappedBy="aircraft", cascade={"all"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="charterAircraft", cascade={"all"})
     */
    private $videos;

    /**
     * @ORM\ManyToOne(targetEntity="AircraftModel", inversedBy="charterAircraft")
     * @ORM\JoinColumn(name="aircraft_model_id", referencedColumnName="id")
     */
    private $model;

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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer", nullable=true)
     */
    private $seats;

    /**
     * @var string
     *
     * @ORM\Column(name="tail_number", type="string", length=50, nullable=true)
     */
    private $tailNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Airport", inversedBy="charterAircraft")
     */
    private $location;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="available_from", type="datetime", nullable=true)
     */
    private $availableFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availble_to", type="datetime", nullable=true)
     */
    private $availableTo;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="hourly_rate", type="bigint", nullable=true)
     */
    private $hourlyRate;

    /**
     * @var integer
     *
     * @ORM\Column(name="hourlyrate_2", type="bigint", nullable=true)
     */
    private $hourlyRate2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="air_ambulance", type="boolean", nullable=true)
     */
    private $airAmbulance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide_tail_number", type="boolean", nullable=true)
     */
    private $hideTailNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="real_tail_number", type="string", length=255, nullable=true)
     */
    private $realTailNumber;


    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name . " - #" . $this->tailNumber;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emptylegs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return CharterAircraft
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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getModel() ? $this->getModel()->getType() : null;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return CharterAircraft
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set tailNumber
     *
     * @param string $tailNumber
     * @return CharterAircraft
     */
    public function setTailNumber($tailNumber)
    {
        $this->tailNumber = $tailNumber;

        return $this;
    }

    /**
     * Get tailNumber
     *
     * @return string
     */
    public function getTailNumber()
    {
        return $this->tailNumber;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return CharterAircraft
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set availableFrom
     *
     * @param \DateTime $availableFrom
     * @return CharterAircraft
     */
    public function setAvailableFrom($availableFrom)
    {
        $this->availableFrom = $availableFrom;

        return $this;
    }

    /**
     * Get availableFrom
     *
     * @return \DateTime
     */
    public function getAvailableFrom()
    {
        return $this->availableFrom;
    }

    /**
     * Set availableTo
     *
     * @param \DateTime $availableTo
     * @return CharterAircraft
     */
    public function setAvailableTo($availableTo)
    {
        $this->availableTo = $availableTo;

        return $this;
    }

    /**
     * Get availableTo
     *
     * @return \DateTime
     */
    public function getAvailableTo()
    {
        return $this->availableTo;
    }

    /**
     * Set hourlyRate
     *
     * @param integer $hourlyRate
     * @return CharterAircraft
     */
    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate * 100;

        return $this;
    }

    /**
     * Get hourlyRate
     *
     * @return integer
     */
    public function getHourlyRate()
    {
        return $this->hourlyRate / 100;
    }

    /**
     * Set hourlyRate2
     *
     * @param integer $hourlyRate2
     * @return CharterAircraft
     */
    public function setHourlyRate2($hourlyRate2)
    {
        $this->hourlyRate2 = $hourlyRate2 * 100;

        return $this;
    }

    /**
     * Get hourlyRate2
     *
     * @return integer
     */
    public function getHourlyRate2()
    {
        return $this->hourlyRate2 / 100;
    }

    /**
     * Set airAmbulance
     *
     * @param boolean $airAmbulance
     * @return CharterAircraft
     */
    public function setAirAmbulance($airAmbulance)
    {
        $this->airAmbulance = $airAmbulance;

        return $this;
    }

    /**
     * Get airAmbulance
     *
     * @return boolean
     */
    public function getAirAmbulance()
    {
        return $this->airAmbulance;
    }

    /**
     * Set hideTailNumber
     *
     * @param boolean $hideTailNumber
     * @return CharterAircraft
     */
    public function setHideTailNumber($hideTailNumber)
    {
        $this->hideTailNumber = $hideTailNumber;

        return $this;
    }

    /**
     * Get hideTailNumber
     *
     * @return boolean
     */
    public function getHideTailNumber()
    {
        return $this->hideTailNumber;
    }

    /**
     * Set realTailNumber
     *
     * @param string $realTailNumber
     * @return CharterAircraft
     */
    public function setRealTailNumber($realTailNumber)
    {
        $this->realTailNumber = $realTailNumber;

        return $this;
    }

    /**
     * Get realTailNumber
     *
     * @return string
     */
    public function getRealTailNumber()
    {
        return $this->realTailNumber;
    }

    /**
     * Set operator
     *
     * @param \JetCharters\AppBundle\Entity\Operator $operator
     * @return CharterAircraft
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

    /**
     * Get company
     *
     * @return string
     */
    public function getCompanyName()
    {
        if ($this->operator)
            return $this->operator->getName();
        else
            return "None";
    }

    /**
     * Add emptylegs
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs
     * @return CharterAircraft
     */
    public function addEmptyleg(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs)
    {
        $emptylegs->setAircraft($this);
        $this->emptylegs[] = $emptylegs;

        return $this;
    }

    /**
     * Remove emptylegs
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs
     */
    public function removeEmptyleg(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs)
    {
        $this->emptylegs->removeElement($emptylegs);
    }

    /**
     * Get emptylegs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmptylegs()
    {
        return $this->emptylegs;
    }

    /**
     * Add statuslog
     *
     * @param \JetCharters\AppBundle\Entity\AircraftStatusLog $statuslog
     * @return CharterAircraft
     */
    public function addStatuslog(\JetCharters\AppBundle\Entity\AircraftStatusLog $statuslog)
    {
        $this->statuslog[] = $statuslog;

        return $this;
    }

    /**
     * Remove statuslog
     *
     * @param \JetCharters\AppBundle\Entity\AircraftStatusLog $statuslog
     */
    public function removeStatuslog(\JetCharters\AppBundle\Entity\AircraftStatusLog $statuslog)
    {
        $this->statuslog->removeElement($statuslog);
    }

    /**
     * Get statuslog
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatuslog()
    {
        return $this->statuslog;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return CharterAircraft
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add images
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftImage $images
     * @return CharterAircraft
     */
    public function addImage(\JetCharters\AppBundle\Entity\CharterAircraftImage $image)
    {
        $image->setAircraft($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftImage $images
     */
    public function removeImage(\JetCharters\AppBundle\Entity\CharterAircraftImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set Model
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $Model
     * @return CharterAircraft
     */
    public function setModel(\JetCharters\AppBundle\Entity\AircraftModel $Model = null)
    {
        $this->model = $Model;

        return $this;
    }

    /**
     * Get Model
     *
     * @return \JetCharters\AppBundle\Entity\AircraftModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return AircraftModel
     * @deprecated
     */
    public function getAircraftModel() {
        return $this->getModel();
    }

    /**
     * @param AircraftModel $model
     * @deprecated
     */
    public function setAircraftModel(AircraftModel $model) {
        $this->setModel($model);
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return CharterAircraft
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set videoName
     *
     * @param string $videoName
     * @return CharterAircraft
     */
    public function setVideoName($videoName)
    {
        $this->videoName = $videoName;

        return $this;
    }

    /**
     * Get videoName
     *
     * @return string
     */
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * Add videos
     *
     * @param \JetCharters\AppBundle\Entity\Video $videos
     * @return CharterAircraft
     */
    public function addVideo(\JetCharters\AppBundle\Entity\Video $videos)
    {
        $this->videos[] = $videos;

        return $this;
    }

    /**
     * Remove videos
     *
     * @param \JetCharters\AppBundle\Entity\Video $videos
     */
    public function removeVideo(\JetCharters\AppBundle\Entity\Video $videos)
    {
        $this->videos->removeElement($videos);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }
}

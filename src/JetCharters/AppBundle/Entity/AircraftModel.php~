<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Cocur\Slugify\Slugify;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\AircraftModelRepository")
 * @ORM\Table(name="aircraft_models")
 * @Vich\Uploadable
 */

class AircraftModel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="has_lavatory")
     */
    protected $hasLavatory = false;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="number_of_seats")
     */
    protected $numberOfSeats;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="max_range")
     */
    protected $maxRange;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="max_air_speed")
     */
    protected $maxAirSpeed;

    /**
     * @var string
     * @ORM\Column(type="text", name="description")
     */
    protected $description;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="is_featured_ac")
     */
    protected $isFeaturedAC = false;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="featured_ac_rank")
     */
    protected $featuredACRank;

    /**
     * @var
     * @ORM\Column(type="string", name="slug")
     */
    protected $slug;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="AircraftType", inversedBy="aircraftModel")
     */
    protected $type;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="CharterAircraft", mappedBy="model")
     */
    protected $charterAircraft;

    /**
     * @ORM\OneToMany(targetEntity="AircraftModelImage", mappedBy="aircraft", cascade={"all"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="Video", mappedBy="aircraftModel", cascade={"all"})
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true);
     */
    private $alternateNames;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->charterAircraft = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @return AircraftModel
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
     * Set hasLavatory
     *
     * @param boolean $hasLavatory
     * @return AircraftModel
     */
    public function setHasLavatory($hasLavatory)
    {
        $this->hasLavatory = $hasLavatory;

        return $this;
    }

    /**
     * Get hasLavatory
     *
     * @return boolean
     */
    public function getHasLavatory()
    {
        return $this->hasLavatory;
    }

    /**
     * Set numberOfSeats
     *
     * @param integer $numberOfSeats
     * @return AircraftModel
     */
    public function setNumberOfSeats($numberOfSeats)
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    /**
     * Get numberOfSeats
     *
     * @return integer
     */
    public function getNumberOfSeats()
    {
        return $this->numberOfSeats;
    }

    /**
     * Set maxRange
     *
     * @param integer $maxRange
     * @return AircraftModel
     */
    public function setMaxRange($maxRange)
    {
        $this->maxRange = $maxRange;

        return $this;
    }

    /**
     * Get maxRange
     *
     * @return integer
     */
    public function getMaxRange()
    {
        return $this->maxRange;
    }

    /**
     * Set maxAirSpeed
     *
     * @param integer $maxAirSpeed
     * @return AircraftModel
     */
    public function setMaxAirSpeed($maxAirSpeed)
    {
        $this->maxAirSpeed = $maxAirSpeed;

        return $this;
    }

    /**
     * Get maxAirSpeed
     *
     * @return integer
     */
    public function getMaxAirSpeed()
    {
        return $this->maxAirSpeed;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AircraftModel
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
     * Set isFeaturedAC
     *
     * @param boolean $isFeaturedAC
     * @return AircraftModel
     */
    public function setIsFeaturedAC($isFeaturedAC)
    {
        $this->isFeaturedAC = $isFeaturedAC;

        return $this;
    }

    /**
     * Get isFeaturedAC
     *
     * @return boolean
     */
    public function getIsFeaturedAC()
    {
        return $this->isFeaturedAC;
    }

    /**
     * Set featuredACRank
     *
     * @param integer $featuredACRank
     * @return AircraftModel
     */
    public function setFeaturedACRank($featuredACRank)
    {
        $this->featuredACRank = $featuredACRank;

        return $this;
    }

    /**
     * Get featuredACRank
     *
     * @return integer
     */
    public function getFeaturedACRank()
    {
        return $this->featuredACRank;
    }

    /**
     * Add charterAircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft
     * @return AircraftModel
     */
    public function addCharterAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft)
    {
        $this->charterAircraft[] = $charterAircraft;

        return $this;
    }

    /**
     * Remove charterAircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft
     */
    public function removeCharterAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft)
    {
        $this->charterAircraft->removeElement($charterAircraft);
    }

    /**
     * Get charterAircraft
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharterAircraft()
    {
        return $this->charterAircraft;
    }

    /**
     * Add images
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $images
     * @return AircraftModel
     */
    public function addImage(\JetCharters\AppBundle\Entity\AircraftModelImage $images)
    {
        $images->setAircraft($this);
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $images
     */
    public function removeImage(\JetCharters\AppBundle\Entity\AircraftModelImage $images)
    {
        $this->images->removeElement($images);
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
     * Set slug
     *
     * @param string $slug
     * @return AircraftModel
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function __toString() {
        return $this->getName();
    }

    /**
     * Set type
     *
     * @param string $type
     * @return AircraftModel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateSlug() {
        if ( empty($this->slug) ) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
    }


    /**
     * Add videos
     *
     * @param \JetCharters\AppBundle\Entity\Video $videos
     * @return AircraftModel
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

    /**
     * Set alternateNames
     *
     * @param string $alternateNames
     * @return AircraftModel
     */
    public function setAlternateNames($alternateNames)
    {
        $this->alternateNames = $alternateNames;

        return $this;
    }

    /**
     * Get alternateNames
     *
     * @return string 
     */
    public function getAlternateNames()
    {
        return $this->alternateNames;
    }
}

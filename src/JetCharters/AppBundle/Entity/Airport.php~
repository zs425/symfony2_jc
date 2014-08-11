<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Airport
 *
 * @ORM\Table(name="airports")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\AirportRepository")
 */
class Airport
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
     * @ORM\Column(name="lfi_code", type="string", length=255, unique=true)
     */
    private $lfiCode;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="icao_code", type="string", length=10, nullable=true)
     */
    private $icaoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="iata_code", type="string", length=10, nullable=true)
     */
    private $iataCode;

    /**
     * @var string
     *
     * @ORM\Column(name="faa_code", type="string", length=10)
     */
    private $faaCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="country_code", type="string", length=10)
     */
    private $countryCode;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=20)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=20)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="n_latitude", type="string", length=20)
     */
    private $nLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="n_longitude", type="string", length=20)
     */
    private $nLongitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="elevation", type="integer")
     */
    private $elevation;

    /**
     * @var string
     *
     * @ORM\Column(name="operating_hours", type="string", length=100, nullable=true)
     */
    private $operatingHours;

    /**
     * @var integer
     *
     * @ORM\Column(name="utc_conversion", type="integer")
     */
    private $utcConversion;

    /**
     * @var string
     *
     * @ORM\Column(name="closest_city", type="string", length=255, nullable=true)
     */
    private $closestCity;

    /**
     * @var float
     *
     * @ORM\Column(name="closest_city_distance_miles", type="float")
     */
    private $closestCityDistanceMiles = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="closest_city_distance_km", type="float")
     */
    private $closestCityDistanceKm = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="central_business_direction", type="string", length=1, nullable=true)
     */
    private $centralBusinessDirection;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_runway", type="integer")
     */
    private $maxRunway = 0;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="CharterAircraft", mappedBy="location")
     */
    protected $charterAircraft;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraftEmptyLeg", mappedBy="origin")
     */
    private $emptyLegOrigin;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraftEmptyLeg", mappedBy="destination")
     */
    private $emptyLegDestination;

    /**
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

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
     * Set lfiCode
     *
     * @param string $lfiCode
     * @return Airport
     */
    public function setLfiCode($lfiCode)
    {
        $this->lfiCode = $lfiCode;

        return $this;
    }

    /**
     * Get lfiCode
     *
     * @return string 
     */
    public function getLfiCode()
    {
        return $this->lfiCode;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Airport
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
     * Set icaoCode
     *
     * @param string $icaoCode
     * @return Airport
     */
    public function setIcaoCode($icaoCode)
    {
        $this->icaoCode = $icaoCode;

        return $this;
    }

    /**
     * Get icaoCode
     *
     * @return string 
     */
    public function getIcaoCode()
    {
        return $this->icaoCode;
    }

    /**
     * Set iataCode
     *
     * @param string $iataCode
     * @return Airport
     */
    public function setIataCode($iataCode)
    {
        $this->iataCode = $iataCode;

        return $this;
    }

    /**
     * Get iataCode
     *
     * @return string 
     */
    public function getIataCode()
    {
        return $this->iataCode;
    }

    /**
     * Set faaCode
     *
     * @param string $faaCode
     * @return Airport
     */
    public function setFaaCode($faaCode)
    {
        $this->faaCode = $faaCode;

        return $this;
    }

    /**
     * Get faaCode
     *
     * @return string 
     */
    public function getFaaCode()
    {
        return $this->faaCode;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Airport
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
     * Set city
     *
     * @param string $city
     * @return Airport
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Airport
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode
     * @return Airport
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return string 
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Airport
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Airport
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set elevation
     *
     * @param integer $elevation
     * @return Airport
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * Get elevation
     *
     * @return integer 
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * Set operatingHours
     *
     * @param string $operatingHours
     * @return Airport
     */
    public function setOperatingHours($operatingHours)
    {
        $this->operatingHours = $operatingHours;

        return $this;
    }

    /**
     * Get operatingHours
     *
     * @return string 
     */
    public function getOperatingHours()
    {
        return $this->operatingHours;
    }

    /**
     * Set utcConversion
     *
     * @param integer $utcConversion
     * @return Airport
     */
    public function setUtcConversion($utcConversion)
    {
        $this->utcConversion = $utcConversion;

        return $this;
    }

    /**
     * Get utcConversion
     *
     * @return integer 
     */
    public function getUtcConversion()
    {
        return $this->utcConversion;
    }

    /**
     * Set closestCity
     *
     * @param string $closestCity
     * @return Airport
     */
    public function setClosestCity($closestCity)
    {
        $this->closestCity = $closestCity;

        return $this;
    }

    /**
     * Get closestCity
     *
     * @return string 
     */
    public function getClosestCity()
    {
        return $this->closestCity;
    }

    /**
     * Set closestCityDistanceMiles
     *
     * @param float $closestCityDistanceMiles
     * @return Airport
     */
    public function setClosestCityDistanceMiles($closestCityDistanceMiles)
    {
        $this->closestCityDistanceMiles = $closestCityDistanceMiles;

        return $this;
    }

    /**
     * Get closestCityDistanceMiles
     *
     * @return float 
     */
    public function getClosestCityDistanceMiles()
    {
        return $this->closestCityDistanceMiles;
    }

    /**
     * Set closestCityDistanceKm
     *
     * @param float $closestCityDistanceKm
     * @return Airport
     */
    public function setClosestCityDistanceKm($closestCityDistanceKm)
    {
        $this->closestCityDistanceKm = $closestCityDistanceKm;

        return $this;
    }

    /**
     * Get closestCityDistanceKm
     *
     * @return float 
     */
    public function getClosestCityDistanceKm()
    {
        return $this->closestCityDistanceKm;
    }

    /**
     * Set centralBusinessDirection
     *
     * @param string $centralBusinessDirection
     * @return Airport
     */
    public function setCentralBusinessDirection($centralBusinessDirection)
    {
        $this->centralBusinessDirection = $centralBusinessDirection;

        return $this;
    }

    /**
     * Get centralBusinessDirection
     *
     * @return string 
     */
    public function getCentralBusinessDirection()
    {
        return $this->centralBusinessDirection;
    }

    /**
     * Set maxRunway
     *
     * @param integer $maxRunway
     * @return Airport
     */
    public function setMaxRunway($maxRunway)
    {
        $this->maxRunway = $maxRunway;

        return $this;
    }

    /**
     * Get maxRunway
     *
     * @return integer 
     */
    public function getMaxRunway()
    {
        return $this->maxRunway;
    }

    /**
     * Set totalAircraft
     *
     * @param integer $totalAircraft
     * @return Airport
     */
    public function setTotalAircraft($totalAircraft)
    {
        $this->totalAircraft = $totalAircraft;

        return $this;
    }

    /**
     * Get totalAircraft
     *
     * @return integer 
     */
    public function getTotalAircraft()
    {
        return $this->totalAircraft;
    }

    public function __toString() {
        return $this->getIcaoCode() . ' - ' . $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->charterAircraft = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add charterAircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft
     * @return Airport
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
     * Set nLatitude
     *
     * @param string $nLatitude
     * @return Airport
     */
    public function setNLatitude($nLatitude)
    {
        $this->nLatitude = $nLatitude;

        return $this;
    }

    /**
     * Get nLatitude
     *
     * @return string 
     */
    public function getNLatitude()
    {
        return $this->nLatitude;
    }

    /**
     * Set nLongitude
     *
     * @param string $nLongitude
     * @return Airport
     */
    public function setNLongitude($nLongitude)
    {
        $this->nLongitude = $nLongitude;

        return $this;
    }

    /**
     * Get nLongitude
     *
     * @return string 
     */
    public function getNLongitude()
    {
        return $this->nLongitude;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Airport
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

    /**
     * Add emptyLeg
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLeg
     * @return Airport
     */
    public function addEmptyLeg(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLeg)
    {
        $this->emptyLeg[] = $emptyLeg;

        return $this;
    }

    /**
     * Remove emptyLeg
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLeg
     */
    public function removeEmptyLeg(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLeg)
    {
        $this->emptyLeg->removeElement($emptyLeg);
    }

    /**
     * Get emptyLeg
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmptyLeg()
    {
        return $this->emptyLeg;
    }

    public function getAirportCode() {
        if ( !empty($this->faaCode) ) {
            return $this->getFaaCode();
        } elseif ( !empty($this->icaoCode) ) {
            return $this->getIcaoCode();
        } elseif ( !empty($this->iataCode) ) {
            return $this->getIataCode();
        } else {
            return 'ERROR';
        }
    }

    /**
     * Add emptyLegOrigin
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegOrigin
     * @return Airport
     */
    public function addEmptyLegOrigin(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegOrigin)
    {
        $this->emptyLegOrigin[] = $emptyLegOrigin;

        return $this;
    }

    /**
     * Remove emptyLegOrigin
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegOrigin
     */
    public function removeEmptyLegOrigin(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegOrigin)
    {
        $this->emptyLegOrigin->removeElement($emptyLegOrigin);
    }

    /**
     * Get emptyLegOrigin
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmptyLegOrigin()
    {
        return $this->emptyLegOrigin;
    }

    /**
     * Add emptyLegDestination
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegDestination
     * @return Airport
     */
    public function addEmptyLegDestination(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegDestination)
    {
        $this->emptyLegDestination[] = $emptyLegDestination;

        return $this;
    }

    /**
     * Remove emptyLegDestination
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegDestination
     */
    public function removeEmptyLegDestination(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptyLegDestination)
    {
        $this->emptyLegDestination->removeElement($emptyLegDestination);
    }

    /**
     * Get emptyLegDestination
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmptyLegDestination()
    {
        return $this->emptyLegDestination;
    }
}

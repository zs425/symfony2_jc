<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AircraftType
 *
 * @ORM\Table(name="aircraft_types")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\AircraftTypeRepository")
 */
class AircraftType
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", length=1);)
     */
    private $class;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="AircraftModel", mappedBy="type")
     */
    protected $aircraftModel;


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
     * @return AircraftType
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
     * Set slug
     *
     * @param string $slug
     * @return AircraftType
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
     * Constructor
     */
    public function __construct()
    {
        $this->aircraftModel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add aircraftModel
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $aircraftModel
     * @return AircraftType
     */
    public function addAircraftModel(\JetCharters\AppBundle\Entity\AircraftModel $aircraftModel)
    {
        $this->aircraftModel[] = $aircraftModel;

        return $this;
    }

    /**
     * Remove aircraftModel
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $aircraftModel
     */
    public function removeAircraftModel(\JetCharters\AppBundle\Entity\AircraftModel $aircraftModel)
    {
        $this->aircraftModel->removeElement($aircraftModel);
    }

    /**
     * Get aircraftModel
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAircraftModel()
    {
        return $this->aircraftModel;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set class
     *
     * @param integer $class
     * @return AircraftType
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return integer 
     */
    public function getClass()
    {
        return $this->class;
    }
}

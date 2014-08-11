<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Aircraft Image
 *
 * @ORM\Table(name="aircraft_model_images")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class AircraftModelImage
{
    const IMAGEPATH = '/uploads/aircraft/';

    private $webpath = 'aircraft-models/images/';

    /**
     * @ORM\ManyToOne(targetEntity="AircraftModel", inversedBy="images")
     */
    private $aircraft;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="aircraft", fileNameProperty="imageName")
     *
     * @var File $image
     */
    protected $image;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     *
     * @var string $imageName
     */
    protected $imageName;


    /**
     * Set imageName
     *
     * @param string $imageName
     * @return CharterAircraft
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     */
    public function getImage()
    {
        return $this->image;
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
     * Set aircraft
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $aircraft
     * @return AircraftModelImage
     */
    public function setAircraft(\JetCharters\AppBundle\Entity\AircraftModel $aircraft = null)
    {
        $this->aircraft = $aircraft;

        return $this;
    }

    /**
     * Get aircraft
     *
     * @return \JetCharters\AppBundle\Entity\AircraftModel 
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }

    public function getWebPath() {
        return AircraftModelImage::IMAGEPATH . $this->getImageName();
    }
}

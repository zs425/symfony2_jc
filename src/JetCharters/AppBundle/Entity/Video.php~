<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="videos")
 * @Vich\Uploadable
 */

class Video
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AircraftModel", inversedBy="videos", cascade={"persist"})
     */
    private $aircraftModel;

    /**
     * @ORM\ManyToOne(targetEntity="CharterAircraft", inversedBy="videos", cascade={"persist"})
     */
    private $charterAircraft;


    /**
     * @Assert\File(
     *     maxSize="100M",
     *     mimeTypes={"video/x-ms-asf", "video/x-flv", "video/mp4", "video/quicktime", "video/x-msvideo", "video/x-ms-wmv", "video/webm", "video/ogg"}
     * )
     * @Vich\UploadableField(mapping="videos", fileNameProperty="videoName")
     *
     * @var File $video
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=255, name="video_name", nullable=true)
     *
     * @var string $videoName
     */
    private $videoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * Required for video upload to work
     *
     * @var \DateTime $updatedAt
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, name="video_size", nullable=true)
     *
     * @var string $size
     */
    private $size;

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
     * Set video
     *
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;

        if ($this->video) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Video
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
     * Set aircraftModel
     *
     * @param \JetCharters\AppBundle\Entity\AircraftModel $aircraftModel
     * @return Video
     */
    public function setAircraftModel(\JetCharters\AppBundle\Entity\AircraftModel $aircraftModel = null)
    {
        $this->aircraftModel = $aircraftModel;

        return $this;
    }

    /**
     * Get aircraftModel
     *
     * @return \JetCharters\AppBundle\Entity\AircraftModel
     */
    public function getAircraftModel()
    {
        return $this->aircraftModel;
    }

    /**
     * Set charterAircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft
     * @return Video
     */
    public function setCharterAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $charterAircraft = null)
    {
        $this->charterAircraft = $charterAircraft;

        return $this;
    }

    /**
     * Get charterAircraft
     *
     * @return \JetCharters\AppBundle\Entity\CharterAircraft
     */
    public function getCharterAircraft()
    {
        return $this->charterAircraft;
    }



    /**
     * Set size
     *
     * @param string $size
     * @return Video
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }
}

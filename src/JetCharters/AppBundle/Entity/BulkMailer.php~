<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * BulkMailer
 *
 * @ORM\Table(name="bulk_mailers")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\BulkMailerRepository")
 * @Vich\Uploadable
 */
class BulkMailer
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
     * @ORM\Column(name="list", type="string", length=255)
     */
    private $list;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_datetime", type="datetime")
     */
    private $sendTime;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="images", fileNameProperty="headerImageName")
     *
     * @var File $image
     */
    protected $headerImage;

    /**
     * @ORM\Column(type="string", length=255, name="headerimage_name")
     *
     * @var string $headerImageName
     */
    protected $headerImageName;

    /**
     * @var string
     *
     * @ORM\Column(name="top_link", type="string", length=255)
     */
    private $topLink;

    /**
     * @var string
     *
     * @ORM\Column(name="bottom_link", type="string", length=255)
     */
    private $bottomLink;

    /**
     * @var string
     *
     * @ORM\Column(name="mailer_body", type="text")
     */
    private $mailerBody;


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
     * Set list
     *
     * @param string $list
     * @return BulkMailer
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set sendTime
     *
     * @param \DateTime $sendTime
     * @return BulkMailer
     */
    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;

        return $this;
    }

    /**
     * Get sendTime
     *
     * @return \DateTime
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return BulkMailer
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set headerImage
     */
    public function setHeaderImage($headerImage)
    {
        $this->headerImage = $headerImage;

        return $this;
    }

    /**
     * Get headerImage
     */
    public function getHeaderImage()
    {
        return $this->headerImage;
    }

    /**
     * Set topLink
     *
     * @param string $topLink
     * @return BulkMailer
     */
    public function setTopLink($topLink)
    {
        $this->topLink = $topLink;

        return $this;
    }

    /**
     * Get topLink
     *
     * @return string
     */
    public function getTopLink()
    {
        return $this->topLink;
    }

    /**
     * Set bottomLink
     *
     * @param string $bottomLink
     * @return BulkMailer
     */
    public function setBottomLink($bottomLink)
    {
        $this->bottomLink = $bottomLink;

        return $this;
    }

    /**
     * Get bottomLink
     *
     * @return string
     */
    public function getBottomLink()
    {
        return $this->bottomLink;
    }

    /**
     * Set mailerBody
     *
     * @param string $mailerBody
     * @return BulkMailer
     */
    public function setMailerBody($mailerBody)
    {
        $this->mailerBody = $mailerBody;

        return $this;
    }

    /**
     * Get mailerBody
     *
     * @return string
     */
    public function getMailerBody()
    {
        return $this->mailerBody;
    }

    /**
     * Set headerImageName
     *
     * @param string $headerImageName
     * @return BulkMailer
     */
    public function setHeaderImageName($headerImageName)
    {
        $this->headerImageName = $headerImageName;

        return $this;
    }

    /**
     * Get headerImageName
     *
     * @return string
     */
    public function getHeaderImageName()
    {
        return $this->headerImageName;
    }
}

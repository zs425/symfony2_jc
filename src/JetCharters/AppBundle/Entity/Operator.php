<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Operator
 *
 * @ORM\Table(name="operators")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\OperatorRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 * @UniqueEntity(fields = "slug", message="Slug is already in use.")
 */
class Operator
{
    const IMAGEPATH = '/uploads/operator/';

    /**
     * @ORM\OneToMany(targetEntity="OperatorUser", mappedBy="operator", cascade={"persist", "remove"})
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraft", mappedBy="operator", cascade={"persist", "remove"})
     */
    private $aircraft;

    /**
     * @ORM\OneToMany(targetEntity="CharterAircraftEmptyLeg", mappedBy="operator", cascade={"persist", "remove"})
     */
    private $emptylegs;

    /**
     * @ORM\ManyToOne(targetEntity="OperatorUser", cascade={"persist", "remove"})
     */
    private $billingUser;

    /**
     * @ORM\ManyToOne(targetEntity="Administrator")
     */
    private $salesAdmin;
    
    /** 
     * @ORM\OneToMany(targetEntity="OperatorBillingInformation", mappedBy="operator", cascade={"persist"})
     **/
    private $operatorBillingInformation;



    /**
     * @ORM\Column(type="datetime", name="updated_at")
     *
     * @var \DateTime $updatedAt
     */
    protected $updatedAt;

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
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="operator", fileNameProperty="logoName")
     *
     * @var File $logo
     */
    protected $logo;


    /**
     * @ORM\Column(type="string", length=255, name="logo_name", nullable=true)
     *
     * @var string $logoName
     */
    protected $logoName;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"application/pdf"}
     * )
     * @Vich\UploadableField(mapping="specsheets", fileNameProperty="specSheet")
     *
     * @var File $logo
     */
//    protected $spec;

    /**
     * @ORM\Column(type="string", length=255, name="spec_sheet", nullable=true)
     *
     * @var string $logoName
     */
    protected $specSheet;

    /**
     * @Assert\File(
     *     maxSize="100M",
     *     mimeTypes={"video/x-ms-asf", "video/x-flv", "video/mp4", "video/quicktime", "video/x-msvideo", "video/x-ms-wmv", "video/webm", "video/ogg"}
     * )
     * @Vich\UploadableField(mapping="videos", fileNameProperty="videoName")
     *
     * @var File $video
     */
    protected $video;

    /**
     * @ORM\Column(type="string", length=255, name="video_name", nullable=true)
     *
     * @var string $videoName
     */
    protected $videoName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="certificate_number", type="string", length=255)
     */
    private $certificateNumber = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_argus_logo", type="boolean")
     */
    private $showArgusLogo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_wyvern_logo", type="boolean")
     */
    private $showWyvernLogo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_acsf_logo", type="boolean")
     */
    private $showACSFLogo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_isbao_logo", type="boolean")
     */
    private $showISBAOLogo = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="show_faa_logo", type="boolean")
     */
    private $showFaaLogo = false;


    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    private $about;

    /**
     * @var
     * @ORM\Column(name="contact_name", type="string", length=100, nullable=true)
     */
    private $contactName;

    /**
     * @var
     * @ORM\Column(name="contact_phone", type="string", length=100, nullable=true)
     */
    private $contactPhone;

    /**
     * @var
     * @ORM\Column(name="address1", type="string", length=100, nullable=true)
     */
    private $address1;

    /**
     * @var
     * @ORM\Column(name="address2", type="string", length=100, nullable=true)
     */
    private $address2;

    /**
     * @var
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var
     * @ORM\Column(name="zipcode", type="string", length=12, nullable=true)
     */
    private $zipcode = '';

    /**
     * @var
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     */
    private $country = '';

    /**
     * @var
     * @ORM\Column(name="facebook_url", type="string", length=100, nullable=true)
     */
    private $facebookUrl = '';

    /**
     * @var
     * @ORM\Column(name="linkein_url", type="string", length=100, nullable=true)
     */
    private $linkedinUrl = '';

    /**
     * @var
     * @ORM\Column(name="twitter_url", type="string", length=100, nullable=true)
     */
    private $twitterUrl = '';

    /**
     * @var
     * @ORM\Column(name="google_url", type="string", length=100, nullable=true)
     */
    private $googleUrl = '';

    /**
     * @var
     * @ORM\Column(name="youtube_url", type="string", length=100, nullable=true)
     */
    private $youtubeUrl = '';

    /**
     * @var
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @ORM\Column(name="email_verified", type="boolean")
     */
    private $emailVerified = false;

    /**
     * @ORM\Column(name="send_invoice", type="boolean")
     */
    private $sendInvoice = false;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_2 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_3 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_4 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_5 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_6 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_7 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_8 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_airplane_cost_9 = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_account_cost = 0;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $billing_cycle = 'free';

    /**
     * @ORM\Column(type="date")
     */
    private $billing_next_due;

    /**
     * @ORM\Column(type="boolean")
     */
    private $billing_auto_renew = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $billing_credit = 0;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $marketing_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $marketing_forward_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $marketing_call_recording = false;

    /**
     * @ORM\ManyToOne(targetEntity="BillingPlan", inversedBy="operators")
     * @ORM\JoinColumn(name="billing_plan_id", referencedColumnName="id")

     */
    private $billingPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="n_latitude", type="string", length=20, nullable=true)
     */
    private $nLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="n_longitude", type="string", length=20, nullable=true)
     */
    private $nLongitude;


    /**
     * @var boolean
     *
     * @ORM\Column(name="call_recording", type="boolean")
     */
    private $callRecording = false;

    public function __toString() {
        return $this->name;
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
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->aircraft = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emptylegs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set logoName
     *
     * @param string $logoName
     * @return Operator
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get logoName
     *
     * @return string
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * Set videoName
     *
     * @param string $videoName
     * @return Operator
     */
    public function setVideoName($videoName)
    {
        $this->videoName = $videoName;

        return $this;
    }

    /**
     * Get videoName
     */
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * Set video
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
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Operator
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
     * Set website
     *
     * @param string $website
     * @return Operator
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set certificateNumber
     *
     * @param string $certificateNumber
     * @return Operator
     */
    public function setCertificateNumber($certificateNumber)
    {
        $this->certificateNumber = $certificateNumber;

        return $this;
    }

    /**
     * Get certificateNumber
     *
     * @return string
     */
    public function getCertificateNumber()
    {
        return $this->certificateNumber;
    }

    /**
     * Set showArgusLogo
     *
     * @param boolean $showArgusLogo
     * @return Operator
     */
    public function setShowArgusLogo($showArgusLogo)
    {
        $this->showArgusLogo = $showArgusLogo;

        return $this;
    }

    /**
     * Get showArgusLogo
     *
     * @return boolean
     */
    public function getShowArgusLogo()
    {
        return $this->showArgusLogo;
    }

    /**
     * Set showWyvernLogo
     *
     * @param boolean $showWyvernLogo
     * @return Operator
     */
    public function setShowWyvernLogo($showWyvernLogo)
    {
        $this->showWyvernLogo = $showWyvernLogo;

        return $this;
    }

    /**
     * Get showWyvernLogo
     *
     * @return boolean
     */
    public function getShowWyvernLogo()
    {
        return $this->showWyvernLogo;
    }

    /**
     * Set showACSFLogo
     *
     * @param boolean $showACSFLogo
     * @return Operator
     */
    public function setShowACSFLogo($showACSFLogo)
    {
        $this->showACSFLogo = $showACSFLogo;

        return $this;
    }

    /**
     * Get showACSFLogo
     *
     * @return boolean
     */
    public function getShowACSFLogo()
    {
        return $this->showACSFLogo;
    }

    /**
     * Set showISBAOLogo
     *
     * @param boolean $showISBAOLogo
     * @return Operator
     */
    public function setShowISBAOLogo($showISBAOLogo)
    {
        $this->showISBAOLogo = $showISBAOLogo;

        return $this;
    }

    /**
     * Get showISBAOLogo
     *
     * @return boolean
     */
    public function getShowISBAOLogo()
    {
        return $this->showISBAOLogo;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return Operator
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Add operators
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $operators
     * @return Operator
     */
    public function addOperator(\JetCharters\AppBundle\Entity\OperatorUser $operators)
    {
        $this->operators[] = $operators;

        return $this;
    }

    /**
     * Remove operators
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $operators
     */
    public function removeOperator(\JetCharters\AppBundle\Entity\OperatorUser $operators)
    {
        $this->operators->removeElement($operators);
    }

    /**
     * Get operators
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOperators()
    {
        return $this->operators;
    }

    /**
     * Add aircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $aircraft
     * @return Operator
     */
    public function addAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $aircraft)
    {
        $aircraft->setOperator($this);
        $this->aircraft[] = $aircraft;

        return $this;
    }

    /**
     * Remove aircraft
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraft $aircraft
     */
    public function removeAircraft(\JetCharters\AppBundle\Entity\CharterAircraft $aircraft)
    {
        $this->aircraft->removeElement($aircraft);
    }

    /**
     * Get aircraft
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAircraft()
    {
        return $this->aircraft;
    }

    /**
     * Add emptylegs
     *
     * @param \JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs
     * @return Operator
     */
    public function addEmptyleg(\JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg $emptylegs)
    {
        $emptylegs->setOperator($this);
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Operator
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
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function setUpdatedAtCallback() {
        $this->setUpdatedAt(new \DateTime("now", new \DateTimeZone("UTC")));

        if ( empty($this->slug) ) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->name);
        }
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Operator
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
     * Set contactName
     *
     * @param string $contactName
     * @return Operator
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return Operator
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return Operator
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Operator
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Operator
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
     * @return Operator
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
     * Set zipcode
     *
     * @param string $zipcode
     * @return Operator
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Operator
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set spec
     */
    public function setSpec($spec)
    {
        $this->spec = $spec;

        return $this;
    }

    /**
     * Get spec
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * Set specSheet
     *
     * @param string $specSheet
     * @return Operator
     */
    public function setSpecSheet($specSheet)
    {
        $this->specSheet = $specSheet;

        return $this;
    }

    /**
     * Get specSheet
     *
     * @return string
     */
    public function getSpecSheet()
    {
        return $this->specSheet;
    }

    /**
     * Set facebookUrl
     *
     * @param string $facebookUrl
     * @return Operator
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $this->formatUrl($facebookUrl);

        return $this;
    }

    /**
     * Get facebookUrl
     *
     * @return string
     */
    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    /**
     * Set linkedinUrl
     *
     * @param string $linkedinUrl
     * @return Operator
     */
    public function setLinkedinUrl($linkedinUrl)
    {
        $this->linkedinUrl = $this->formatUrl($linkedinUrl);

        return $this;
    }

    /**
     * Get linkedinUrl
     *
     * @return string
     */
    public function getLinkedinUrl()
    {
        return $this->linkedinUrl;
    }

    /**
     * Set twitterUrl
     *
     * @param string $twitterUrl
     * @return Operator
     */
    public function setTwitterUrl($twitterUrl)
    {
        $this->twitterUrl = $this->formatUrl($twitterUrl);

        return $this;
    }

    /**
     * Get twitterUrl
     *
     * @return string
     */
    public function getTwitterUrl()
    {
        return $this->twitterUrl;
    }

    /**
     * Set googleUrl
     *
     * @param string $googleUrl
     * @return Operator
     */
    public function setGoogleUrl($googleUrl)
    {
        $this->googleUrl = $this->formatUrl($googleUrl);

        return $this;
    }

    /**
     * Get googleUrl
     *
     * @return string
     */
    public function getGoogleUrl()
    {
        return $this->googleUrl;
    }

    /**
     * Set youtubeUrl
     *
     * @param string $youtubeUrl
     * @return Operator
     */
    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtubeUrl = $this->formatUrl($youtubeUrl);

        return $this;
    }

    /**
     * Get youtubeUrl
     *
     * @return string
     */
    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    /**
     * Set showFaaLogo
     *
     * @param boolean $showFaaLogo
     * @return Operator
     */
    public function setShowFaaLogo($showFaaLogo)
    {
        $this->showFaaLogo = $showFaaLogo;

        return $this;
    }

    /**
     * Get showFaaLogo
     *
     * @return boolean
     */
    public function getShowFaaLogo()
    {
        return $this->showFaaLogo;
    }

    /**
     * Set callRecording
     *
     * @param boolean $callRecording
     * @return Operator
     */
    public function setCallRecording($callRecording)
    {
        $this->callRecording = $callRecording;

        return $this;
    }

    /**
     * Get callRecording
     *
     * @return boolean 
     */
    public function getCallRecording()
    {
        return $this->callRecording;
    }

    private function formatUrl($url) {
        if ( !empty($url) ) {
            if ( substr($url, 0, 4) != 'http' ) {
                $url = sprintf("http://%s", $url);
            }
        }
        return $url;
    }

    /**
     * Set emailVerified
     *
     * @param boolean $emailVerified
     * @return Operator
     */
    public function setEmailVerified($emailVerified)
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    /**
     * Get emailVerified
     *
     * @return boolean 
     */
    public function getEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * Set sendInvoice
     *
     * @param boolean $sendInvoice
     * @return Operator
     */
    public function setSendInvoice($sendInvoice)
    {
        $this->sendInvoice = $sendInvoice;

        return $this;
    }

    /**
     * Get sendInvoice
     *
     * @return boolean 
     */
    public function getSendInvoice()
    {
        return $this->sendInvoice;
    }

    /**
     * Add users
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $users
     * @return Operator
     */
    public function addUser(\JetCharters\AppBundle\Entity\OperatorUser $users)
    {
        $users->setOperator($this);
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $users
     */
    public function removeUser(\JetCharters\AppBundle\Entity\OperatorUser $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set billingPlan
     *
     * @param \JetCharters\AppBundle\Entity\BillingPlan $billingPlan
     * @return Operator
     */
    public function setBillingPlan(\JetCharters\AppBundle\Entity\BillingPlan $billingPlan = null)
    {
        $this->billingPlan = $billingPlan;

        return $this;
    }

    /**
     * Get billingPlan
     *
     * @return \JetCharters\AppBundle\Entity\BillingPlan 
     */
    public function getBillingPlan()
    {
        return $this->billingPlan;
    }

    /**
     * Set billingUser
     *
     * @param \JetCharters\AppBundle\Entity\OperatorUser $billingUser
     * @return Operator
     */
    public function setBillingUser(\JetCharters\AppBundle\Entity\OperatorUser $billingUser = null)
    {
        $this->billingUser = $billingUser;

        return $this;
    }

    /**
     * Get billingUser
     *
     * @return \JetCharters\AppBundle\Entity\OperatorUser 
     */
    public function getBillingUser()
    {
        return $this->billingUser;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Operator
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set billing_airplane_cost
     *
     * @param integer $billingAirplaneCost
     * @return Operator
     */
    public function setBillingAirplaneCost($billingAirplaneCost)
    {
        $this->billing_airplane_cost = floatval($billingAirplaneCost) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost
     *
     * @return integer 
     */
    public function getBillingAirplaneCost()
    {
        return $this->billing_airplane_cost / 100;
    }

    /**
     * Set billing_account_cost
     *
     * @param integer $billingAccountCost
     * @return Operator
     */
    public function setBillingAccountCost($billingAccountCost)
    {
        $this->billing_account_cost = floatval($billingAccountCost) * 100;

        return $this;
    }

    /**
     * Get billing_account_cost
     *
     * @return integer 
     */
    public function getBillingAccountCost()
    {
        return $this->billing_account_cost / 100;
    }

    /**
     * Set billing_cycle
     *
     * @param string $billingCycle
     * @return Operator
     */
    public function setBillingCycle($billingCycle)
    {
        $this->billing_cycle = $billingCycle;

        return $this;
    }

    /**
     * Get billing_cycle
     *
     * @return string 
     */
    public function getBillingCycle()
    {
        return $this->billing_cycle;
    }

    /**
     * Set billing_next_due
     *
     * @param \DateTime $billingNextDue
     * @return Operator
     */
    public function setBillingNextDue($billingNextDue)
    {
        $this->billing_next_due = $billingNextDue;

        return $this;
    }

    /**
     * Get billing_next_due
     *
     * @return \DateTime 
     */
    public function getBillingNextDue()
    {
        return $this->billing_next_due;
    }

    /**
     * Set billing_auto_renew
     *
     * @param boolean $billingAutoRenew
     * @return Operator
     */
    public function setBillingAutoRenew($billingAutoRenew)
    {
        $this->billing_auto_renew = $billingAutoRenew;

        return $this;
    }

    /**
     * Get billing_auto_renew
     *
     * @return boolean 
     */
    public function getBillingAutoRenew()
    {
        return $this->billing_auto_renew;
    }

    /**
     * Set marketing_number
     *
     * @param integer $marketingNumber
     * @return Operator
     */
    public function setMarketingNumber($marketingNumber)
    {
        $this->marketing_number = $marketingNumber;

        return $this;
    }

    /**
     * Get marketing_number
     *
     * @return integer 
     */
    public function getMarketingNumber()
    {
        return $this->marketing_number;
    }

    /**
     * Set marketing_forward_number
     *
     * @param integer $marketingForwardNumber
     * @return Operator
     */
    public function setMarketingForwardNumber($marketingForwardNumber)
    {
        $this->marketing_forward_number = $marketingForwardNumber;

        return $this;
    }

    /**
     * Get marketing_forward_number
     *
     * @return integer 
     */
    public function getMarketingForwardNumber()
    {
        return $this->marketing_forward_number;
    }

    /**
     * Set marketing_call_recording
     *
     * @param boolean $marketingCallRecording
     * @return Operator
     */
    public function setMarketingCallRecording($marketingCallRecording)
    {
        $this->marketing_call_recording = $marketingCallRecording;

        return $this;
    }

    /**
     * Get marketing_call_recording
     *
     * @return boolean 
     */
    public function getMarketingCallRecording()
    {
        return $this->marketing_call_recording;
    }

    /**
     * Set salesAdmin
     *
     * @param \JetCharters\AppBundle\Entity\Administrator $salesAdmin
     * @return Operator
     */
    public function setSalesAdmin(\JetCharters\AppBundle\Entity\Administrator $salesAdmin = null)
    {
        $this->salesAdmin = $salesAdmin;

        return $this;
    }

    /**
     * Get salesAdmin
     *
     * @return \JetCharters\AppBundle\Entity\Administrator 
     */
    public function getSalesAdmin()
    {
        return $this->salesAdmin;
    }

    /**
     * Set billing_airplane_cost_2
     *
     * @param integer $billingAirplaneCost2
     * @return Operator
     */
    public function setBillingAirplaneCost2($billingAirplaneCost2)
    {
        $this->billing_airplane_cost_2 = floatval($billingAirplaneCost2) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_2
     *
     * @return integer 
     */
    public function getBillingAirplaneCost2()
    {
        return $this->billing_airplane_cost_2 / 100;
    }

    /**
     * Set billing_airplane_cost_3
     *
     * @param integer $billingAirplaneCost3
     * @return Operator
     */
    public function setBillingAirplaneCost3($billingAirplaneCost3)
    {
        $this->billing_airplane_cost_3 = floatval($billingAirplaneCost3) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_3
     *
     * @return integer 
     */
    public function getBillingAirplaneCost3()
    {
        return $this->billing_airplane_cost_3 / 100;
    }

    /**
     * Set billing_airplane_cost_4
     *
     * @param integer $billingAirplaneCost4
     * @return Operator
     */
    public function setBillingAirplaneCost4($billingAirplaneCost4)
    {
        $this->billing_airplane_cost_4 = floatval($billingAirplaneCost4) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_4
     *
     * @return integer 
     */
    public function getBillingAirplaneCost4()
    {
        return $this->billing_airplane_cost_4 / 100;
    }

    /**
     * Set billing_airplane_cost_5
     *
     * @param integer $billingAirplaneCost5
     * @return Operator
     */
    public function setBillingAirplaneCost5($billingAirplaneCost5)
    {
        $this->billing_airplane_cost_5 = floatval($billingAirplaneCost5) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_5
     *
     * @return integer 
     */
    public function getBillingAirplaneCost5()
    {
        return $this->billing_airplane_cost_5 / 100;
    }

    /**
     * Set billing_airplane_cost_6
     *
     * @param integer $billingAirplaneCost6
     * @return Operator
     */
    public function setBillingAirplaneCost6($billingAirplaneCost6)
    {
        $this->billing_airplane_cost_6 = floatval($billingAirplaneCost6) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_6
     *
     * @return integer 
     */
    public function getBillingAirplaneCost6()
    {
        return $this->billing_airplane_cost_6 / 100;
    }

    /**
     * Set billing_airplane_cost_7
     *
     * @param integer $billingAirplaneCost7
     * @return Operator
     */
    public function setBillingAirplaneCost7($billingAirplaneCost7)
    {
        $this->billing_airplane_cost_7 = floatval($billingAirplaneCost7) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_7
     *
     * @return integer 
     */
    public function getBillingAirplaneCost7()
    {
        return $this->billing_airplane_cost_7 / 100;
    }

    /**
     * Set billing_airplane_cost_8
     *
     * @param integer $billingAirplaneCost8
     * @return Operator
     */
    public function setBillingAirplaneCost8($billingAirplaneCost8)
    {
        $this->billing_airplane_cost_8 = floatval($billingAirplaneCost8) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_8
     *
     * @return integer 
     */
    public function getBillingAirplaneCost8()
    {
        return $this->billing_airplane_cost_8 / 100;
    }


    /**
     * Set billing_credit
     *
     * @param integer $billingCredit
     * @return Operator
     */
    public function setBillingCredit($billingCredit)
    {
        $this->billing_credit = floatval($billingCredit) * 100;

        return $this;
    }

    /**
     * Get billing_credit
     *
     * @return integer 
     */
    public function getBillingCredit()
    {
        return $this->billing_credit / 100;
    }

    /**
     * Set billing_airplane_cost_9
     *
     * @param integer $billingAirplaneCost9
     * @return Operator
     */
    public function setBillingAirplaneCost9($billingAirplaneCost9)
    {
        $this->billing_airplane_cost_9 = floatval($billingAirplaneCost9) * 100;

        return $this;
    }

    /**
     * Get billing_airplane_cost_9
     *
     * @return integer 
     */
    public function getBillingAirplaneCost9()
    {
        return $this->billing_airplane_cost_9 / 100;
    }

    public function getContactPhoneNumber() {
        return $this->getContactPhone();
    }

    /**
     * Add operatorBillingInformation
     *
     * @param \JetCharters\AppBundle\Entity\OperatorBillingInformation $operatorBillingInformation
     * @return Operator
     */
    public function addOperatorBillingInformation(\JetCharters\AppBundle\Entity\OperatorBillingInformation $operatorBillingInformation)
    {
        $this->operatorBillingInformation[] = $operatorBillingInformation;

        return $this;
    }

    /**
     * Remove operatorBillingInformation
     *
     * @param \JetCharters\AppBundle\Entity\OperatorBillingInformation $operatorBillingInformation
     */
    public function removeOperatorBillingInformation(\JetCharters\AppBundle\Entity\OperatorBillingInformation $operatorBillingInformation)
    {
        $this->operatorBillingInformation->removeElement($operatorBillingInformation);
    }

    /**
     * Get operatorBillingInformation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOperatorBillingInformation()
    {
        return $this->operatorBillingInformation;
    }

    public function getLogoWebPath() {
        return Operator::IMAGEPATH . $this->getLogoName();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateLatLong() {
        $address = urlencode(sprintf("%s, %s, %s", $this->getAddress1(), $this->getCity(), $this->getState()));
        $url = sprintf("http://maps.google.com/maps/api/geocode/json?address=%s&sensor=false", $address);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        if ( isset($response_a->results[0]) ) {
            $this->setNLatitude($response_a->results[0]->geometry->location->lat);
            $this->setNLongitude($response_a->results[0]->geometry->location->lng);
        }

    }

    /**
     * Set nLatitude
     *
     * @param string $nLatitude
     * @return Operator
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
     * @return Operator
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
}

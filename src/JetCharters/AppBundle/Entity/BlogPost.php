<?php

namespace JetCharters\AppBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPost
 *
 * @ORM\Table(name="blog_post")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\BlogPostRepository")
 * @UniqueEntity("postTitle", message="Post title already exist.")
 */
class BlogPost
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
     * @ORM\Column(name="post_title", type="string", length=255, unique=true)
     * @Assert\NotBlank(message = "Please enter post title", groups={"add", "edit"})
     */
    private $postTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_body", type="text")
     * @Assert\NotBlank(message = "Please enter post body", groups={"add", "edit"})
     */
    private $postBody;

    /**
     * @var string
     *
     * @ORM\Column(name="post_slug", type="string", length=255)
     */
    private $postSlug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime")
     */
    private $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime")
     */
    private $updatedOn;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_publish", type="boolean", nullable=true)
     */
    private $isPublish;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer", nullable=true, options={"default" = 0})
     */
    private $views;

    /**
    * @ORM\ManyToOne(targetEntity="BlogPostCategory", inversedBy="blogPost")
    * @ORM\JoinColumn(onDelete="CASCADE")
    * @Assert\NotBlank(message = "Please select category", groups={"add", "edit"})
    */
    private $category;
    
    /**
    * @ORM\ManyToOne(targetEntity="Administrator", inversedBy="blogPost")
    * @ORM\JoinColumn(onDelete="CASCADE")
    */
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="Image", inversedBy="blogPost")
    * @ORM\JoinColumn(onDelete="CASCADE")
    * @Assert\NotBlank(message = "Please select image", groups={"add"})
    */
    private $image;
    
   /** 
    * @ORM\OneToMany(targetEntity="Comment", mappedBy="blogPost", cascade={"persist"})
    **/
   private $comment;
   
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setCreatedOn(new \DateTime("now", new \DateTimeZone('UTC')));
        $this->setUpdatedOn(new \DateTime("now", new \DateTimeZone('UTC')));
	$this->setPostSlug($this->clean($this->getPostTitle()));
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->setUpdatedOn(new \DateTime("now", new \DateTimeZone('UTC')));
        $this->setPostSlug($this->clean($this->getPostTitle()));
    }
    
    function clean($string) {
	
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	
	return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
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
     * Set postTitle
     *
     * @param string $postTitle
     * @return BlogPost
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string 
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postBody
     *
     * @param string $postBody
     * @return BlogPost
     */
    public function setPostBody($postBody)
    {
        $this->postBody = $postBody;

        return $this;
    }

    /**
     * Get postBody
     *
     * @return string 
     */
    public function getPostBody()
    {
        return $this->postBody;
    }

    /**
     * Set postSlug
     *
     * @param string $postSlug
     * @return BlogPost
     */
    public function setPostSlug($postSlug)
    {
        $this->postSlug = $postSlug;

        return $this;
    }

    /**
     * Get postSlug
     *
     * @return string 
     */
    public function getPostSlug()
    {
        return $this->postSlug;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return BlogPost
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return BlogPost
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set isPublish
     *
     * @param boolean $isPublish
     * @return BlogPost
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    /**
     * Get isPublish
     *
     * @return boolean 
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    /**
     * Set category
     *
     * @param \JetCharters\AppBundle\Entity\BlogPostCategory $category
     * @return BlogPost
     */
    public function setCategory(\JetCharters\AppBundle\Entity\BlogPostCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \JetCharters\AppBundle\Entity\BlogPostCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return BlogPost
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"},
     *     mimeTypesMessage = "Please upload a valid image"
     * )
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user
     *
     * @param \JetCharters\AppBundle\Entity\User $user
     * @return BlogPost
     */
    public function setUser(\JetCharters\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \JetCharters\AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return BlogPost
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comment
     *
     * @param \JetCharters\AppBundle\Entity\Comment $comment
     * @return BlogPost
     */
    public function addComment(\JetCharters\AppBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \JetCharters\AppBundle\Entity\Comment $comment
     */
    public function removeComment(\JetCharters\AppBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comment;
    }
}

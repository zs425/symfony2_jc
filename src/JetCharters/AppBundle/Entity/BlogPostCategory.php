<?php

namespace JetCharters\AppBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogPostCategory
 *
 * @ORM\Table(name="blog_post_category")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\BlogPostCategoryRepository")
 */
class BlogPostCategory
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
     * @ORM\Column(name="category_name", type="string", length=255)
     * @Assert\NotBlank(message = "Please enter category name")
     */
    private $categoryName;

    /**
     * @var string
     *
     * @ORM\Column(name="category_slug", type="string", length=255)
     */
    private $categorySlug;
    
   /** 
    * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category", cascade={"persist"})
    **/
   private $blogPost;

   /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setCategorySlug($this->clean($this->getCategoryName()));
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->setCategorySlug($this->clean($this->getCategoryName()));
    }
    
    function clean($string) {
	
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	
	return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->blogPost = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoryName
     *
     * @param string $categoryName
     * @return BlogPostCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set category_slug
     *
     * @param string $categorySlug
     * @return BlogPostCategory
     */
    public function setCategorySlug($categorySlug)
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }

    /**
     * Get category_slug
     *
     * @return string 
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    /**
     * Add blogPost
     *
     * @param \JetCharters\AppBundle\Entity\BlogPost $blogPost
     * @return BlogPostCategory
     */
    public function addBlogPost(\JetCharters\AppBundle\Entity\BlogPost $blogPost)
    {
        $this->blogPost[] = $blogPost;

        return $this;
    }

    /**
     * Remove blogPost
     *
     * @param \JetCharters\AppBundle\Entity\BlogPost $blogPost
     */
    public function removeBlogPost(\JetCharters\AppBundle\Entity\BlogPost $blogPost)
    {
        $this->blogPost->removeElement($blogPost);
    }

    /**
     * Get blogPost
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlogPost()
    {
        return $this->blogPost;
    }
}

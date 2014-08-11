<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * comment
 *
 * @ORM\Table(name="blog_post_comments")
 * @ORM\Entity(repositoryClass="JetCharters\AppBundle\Entity\commentRepository")
 */
class Comment
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="commentText", type="text")
     */
    private $commentText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime")
     */
    private $insertDate;
    
    /**
     * @ORM\ManyToMany(targetEntity="BlogPost", inversedBy="comment")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $blogPost;
    
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
     * Set name
     *
     * @param string $name
     * @return Comment
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
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Comment
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set commentText
     *
     * @param string $commentText
     * @return Comment
     */
    public function setCommentText($commentText)
    {
        $this->commentText = $commentText;

        return $this;
    }

    /**
     * Get commentText
     *
     * @return string 
     */
    public function getCommentText()
    {
        return $this->commentText;
    }

    /**
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return Comment
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;

        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Add blogPost
     *
     * @param \JetCharters\AppBundle\Entity\BlogPost $blogPost
     * @return Comment
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

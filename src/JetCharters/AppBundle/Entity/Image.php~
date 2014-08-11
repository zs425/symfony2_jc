<?php

namespace JetCharters\AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="image")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
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
     * @ORM\Column(type="string", length=255, name="mime_type")
     *
     * @var string $mimeTypes
     */
    protected $mimeType;
    
    /**
     * @ORM\Column(type="string", length=255, name="original_name", nullable=true)
     *
     * @var string $originalName
     */
    protected $originalName;
    
   /** 
    * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="image", cascade={"persist"})
    **/
   private $blogPost;
   
   protected $imagePath;
   
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     * 
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImage(File $image)
    {
	
        $this->image = $image;
        //$this->setOriginalName($image->getClientOriginalName());
	$this->setMimeType($image->getMimeType());
    }

    /**
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
      * This function returns a var containing the raw content of the original image
      */
    function outputImage()
    {
	return file_get_contents($this->getAbsolutePath());
    }
    
    /**
      * This function returns a var containing the raw content of a thum
      * @param $width the width of the thumb
      * @param $height the height of the thumb
      * @param $quality the quality of the generated thumb, number 0-100
      */
    function outputThumb($width,$height,$quality)
    {
	//check if height and width are within bounds
	if ($width>1000 || $height>1000) {
	    die("incorrect size");
	}
		
	list($width_orig, $height_orig) = getimagesize($this->getAbsolutePath());
	
	if ($width_orig<$width && $height_orig<$height) {
	    $width=$width_orig;
	    $height=$height_orig;
	}
	elseif ($width && ($width_orig < $height_orig)) {
	    $width = ($height / $height_orig) * $width_orig;
	} 
	else {
	    $height = ($width / $width_orig) * $height_orig;
	}
	
	$image_p = imagecreatetruecolor($width, $height);
    
	switch ($this->getMimeType()) {
	    case "image/pjpeg":
	    case "image/jpeg":
	    case "image/jp2":
	    $image = imagecreatefromjpeg($this->getAbsolutePath());
	    
	    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	    // Output
	    ob_start();
	    if (imagejpeg($image_p, NULL, $quality))	{
		    imagedestroy($image);
		    imagedestroy ($image_p);			
		    return ob_get_clean();;
	    }
	    return false;
	    break;
				    
	    case "image/png":
	    case "image/x-png":
	    $image = imagecreatefrompng($this->getAbsolutePath());
	    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	    // Output
	    ob_start();
	    //note; quality for png is compression mode, this is always lossless
	    if (imagepng($image_p, NULL, 6)) {
		    imagedestroy($image);
		    imagedestroy ($image_p);
		    return ob_get_clean();;
	    }
	    return false;
	    break;
	    
	    case "image/gif":
	    $image = imagecreatefromgif($this->getAbsolutePath());
	    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	    // Output
	    ob_start();
	    if (imagegif($image_p)) {
		imagedestroy($image);
		imagedestroy ($image_p);
		return ob_get_clean();
	    }		
	    return false;
	    break;
	    
	    default:
	    return false;
	    break;
	}
	    
    }
    
    protected function getUploadRootDir()
    {
	return __DIR__.'/../../../../web';
    }
    
    protected function getAbsolutePath()
    {
	if (!is_numeric($this->getId())) {
	    return false;
	}
	
	return $this->getUploadRootDir()."/".$this->getImagePath();
    }
    
    protected function getImagePath()
    {
	return $this->imagePath;
    }
    
    public function setImagePath($path)
    {
	$this->imagePath = $path;
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
     * Set imageName
     *
     * @param string $imageName
     * @return Image
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
     * Set mimeType
     *
     * @param string $mimeType
     * @return Image
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string 
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set originalName
     *
     * @param string $originalName
     * @return Image
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string 
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Add blogPost
     *
     * @param \JetCharters\AppBundle\Entity\BlogPost $blogPost
     * @return Image
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

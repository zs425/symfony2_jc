<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/get/image")
 */
class ImageController extends Controller
{
    /**
     * @Route("/{imageId}", name="public_get_image")
     */    
    public function getImageAction($imageId)
    {
	$em = $this->getDoctrine()->getEntityManager();

	$image = $em->getRepository('JetChartersAppBundle:Image')->findOneById($imageId);

	if (!$image) {
	    die($this->get('translator')->trans("image not found"));
	}
	
	$helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
	$path = $helper->asset($image, 'image');
	
	$image->setImagePath($path);
	
	$headers = array('Content-Type'     =>  $image->getMimeType(), 'Content-Disposition' => 'inline;"');

	return new Response($image->outputImage(), 200, $headers); 

    }
    
    /**
     * @Route("/{imageId}/{width}/{height}", name="public_get_image_thumb")
     */	
    public function getThumbAction($imageId, $width, $height)
    {
	$em = $this->getDoctrine()->getEntityManager();

	$image = $em->getRepository('JetChartersAppBundle:Image')->findOneById($imageId);

	if (!$image) {
	    die($this->get('translator')->trans("image not found"));
	}
	
	$helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
	$path = $helper->asset($image, 'image');
	$image->setImagePath($path);
		
	$headers = array('Content-Type'     =>  $image->getMimeType(), 'Content-Disposition' => 'inline;"');

	return new Response($image->outputThumb($width,$height,75), 200, $headers); 
    }
}

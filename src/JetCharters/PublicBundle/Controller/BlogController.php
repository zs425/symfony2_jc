<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BlogController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route("/comment/{blogId}/add", name="public_blog_add_comment")
     * @Template()
     */
    public function addCommentAction($blogId, Request $request) {
        
        $em = $this->getDoctrine()->getManager();
	
	$commenterName = $request->request->get('commenterName');
	$commenterEmail = $request->request->get('commenterEmail');
	$commenterUrl = $request->request->get('commenterUrl');
	$commentText = $request->request->get('commentText');
	
	
	$errorMsg = false;
	if ($commenterName=='') {
	    $errorMsg = array (
			    'result' => 'Error', 
			    'message' => 'Please enter name.', 
			);
	} elseif($commenterEmail=='') {
	    $errorMsg = array (
			    'result' => 'Error', 
			    'message' => 'Please enter email.', 
			);
	} elseif(!filter_var($commenterEmail, FILTER_VALIDATE_EMAIL)) {
	    $errorMsg = array (
			    'result' => 'Error', 
			    'message' => 'Please enter valid email.', 
			);
	} elseif($commentText=='') {
	    $errorMsg = array (
			    'result' => 'Error', 
			    'message' => 'Please enter comment.', 
			);
	}
	
	if ($errorMsg!=false) {
	
	    $response = new Response(json_encode($errorMsg));
	    $response->headers->set('Content-Type', 'application/json');

	    return $response;
	}
	
	$blogPost = $em->getRepository('JetChartersAppBundle:BlogPost')->find($blogId);

	$comment = new Comment();
	$comment->setName($commenterName);
	$comment->setEmail($commenterEmail);
	$comment->setUrl($commenterUrl);
	$comment->setCommentText($commentText);
	$comment->addBlogPost($blogPost);
	$comment->setInsertDate(new \Datetime());
	
	$em->persist($comment);
	$em->flush();
	
	//$comment->setBlogPost($blogPost);
	
	$successMsg = array (
			    'result' => 'Success', 
			    'message' => 'Comment added successfully.', 
			);
			
	$response = new Response(json_encode($successMsg));
	$response->headers->set('Content-Type', 'application/json');

	return $response;
	
    }

    /**
     * @Route("/{categorySlug}", name="public_blog", defaults={"categorySlug" = null})
     * @Template()
     */
    public function indexAction($categorySlug = null, Request $request) {
    
	$em = $this->getDoctrine()->getManager();
	
	$searchCriteria = $request->request->get('blog-search-text');
	
	if ($searchCriteria!=null) {
	    $blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->searchBlogCriteria($searchCriteria);
	} else if ($categorySlug!=null) {
	    $blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->searchByCategorySlug($categorySlug);
	} else {
	    $blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->getAllActiveBlogPost();
	}
	
	return array('blogPostEntity'=>$blogPostEntity, 'hostName' => $this->getRequest()->getHost());
    }
    
    /**
     * @Route("/recent/blog", name="recent_blog")
     * @Template()
     */
    public function recentBlogAction($footer = false) {
	
	$em = $this->getDoctrine()->getManager();
	
	$blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->getRecentBlog();
	    
        return array(
		'blogPostEntity'=>$blogPostEntity, 
		'footer' => $footer
	);
    }
    
    /**
     * @Route("/popular/blog", name="popular_blog")
     * @Template()
     */
    public function popularBlogAction($footer = false) {
	
	$em = $this->getDoctrine()->getManager();
	
	$blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->getPopularBlog();
	    
        return array(
		'blogPostEntity'=>$blogPostEntity, 
		'footer' => $footer
	);
    }
    
    /**
     * @Route("/{categorySlug}/{postSlug}", name="public_blog_single")
     * @Template()
     */
    public function singleAction($categorySlug, $postSlug) {
        
        $em = $this->getDoctrine()->getManager();
        
        $blogPostEntityNew = $em->getRepository('JetChartersAppBundle:BlogPost')->findByPostSlug($postSlug);
	if (count($blogPostEntityNew)>0) {
	    $blogPostEntityNew = reset($blogPostEntityNew);
	    //For update view count of post
	    $blogPostEntityNew->setViews($blogPostEntityNew->getViews()+1);
	    
	    $em->persist($blogPostEntityNew);
	    $em->flush();
	}
	
	$blogPostEntity = $em->getRepository('JetChartersAppBundle:BlogPost')->getBlogPostDetailBySlug($postSlug);
	if (count($blogPostEntity)>0) {
	    $blogPostEntity = reset($blogPostEntity);
	} else {
	    throw $this->createNotFoundException('Unable to find Blog Post.');
	}
	
	$articles = $em->getRepository('JetChartersAppBundle:BlogPost')->getRecentBlog(3, array('blogPostId' => $blogPostEntity));
	
        return array(
		'blogPostEntity' => $blogPostEntity, 
		'articles' => $articles, 
		'hostName' => $this->getRequest()->getHost()
	);
    }
    
    /**
     * @Template()
     */
    public function categoriesAction() {
	
	$em = $this->getDoctrine()->getManager();

        $blogCategoryEntity = $em->getRepository('JetChartersAppBundle:BlogPostCategory')->findAll();
        
        return array('blogCategoryEntity'=>$blogCategoryEntity);
    }
}

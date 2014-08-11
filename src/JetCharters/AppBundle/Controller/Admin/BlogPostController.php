<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\BlogPost;
use JetCharters\AppBundle\Form\Admin\BlogPostType;
use JetCharters\AppBundle\Entity\Image;

/**
 * BlogPost controller.
 *
 * @Route("/admin/blog/post")
 */
class BlogPostController extends Controller
{

    /**
     * Lists all BlogPost entities.
     *
     * @Route("/", name="admin_blog_post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:BlogPost')->findAll();
	/*
	$entity = $em->getRepository('JetChartersAppBundle:Image')->find(7);
	$helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
	echo $path = $helper->asset($entity, 'image');
        */
        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BlogPost entity.
     *
     * @Route("/", name="admin_blog_post_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin/BlogPost:new.html.twig")
     */
    public function createAction(Request $request)
    {
	$user = $this->get('security.context')->getToken()->getUser();
	
	$entity = new BlogPost();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
	
	$validator = $this->get('validator');
	
	$errors = $validator->validate($entity, array('add'));
	
	if (count($errors) <= 0) {
	    
	    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		
		$user = $em->getRepository('JetChartersAppBundle:User')->find($user->getId());
	
		$imageEntity = new Image();
		$imageEntity->setImage($entity->getImage());
		
		$em->persist($imageEntity);
		$em->flush();
		
		$entity->setUser($user);
		$entity->setImage($imageEntity);
		
		$em->persist($entity);
		$em->flush();
		
		$this->get('session')->getFlashBag()->add('success', 'Post created successfully!');
		
		return $this->redirect($this->generateUrl('admin_blog_post'));
	    }
	}

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'errors' => $errors
        );
    }

    /**
    * Creates a form to create a BlogPost entity.
    *
    * @param BlogPost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(BlogPost $entity)
    {
        $form = $this->createForm(new BlogPostType(), $entity, array(
            'action' => $this->generateUrl('admin_blog_post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogPost entity.
     *
     * @Route("/new/{categoryId}", name="admin_blog_post_new", defaults={"categoryId" = null})
     * @Method("GET")
     * @Template()
     */
    public function newAction($categoryId)
    {
	$em = $this->getDoctrine()->getManager();	
        
        $entity = new BlogPost();
	
	if ($categoryId) {
	    
	    $categoryEntity = $em->getRepository('JetChartersAppBundle:BlogPostCategory')->find($categoryId);
	    
	    if ($categoryEntity) {
		$entity->setCategory($categoryEntity); 
	    }
        }
        
        $form   = $this->createCreateForm($entity);
       
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BlogPost entity.
     *
     * @Route("/{id}", name="admin_blog_post_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BlogPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BlogPost entity.
     *
     * @Route("/{id}/edit", name="admin_blog_post_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BlogPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }
        
	$entity->setImage(NULL);
        $editForm = $this->createEditForm($entity);
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a BlogPost entity.
    *
    * @param BlogPost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogPost $entity)
    {
        $form = $this->createForm(new BlogPostType(), $entity, array(
            'action' => $this->generateUrl('admin_blog_post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * Edits an existing BlogPost entity.
     *
     * @Route("/{id}", name="admin_blog_post_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:Admin/BlogPost:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {	
	$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BlogPost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }
	$previousImageEntity = $entity->getImage();
	$entity->setImage(NULL);
	
        $editForm = $this->createEditForm($entity, array('edit'));
        
        $editForm->handleRequest($request);
	
	$validator = $this->get('validator');
	
	$errors = $validator->validate($entity);
	
	if (count($errors) <= 0) {
	
	    if ($editForm->isValid()) {
			
		if ($entity->getImage()) {
		    $imageEntity = new Image();
		    $imageEntity->setImage($entity->getImage());	
		    $em->persist($imageEntity);
		    $entity->setImage($imageEntity);
		} else {
		    $entity->setImage($previousImageEntity);
		}

	    	$em->persist($entity);
		$em->flush();
		
		$this->get('session')->getFlashBag()->add('success', 'Post updated successfully!');
		
		return $this->redirect($this->generateUrl('admin_blog_post'));
	    }
	}
	
	
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'errors' => $errors,
        );
    }
    
    /**
     * Deletes a BlogPost entity.
     *
     * @Route("/delete/{id}", name="admin_blog_post_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getManager();
	$entity = $em->getRepository('JetChartersAppBundle:BlogPost')->find($id);

	if (!$entity) {
	    throw $this->createNotFoundException('Unable to find BlogPost entity.');
	}

	$em->remove($entity);
	$em->flush();

	$this->get('session')->getFlashBag()->add('success', 'Post deleted successfully!');
	
        return $this->redirect($this->generateUrl('admin_blog_post'));
    }

    /**
     * Creates a form to delete a BlogPost entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_blog_post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

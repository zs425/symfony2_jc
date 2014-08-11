<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg;
use JetCharters\AppBundle\Form\EmptyLegType;

/**
 * EmptyLeg controller.
 *
 * @Route("/admin/empty-legs")
 */
class EmptyLegController extends Controller
{

    /**
     * Lists all EmptyLeg entities.
     *
     * @Route("/", name="admin_emptylegs")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:CharterAircraftEmptyLeg')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new EmptyLeg entity.
     *
     * @Route("/", name="admin_emptylegs_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin\EmptyLeg:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CharterAircraftEmptyLeg();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
	
        if ($form->isValid()) {
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_emptylegs'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a EmptyLeg entity.
    *
    * @param EmptyLeg $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CharterAircraftEmptyLeg $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $aircraft = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAll();

        $form = $this->createForm(new EmptyLegType($aircraft), $entity, array(
            'action' => $this->generateUrl('admin_emptylegs_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EmptyLeg entity.
     *
     * @Route("/new", name="admin_emptylegs_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aircraft = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAll();

        if ($aircraft == null) {
            $this->get('session')->getFlashBag()->add(
            'error',
            'You have no aircraft in the Jetcharters.com system. Please add an aircraft before adding an empty leg.'
            );
            return $this->redirect($this->generateUrl('admin_emptylegs'));
        } else {
            $entity = new CharterAircraftEmptyLeg();
            $form   = $this->createCreateForm($entity);

            return array(
                'entity' => $entity,
                'form'   => $form->createView(),
            );
        }

    }

    /**
     * Finds and displays a EmptyLeg entity.
     *
     * @Route("/{id}", name="admin_emptylegs_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:EmptyLeg')->find($id);
        var_dump($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmptyLeg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EmptyLeg entity.
     *
     * @Route("/{id}/edit", name="admin_emptylegs_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraftEmptyLeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmptyLeg entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a EmptyLeg entity.
    *
    * @param EmptyLeg $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CharterAircraftEmptyLeg $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $aircraft = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAll();

        $form = $this->createForm(new EmptyLegType($aircraft), $entity, array(
            'action' => $this->generateUrl('admin_emptylegs_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('operator');

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EmptyLeg entity.
     *
     * @Route("/{id}", name="admin_emptylegs_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:Admin\EmptyLeg:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraftEmptyLeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmptyLeg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_emptylegs'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a EmptyLeg entity.
     *
     * @Route("/{id}", name="admin_emptylegs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:EmptyLeg')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EmptyLeg entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_emptylegs'));
    }

    /**
     * Creates a form to delete a EmptyLeg entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_emptylegs_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

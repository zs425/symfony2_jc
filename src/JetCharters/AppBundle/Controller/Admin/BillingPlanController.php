<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\BillingPlan;
use JetCharters\AppBundle\Form\BillingPlanType;

/**
 * BillingPlan controller.
 *
 * @Route("/admin/billingplans")
 */
class BillingPlanController extends Controller
{

    /**
     * Lists all BillingPlan entities.
     *
     * @Route("/", name="admin_billingplans")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:BillingPlan')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BillingPlan entity.
     *
     * @Route("/", name="admin_billingplans_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin/BillingPlan:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BillingPlan();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_billingplans'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a BillingPlan entity.
    *
    * @param BillingPlan $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(BillingPlan $entity)
    {
        $form = $this->createForm(new BillingPlanType(), $entity, array(
            'action' => $this->generateUrl('admin_billingplans_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BillingPlan entity.
     *
     * @Route("/new", name="admin_billingplans_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BillingPlan();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BillingPlan entity.
     *
     * @Route("/{id}", name="admin_billingplans_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BillingPlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BillingPlan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BillingPlan entity.
     *
     * @Route("/{id}/edit", name="admin_billingplans_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BillingPlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BillingPlan entity.');
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
    * Creates a form to edit a BillingPlan entity.
    *
    * @param BillingPlan $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BillingPlan $entity)
    {
        $form = $this->createForm(new BillingPlanType(), $entity, array(
            'action' => $this->generateUrl('admin_billingplans_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BillingPlan entity.
     *
     * @Route("/{id}", name="admin_billingplans_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:BillingPlan:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BillingPlan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BillingPlan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_billingplans'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BillingPlan entity.
     *
     * @Route("/{id}", name="admin_billingplans_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:BillingPlan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BillingPlan entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_billingplans'));
    }

    /**
     * Creates a form to delete a BillingPlan entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_billingplans_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

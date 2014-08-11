<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\BulkMailer;
use JetCharters\AppBundle\Form\BulkMailerType;

/**
 * BulkMailer controller.
 *
 * @Route("/admin/bulkmailer")
 */
class BulkMailerController extends Controller
{

    /**
     * Lists all BulkMailer entities.
     *
     * @Route("/", name="admin_bulkmailer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:BulkMailer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BulkMailer entity.
     *
     * @Route("/", name="admin_bulkmailer_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:BulkMailer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BulkMailer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bulkmailer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a BulkMailer entity.
    *
    * @param BulkMailer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(BulkMailer $entity)
    {
        $form = $this->createForm(new BulkMailerType(), $entity, array(
            'action' => $this->generateUrl('admin_bulkmailer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BulkMailer entity.
     *
     * @Route("/new", name="admin_bulkmailer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BulkMailer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BulkMailer entity.
     *
     * @Route("/{id}", name="admin_bulkmailer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BulkMailer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BulkMailer entity.
     *
     * @Route("/{id}/edit", name="admin_bulkmailer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BulkMailer entity.');
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
    * Creates a form to edit a BulkMailer entity.
    *
    * @param BulkMailer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BulkMailer $entity)
    {
        $form = $this->createForm(new BulkMailerType(), $entity, array(
            'action' => $this->generateUrl('admin_bulkmailer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BulkMailer entity.
     *
     * @Route("/{id}", name="admin_bulkmailer_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:BulkMailer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BulkMailer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bulkmailer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BulkMailer entity.
     *
     * @Route("/{id}", name="admin_bulkmailer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BulkMailer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_bulkmailer'));
    }

    /**
     * Creates a form to delete a BulkMailer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bulkmailer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    /**
     * Displays a form to send a BulkMailer entity.
     *
     * @Route("/{id}/send_preview", name="admin_bulkmailer_send_preview")
     * @Method("GET")
     * @Template()
     */
    public function sendPreviewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BulkMailer entity.');
        }

        $sendButton = $this->createSendButton($entity);

        return array(
            'entity'      => $entity,
            'send_button'   => $sendButton->createView(),
        );
    }

    /**
    * Creates a form to send a BulkMailer entity.
    *
    * @param BulkMailer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createSendButton(BulkMailer $entity)
    {
        $form = $this->createFormBuilder($entity, array(
            'action' => $this->generateUrl('admin_bulkmailer_send', array('id' => $entity->getId())),
            'method' => 'POST',
        ))
        ->add('submit', 'submit', array('label' => 'Send'))
        ->getForm();

        return $form;
    }
    /**
     * sends an existing BulkMailer entity.
     *
     * @Route("/{id}/send", name="admin_bulkmailer_send")
     * @Method("POST")
     * @Template("JetChartersAppBundle:BulkMailer:send.html.twig")
     */
    public function sendAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:BulkMailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BulkMailer entity.');
        }

        $sendButton = $this->createSendButton($entity);
        $sendButton->handleRequest($request);

        if ($sendButton->isValid()) {

            // -------------------------------
            // TODO: Schedule email to be sent
            // -------------------------------

            return $this->redirect($this->generateUrl('admin_bulkmailer'));
        }

        return array(
            'entity'      => $entity,
            'send_form'   => $sendButton->createView()
        );
    }
}

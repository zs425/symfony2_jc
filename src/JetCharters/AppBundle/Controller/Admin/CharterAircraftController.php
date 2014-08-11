<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\CharterAircraft;
use JetCharters\AppBundle\Entity\CharterAircraftImage;
use JetCharters\AppBundle\Form\CharterAircraftType;

/**
 * Aircraft controller.
 *
 * @Route("/admin/charter-aircraft")
 */
class CharterAircraftController extends Controller
{
    private function getUserManager()
    {
        // Set discriminator to Operators
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass('JetCharters\AppBundle\Entity\Operator');

        return $this->container->get('pugx_user_manager');
    }

    /**
     * Lists all CharterAircraft entities.
     *
     * @Route("/list/{op_username}", name="admin_aircraft")
     * @Method("GET")
     * @Template()
     */
    public function defaultAction($op_username = null)
    {
        $em = $this->getDoctrine()->getManager();

        if ($op_username) {

            $um = $this->getUserManager();
            $operator = $um->findUserBy(array('username' => $op_username));
            $entities = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAllByOperator($operator);

        } else {

            $entities = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAll();

        }

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new CharterAircraft entity.
     *
     * @Route("/new/{op_username}", name="admin_aircraft_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin\Aircraft:new.html.twig")
     */
    public function createAction(Request $request, $op_username = null)
    {
        $entity = new CharterAircraft();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($op_username) {
                $um = $this->getUserManager();
                $operator = $um->findUserBy(array('username' => $op_username));

                // Set company
                $entity->setCompany($operator->getCompany());
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_aircraft', array('op_username' => $op_username)));
        }

        if ($op_username) $op_company = $this->getUserManager()->findUserBy(array('username' => $op_username))->getCompany();
        else $op_company = null;

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'op_company' => $op_company
        );
    }


    /**
     * Creates a form to create a CharterAircraft entity.
     *
     * @param CharterAircraft $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CharterAircraft $entity, $op_username = null)
    {
        $form = $this->createForm(new CharterAircraftType(), $entity, array(
            'action' => $this->generateUrl('admin_aircraft_create', array('op_username' => $op_username)),
            'method' => 'POST',
        ));

        $form
            ->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }

    /**
     * Creates a image upload form
     *
     * @param CharterAircraft $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createImageForm(CharterAircraft $entity)
    {
        $form = $this->createForm(new AircraftImageUploadType(), $entity, array(
            'action' => $this->generateUrl('admin_aircraft_update'),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new CharterAircraft entity.
     *
     * @Route("/new/{op_username}", name="admin_aircraft_new")
     * @Method("GET")
     */
    public function newAction($op_username = null)
    {
        $em = $this->getDoctrine()->getManager();

        if ($op_username) $op_company = $this->getUserManager()->findUserBy(array('username' => $op_username))->getCompany();
        else $op_company = null;

        $entity = new CharterAircraft();
        $entity->setName("New Aircraft");
        $entity->setStatus("Disabled");
        $entity->setCompany($op_company);

        $em->persist($entity);
        $em->flush();

        return $this->generateUrl('admin_aircraft_edit', array('id' => $entity->getId()));
    }

    /**
     * Finds and displays a CharterAircraft entity.
     *
     * @Route("/{id}", name="admin_aircraft_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CharterAircraft entity.
     *
     * @Route("/{id}/edit", name="admin_aircraft_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $video = $this->get('vzaar_helper')->getVideo($entity, 'video');

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'video_embed' => $video['video_embed'],
            'vzaar_status' => $video['vzaar_status']
        );
    }

    /**
     * Creates a form to edit a CharterAircraft entity.
     *
     * @param CharterAircraft $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(CharterAircraft $entity)
    {
        $form = $this->createForm(new CharterAircraftType(), $entity, array(
            'action' => $this->generateUrl('admin_aircraft_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
            ->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }

    /**
     * Edits an existing CharterAircraft entity.
     *
     * @Route("/{id}", name="admin_aircraft_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:Admin\Aircraft:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_aircraft'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CharterAircraft entity.
     *
     * @Route("/{id}/delete", name="admin_aircraft_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_aircraft'));
    }

    /**
     * Creates a form to delete a CharterAircraft entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_aircraft_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    /**
     * Uploads image and attaches to aircraft
     *
     * @Route("/{id}/upload_image", name="admin_aircraft_upload_image")
     * @Method("POST")
     */
    public function uploadImageAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $images = $request->files;
        $responsedata = false;

        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $entity_image = new CharterAircraftImage();
                $entity_image->setImage($image);
                $em->persist($entity_image);

                // TODO: add security measures: get by operator
                $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);
                $entity->addImage($entity_image);

                $em->persist($entity);
                $em->flush();

                $responsedata = array("id" => $entity_image->getId());
            }
        }

        $response = new JsonResponse();
        $response->setData($responsedata);

        return $response;
    }

    /**
     * Gets current aircraft images
     *
     * @Route("/{id}/get_images", name="admin_aircraft_get_images")
     */
    public function getImagesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);
        $aircraftimages = $entity->getImages();

        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');

        $images = array();

        foreach ($aircraftimages as $image) {
            $path = $helper->asset($image, 'image');
            $images[] = array("path" => $path, "name" => $image->getId(), "size" => 1000); //TODO: get size of image
        }

        $response = new JsonResponse();
        $response->setData($images);

        return $response;
    }

    /**
     * Deletes an aircraft image
     *
     * @Route("/delete_image/{id}", name="admin_aircraft_delete_image")
     * @Method("DELETE")
     */
    public function deleteImageAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        // TODO: add security measures: get by operator
        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraftImage')->find($id);

        $em->remove($entity);
        $em->flush();

        return new JsonResponse();
    }

}

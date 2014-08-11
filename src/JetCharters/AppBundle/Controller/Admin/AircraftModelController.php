<?php

namespace JetCharters\AppBundle\Controller\Admin;

use JetCharters\AppBundle\Entity\AircraftModel;
use JetCharters\AppBundle\Entity\AircraftModelImage;
use JetCharters\AppBundle\Form\Admin\AircraftModelType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\Video;


/**
 * Aircraft Model controller.
 *
 * @Route("/admin/aircraft")
 */
class AircraftModelController extends Controller {

    /**
     * @param Request $request
     * @Route("/", name="admin_aircraft_models")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {
        $entities = $this->getDoctrine()->getRepository('JetChartersAppBundle:AircraftModel')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * @param Request $request
     * @Route("/edit/{id}", name="admin_aircraft_models_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AircraftModel entity.');
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
     * Displays a form to create a new AircraftModel entity.
     *
     * @Route("/new/{op_username}", name="admin_aircraft_models_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($op_username = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new AircraftModel();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'new_form' => $form->createView()
        );
    }

    /**
     * Creates a new AircraftModel entity.
     *
     * @Route("/new", name="admin_aircraft_models_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin\AircraftModel:new.html.twig")
     */
    public function createAction(Request $request, $op_username = null)
    {
        $entity = new AircraftModel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_aircraft_models_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing AircraftModel entity.
     *
     * @Route("/{id}", name="admin_aircraft_models_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:Admin\AircraftModel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aircraft Model entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Successfully Updated Model Aircraft.');

            return $this->redirect($this->generateUrl('admin_aircraft_models'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AircraftModel entity.
     *
     * @Route("/{id}/delete", name="admin_aircraft_models_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AircraftModel entity.');
            }

            $this->get('session')->getFlashBag()->add('success', 'Successfully Removed Model Aircraft.');

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_aircraft_mdels'));
    }

    /**
     * Creates a form to edit a AircraftModel entity.
     *
     * @param AircraftModel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(AircraftModel $entity)
    {
        $form = $this->createForm(new AircraftModelType(), $entity, array(
            'action' => $this->generateUrl('admin_aircraft_models_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
            ->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }

    /**
     * Creates a form to delete a AircraftModel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_aircraft_models_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    /**
     * Creates a form to create a AircraftModel entity.
     *
     * @param AircraftModel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AircraftModel $entity, $op_username = null)
    {
        $form = $this->createForm(new AircraftModelType(), $entity, array(
            'action' => $this->generateUrl('admin_aircraft_models_create'),
            'method' => 'POST',
        ));

        $form
            ->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }


    /**
     * Uploads image and attaches to aircraft
     *
     * @Route("/{id}/upload_video", name="admin_aircraft_upload_video")
     * @Method("POST")
     */
    public function uploadVideoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $request->files;

        foreach ($videos as $video) {
            if ($video instanceof UploadedFile) {
                $entity_video = new Video();
                $entity_video->setSize($video->getSize());
                $entity_video->setVideo($video);

                // TODO: add security measures: get by admin
                $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);
                $entity_video->setAircraftModel($entity);

                $em->persist($entity_video);
                $em->persist($entity);
                $em->flush();

                $responsedata = array("id" => $entity_video->getId());
            }
        }

        $response = new JsonResponse();
        $response->setData($responsedata);

        return $response;
    }

    /**
     * Gets current aircraft videos
     *
     * @Route("/{id}/get_videos", name="admin_aircraft_get_videos")
     */
    public function getVideosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);
        $aircraftvideos = $entity->getVideos();

        $videos = array();

        foreach ($aircraftvideos as $video) {
            $video_info = $this->get('vzaar_helper')->getVideo($video, 'video');
            $videos[] = array(
                "path" => $video_info['thumbnail'],
                "name" => $video->getId(),
                "size" => $video->getSize());
        }

        $response = new JsonResponse();
        $response->setData($videos);

        return $response;
    }

    /**
     * Gets a video embed code
     *
     * @Route("/get_video_embed/{id}", name="admin_aircraft_get_video_embed")
     * @Method("GET")
     */
    public function getVideoEmbedAction(Request $request, $id = NULL)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:Video')->find($id);

        $video = $this->get('vzaar_helper')->getVideo($entity, 'video');

        if($video['vzaar_status'] == "Active"){
            $embed = $video['video_embed'];
        }else
        {
            $embed = "<h5 class='alert-error'>".$video['vzaar_status']."</h5>";
        }

        $response = new JsonResponse();
        $response->setData(array("embed" => $embed));

        return $response;
    }

    /**
     * Deletes an aircraft video
     *
     * @Route("/delete_video/{id}", name="admin_aircraft_delete_video")
     * @Method("DELETE")
     */
    public function deletevideoAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        // TODO: add security measures: get by admin
        $video = $em->getRepository('JetChartersAppBundle:Video')->find($id);

        $em->remove($video);
        $em->flush();

        return new JsonResponse();
    }

    /**
     * @param $id
     * @Route("/deactivate/{id}", name="admin_aircraft_deactivate")
     * @Method("GET")
     */
    public function deactivateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByadmin($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $entity->setActive(false);

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_aircraft'));
    }


    /**
     * Uploads image and attaches to aircraft
     *
     * @Route("/upload_image/{id}", name="admin_aircraft_models_upload_image")
     * @Method("POST")
     */
    public function uploadImageAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);

        $images = $request->files;

        $responsedata = array('error');

        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                $entity_image = new AircraftModelImage();
                $entity_image->setImage($image);
                $entity_image->setAircraft($entity);
                $em->persist($entity_image);

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
     * @Route("/get_images/{id}", name="admin_aircraft_models_get_images")
     * @Method("GET")
     */
    public function getImagesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:AircraftModel')->find($id);
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
     * @Route("/delete_image/{id}", name="admin_aircraft_models_delete_image")
     * @Method("DELETE")
     */
    public function deleteImageAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        // TODO: add security measures: get by admin
        $entity = $em->getRepository('JetChartersAppBundle:AircraftModelImage')->find($id);

        $em->remove($entity);
        $em->flush();

        return new JsonResponse();
    }

}
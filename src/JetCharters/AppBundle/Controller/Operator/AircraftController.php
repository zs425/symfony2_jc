<?php

namespace JetCharters\AppBundle\Controller\Operator;

use JetCharters\AppBundle\Controller\JCAppBundleController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\CharterAircraft;
use JetCharters\AppBundle\Entity\CharterAircraftImage;
use JetCharters\AppBundle\Entity\Video;
use JetCharters\AppBundle\Form\CharterAircraftType;

/**
 * Aircraft controller.
 *
 * @Route("/operator-admin/aircraft")
 */
class AircraftController extends JCAppBundleController
{
    /**
     * Lists all CharterAircraft entities.
     *
     * @Route("/", name="operator_aircraft")
     * @Method("GET")
     * @Template()
     */
    public function defaultAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findAllByOperator($this->getUser());

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CharterAircraft entity.
     *
     * @Route("/", name="operator_aircraft_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Operator\Aircraft:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CharterAircraft();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Set company
            $entity->setCompany($this->getUser()->getCompany());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('operator_aircraft'));
        }
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CharterAircraft entity.
    *
    * @param CharterAircraft $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CharterAircraft $entity)
    {
        $form = $this->createForm(new CharterAircraftType(), $entity, array(
            'action' => $this->generateUrl('operator_aircraft_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }

    /**
     * Displays a form to create a new CharterAircraft entity.
     *
     * @Route("/new", name="operator_aircraft_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = new CharterAircraft();
        $entity->setName("New Aircraft");
        $entity->setActive(0);
        $entity->setOperator($this->getUser()->getOperator());

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('operator_aircraft_edit', array('id' => $entity->getId())));
    }

    /**
     * Finds and displays a CharterAircraft entity.
     *
     * @Route("/{id}", name="operator_aircraft_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CharterAircraft entity.
     *
     * @Route("/{id}/edit", name="operator_aircraft_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
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
            'action' => $this->generateUrl('operator_aircraft_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Save Aircraft'));

        return $form;
    }
    /**
     * Edits an existing CharterAircraft entity.
     *
     * @Route("/{id}", name="operator_aircraft_update")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->setSuccessFlash('Aircraft information updated successfully.');
            return $this->redirect($this->generateUrl('operator_aircraft_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CharterAircraft entity.
     *
     * @Route("/{id}", name="operator_aircraft_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('operator_aircraft'));
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
            ->setAction($this->generateUrl('operator_aircraft_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Uploads image and attaches to aircraft
     *
     * @Route("/{id}/upload_image", name="operator_aircraft_upload_image")
     * @Method("POST")
     */
    public function uploadImageAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $images = $request->files;

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
     * @Route("/{id}/get_images", name="operator_aircraft_get_images")
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
     * @Route("/delete_image/{id}", name="operator_aircraft_delete_image")
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

    /**
     * Uploads image and attaches to aircraft
     *
     * @Route("/{id}/upload_video", name="operator_aircraft_upload_video")
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

                // TODO: add security measures: get by operator
                $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);
                $entity_video->setCharterAircraft($entity);

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
     * @Route("/{id}/get_videos", name="operator_aircraft_get_videos")
     * @Method("GET")
     */
    public function getVideosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->find($id);
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
     * @Route("/get_video_embed/{id}", name="operator_aircraft_get_video_embed")
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
     * @Route("/delete_video/{id}", name="operator_aircraft_delete_video")
     * @Method("DELETE")
     */
    public function deletevideoAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        // TODO: add security measures: get by operator
        $entity = $em->getRepository('JetChartersAppBundle:Video')->find($id);

        $em->remove($entity);
        $em->flush();

        return new JsonResponse();
    }

    /**
     * @param $id
     * @Route("/deactivate/{id}", name="operator_aircraft_deactivate")
     * @Method("GET")
     */
    public function deactivateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $entity->setActive(false);

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('operator_aircraft'));
    }

    /**
     * @param $id
     * @Route("/activate/{id}", name="operator_aircraft_activate")
     * @Method("GET")
     */
    public function activateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findByOperator($id, $this->getUser());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CharterAircraft entity.');
        }

        $entity->setActive(true);

        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('operator_aircraft'));
    }

}


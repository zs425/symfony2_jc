<?php

namespace JetCharters\AppBundle\Controller\Operator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JetCharters\AppBundle\Entity\User;
use JetCharters\AppBundle\Form\Profile;

/**
 * @Route("/operator-admin/profile")
 */

class ProfileController extends Controller
{
    /**
     * @Route("/contact", name="operator_profile_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
	   $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $editForm = $this->createForm(new Profile\ContactType(), $entity, array(
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_contact'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            );
    }

    /**
     * @Route("/company/info", name="operator_profile_company_info")
     * @Template()
     */
    public function companyInfoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getOperator();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $editForm = $this->createForm(new Profile\CompanyInfoType(), $entity, array(
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            );
    }

    /**
     * @Route("/company/logo", name="operator_profile_company_logo")
     * @Template()
     */
    public function companyLogoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getOperator();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $logoForm = $this->createForm(new Profile\CompanyLogoType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_profile_company_logo')
        ));

        $logoForm->add('submit', 'submit', array('label' => 'Update'));

        $logoForm->handleRequest($request);

        if ($logoForm->isValid() && $request->getMethod() == "PUT") {
            $this->container->get('vich_uploader.storage')->upload($entity);
            $em->persist($entity);
            $em->flush();


            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        return array(
            'entity'      => $entity,
            'logo_form'   => $logoForm->createView()
            );
    }

    /**
     * @Route("/company/video", name="operator_profile_company_video")
     * @Template()
     */
    public function companyVideoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getOperator();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $videoForm = $this->createForm(new Profile\CompanyVideoType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_profile_company_video')
        ));

        $videoForm->add('submit', 'submit', array('label' => 'Update'));

        $videoForm->handleRequest($request);

        if ($videoForm->isValid() && $request->getMethod() == "PUT") {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        if ($request->getMethod() != "PUT")
        {
            $video = $this->get('vzaar_helper')->getVideo($entity, 'video');
        }

        return array(
            'entity'      => $entity,
            'video_form'   => $videoForm->createView(),
            'video_embed' => $video['video_embed'],
            'vzaar_status' => $video['vzaar_status']
            );
    }

    /**
     * @Route("/social", name="operator_profile_social")
     * @Template()
     */
    public function socialAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getOperator();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $socialForm = $this->createForm(new Profile\SocialType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_profile_social')
        ));

        $socialForm->add('submit', 'submit', array('label' => 'Update'));

        $socialForm->handleRequest($request);

        if ($socialForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        return array(
            'entity'      => $entity,
            'social_form'   => $socialForm->createView()
            );    }

    /**
     * @Route("/salesforce", name="operator_profile_salesforce")
     * @Template()
     */
    public function salesforceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $salesforceForm = $this->createForm(new Profile\SalesForceIntegrationType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_profile_salesforce')
        ));

        $salesforceForm->add('submit', 'submit', array('label' => 'Update'));

        $salesforceForm->handleRequest($request);

        if ($salesforceForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        return array(
            'entity'      => $entity,
            'salesforce_form'   => $salesforceForm->createView()
            );
    }

    /**
     * @Route("/callrecording", name="operator_profile_callrecording")
     * @Template()
     */
    public function callRecordingAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getOperator();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $crForm = $this->createForm(new Profile\CallRecordingType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_profile_callrecording')
        ));

        $crForm->add('submit', 'submit', array('label' => 'Update'));

        $crForm->handleRequest($request);

        if ($crForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_profile_company_info'));
        }

        return array(
            'entity'     => $entity,
            'cr_form'   => $crForm->createView()
            );
    }
}

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
use JetCharters\AppBundle\Form\Billing;

/**
 * @Route("/operator-admin/billing")
 */

class BillingController extends Controller
{
    /**
     * @Route("/", name="operator_billing_options")
     * @Template()
     */
    public function billingOptionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $editForm = $this->createForm(new Billing\BillingOptionsType(), $entity, array(
            'method' => 'PUT',
            'action' => $this->generateUrl('operator_billing_options')
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid() && $request->getMethod() == "PUT") {
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('operator_billing_options'));
        }

        return array(
            'entity'     => $entity,
            'edit_form'   => $editForm->createView()
            );
    }

    /**
     * @Route("/history", name="operator_billing_history")
     * @Template()
     */
    public function billingHistoryAction(Request $request)
    {


        return array();
    }

}
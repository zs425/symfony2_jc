<?php

namespace JetCharters\AppBundle\Controller\Operator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/operator-admin/inbox")
 */

class InboxController extends Controller
{
    /**
     * @Route("/", name="operator_inbox")
     * @Template()
     */
    public function defaultAction()
    {
    	//  //returns an instance of Vresh\TwilioBundle\Service\TwilioWrapper
     //    $twilio = $this->get('twilio.api');

     //    try {
     //    // Initiate a new outbound call
     //    $call = $twilio->account->calls->create(
     //        '+18654072927', // The number of the phone initiating the call
     //        '+15184213705', // The number of the phone receiving call
     //        'http://24.149.55.79:8080/call.xml' // The URL Twilio will request when the call is answered
     //    );
     //    echo 'Started call: ' . $call->sid;
	    // } catch (Exception $e) {
	    //     echo 'Error: ' . $e->getMessage();
	    // }

        return new Response("");
    }

}

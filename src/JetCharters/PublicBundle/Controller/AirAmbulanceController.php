<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class AirAmbulanceController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/air-ambulance")
 */
class AirAmbulanceController extends Controller
{
    /**
     * @param $name
     * @return array
     * @Route("/", name="public_air_ambulance")
     * @Template()
     */
    public function indexAction()
    {

        $airAmbulance = $this->getDoctrine()->getRepository('JetChartersAppBundle:CharterAircraft')->findAllAirAmbulances();

        return array(
            'airAmbulance' => $airAmbulance
        );
    }
}

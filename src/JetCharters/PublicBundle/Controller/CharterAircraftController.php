<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CharterAircraftController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/charter-aircraft")
 */
class CharterAircraftController extends Controller
{
    /**
     * @Route("/", name="public_charter_aircraft")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $airport_type =  $request->request->get('aircraft_type_private_jets');
        $city_airport_code =  $request->request->get('city_airport_code_private_jets');
        $radius =  $request->request->get('radius_private_jets');

        $city = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findCityByAirportCode($city_airport_code);

        $aircrafts = $this->getDoctrine()->getRepository('JetChartersAppBundle:CharterAircraft')->findByType($airport_type, $city, $radius);

        return array( 'aircrafts' => $aircrafts );

    }

    /**
     * @Route("/by-type/{type_slug}", name="public_charter_aircraft_by_type")
     * @Template()
     */
    public function byModelTypeAction($type_slug)
    {

    }

    /**
     * @Route("/{slug}", name="public_charter_aircraft_detail_old")
     * @Route("/{slug}.cfm", name="public_charter_aircraft_detail_cfm")
     */
    public function oldDetailAction($slug)
    {
        return $this->forward('JetChartersPublicBundle:CharterAircraft:detail', array(
            'operator' => '',
            'aircraft' => '',
            'tail' => ''
        ));
    }

    /**
     * @param $operator
     * @param $aircraft
     * @param $tail
     * @Route("/{operator}/{aircraft}/{tail}", name="public_charter_aircraft_detail")
     * @Template()
     */

    public function detailAction($operator, $aircraft, $tail)
    {

        $em = $this->getDoctrine()->getManager();

        $charterAircraftDetail = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findCharterAircraftDetail($operator, $aircraft, $tail);
        if (count($charterAircraftDetail) > 0) {
            $charterAircraftDetail = reset($charterAircraftDetail);

            if ($charterAircraftDetail->getModel()) {
                if ($charterAircraftDetail->getModel()->getType()) {
                    $similarAircrafts = $em->getRepository('JetChartersAppBundle:CharterAircraft')->findSimilartAircraft($charterAircraftDetail->getModel()->getType()->getId(), $charterAircraftDetail->getId());
                }
            }
        } else {
            throw $this->createNotFoundException('Unable to find Charter Aircraft.');
        }

        return array(
	    'charterAircraft' => $charterAircraftDetail, 
	    'similarAircrafts' => isset($similarAircrafts) ? $similarAircrafts : false,
	    'hostName' => $this->getRequest()->getHost()
        );
    }
}

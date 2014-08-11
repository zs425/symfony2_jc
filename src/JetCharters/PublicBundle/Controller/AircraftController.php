<?php

namespace JetCharters\PublicBundle\Controller;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use JetCharters\AppBundle\Entity\Airport;

/**
 * Class CharterAircraftController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/private-jets")
 */
class AircraftController extends Controller
{
    /**
     * @Route("/", name="public_aircraft")
     * @Template()
     */
    public function indexAction()
    {
        $types = $this->getDoctrine()->getRepository('JetChartersAppBundle:AircraftType')->findAll();

        $grouped = array();
        foreach($types as $type) {
            $grouped[$type->getSlug()] = array();
            foreach($type->getAircraftModel() as $model) {
                $grouped[$type->getSlug()][] = $model;
            }
        }

        return array(
            'models'		=> $grouped,
            'aircraftTypes'	=> $types		
        );
    }
    
    /**
     * @Route("/airport-search", name="public_aircraft_search_airport")
     * @Template()
     */
    public function airportSearchAction(Request $request)
    {
	/*echo '<pre/>';
	print_r($_REQUEST);
	echo $request->request->get('term');
	die();*/

        $airports = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->searchAirports($request->request->get('term'));
        $dataArr  = array();
        if(count($airports)>0) {

            foreach($airports as $airport) {
            $name = $airport->getName();
            if ($airport->getIcaoCode()!='') {
                $name .= " - ".$airport->getIcaoCode();
            }
            $dataArr[]  = array(
                    'id' 	=> $airport->getId(),
                    'text'	=> $name
                    );
            }
        }

        $response = new Response(json_encode($dataArr));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/{slug}.cfm", name="public_aircraft_detail_cfm")
     * @Route("/{slug}", name="public_aircraft_detail")
     * @Template()
     */
    public function detailAction($slug) {
        $repository = $this->getDoctrine()->getRepository('JetChartersAppBundle:AircraftModel');

        try {
            $aircraft = $repository->findBySlug($slug);
        } catch(NoResultException $e) {
            throw $this->createNotFoundException('Unable to find Aircraft Model.');
        }

        if (!$aircraft) {
            throw $this->createNotFoundException('Unable to find Aircraft Model.');
        }

        $related = $repository->findByType($aircraft->getType());

        foreach($related as $k => $relate) {
            if ( $relate == $aircraft ) {
                unset($related[$k]);
            }
        }

        $charter_aircraft_repo = $this->getDoctrine()->getRepository('JetChartersAppBundle:CharterAircraft');

        return array(
            'aircraft' => $aircraft,
            'related' => $related,
            'charters' => $charter_aircraft_repo->findByModel($aircraft)
        );
    }
}

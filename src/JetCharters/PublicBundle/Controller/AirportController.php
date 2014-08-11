<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use JetCharters\AppBundle\Entity\Airport;

/**
 * Class AirportController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/airports")
 */
class AirportController extends Controller
{
    /**
     * @Route("/", name="public_airports")
     * @Template()
     */
    public function indexAction()
    {
        $airportsByState = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findAllAirportsByState();
        $airportsByCountry = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findAllAirportsByCountry();

        return array(
            'airportsByState' => $airportsByState,
            'airportsByCountry' => $airportsByCountry,
        );
    }

    /**
     * @Route("/{location}", name="public_airports_list")
     * @Template()
     */
    public function airportListAction($location)
    {
        $airports = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findAirportByLocation(str_replace("-", " ", $location));

        return array(
            'airports' => $airports,
        );
    }

    /**
     * @Route("/{location}/{slug}", name="public_airport_detail")
     * @Route("/{location}/{slug}.cfm", name="public_airport_detail_cfm")
     * @Template()
     */
    public function detailAction($location, $slug)
    {
        //$location >> city
        //$slug >> airport name
        $airport = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findOneBySlug($slug);

        if (!$airport) {
            throw $this->createNotFoundException('Unable to find Airport.');
        }
        
        $nearestAirports = $this->getDoctrine()->getRepository('JetChartersAppBundle:Airport')->findNearestAirports($airport->getNLatitude(), $airport->getNLongitude(), $airport->getId());
        
        return array(
            'airport' => $airport,
            'nearestAirports' => $nearestAirports,
        );
    }
}

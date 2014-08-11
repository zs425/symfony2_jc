<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class EmptyLegController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/empty-legs")
 */
class EmptyLegController extends Controller
{
    /**
     * @Route("/", name="public_empty_leg_index")
     * @Template()
     */
    public function indexAction()
    {
        $form_defaults = array(
            'from_date' => '2014-01-01',
            'to_date' => '2014-04-01'
        );

        $results = $this->getDoctrine()->getManager()
            ->getRepository('JetChartersAppBundle:CharterAircraftEmptyLeg')
            ->searchAllBy($form_defaults);

        return array(
            'results' => $results,
            'form_defaults' => $form_defaults
        );
    }
}

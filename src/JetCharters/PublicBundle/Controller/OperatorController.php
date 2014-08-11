<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JetCharters\AppBundle\Entity\EmptyLeg;

/**
 * Class OperatorController
 * @package JetCharters\PublicBundle\Controller
 * @Route("/operators")
 */
class OperatorController extends Controller
{
    /**
     * @Route("/", name="public_operators")
     * @Template()
     */
//    public function indexAction()
//    {
//        return array('results' => array());
//    }

    /**
     * @Route("/{slug}", name="public_operator_detail")
     * @Route("/{slug}.cfm", name="public_operator_detail_cfm")
     * @Template()
     */
    public function detailAction($slug) {
        $operator = $this->getDoctrine()->getRepository('JetChartersAppBundle:Operator')->findBySlugForDetail($slug);

        if ( !$operator ) {
            throw $this->createNotFoundException('Unable to find operator.');
        }
        $similartOperators = $this->getDoctrine()->getRepository('JetChartersAppBundle:Operator')->findSimilarOperators($operator->getNLatitude(), $operator->getNLongitude(), $operator->getId());
        
        return array(
            'operator' => $operator,
            'similartOperators' => $similartOperators
            
        );
    }
}

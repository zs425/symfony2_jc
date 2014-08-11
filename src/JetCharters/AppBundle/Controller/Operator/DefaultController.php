<?php

namespace JetCharters\AppBundle\Controller\Operator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/operator-admin")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="operator_dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
    	$name = "Jim";
        return array('name' => $name."foo");
    }

    /**
     * @Route("/terms", name="operator_terms")
     * @Template()
     */
    public function termsAction()
    {
        return array();
    }

    /**
     * @Route("/dashboard/chart_data", name="operator_dashboard_chart_data")
     */
    public function chartDataAction()
    {
    	$response = new JsonResponse();
		$response->setData(array(
		    'visitors' => array([1, 90], [2, 81], [3, 332], [4, 95],[5, 171],[6, 130],[7, 165],[8, 141],[9, 212],[10, 184],[11, 201],[12, 150]),
		    'visits' => array([1, 4], [2, 4], [3, 7], [4, 12],[5, 5],[6, 7],[7, 13],[8, 12],[9, 6],[10,24],[11,15],[12, 10]),
		    'ticks' => array([1,"FEB 2013"], [2,"MAR 2013"], [3,"APR 2013"], [4,"MAY 2013"], [5,"JUN 2013"], [6,"JUL 2013"],
                       [7,"AUG 2013"], [8,"SEP 2013"], [9,"OCT 2013"], [10,"NOV 2013"], [11,"DEC 2013"], [12,"JAN 2014"])
		));

		return $response;
    }

    /** TESTING
     * @Route("/company", name="operator_dashboard_company")
     */
    public function companyAction()
    {
        $user = $this->getUser();
        $company = $user->getCompany();
        \Doctrine\Common\Util\Debug::dump($company);
        return new Response(" ");
    }

}

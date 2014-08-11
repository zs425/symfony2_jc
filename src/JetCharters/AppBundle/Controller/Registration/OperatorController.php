<?php

namespace JetCharters\AppBundle\Controller\Registration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class OperatorController extends Controller
{
	/**
	 * @Route("/register/operator", name="register_operator")
	 */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('JetCharters\AppBundle\Entity\OperatorUser');
    }
} 
<?php

namespace JetCharters\AppBundle\Controller\Registration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AdministratorController extends Controller
{
	/**
	 * @Route("/register/administrator", name="register_administrator")
	 */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('JetCharters\AppBundle\Entity\Administrator');
    }
}
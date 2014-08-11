<?php

namespace JetCharters\AppBundle\Controller\Registration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SiteUserController extends Controller
{
	/**
	 * @Route("/register/user", name="register_siteuser")
	 */
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('JetCharters\AppBundle\Entity\SiteUser');
    }
}
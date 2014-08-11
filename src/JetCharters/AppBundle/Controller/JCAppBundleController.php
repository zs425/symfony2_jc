<?php

namespace JetCharters\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JCAppBundleController extends Controller {

    public function setSuccessFlash($message) {
        $this->get('session')->getFlashBag()->add(
            'success',
            $message
        );
    }
}
<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Badges controller.
 *
 * @Route("/admin/badges")
 */
class BadgesController extends Controller
{
    /**
     * Badge Generator
     *
     * @Route("/", name="admin_badges")
     * @Template()
     */
    public function defaultAction(Request $request)
    {
        $badge_code = "";

        $form = $this->createFormBuilder()
                    ->add('badgecolor', 'choice', array('label' => 'Badge Color', 'choices' =>
                        array(  1 => 'Blue',
                                2 => 'Black'
                                )))
                    ->add('badgeurl', 'text', array('label' => 'Badge URL', 'attr' => array('value' => 'http://jetcharters.com')))
                    ->add('generate', 'submit', array('label' => 'Generate'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $url = $form["badgeurl"]->getData();
            switch ($form["badgecolor"]->getData()) {
                case 1:
                    $badge_code = '<script src="http://www.jetcharters.com/js/badges.js"></script> <script> var bid="1"; var url="'.$url.'"; badge(bid,url); </script> <div style="width:200px;font-family:arial;font-size:9px;text-align:center">Aircraft availability provided by <a href="http://www.jetcharters.com/">JetCharters.com</a> Aircraft information</div>';
                    break;

                case 2:
                    $badge_code = '<script src="http://www.jetcharters.com/js/badges.js"></script> <script> var bid="2"; var url="'.$url.'"; badge(bid,url); </script> <div style="width:200px;font-family:arial;font-size:9px;text-align:center">Source: <a href="http://www.JetCharters.com/">JetCharters.com</a> Information</div> ';
                    break;
            }
        }

        return array(
            'form' => $form->createView(),
            'badge_code' => $badge_code
        );
    }

}

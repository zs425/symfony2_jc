<?php

namespace JetCharters\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use JetCharters\AppBundle\Entity\OperatorUser;
use JetCharters\AppBundle\Entity\Operator;
use JetCharters\AppBundle\Entity\OperatorBillingInformation;

use JetCharters\AppBundle\Form\OperatorUserType;
use JetCharters\AppBundle\Form\OperatorBillingInformationType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="public_index")
     * @Template()
     */
    public function indexAction()
    {
        $types = $this->getDoctrine()->getManager()->getRepository('JetChartersAppBundle:AircraftType')->findAll();
                
        //$geo_info = $this->geoCheckIP($this->getIp());
        $geo_info = $this->geoCheckIP("150.210.231.30");
        $country_code = explode(' ', explode('-', $geo_info["country"])[0])[0];
        $state = $geo_info["state"];        
        $city = $geo_info["city"];          
        
        $featured_charters = $this->getDoctrine()->getManager()->getRepository('JetChartersAppBundle:CharterAircraft')->findFeaturedAircraft($country_code, $state, $city);

        return array(
            'types' => $types,
            'featured_charters' => $featured_charters
        );
    }
        
    public function createCustomForm($formType, $entity, $otherDataArr=array(), $label='Create') {
	
	$otherDataArr['method'] = 'POST';
	
	$customform = $this->createForm($formType, $entity, $otherDataArr);

        return $customform->add('submit', 'submit', array('label' => $label));
    }

    /**
     * @Route("/operator_sign_up/step1/", name="public_operators_signup_step1")
     * @Template()
     */
    public function operatorSignUpAction(Request $request)
    {
	$operatorUser = new OperatorUser();

        $operatorUserForm = $this->createCustomForm(new OperatorUserType(), $operatorUser);

        if ($request->getMethod() == 'POST') {

            $operatorUserForm->handleRequest($request);

            $postData = $request->request->get('jetcharters_appbundle_operator');
            $companyName = $postData['companyName'];
            $website = $postData['website'];
            $certificate = $postData['certificate'];

            $errors = $this->get('validator')->validate($operatorUser, array('registration'));

            if ($operatorUserForm->isValid() && count($errors) <= 0 && $companyName != '') {

                $em = $this->getDoctrine()->getManager();

                $operatorUser->setUsername($operatorUser->getEmail());
                $operatorUser->setPlainPassword($operatorUser->getPassword());
                $operatorUser->setEnabled(1);

                $em->persist($operatorUser);
                $em->flush();

                //Insert Operator
                if ($operatorUser->getId() > 0) {

                    $operator = new Operator();

                    $operator->setName($companyName);
                    $operator->setWebsite($website);
                    $operator->setCertificateNumber($certificate);
                    $operator->setContactName($operatorUser->getFirstName() . " " . $operatorUser->getLastName());
                    $operator->setContactPhone($operatorUser->getPhone());
                    $operator->setAddress1($operatorUser->getAddress1());
                    $operator->setAddress2($operatorUser->getAddress2());
                    $operator->setCity($operatorUser->getCity());
                    $operator->setState($operatorUser->getState());
                    $operator->setZipcode($operatorUser->getZip());
                    $operator->setCountry($operatorUser->getCountry());
                    $operator->setSlug($this->clean($operatorUser->getFirstName() . "-" . $operatorUser->getLastName()));
                    $operator->setIsActive(1);
                    $operator->setBillingNextDue(new \DateTime());
                    $operator->setBillingUser($operatorUser);

                    $em->persist($operator);
                    $em->flush();

                    //Udpate OperatorUser with Operator
                    if ($operator->getId()) {
                        $operatorUser->setOperator($operator);

                        $em->persist($operator);

                        $em->flush();
                    }

		    $this->get('session')->set('registeredUserId', $operatorUser->getId());
			    
                    return $this->redirect($this->generateUrl('public_operators_signup_step2'));
                }
            } else {
                $formErrors = $this->getErrorMessages($operatorUserForm);

            }
        }

        return array(
            'form' => $operatorUserForm->createView(),
            'errors' => isset($errors) ? $errors : false,
            'formErrors' => isset($formErrors) ? $formErrors : false
        );
    }

    /**
     * @Route("/operator_sign_up/step2/", name="public_operators_signup_step2")
     * @Template()
     */
    public function operatorSignUpStep2Action(Request $request)
    {
	$operatorBillingInformation = new OperatorBillingInformation();
	
	if ($this->get('session')->get('registeredUserId') && $this->get('session')->get('registeredUserId')>0){
	    $operator = $this->getDoctrine()->getManager()->getRepository('JetChartersAppBundle:OperatorUser')->find($this->get('session')->get('registeredUserId'));
	} else {
	    $operator = false;
	}	
	
	$operatorBillingInformationForm = $this->createCustomForm(new OperatorBillingInformationType(), $operatorBillingInformation, array('registeredUser' => $operator), 'Activate');

	return array(
            'form' => $operatorBillingInformationForm->createView(),
            'errors' => isset($errors) ? $errors : false,
            'formErrors' => isset($formErrors) ? $formErrors : false
        );
        
    }

    private function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    private function getErrorMessages(\Symfony\Component\Form\Form $form)
    {
        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }

    /**
     * @Route("/advertise", name="public_advertise")
     * @Template()
     */
    public function advertiseAction()
    {

        return array();
    }

    /**
     * @Route("/safety", name="public_safety")
     * @Template()
     */
    public function safetyAction()
    {

        return array();
    }
    
    /**
     * @Route("/why-charter", name="public_why_charter")
     * @Template()
     */
    public function whyCharterAction()
    {

        return array();
    }
    
    /**
     * @Route("/about", name="public_about_charter")
     * @Template()
     */
    public function aboutCharterAction()
    {

        return array();
    }

    /**
     * @Template()
     */
    public function globalLoginAction()
    {
        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return array(
            'csrf_token' => $csrfToken
        );
    }
    
    private function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];        
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
     
        return $ip;
    }
      
   private function geoCheckIP($ip)
   {
        //check, if the provided ip is valid
       if(!filter_var($ip, FILTER_VALIDATE_IP))
       {
               throw new InvalidArgumentException("IP is not valid");
       }

       //contact ip-server
       $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
       if (empty($response))
       {
               throw new InvalidArgumentException("Error contacting Geo-IP-Server");
       }

       //Array containing all regex-patterns necessary to extract ip-geoinfo from page
       $patterns=array();
       $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
       $patterns["country"] = '#Country: (.*?)&nbsp;#i';
       $patterns["state"] = '#State/Region: (.*?)<br#i';
       $patterns["city"] = '#City: (.*?)<br#i';

       //Array where results will be stored
       $ipInfo=array();

       //check response from ipserver for above patterns
       foreach ($patterns as $key => $pattern)
       {
               //store the result in array
               $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
       }

       return $ipInfo;
   }
}

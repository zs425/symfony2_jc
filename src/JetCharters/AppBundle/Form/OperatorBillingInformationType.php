<?php

namespace JetCharters\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OperatorBillingInformationType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
	$builder
            ->add('aircraftFleet', 'integer',  array('data'  => 1 ))
            ->add('couponCode', 'text',  array('required'  => false))
            ->add('billCycle', 'choice', array('choices'  => array('monthly' => 'Month', 'quarterly' => '3 Months - 5% OFF', 'yearly' => 'Year - 10% OFF'), 'required' => true))
            ->add('totalCost', 'text',  array('attr'  => array('disabled' => 'disabled'), 'data' => '$49.95 per month' ))
            ->add('cardType', 'choice', array('choices'  => array('visa' => 'Visa', 'mastercard' => 'Mastercard', 'amex' => 'American Express'), 'required' => true))
            ->add('cardNumber')
            ->add('expireDate', 'date')
            ->add('ccvNumber')
            ->add('renewalTerm', 'choice', array('choices'  => array('6 Months' => '6 Months', '1 Year' => '1 Year'), 'expanded' => true, 'required' => true))
            ->add('operator' , new OperatorUserType(), array('formStep'=>'step2', 'registeredUserData' => isset($options['registeredUser']) ? $options['registeredUser'] : false ))//, array('formStep'=>'step2'))
	    ->add('termConditons',  'checkbox', array( "mapped" => false, 'required'  => true, 'label'  => 'I agree to the JetCharters.com Terms and Conditions. ', 'attr' => array('value'=>true)))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\OperatorBillingInformation',
	    'registeredUser' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_operatorbillinginformation';
    }
}

<?php

namespace JetCharters\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CharterAircraftType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('operatorID')
            ->add('active', 'choice', array("choices" => array(
                        1 => "Enabled",
                        0 => "Disabled")))
//            ->add('name')
            ->add('model')
//            ->add('location')
            ->add('tailNumber')
            ->add('hideTailNumber', 'checkbox', array( 'required' => false))
            ->add('seats')
            // ->add('availableFrom')
            // ->add('availableTo')
            // ->add('photos')
            ->add('hourlyRate')
//             ->add('hourlyRate2')
//             ->add('realTailNumber')
            ->add('airAmbulance', 'choice', array(
                    'choices'   => array(false => 'No', true => 'Yes')  ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\CharterAircraft'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_charteraircraft';
    }
}

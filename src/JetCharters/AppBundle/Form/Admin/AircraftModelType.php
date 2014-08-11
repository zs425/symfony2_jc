<?php

namespace JetCharters\AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AircraftModelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('type')
            ->add('hasLavatory', 'choice', array('choices' => array(0 => 'No', 1 => 'Yes'), 'required' => false))
            ->add('numberOfSeats')
            ->add('maxRange')
            ->add('maxAirSpeed')
            ->add('description')
            ->add('isFeaturedAC', 'choice', array('choices' => array(0 => 'No', 1 => 'Yes'), 'required' => false))
            ->add('featuredACRank')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\AircraftModel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_aircraftmodel';
    }
}

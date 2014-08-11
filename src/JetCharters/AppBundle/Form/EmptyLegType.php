<?php

namespace JetCharters\AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use JetCharters\AppBundle\Entity\CharterAircraftRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use JetCharters\AppBundle\Form\Type\AutoSelectType;

class EmptyLegType extends AbstractType
{
    protected $aircraft;

    public function __construct($aircraft) {
        $this->aircraft = $aircraft;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('name')
            ->add('aircraft', 'entity', array(
                'class' => 'JetChartersAppBundle:CharterAircraft',
                'choices' => $this->aircraft
            ))
            ->add('fromDate','datePicker')
            ->add('toDate','datePicker')
//            ->add('origin', 'autoSelect', array('class' => 'JetCharters\AppBundle\Entity\Airport' ))
//            ->add('destination', 'autoSelect', array('class' => 'JetCharters\AppBundle\Entity\Airport' ))
//            ->add('company')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_emptyleg';
    }
}

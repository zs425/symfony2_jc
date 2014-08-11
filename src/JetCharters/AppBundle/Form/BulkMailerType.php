<?php

namespace JetCharters\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BulkMailerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('list')
            ->add('sendTime', 'datetime', array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                ))
            ->add('subject')
            ->add('headerImage')
            ->add('topLink')
            ->add('bottomLink')
            ->add('mailerBody')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\BulkMailer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_bulkmailer';
    }
}

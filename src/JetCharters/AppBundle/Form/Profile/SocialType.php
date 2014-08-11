<?php

namespace JetCharters\AppBundle\Form\Profile;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SocialType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('facebook_url')
            ->add('twitter_url')
            ->add('google_url')
            ->add('youtube_url')
            ->add('linkedin_url');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\Operator'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_social';
    }
}

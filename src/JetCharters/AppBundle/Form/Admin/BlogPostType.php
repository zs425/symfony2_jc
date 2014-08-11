<?php

namespace JetCharters\AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogPostType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postTitle')
            ->add('postBody', 'textarea', array("attr" => array("class"=>".wysihtml5")))
            ->add('image', 'file')
	    ->add('category', 'entity', array(
	      'class' => 'JetChartersAppBundle:BlogPostCategory',
	      'property' => 'categoryName',
	      'empty_value' => 'Choose Category'
	    ))
            ->add('isPublish')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\BlogPost'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_blogpost';
    }
}

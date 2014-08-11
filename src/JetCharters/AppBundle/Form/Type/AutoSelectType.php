<?php

namespace JetCharters\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutoSelectType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            //'widget' => 'single_text'
        ));
    }
    
    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'autoSelect';
    }
}
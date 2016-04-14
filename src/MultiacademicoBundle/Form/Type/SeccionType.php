<?php

namespace MultiacademicoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SeccionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('label'=>'Seccion',
                                     'choices'=>array('Matutino'=>'Matutino',
                                                                 'Vespertino'=>'Vespertino',
                                                                 'Nocturno'=>'Nocturno'),
                                      'placeholder'=>'',
                                      /*'attr'=>array(
                                          'style'=>'width:4.5em;'
                                          )*/
            
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
    public function getName()
    {
        return 'seccion';
    }
}
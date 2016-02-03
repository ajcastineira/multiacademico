<?php

namespace MultiacademicoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParaleloType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('label'=>'Paralelo',
                                       'choices'=>array('A'=>'A',
                                                        'B'=>'B',
                                                        'C'=>'C',
                                                       'D'=>'D',
                                                        'E'=>'E',
                                                        'F'=>'F',
                                                        'G'=>'G',
                                                        'H'=>'H',
                                                        'I'=>'I',
                                                        'J'=>'J'
                                                         ),
                                      'placeholder'=>'',
                                      'attr'=>array(
                                          'style'=>'width:6em;'
                                          )
            
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
    public function getName()
    {
        return 'paralelo';
    }
}
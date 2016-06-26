<?php

namespace MultiacademicoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use Doctrine\ORM\EntityManager;
//use Multiservices\UbicatexBundle\Form\DataTransformer\CiudadToNumberTransformer;

class NotaCualitativaType extends AbstractType
{
    //private $entityManager;
    //private $transformer;
  /*  public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }*/
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('choices'=>array('EX'=>'EX',
                                                        'MB'=>'MB',
                                                        'B'=>'B',
                                                       'R'=>'R',
                                                        'I'=>'I'
                                                         ),
                                      'placeholder'=>'',
                                      'attr'=>array(
                                          'style'=>'width:5.5em;'
                                          )
            
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
    public function getName()
    {
        return 'letra';
    }
}
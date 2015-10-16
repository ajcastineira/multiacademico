<?php

namespace MultiacademicoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Doctrine\ORM\EntityManager;
//use Multiservices\UbicatexBundle\Form\DataTransformer\CiudadToNumberTransformer;

class NotaType extends AbstractType
{
    //private $entityManager;
    //private $transformer;
  /*  public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }*/
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr'=>array(
                'min'=> '0' ,
                'max'=> '10' ,
                'step'=>'0.01',
                'style'=>'width: 5em;',)
                //'maxlength'=>4,
                
                
                
            
        ));
    }

    public function getParent()
    {
        return 'number';
    }
    public function getName()
    {
        return 'nota';
    }
}
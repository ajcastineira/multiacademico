<?php

namespace MultiacademicoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MateriaType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr'=>array( 'class'=>'chosen-select ',
                           'data-chosen-select'=>null,
                          'data-placeholder'=>'Seleccione Materia...'),
            'class'=>  'MultiacademicoBundle:Materias',
            'placeholder'=>'',
            'multiple'=>false
        ));
    }

    public function getParent()
    {
        return EntityType::class;
    }
    public function getName()
    {
        return 'materia';
    }
}
<?php

namespace Multiservices\ArxisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsersType extends AbstractType
{
    /*private $entityManager;
    private $transformer;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }*/
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
             'attr'=>array( 'class'=>'chosen-select ',
                           'data-chosen-select'=>null,
                          'data-placeholder'=>'Seleccione Usuario...'),
            'class'=>  'MultiservicesArxisBundle:Usuario',
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
        return 'users';
    }
}
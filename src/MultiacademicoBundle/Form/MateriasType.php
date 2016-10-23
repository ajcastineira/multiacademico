<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MateriasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('materia')
            ->add('materiatipo',ChoiceType::class,['label'=>'Tipo',
                                                   'choices'=>['Básica'=>'BASICA',
                                                               'Oferta Institucional'=>'OFERTAINST'
                                                   ]])
            ->add('areas',null,array('attr'=>array(
                                                                'multiple'=>null,
                                                                'class'=>'chosen-select',
                                                                'data-chosen-select'=>null,
                                                                'data-placeholder'=>'Seleccione Area Academica...'),
                                                    'multiple'=>true,
                                                    'expanded'=>false,
                                                    'placeholder'=>''
                                                    ))
            ->add('prioridad')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Materias',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'materias';
    }
}

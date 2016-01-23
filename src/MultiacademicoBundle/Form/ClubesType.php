<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ClubesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club',null,array('label'=>'Nombre Proyecto Escolar'))
           //->add('clubabreviatura')
            //->add('clubestado')
            ->add('campoaccion',null,array('label'=>'Campo de Accion'))
            ->add('clubcoddocente',null,array('label'=>'Docente Encargado',
                                              'attr'=>array(
                                                                'class'=>'chosen-select ','data-chosen-select'=>null)
                                                    ))
            ->add('registrados',CollectionType::class,array(
                'label'=>'Alumnos Registrados en Club',
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
                'entry_type'   => ClubesEstudianteType::class,
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Clubes',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clubes';
    }
}

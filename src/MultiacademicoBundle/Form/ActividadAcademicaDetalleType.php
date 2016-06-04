<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use MultiacademicoBundle\Form\Type\NotaType;

class ActividadAcademicaDetalleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calificacion',NotaType::class)
            //->add('entregada')
            //->add('fechaEntregada', DateTimeType::class)
            //->add('revisada')
            //->add('fechaRevisada', DateTimeType::class)
            //->add('estado')
            //->add('matricula')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\ActividadAcademicaDetalle',
            'attr' => array('ng-submit'=>"processForm(\$event,'actividad_academica_detalle')")
        ));
    }
}

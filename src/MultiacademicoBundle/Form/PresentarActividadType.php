<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PresentarActividadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')    
            ->add('file', FileType::class, [
                    'label' => 'Archivo',
                     'required'=>false,
                    'attr' => [
                                'accept'=>'image/*, application/pdf, application/x-pdf,
                               application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                               application/vnd.ms-excel , application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                               application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation,
                              application/x-rar-compressed, application/zip'
                    ]
            ])
            ->add('observacion')        
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
            'attr' => array('ng-submit'=>"processForm(\$event,'presentar_actividad')")
        ));
    }
}

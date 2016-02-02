<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MatriculasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matriculacodperiodo',null,array('label'=>'Periodo'))
            ->add('matriculacodestudiante',null,array('label'=>'Estudiante'))
            ->add('matriculacodespecializacion',null,array('label'=>'Especializacion'))
            ->add('matriculacodcurso',null,array('label'=>'Curso'))
            
            ->add('matriculaparalelo',ChoiceType::class,array('label'=>'Paralelo',
                                                              'choices'=>array( 'A'=>'A',
                                                                                'B'=>'B',
                                                                                'C'=>'C',
                                                                                'D'=>'D',
                                                                                'E'=>'E',
                                                                                'F'=>'F',
                                                                                'G'=>'G',
                                                                                'H'=>'H',
                                                                                'I'=>'I'
                                                                                )  
                                                               ))
            ->add('matriculaseccion',ChoiceType::class,array('label'=>'Seccion',
                                                'choices'=>array('Matutino'=>'Matutino',
                                                                 'Vespertino'=>'Vespertino',
                                                                 'Nocturno'=>'Nocturno')
                                                ))
            ->add('matriculafecha', DateTimeType::class)
            //->add('matriculaclave')
            ->add('matriculatipo',ChoiceType::class,array(
                                                           'choices'=>array('Ordinaria'=>'Ordinaria','Extraordinaria'=>'Extraordinaria')
                                                           ))
            ->add('matriculaobservacion',null,array('label'=>'Observacion'))
            //->add('matriculaestado')
          //  ->add('matriculausuario')
            
            
          //  ->add('aula')
         //   ->add('comportamiento')
          //  ->add('asistencia')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Matriculas',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }
    
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'matriculas';
    }
}

<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

use MultiacademicoBundle\Form\Type\SeccionType;
use MultiacademicoBundle\Form\Type\ParaleloType;
use MultiacademicoBundle\Form\Type\EstudianteNoMatriculadoType;

class MatriculasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matriculacodperiodo',null,array('label'=>'Periodo'));
        
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event)  {
                $form = $event->getForm();

                $formOptions = array(
                    'class' => 'MultiacademicoBundle:Estudiantes',
                    'property_path' => 'matriculacodestudiante',
                    'query_builder' => function (EntityRepository $er)  {
                         return $er->estudiantesNoMatriculados();
                    },
                );

                // create the field, this is similar the $builder->add()
                // field name, field type, data, options
                $form->add('matriculacodestudiante', EstudianteNoMatriculadoType::class, $formOptions);
            }
        );
        
        
        
        
        $builder
            //->add('matriculacodestudiante',  EstudianteNoMatriculadoType::class,array('label'=>'Estudiante'))
            ->add('matriculacodespecializacion',null,array('label'=>'Especializacion'))
            ->add('matriculacodcurso',null,array('label'=>'Curso'))
            ->add('matriculaparalelo',ParaleloType::class)
            ->add('matriculaseccion',SeccionType::class)
           // ->add('matriculafecha', DateTimeType::class)
            
            ->add('matriculatipo',ChoiceType::class,array(
                                                           'choices'=>array('Ordinaria'=>'Ordinaria','Extraordinaria'=>'Extraordinaria')
                                                           ))
            ->add('matriculaobservacion',null,array('label'=>'Observacion'))
            
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

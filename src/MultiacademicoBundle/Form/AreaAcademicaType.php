<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AreaAcademicaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('director',null,array('attr'=>array(
                                                                'class'=>'chosen-select ',
                                                                'data-chosen-select'=>null,
                                                                'data-placeholder'=>'Seleccione Docente...'),
                                                    'placeholder'=>''
                                                    ))
                ->add('materias',null,array('attr'=>array(
                                                                'multiple'=>null,
                                                                'class'=>'chosen-select',
                                                                'data-chosen-select'=>null,
                                                                'data-placeholder'=>'Seleccione Materias...'),
                                                    'placeholder'=>''
                                                    ))
                //->add('subdirector')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\AreaAcademica',
            'attr' => array('ng-submit'=>"processForm(\$event,'multiacademicobundle_areaacademica')")
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'multiacademicobundle_areaacademica';
    }


}

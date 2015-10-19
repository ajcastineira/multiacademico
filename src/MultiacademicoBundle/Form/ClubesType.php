<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('clubcoddocente',null,array('label'=>'Docente Encargado'))
            ->add('registrados','collection',array(
                'label'=>'Alumnos Registrados en Club',
                'allow_add'=>true,
                'allow_delete'=>true,
                'by_reference'=>false,
                'type'   => new ClubesEstudianteType(),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
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
        return 'multiacademicobundle_clubes';
    }
}

<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalificarProyectoEscolarType extends AbstractType
{
    private $quimestre;
    private $parcial;
    
    public function __construct($quimestre,$parcial) {
        $this->quimestre=$quimestre;
        $this->parcial=$parcial;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('calificaciones', 'collection', array(
                        
                        'type'   => new ClubesDetalleType($this->quimestre,$this->parcial),
                        'options'  => array(
                            //'required'  => false,
                            //'attr'      => array('class' => 'email-box')
                        ),
                    ));
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Calificar\ProyectoACalificar',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_calificar_proyectoescolar';
    }
}

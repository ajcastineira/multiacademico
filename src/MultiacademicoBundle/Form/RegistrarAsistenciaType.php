<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use MultiacademicoBundle\Libs\Parcial;

class RegistrarAsistenciaType extends AbstractType
{
    private $quimestre;
    private $parcial;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //var_dump($this->getParent());
       
        $builder->add('asistencias', CollectionType::class, array(
                        
                        //'entry_type'   => new ClubesDetalleType($this->quimestre,$this->parcial),
                        'entry_type' => AsistenciaType::class ,
                        'entry_options'  => array(
                            //'required'  => false,
                            //'attr'      => array('class' => 'email-box')
                            )
                    ));
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Calificar\AsistenciasARegistrar',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'registrar_asistencia';
    }
}

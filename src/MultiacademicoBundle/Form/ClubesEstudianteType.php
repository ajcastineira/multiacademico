<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\Type\LetraType;

class ClubesEstudianteType extends AbstractType
{
    //private $q;
    //private $p;
    
    //public function __construct($q,$p) {
    //    $this->q=$q;
      //  $this->p=$p;
   // }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
           // ->add('codclub')
            ->add('clubescodestudiante',null,array('attr'=>array(
                                                                'class'=>'chosen-select ',
                                                                'data-chosen-select'=>null,
                                                                'data-placeholder'=>'Buscar Estudiante...'),
                                                    'placeholder'=>''
                                                    ))
            //->add('notaQ'.$this->q.'P1',new LetraType())
            //->add('notaQ'.$this->q.'P2',new LetraType())
            //->add('notaQ'.$this->q.'P3',new LetraType())
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\ClubesDetalle',
            'attr' => array(
                              "class"=>"" 
                            // 'ng-submit'=>"processForm(\$event,'".$this->getName()."')"
                            )
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clubes_estudiante';
    }
}

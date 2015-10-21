<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use MultiacademicoBundle\Form\Type\LetraType;

class ClubesDetalleType extends AbstractType
{
    private $q;
    private $p;
    
    public function __construct($q,$p) {
        $this->q=$q;
        $this->p=$p;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notaQ'.$this->q.'P1',new LetraType())
            ->add('notaQ'.$this->q.'P2',new LetraType())
            ->add('notaQ'.$this->q.'P3',new LetraType())
           // ->add('codclub')
          //  ->add('clubescodestudiante')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\ClubesDetalle',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_clubesdetalle';
    }
}

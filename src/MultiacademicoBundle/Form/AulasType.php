<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AulasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periodo')
            ->add('curso')
            ->add('especializacion')
            ->add('paralelo')
            ->add('seccion')
            ->add('alias')     
            ->add('tutor')
            ->add('inspector')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Aula',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'aulas';
    }
}

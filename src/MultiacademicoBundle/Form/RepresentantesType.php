<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RepresentantesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('representante')
            ->add('cedula')
            ->add('domicilio')
            ->add('telefono')
            ->add('tipo',  ChoiceType::class,['label'=>'Tipo de Representante','choices'=>[
                                                                                        'Madre'=>'Madre',
                                                                                         'Padre'=>'Padre',
                                                                                         'Otro'=>'Otro'
                                                                                        ]])
            ->add('montoMensual')
           // ->add('status')
           // ->add('usuario')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Representantes',
            'attr' => array('ng-submit'=>"processForm(\$event,'representantes')")
        ));
    }
}

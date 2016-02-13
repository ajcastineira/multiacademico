<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\Type\RepresentanteType;

class IngresosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('fecha', 'datetime')
            ->add('monto')
            ->add('descripcion')
            ->add('referencia')
            ->add('collectedby')
            ->add('modifiedby')
            ->add('formaPago')
            ->add('representante',  RepresentanteType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Ingresos',
            'attr' => array('ng-submit'=>"processForm(\$event,'ingresos')")
        ));
    }
}

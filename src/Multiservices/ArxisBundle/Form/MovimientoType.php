<?php

namespace Multiservices\ArxisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovimientoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monto')
            ->add('detalle')
            ->add('fecha')
            ->add('f1')
            ->add('f2')
            ->add('type')
            ->add('origenuid')
            ->add('destinouid')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\ArxisBundle\Entity\Movimiento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiservices_arxisbundle_movimiento';
    }
}

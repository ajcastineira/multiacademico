<?php

namespace Multiservices\ArxisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MensajesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('autorid')
            ->add('destinoid')
            ->add('mensaje')
            ->add('timesent')
            ->add('timeread')
            ->add('leido')
            ->add('eliminadoautor')
            ->add('eliminadodestino')
            ->add('importante')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\ArxisBundle\Entity\Mensajes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiservices_arxisbundle_mensajes';
    }
}

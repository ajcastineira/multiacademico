<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Multiservices\LexBundle\Entity\Contactos;

class IngresosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         //   ->add('fecha')
            ->add('cliente','cliente')
            ->add('monto')
          //  ->add('caso')
            ->add('descripcion')
            ->add('referencia')
            ->add('formaPago')
        ;
        
        $formModifier = function (FormInterface $form, Contactos $cliente = null) {
             $casos = null === $cliente ? array() : $cliente->getCasos();
            $form->add('caso', 'entity', array(
                    'class'       => 'LexBundle:Casos',
                    'placeholder' => '',
                    'choices'     => $casos,
                    'required' => false
                ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCliente());
            }
        );

        $builder->get('cliente')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();
                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $sport);
            }
        );

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Multiservices\PayPayBundle\Entity\Ingresos',
            'attr' => array('ng-submit'=>"processForm('".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiservices_paypaybundle_ingresos';
    }
}

<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Multiservices\PayPayBundle\Entity\Facturas;
use MultiacademicoBundle\Entity\Representantes;
use Multiservices\PayPayBundle\Entity\Ingresos;

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
            ->add('representante',  RepresentanteType::class)
            ->add('monto')
            ->add('descripcion')
            ->add('referencia')
           // ->add('collectedby')
          //  ->add('modifiedby')
            ->add('formaPago')
           // ->add('factura')
           
                ;
                
                
           $formModifier = function (FormInterface $form, Representantes $representante = null) {
                
               
               //$facturas = null === $representante ? array() : $representante->getFacturas()->toArray();
                
                
                $formOptions = array(
                    'class'       => 'PayPayBundle:Facturas',
                    'placeholder' => '',
                    //'choices'     => $facturas,
                    'multiple'=>true,
                    'property_path' => 'facturas',
                    'query_builder' => function (EntityRepository $er) use($representante)  {
                         return $er->facturasPendientes($representante);
                    }
                );
                
            $form->add('facturas', EntityType::class, $formOptions);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. Ingresos
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getRepresentante());
            }
        );

        $builder->get('representante')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $representante = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $representante);
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
            'attr' => array('ng-submit'=>"processForm(\$event,'ingresos')")
        ));
    }
}

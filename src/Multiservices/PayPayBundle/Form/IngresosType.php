<?php

namespace Multiservices\PayPayBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Multiservices\PayPayBundle\Entity\Facturas;
use MultiacademicoBundle\Entity\Representantes;
use MultiacademicoBundle\Entity\Estudiantes;
use Multiservices\PayPayBundle\Entity\Ingresos;

use MultiacademicoBundle\Form\Type\RepresentanteEstudianteType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class IngresosType extends AbstractType
{
    private $manager;

    public function __construct()
    {
      //  $this->manager = $manager;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateTimeType::class)
            ->add('estudiante',  RepresentanteEstudianteType::class)
            ->add('monto',NumberType::class,['attr'=>
                                                    ['step'=>'0.01']]
                                            )
            ->add('descripcion')
            ->add('referencia')
           // ->add('collectedby')
          //  ->add('modifiedby')
            ->add('formaPago')
           // ->add('factura')
           
                ;
                
                
           $formModifier = function (FormInterface $form, Representantes $representante = null, PersistentCollection $facturas=null) {
                
               $facturas = null === $facturas ? array() : $facturas->toArray();
                
                $formOptions = array(
                    'class'       => 'PayPayBundle:Facturas',
                    'placeholder' => '',
                    //'choices'     => $facturas,
                    'multiple'=>true,
                    'property_path' => 'facturas',
                    'query_builder' => function (EntityRepository $er) use($representante,$facturas)  {
                         return $er->facturasPendientes($representante,$facturas);
                    }
                );
                
            $form->add('facturas', EntityType::class, $formOptions);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. Ingresos
                $data = $event->getData();

                 $formModifier($event->getForm(), $data->getRepresentante(),$data->getFacturas());
                }    
        );

        $builder->get('estudiante')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $representante = $event->getForm()->getData()->getRepresentante();
                $facturas = $event->getForm()->getParent()->getData()->getFacturas();
                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $representante,$facturas);
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

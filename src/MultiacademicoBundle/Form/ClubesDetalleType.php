<?php

namespace MultiacademicoBundle\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\Type\LetraType;
use MultiacademicoBundle\Calificar\ProyectoACalificar;

class ClubesDetalleType extends AbstractType
{
    private $q;
    private $p;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $notas = $event->getData();
                $form = $event->getForm();
                $dataparent = $event->getForm()->getParent()->getParent()->getData();
                if ($dataparent instanceof ProyectoACalificar)
                {
                    $this->q=$dataparent->getParcial()->getQ();
                    $this->p=$dataparent->getParcial()->getP();       
                
            
                $form
                    ->add('notaQ'.$this->q.'P1',LetraType::class,['required'=>false])
                    ->add('notaQ'.$this->q.'P2',LetraType::class,['required'=>false])
                    ->add('notaQ'.$this->q.'P3',LetraType::class,['required'=>false]);
                }  
        })
                         
           // ->add('codclub')
          //  ->add('clubescodestudiante')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
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
        return 'clubesdetalle';
    }
}

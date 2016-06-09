<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\Type\LetraType;
use MultiacademicoBundle\Calificar\ComportamientoACalificar;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ComportamientoType extends AbstractType
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
                if ($dataparent instanceof ComportamientoACalificar)
                {
                    $this->q=$dataparent->getParcial()->getQ();
                    $this->p=$dataparent->getParcial()->getP(); 
                    if ($this->q<3)
                    {
                $form
                    ->add('agdcQ'.$this->q.'P'.$this->p, LetraType::class, ['required'=>false])
                    ->add('estabienQ'.$this->q.'P'.$this->p, TextareaType::class, ['required'=>false])
                    ->add('mejorarQ'.$this->q.'P'.$this->p, TextareaType::class, ['required'=>false])
                    ->add('crecomendacionQ'.$this->q.'P'.$this->p, TextareaType::class, ['required'=>false]);
                    }
                }  
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Comportamiento',
            'attr' => array('ng-submit'=>"processForm(\$event,'comportamiento')")
        ));
    }
}

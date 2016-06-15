<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use MultiacademicoBundle\Calificar\AsistenciasARegistrar;

class AsistenciaType extends AbstractType
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
                if ($dataparent instanceof AsistenciasARegistrar)
                {
                    $this->q=$dataparent->getParcial()->getQ();
                    $this->p=$dataparent->getParcial()->getP();       
                
            
                $form
                    ->add('atP'.$this->p.'Q'.$this->q,LetraType::class)
                    ->add('fjP'.$this->p.'Q'.$this->q,LetraType::class)
                    ->add('fiP'.$this->p.'Q'.$this->q,LetraType::class);
                }  
        });
        /*$builder
            ->add('atP1Q1')
            ->add('fjP1Q1')
            ->add('fiP1Q1')
            ->add('atP2Q1')
            ->add('fjP2Q1')
            ->add('fiP2Q1')
            ->add('atP3Q1')
            ->add('fjP3Q1')
            ->add('fiP3Q1')
            ->add('atP1Q2')
            ->add('fjP1Q2')
            ->add('fiP1Q2')
            ->add('atP2Q2')
            ->add('fjP2Q2')
            ->add('fiP2Q2')
            ->add('atP3Q2')
            ->add('fjP3Q2')
            ->add('fiP3Q2')
            ->add('asistencianummatricula')
        ;*/
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Asistencia',
            'attr' => array('ng-submit'=>"processForm(\$event,'asistencia')")
        ));
    }
}

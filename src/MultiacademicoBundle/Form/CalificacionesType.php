<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalificacionesType extends AbstractType
{
    private $q;
    private $p;
    
    public function __construct($q,$p) {
        $this->q=$q;
        $this->p=$p;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     
        
          //  ->add('calificacionnummatricula')
           // ->add('calificacioncodmateria')
           for ($i=1;$i<=5;$i++)     
           {
            $notavar='q'.$this->q.'P'.$this->p.'N'.$i;
               $builder->add($notavar,'nota');
           }
           if ($this->p==3)
           {
            $builder->add('q'.$this->q.'Ex','nota');
           }
           // ->add('q1P1Recomendacion')
           // ->add('q1P1Planmejora')
           /* ->add('q1P1Co')
            ->add('q1P2N1')
            ->add('q1P2N2')
            ->add('q1P2N3')
            ->add('q1P2N4')
            ->add('q1P2N5')
            ->add('q1P2Recomendacion')
            ->add('q1P2Planmejora')
            ->add('q1P2Co')
            ->add('q1P3N1')
            ->add('q1P3N2')
            ->add('q1P3N3')
            ->add('q1P3N4')
            ->add('q1P3N5')
            ->add('q1P3Recomendacion')
            ->add('q1P3Planmejora')
            ->add('q1P3Co')
            ->add('q1Ex')
            ->add('q1Recomendacion')
            ->add('q1Planmejora')
            ->add('q2P1N1')
            ->add('q2P1N2')
            ->add('q2P1N3')
            ->add('q2P1N4')
            ->add('q2P1N5')
            ->add('q2P1Recomendacion')
            ->add('q2P1Planmejora')
            ->add('q2P1Co')
            ->add('q2P2N1')
            ->add('q2P2N2')
            ->add('q2P2N3')
            ->add('q2P2N4')
            ->add('q2P2N5')
            ->add('q2P2Recomendacion')
            ->add('q2P2Planmejora')
            ->add('q2P2Co')
            ->add('q2P3N1')
            ->add('q2P3N2')
            ->add('q2P3N3')
            ->add('q2P3N4')
            ->add('q2P3N5')
            ->add('q2P3Recomendacion')
            ->add('q2P3Planmejora')
            ->add('q2P3Co')
            ->add('q2Ex')
            ->add('q2Recomendacion')
            ->add('q2Planmejora')
            ->add('mejoramiento')
            ->add('supletorio')
            ->add('remedial')
            ->add('gracia')
            ->add('grado')*/
            
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Calificaciones',
            'attr' => array(
                            'class'=>"",
                            'style'=>"display: flex;"
                            //'ng-submit'=>"processForm(\$event,'".$this->getName()."')"
                )
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_calificaciones';
    }
}

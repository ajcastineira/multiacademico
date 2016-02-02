<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DistributivosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distributivocodperiodo')
            ->add('distributivocoddocente')
            ->add('distributivocodmateria')  
            ->add('distributivocodcurso')
            ->add('distributivocodespecializacion')
            ->add('distributivoparalelo',ChoiceType::class,array('label'=>'Paralelo',
                                                              'choices'=>array( 'A'=>'A',
                                                                                'B'=>'B',
                                                                                'C'=>'C',
                                                                                'D'=>'D',
                                                                                'E'=>'E',
                                                                                'F'=>'F',
                                                                                'G'=>'G',
                                                                                'H'=>'H',
                                                                                'I'=>'I'
                                                                                )  
                                                               ))
            ->add('distributivoseccion',ChoiceType::class,array('label'=>'Seccion',
                                                'choices'=>array('Matutino'=>'Matutino',
                                                                 'Vespertino'=>'Vespertino',
                                                                 'Nocturno'=>'Nocturno')
                                    ))
            ->add('distributivohora')
            ->add('distributivofecha')
            ->add('distributivoestado')
            ->add('distributivogrado')
            
            
            
            
            //->add('aula')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Distributivos',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'distributivos';
    }
}

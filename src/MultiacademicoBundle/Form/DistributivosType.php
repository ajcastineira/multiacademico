<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\Type\SeccionType;
use MultiacademicoBundle\Form\Type\ParaleloType;

class DistributivosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distributivocodperiodo',null,['label'=>'Periodo'])
            ->add('distributivocoddocente',null,['label'=>'Docente'])
            ->add('distributivocodmateria',null,['label'=>'Materia'])
            ->add('distributivocodcurso',null,['label'=>'Curso'])
            ->add('distributivocodespecializacion',null,['label'=>'Especializacion'])
            ->add('distributivoparalelo',ParaleloType::class)
            ->add('distributivoseccion',SeccionType::class)
            ->add('distributivohora',null,['label'=>'Horas Semanales'])
            ->add('distributivofecha',null,['label'=>'Fecha'])
           // ->add('distributivoestado')
       //     ->add('distributivogrado')
            
            
            
            
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

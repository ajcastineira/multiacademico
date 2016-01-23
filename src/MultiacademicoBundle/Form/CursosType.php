<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CursosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cursoabreviatura',null,array('label'=>'Abreviatura:'))
            ->add('curso',null,array('label'=>'Curso:'))
            ->add('cursoestado',  ChoiceType::class,array('label'=>'Estado',
                                               'choices' => array('Activo'=>'Activo',
                                                                  'Inactivo'=>'Inactivo')))
          //  ->add('tipo')
          //  ->add('nivel')
          //  ->add('grado')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Cursos',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cursos';
    }
}

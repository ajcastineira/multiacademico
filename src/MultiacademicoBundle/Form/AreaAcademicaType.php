<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AreaAcademicaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('director')
                //->add('subdirector')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\AreaAcademica',
            'attr' => array('ng-submit'=>"processForm(\$event,'multiacademicobundle_areaacademica')")
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'multiacademicobundle_areaacademica';
    }


}

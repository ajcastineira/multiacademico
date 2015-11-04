<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocentesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docentecedula')
            ->add('login')
            ->add('password')
            ->add('docentetrato')
            ->add('docente')
            ->add('docentedomicilio')
            ->add('docenteemail')
            ->add('docentetelefono')
            ->add('docentecargo')
            ->add('docenteestado')
            ->add('username')
            ->add('salt')
            ->add('path')
            ->add('theme')
            ->add('signature')
            ->add('signatureFormat')
            ->add('created')
            ->add('access')
            ->add('lastlogin')
            ->add('lastactivity')
            ->add('status')
            ->add('timezone')
            ->add('language')
            ->add('picture')
            ->add('init')
            ->add('data')
            ->add('mail')
            ->add('usuario')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Docentes',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_docentes';
    }
}

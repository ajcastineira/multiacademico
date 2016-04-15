<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DocentesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docentecedula',null,['label'=>'Cedula'])    
           // ->add('mail')
            ->add('docentetrato',null,['label'=>'Trato'])    
            ->add('docente')
            ->add('docentedomicilio',null,['label'=>'Domicilio'])
            ->add('docenteemail',null,['label'=>'Email'])    
            ->add('docentetelefono',null,['label'=>'Telefono'])
            ->add('docentecargo',null,['label'=>'Cargo'])
            //->add('docenteestado')
            //->add('username')
           // ->add('salt')
           // ->add('path')
            //->add('theme')
            //->add('signature')
            //->add('signatureFormat')
            //->add('created')
            //->add('access')
            //->add('lastlogin')
            //->add('lastactivity')
            //->add('status')
            //->add('timezone')
            //->add('language')
            //->add('picture')
            //->add('init')
            //->add('data')
            
            //->add('usuario')
            ->add('username')
            ->add('password',PasswordType::class,['label'=>'Password'])    
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
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
        return 'docentes';
    }
}

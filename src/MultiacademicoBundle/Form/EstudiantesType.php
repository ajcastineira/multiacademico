<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudiantesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estudianteCedula')
            ->add('estudiante')
            ->add('estudianteFechanacimiento')
            ->add('estudianteNacionalidad')
            ->add('estudianteLugarnacimiento')
            ->add('estudianteProvinciaN')
            ->add('estudianteCantonN')
            ->add('estudianteParroquiaN')
            ->add('estudianteDomicilio')
            ->add('estudianteProvinciaD')
            ->add('estudianteCantonD')
            ->add('estudianteParroquiaD')
            ->add('estudianteGenero')
            ->add('estudianteDiscapacidad')
            ->add('estudianteConae')
            ->add('estudianteEtnia')
            ->add('estudiantePlantel')
            ->add('estudianteCorreo')
            ->add('estudianteCarnet')
            ->add('estudianteFoto')
            ->add('estudianteEstado')
            ->add('estudianteNumeroacta')
            ->add('madre')
            ->add('madreCedula')
            ->add('madreEstadocivil')
            ->add('madreTelefono')
            ->add('madreDomicilio')
            ->add('madreBono')
            ->add('padre')
            ->add('padreCedula')
            ->add('padreEstadocivil')
            ->add('padreTelefono')
            ->add('padreDomicilio')
            ->add('representanteCedula')
            ->add('representante')
            ->add('representanteDomicilio')
            ->add('representanteTelefono')
            ->add('representanteTipo')
            ->add('username')
            ->add('password')
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Estudiantes',
            'attr' => array('ng-submit'=>"processForm('".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_estudiantes';
    }
}

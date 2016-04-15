<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use MultiacademicoBundle\Form\Type\RepresentanteType;
class EstudiantesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('representante',  RepresentanteType::class)
            ->add('estudianteCedula',null,['label'=>'Cedula'])
            ->add('mail',null,['label'=>'Email'])
            ->add('estudiante',null,['label'=>'Estudiante (Apellidos y Nombres)'])
                
            ->add('estudianteFechanacimiento',DateType::class,['label'=>'Fecha de Nacimiento',
                                                                  'format' => 'yyyy-MM-dd',
                                                                  'format' => 'yyyy-MM-dd',
                                                                   'years'=>range(1990,date('Y'))])
           /* ->add('estudianteNacionalidad',null,['label'=>'Nacionalidad'])
            ->add('estudianteLugarnacimiento',null,['label'=>'Lugar Nacimiento'])
            ->add('estudianteProvinciaN',null,['label'=>'Provincia Nacimiento'])
            ->add('estudianteCantonN',null,['label'=>'Canton Nacimiento'])
            ->add('estudianteParroquiaN',null,['label'=>'Parroquia Nacimiento'])
            ->add('estudianteDomicilio',null,['label'=>'Domicilio'])
            ->add('estudianteProvinciaD',null,['label'=>'Provincia Domicilio'])
            ->add('estudianteCantonD',null,['label'=>'Canton Domicilio'])
            ->add('estudianteParroquiaD',null,['label'=>'Parroquia Domicilio'])*/
            ->add('estudianteGenero',  ChoiceType::class,['label'=>'Genero','choices'=>[
                                                                                        'Masculino'=>'Masculino',
                                                                                         'Femenino'=>'Femenino'
                                                                                        ]])
            ->add('estudianteDiscapacidad',  ChoiceType::class,['label'=>'Sufre Discapacidad','choices'=>[
                                                                                            'No'=>'No',
                                                                                            'Si'=>'Si',
                                                                                        ]])
            //->add('estudianteConae')
            //->add('estudianteEtnia')
            //->add('estudiantePlantel')
            //->add('estudianteCorreo')
           // ->add('estudianteCarnet')
           // ->add('estudianteFoto')
            //->add('estudianteEstado')
            //->add('estudianteNumeroacta')
                
                
         /*       
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
            ->add('padreDomicilio')*/
                
                
          //  ->add('representanteCedula')
            
         //   ->add('representanteDomicilio')
          //  ->add('representanteTelefono')
           /* ->add('representanteTipo',  ChoiceType::class,['label'=>'Tipo de Representante','choices'=>[
                                                                                        'Madre'=>'Madre',
                                                                                         'Padre'=>'Padre',
                                                                                         'Otro'=>'Otro'
                                                                                        ]])*/
            ->add('username',null,['label'=>'Username'])    
            ->add('password',PasswordType::class,['label'=>'Password'])    
           // ->add('username')
           // ->add('password')
          //  ->add('salt')
          //  ->add('path')
          //  ->add('theme')
          //  ->add('signature')
          //  ->add('signatureFormat')
          //  ->add('created')
         //   ->add('access')
          //  ->add('lastlogin')
          //  ->add('lastactivity')
          //  ->add('status')
          //  ->add('timezone')
         //   ->add('language')
          //  ->add('picture')
           // ->add('init')
          //  ->add('data')
            
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Estudiantes',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
                            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estudiantes';
    }
}

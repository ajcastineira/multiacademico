<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\ConfiguracionEntidadType;
use MultiacademicoBundle\Form\DataTransformer\DataToConfigDataTransformer;
use MultiacademicoBundle\Configuracion\ConfiguracionEntidad;
use MultiacademicoBundle\Configuracion\ConfiguracionAnioLectivo;
use MultiacademicoBundle\Form\ConfiguracionAnioLectivoType;

class EntidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer=new DataToConfigDataTransformer(ConfiguracionEntidad::class);
        $transformerAnio=new DataToConfigDataTransformer(ConfiguracionAnioLectivo::class);
        $builder
                
            ->add('entidad')
            ->add('titulo')
            ->add('lema')
            ->add('siglas')
            ->add('direccion')
            ->add('ciudad')
            ->add('lugar')
            ->add('web')
            ->add('email')
            ->add('telefono')
            //->add('visitas')
            ->add('esParticular')
            ->add('data', ConfiguracionEntidadType::class, array(
                // validation message if the data transformer fails
                'invalid_message' => 'That is not a valid json',
            ))
            ->add('configAnioLectivo', ConfiguracionAnioLectivoType::class, array(
                // validation message if the data transformer fails
                'invalid_message' => 'That is not a valid json',
            ))    
            ;
            $builder->get('data')->addModelTransformer($transformer);
            $builder->get('configAnioLectivo')->addModelTransformer($transformerAnio);
         
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Entidad',
            'attr' => array('ng-submit'=>"processForm(\$event,'entidad')")
        ));
    }
}

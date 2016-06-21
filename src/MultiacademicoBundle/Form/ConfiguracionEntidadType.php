<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
Use MultiacademicoBundle\Configuracion\ConfiguracionAnioLectivo;
use MultiacademicoBundle\Form\DataTransformer\DataToConfigDataTransformer;
use MultiacademicoBundle\Form\ConfiguracionAnioLectivoType;

class ConfiguracionEntidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer=new DataToConfigDataTransformer(ConfiguracionAnioLectivo::class);
        $builder
            //->add('logoiz')
            //->add('logoder')
            //->add('logocenter')
            ->add('codamie')
           // ->add('certpromo')
           // ->add('vencimiento')
            //->add('configuracionAnioLectivo',  ConfiguracionAnioLectivoType::class)
        ;
        //$builder->get('configuracionAnioLectivo')->addModelTransformer($transformer);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Configuracion\ConfiguracionEntidad',
            'attr' => array('ng-submit'=>"processForm(\$event,'configuracion_entidad')")
        ));
    }
}

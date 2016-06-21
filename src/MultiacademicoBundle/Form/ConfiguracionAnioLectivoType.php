<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Form\ConfiguracionQuimestresType;
use MultiacademicoBundle\Configuracion\ConfiguracionQuimestres;
use MultiacademicoBundle\Configuracion\ConfiguracionQuimestre;
use MultiacademicoBundle\Form\DataTransformer\DataToConfigDataTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConfiguracionAnioLectivoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$transformer=new DataToConfigDataTransformer(ConfiguracionQuimestres::class);
        $transformerq=new DataToConfigDataTransformer(ConfiguracionQuimestre::class);
        $builder
            ->add('fechaInicioAnio', DateType::class)
            ->add('fechaFinAnio', DateType::class)
            ->add('quimestre1',  ConfiguracionQuimestreType::class)
            ->add('quimestre2',  ConfiguracionQuimestreType::class)
            //->add('codamie')
           // ->add('certpromo')
           // ->add('vencimiento')
           // ->add('configuracionQuimestres',  ConfiguracionQuimestresType::class)
        ;
        //$builder->get('configuracionQuimestres')->addModelTransformer($transformer);
        $builder->get('quimestre1')->addModelTransformer($transformerq);
        $builder->get('quimestre2')->addModelTransformer($transformerq);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Configuracion\ConfiguracionAnioLectivo',
            'attr' => array('ng-submit'=>"processForm(\$event,'configuracion_anio_lectivo')")
        ));
    }
}

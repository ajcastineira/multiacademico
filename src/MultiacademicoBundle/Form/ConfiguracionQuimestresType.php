<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Configuracion\ConfiguracionQuimestre;
use MultiacademicoBundle\Form\ConfiguracionQuimestreType;
use MultiacademicoBundle\Form\DataTransformer\DataToConfigDataTransformer;

class ConfiguracionQuimestresType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer=new DataToConfigDataTransformer(ConfiguracionQuimestre::class);
        $builder
            ->add('quimestre1',  ConfiguracionQuimestreType::class)
            ->add('quimestre2',  ConfiguracionQuimestreType::class)
            //->add('codamie')
           // ->add('certpromo')
           // ->add('vencimiento')
            //->add('configuracionAnioLectivo')
        ;
        $builder->get('quimestre1')->addModelTransformer($transformer);
        $builder->get('quimestre2')->addModelTransformer($transformer);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Configuracion\ConfiguracionQuimestres',
            'attr' => array('ng-submit'=>"processForm(\$event,'configuracion_quimestres')")
        ));
    }
}

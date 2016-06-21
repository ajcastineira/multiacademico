<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MultiacademicoBundle\Configuracion\ConfiguracionParciales;
use MultiacademicoBundle\Form\ConfiguracionQuimestreType;
use MultiacademicoBundle\Form\DataTransformer\DataToConfigDataTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConfiguracionParcialesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$transformer=new DataToConfigDataTransformer(ConfiguracionParciales::class);
        $builder
            ->add('fechaInicioParcial1',  DateType::class)
            ->add('fechaFinParcial1',  DateType::class)
            ->add('fechaInicioParcial2',  DateType::class)
            ->add('fechaFinParcial2',  DateType::class)
            ->add('fechaInicioParcial3',  DateType::class)
            ->add('fechaFinParcial3',  DateType::class)
            //->add('codamie')
           // ->add('certpromo')
           // ->add('vencimiento')
            //->add('configuracionAnioLectivo')
        ;
        //$builder->get('quimestre1')->addModelTransformer($transformer);
        //$builder->get('quimestre2')->addModelTransformer($transformer);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Configuracion\ConfiguracionParciales',
            'attr' => array('ng-submit'=>"processForm(\$event,'configuracion_parciales')")
        ));
    }
}

<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConfiguracionQuimestreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('fechaInicioQ', DateType::class)
            ->add('fechaFinQ', DateType::class)
            ->add('fechaInicioParcial1',  DateType::class)
            ->add('fechaFinParcial1',  DateType::class)
            ->add('fechaInicioParcial2',  DateType::class)
            ->add('fechaFinParcial2',  DateType::class)
            ->add('fechaInicioParcial3',  DateType::class)
            ->add('fechaFinParcial3',  DateType::class)
           // ->add('certpromo')
           // ->add('vencimiento')
            //->add('configuracionAnioLectivo')
        ;
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Configuracion\ConfiguracionQuimestre',
            'attr' => array('ng-submit'=>"processForm(\$event,'configuracion_quimestre')")
        ));
    }
}

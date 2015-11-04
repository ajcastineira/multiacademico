<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistributivosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('distributivoparalelo')
            ->add('distributivoseccion')
            ->add('distributivohora')
            ->add('distributivofecha')
            ->add('distributivoestado')
            ->add('distributivogrado')
            ->add('distributivocodperiodo')
            ->add('distributivocoddocente')
            ->add('distributivocodmateria')
            ->add('distributivocodcurso')
            ->add('distributivocodespecializacion')
            //->add('aula')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\Distributivos',
            'attr' => array('ng-submit'=>"processForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'multiacademicobundle_distributivos';
    }
}

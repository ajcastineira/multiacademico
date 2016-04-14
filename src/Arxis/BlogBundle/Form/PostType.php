<?php

namespace Arxis\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',null,array('attr'=>array('class'=>'form-control input-lg no-border',
                                                     'rows'=>2,
                                                    'placeholder'=>'¿En que estas pensando ahora?')))
           //->add('createdAt')
           // ->add('updatedAt')
           // ->add('author')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arxis\BlogBundle\Entity\Post',
            'attr' => array('ng-submit'=>"publicPostForm(\$event,'".$this->getName()."')")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'post';
    }
}

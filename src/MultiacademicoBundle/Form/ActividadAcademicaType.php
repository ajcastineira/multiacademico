<?php

namespace MultiacademicoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityRepository;


class ActividadAcademicaType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         // grab the user, do a quick sanity check that one exists
        $user = $this->tokenStorage->getToken()->getUser();
        if (!$user) {
            throw new \LogicException(
                'The ActividadAcademicaType cannot be used without an authenticated user!'
            );
        }
        $builder
            ->add('distributivo',null,[
                    'class' => 'MultiacademicoBundle:Distributivos',
                    'property_path' => 'distributivo',
                    'query_builder' => function (EntityRepository $er) use ($user){
                         return $er->misDistributivos($user);
                    },
            ])    
            ->add('titulo')
            ->add('descripcion')
            ->add('fechaEntrega', DateTimeType::class)
            ->add('tipo', ChoiceType::class, ['choices'=>[
                                                           'Tarea' => 'Tarea',
                                                           'Actividad Individual' => 'Actividad Individual',
                                                           'Actividad Grupal' => 'Actividad Grupal',
                                                           'Leccion' => 'Leccion',
                                                         ]] )
            ->add('estado')    
            ->add('file', FileType::class, [
                    'label' => 'Archivo',
                     'required'=>false,
                    'attr' => [
                                'accept'=>'image/*, application/pdf, application/x-pdf,
                               application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                               application/vnd.ms-excel , application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                               application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation,
                              application/x-rar-compressed, application/zip'
                    ]
            ])
            //->add('fechaEnvio', DateTimeType::class)
            
            //->add('sendBy')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MultiacademicoBundle\Entity\ActividadAcademica',
            'attr' => array('ng-submit'=>"processForm(\$event,'actividad_academica')")
        ));
    }
}

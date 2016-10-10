<?php

/*
 *Todos los derechos reservados
 */

namespace Multiservices\ArxisBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Multiservices\ArxisBundle\Entity\Usuario;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class UsuarioListener  {
    
   
    protected $container;
    protected $tokenStorage;
    protected $s3;
    private $actividadesPorEnviar = [];
    private $tareasPorNotificar = [];

    /**
     * @param TokenStorage $securityContext
     * @param Container $container The container
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container)
    {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
        $this->s3=$this->container->get('aws_s3_helper');
  
    }
    public function prePersist(Usuario $usuario, LifecycleEventArgs $args)
    {
        $usuario->preUpload();
    }
    public function postPersist(Usuario $usuario, LifecycleEventArgs $args)
    {
        $this->s3->uploadFileFromEntity($usuario);
    }
    public function postLoad(Usuario $usuario, LifecycleEventArgs $args)
    {
        
        $usuario->setWebPath($this->s3->getWebPath($usuario->getPath(),$usuario->getUploadDir()));
    }
    public function preUpdate(Usuario $usuario, PreUpdateEventArgs $args)
    {
        $usuario->preUpload($usuario);    
    }
    public function postUpdate(Usuario $usuario, LifecycleEventArgs $args)
    {
        $this->s3->uploadFileFromEntity($usuario);
        
    }
    public function postRemove(Usuario $usuario, LifecycleEventArgs $args)
    {
        $usuario->removeUpload();
    }
    
    

}

<?php

/*
 *Todos los derechos reservados
 */

namespace Multiservices\ArxisBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Multiservices\ArxisBundle\Entity\Usuario;
use AppBundle\Lib\AWSS3Helper;


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
        $this->uploadFileToAWSS3($usuario);
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
        $this->uploadFileToAWSS3($usuario);
    }
    public function postRemove(Usuario $usuario, LifecycleEventArgs $args)
    {
        $usuario->removeUpload();
    }
    
    private function uploadFileToAWSS3(Usuario $usuario){
        
        if (null === $usuario->getFile()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        //$usuario->getFile()->move($usuario->getUploadRootDir(), $usuario->getPath());
         try {
            // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
            $upload = $this->s3->upLoadFile($usuario->getUploadDir().'/'.$usuario->getPath(), $usuario->getFile()->getPathName());
            $usuario->setWebPath($this->s3->getWebPath($usuario->getPath(),$usuario->getUploadDir()));
            }catch(Exception $e) {
                
            }             
        // check if we have an old image
        if (null!==$usuario->getTemp()) {
            // delete the old image
            try{
            unlink($usuario->getUploadRootDir().'/'.$usuario->getTemp());
            }catch(\Exception $e)
            {}
            // clear the temp image path
            $usuario->setTemp(null);
        }
        $usuario->setFile();
        }

}

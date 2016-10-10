<?php

/*
 *Todos los derechos reservados
 */

namespace MultiacademicoBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use MultiacademicoBundle\Entity\ActividadAcademicaDetalle;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class ActividadAcademicaDetalleListener  {
    
   
    protected $container;
    protected $tokenStorage;
    protected $s3;
    private $actividadesPorEnviar = [];
    private $tareasPorNotificar = [];

    /**
     * @param TokenStorage $securityContext
     * @param Router $router The router
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container)
    {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
        $this->s3=$this->container->get('aws_s3_helper');
  
    }
    public function prePersist(ActividadAcademicaDetalle $actividadAcademica, LifecycleEventArgs $args)
    {
           // $actividadAcademica->setFechaEnvio(new \Datetime());
           // $actividadAcademica->setEstado(EstadoActividadAcademicaType::ENVIADA);
            //$this->preEnviarActvidadAEstudiantes($actividadAcademica);
            //$this->preNotificar($actividadAcademica);
           // $actividadAcademica->preUpload();
            
    }
    public function postPersist(ActividadAcademicaDetalle $actividadAcademica, LifecycleEventArgs $args)
    {
            //$this->preUpload($actividadAcademica);
    }
    public function postLoad(ActividadAcademicaDetalle $actividadAcademica, LifecycleEventArgs $args)
    {
        $actividadAcademica->setWebPath($this->s3->getWebPath($actividadAcademica->getPath(),$actividadAcademica->getUploadDir()));
    }
    public function preUpdate(ActividadAcademicaDetalle $actividadAcademica, PreUpdateEventArgs $args)
    {
            //$this->preNotificar($actividadAcademica);
            if ($args->hasChangedField('calificacion'))
            {
                $actividadAcademica->setEstado(EstadoActividadAcademicaType::REVISADA);
                $actividadAcademica->setRevisada(true);
                $actividadAcademica->setFechaRevisada(new \DateTime());
            }
            if ($args->hasChangedField('descripcion'))
            {
                $actividadAcademica->setEstado(EstadoActividadAcademicaType::ENTREGADA);
                $actividadAcademica->setEntregada(true);
                $actividadAcademica->setFechaEntregada(new \DateTime());
            }
            //$actividadAcademica->preUpload();
            //$change=$args->getEntityChangeSet();
            $this->preUpload($actividadAcademica);
           
    }
    public function postUpdate(ActividadAcademicaDetalle $actividadAcademica, LifecycleEventArgs $args)
    {
            $this->s3->uploadFileFromEntity($actividadAcademica);
    }
    public function postRemove(ActividadAcademicaDetalle $actividadAcademica, LifecycleEventArgs $args)
    {
           // $actividadAcademica->removeUpload();
    }
    
     private function preUpload($actividadAcademica)
    {
        if (null !== $actividadAcademica->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $actividadAcademica->setArchivo($filename.'.'.$actividadAcademica->getFile()->guessExtension());
        }
    }
    
    public function postFlush(PostFlushEventArgs $args)
    {
        if (!empty($this->actividadesPorEnviar)) {
            $em = $args->getEntityManager();
            foreach ($this->actividadesPorEnviar as $actividad) {
                $em->persist($actividad);
            }
            $this->actividadesPorEnviar=[];
            $em->flush();
       }
        
    }
    private function preNotificar($actividadAcademica)
    {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            
            $notificador=$this->container->get('notificadorDeAula');
            $aula=$actividadAcademica->getDistributivo()->getAula();
            $matriculados=$aula->getMatriculados();
            
            $actiondata=new \MultiacademicoBundle\ActionData\DocenteSendTaskYou();
            $actiondata->setDocente($user->getName());
            $actiondata->setMateria($actividadAcademica->getDistributivo()->getDistributivocodmateria()->getMateria());
            $actiondata->setTipo($actividadAcademica->getTipo());
            $actiondata->setTema($actividadAcademica->getTitulo());
                    
            $notificaciones=$notificador->preNotificarAula($aula, $actiondata->getActionid(), 'titulo', $actiondata);
            
            $this->tareasPorNotificar = $notificaciones;
    }
}

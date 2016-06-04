<?php

/*
 *Todos los derechos reservados
 */

namespace MultiacademicoBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use MultiacademicoBundle\Entity\ActividadAcademica;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class ActividadAcademicaListener  {
    
   
    protected $container;
    protected $tokenStorage;
    private $tareasPorNotificar = [];

    /**
     * @param TokenStorage $securityContext
     * @param Router $router The router
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container)
    {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
  
    }
    public function prePersist(ActividadAcademica $actividadAcademica, LifecycleEventArgs $args)
    {
            $user = $this->tokenStorage->getToken()->getUser();
            $docente=$this->container
                            ->get('doctrine')->getEntityManager()
                            ->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($user);
            $actividadAcademica->setSendBy($docente);
            $actividadAcademica->setFechaEnvio(new \Datetime());
            $actividadAcademica->setEstado(EstadoActividadAcademicaType::ENVIADA);
            
    }
    public function preUpdate(ActividadAcademica $actividadAcademica, PreUpdateEventArgs $args)
    {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            
                //$notificador=$this->container->get('notificador');
                //$usuarioanotificar=$actividadAcademica->getUsuario();
                
               /* $actiondata=new \MultiacademicoBundle\ActionData\DocenteSendTaskYou();
                  $actiondata->setDocente($user->getName());
                  $actiondata->setMateria($calificacion->getCalificacioncodmateria()->getMateria());
                  
                  $n=$notificador->crearNotificacion($actiondata->getActionid(),$user->getName(),$usuarioanotificar,$actiondata);
                  $this->tareasPorNotificar[] = $n;*/
    }
   
    
    public function postFlush(PostFlushEventArgs $args)
    {
        
        /*if (!empty($this->tareasPorNotificar)) {
            $em = $args->getEntityManager();
            foreach ($this->tareasPorNotificar as $notificacion) {
                
                $em->persist($notificacion);
                 
            }
            $this->tareasPorNotificar=[];
        
            $em->flush();
            
       }*/
        //$args->getEmptyInstance()
        //$this->container->get('notificadorDeAula')->notificarAula();
    }
}

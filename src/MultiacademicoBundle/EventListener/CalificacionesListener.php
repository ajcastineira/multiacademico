<?php

/*
 *Todos los derechos reservados
 */

namespace MultiacademicoBundle\EventListener;

use Doctrine\ORM\Mapping as ORM;
//use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use MultiacademicoBundle\Entity\Calificaciones;
use Multiservices\NotifyBundle\Servicios\Notificador;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class CalificacionesListener {
    
   
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    
    
    /**
     * @ORM\PreUpdate
     */
    public function comprobar(Calificaciones $calificacion, PreUpdateEventArgs $event)
    {
        
        if ($event->hasChangedField('gracia')) {
            //var_dump("gracia camibio");
          //  $calificacion->setGrado(12);
          //  $user = $this->container->get('security.token_storage')->getToken()->getUser();
           // $notificador=$this->container->get('notificador');
           // $notificador->notificar('docente_write_calificacion', $user->getName(), $user);
            
            
        }
    }
    /**
     * @ORM\PostUpdate
     */
    public function notificarUpdateCalificacion(Calificaciones $calificacion, LifecycleEventArgs $event)
    {
                
                $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $notificador=$this->container->get('notificador');
                $usuarioanotificar=$calificacion->getCalificacionnummatricula()->getMatriculacodestudiante()->getUsuario();
                 
                  
                  $actiondata=new \MultiacademicoBundle\ActionData\DocenteWtriteCalificacionYou();
                  $actiondata->setDocente($user->getName());
                  $actiondata->setMateria($calificacion->getCalificacioncodmateria()->getMateria());
                  $notificador->notificar($actiondata->getActionid(), $user->getName(), $usuarioanotificar,$actiondata);
      
    }
}

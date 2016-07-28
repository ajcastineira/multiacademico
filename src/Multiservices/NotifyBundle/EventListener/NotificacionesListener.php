<?php

/*
 * Todos los derechos reservados
 */

/**
 * Description of LogoutListener
 *
 * @author Rene Arias
 */
namespace Multiservices\NotifyBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Multiservices\NotifyBundle\Entity\Notificaciones;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class NotificacionesListener  {
    
   
    protected $container;
    private $notificacionPorSubir;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function preFlush(Notificaciones $notificacion, PreFlushEventArgs $event) {
        
        $this->notificacionPorSubir=$notificacion;
    }
   
    
    public function postFlush(PostFlushEventArgs $args)
    {
        
        if ($this->notificacionPorSubir) {
            $notificacion=$this->notificacionPorSubir;
            $firebase = $this->container->get('kreait_firebase.connection.main');
            
            $firebase->update([$notificacion->getId()=>
                                            ['uid'=>$notificacion->getNotificacionuser()->getId(),
                                             'username'=>$notificacion->getNotificacionuser()->getUsername(),
                                             'date'=>$notificacion->getNotificaciontimestamp()*(-1),
                                             'icon'=>$notificacion->getIcon(),
                                             'read'=>$notificacion->isRead(),
                                             'message'=>$notificacion->getMessage(),
                                            ]
                    ], 'notificaciones/'.$notificacion->getNotificacionuser()->getUsername());
            $this->notificacionPorSubir=null;
        }
    }
}

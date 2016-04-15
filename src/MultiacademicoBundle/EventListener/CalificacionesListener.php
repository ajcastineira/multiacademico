<?php

/*
 *Todos los derechos reservados
 */

namespace MultiacademicoBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use MultiacademicoBundle\Entity\Calificaciones;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class CalificacionesListener  {
    
   
    protected $container;
    private $calificacionesPorNotificar = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function preUpdate(Calificaciones $calificacion, PreUpdateEventArgs $args)
    {

            $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $notificador=$this->container->get('notificador');
                $usuarioanotificar=$calificacion->getCalificacionnummatricula()->getMatriculacodestudiante()->getUsuario();
                
                $actiondata=new \MultiacademicoBundle\ActionData\DocenteWtriteCalificacionYou();
                  $actiondata->setDocente($user->getName());
                  $actiondata->setMateria($calificacion->getCalificacioncodmateria()->getMateria());
                  
                  $n=$notificador->crearNotificacion($actiondata->getActionid(),$user->getName(),$usuarioanotificar,$actiondata);
                  $this->calificacionesPorNotificar[] = $n;
    }
   
    
    public function postFlush(PostFlushEventArgs $args)
    {
        
        if (!empty($this->calificacionesPorNotificar)) {
            $em = $args->getEntityManager();
            foreach ($this->calificacionesPorNotificar as $notificacion) {
                
                $em->persist($notificacion);
                 
            }
            $this->calificacionesPorNotificar=[];
            $em->flush();
            
       }
    }
}

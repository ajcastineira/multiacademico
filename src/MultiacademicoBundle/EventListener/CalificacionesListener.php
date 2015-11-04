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
    private $calificacionesPorNotificar = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

     

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        // False check is compulsory otherwise duplication occurs
        if (($entity instanceof Calificaciones) === false) {
            //$userLog = new UserLog();
            //$userLog->setDescription($entity->getId() . ' being updated.');
            $calificacion=$entity;
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
                $notificador=$this->container->get('notificador');
                $usuarioanotificar=$calificacion->getCalificacionnummatricula()->getMatriculacodestudiante()->getUsuario();
                
                $actiondata=new \MultiacademicoBundle\ActionData\DocenteWtriteCalificacionYou();
                  $actiondata->setDocente($user->getName());
                  $actiondata->setMateria($calificacion->getCalificacioncodmateria()->getMateria());
                  $n= new \Multiservices\NotifyBundle\Entity\Notificaciones();
                  $n->setActionid($actiondata->getActionid());
                  $n->setNotificaciontitulo($user->getName());
                  $n->setVariables($actiondata);
                  $n->setNotificacionuser($usuarioanotificar);
                  //$n=$notificador->crearNotificacion($actiondata->getActionid(), $user->getName(), $usuarioanotificar,$actiondata);
            

            $this->calificacionesPorNotificar[] = $n;
        }
    }
   
    
    public function postFlush(PostFlushEventArgs $args)
    {
        if (!empty($this->calificacionesPorNotificar)) {
            $em = $args->getEntityManager();
            foreach ($this->calificacionesPorNotificar as $notificacion) {
                
                
                
                 
                
                
                $em->persist($notificacion);
            
                
                
            }
            $em->flush();
        }
    }
}

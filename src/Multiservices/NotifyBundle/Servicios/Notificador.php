<?php
namespace Multiservices\NotifyBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Multiservices\NotifyBundle\Entity\Notificaciones;

/**
 * Description of timeago
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */

class Notificador
{
    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    function notificar($accion,$titulo="",$user,$data=null)
    {
       $em=$this->entityManager;
       $notificacion=New Notificaciones;
       $notificacion->setActionid($em->getRepository('NotifyBundle:Actions')->find($accion));
       $notificacion->setNotificacionuser($user);
       $notificacion->setNotificacionrole(1);
       
       $notificacion->setNotificaciontitulo($titulo);
       $notificacion->setNotificacion($accion);
       $notificacion->setNotificaciontimestamp(time());
       $notificacion->setNotificacionestado(0);
       $notificacion->setVariables($data);
       $em->persist($notificacion);
       $em->flush();  
       return $notificacion;
    }
    
}


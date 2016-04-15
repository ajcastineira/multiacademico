<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NotificacionesRepository extends EntityRepository
{
    public function guardar($notificacion)
    {
         $em = $this->getEntityManager();
        $em->persist($notificacion);
       $em->flush();
    }
   public function inbox($user)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT n'
                    . ' FROM NotifyBundle:Notificaciones n '
                    . 'where n.notificacionuser=:user'
                    . ' ORDER BY n.notificaciontimestamp DESC')
            ->setParameter(":user", $user)
            ->getResult();
    }
   /* public function findMensajesRecibidos($user)
    {
    $em = $this->getEntityManager();

    $dql = "SELECT m
        FROM MultiservicesNotifyBundle:Mensajes m
        join m.destino u
        where u.id=:destinoid
        order by m.timesent desc";
    
    
    $query = $em->createQuery($dql);
    $query->setParameter('destinoid', $user);
    //$query->setParameter('title', '%' . $title . '%');


    
    $mensajes= $query->getResult();

    return $mensajes;
    }*/
}

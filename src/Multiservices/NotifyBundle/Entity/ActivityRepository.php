<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\NotifyBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ActivityRepository extends EntityRepository
{
    
   public function recentActivities()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM NotifyBundle:Activity a '
                    . 'where 1=1'
                    . ' ORDER BY a.timestamp DESC')
            //->setParameter(":user", $user)
            ->getResult();
    }
    public function myActivities($user)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM NotifyBundle:Activity a '
                    . 'where a.uid=:user'
                    . ' ORDER BY a.timestamp DESC')
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

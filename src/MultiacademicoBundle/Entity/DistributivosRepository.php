<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DistributivosRepository extends EntityRepository
{
    
   public function miDistributivo($docente)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT d'
                    . ' FROM MultiacademicoBundle:Distributivos d '
                    . 'where d.distributivocoddocente=:docente'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":docente", $docente)
            ->getResult();
    }
}

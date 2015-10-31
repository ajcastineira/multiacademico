<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class MatriculasRepository extends EntityRepository
{
    
   public function matriculadosSinClave()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m, e, u'
                    . ' FROM MultiacademicoBundle:Matriculas m '
                    . ' join m.matriculacodestudiante e '
                    . ' join e.usuario u '
                    . ' where u.password=:pass '
                   // . ' m.materia != :materia'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":pass", "")
           ->getResult();
    }
    
    
}

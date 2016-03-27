<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EstudiantesRepository extends EntityRepository
{
    
    public function estudiantesNoMatriculados()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('e')
                    ->from('MultiacademicoBundle:Estudiantes','e')
                    ->where('e.matriculas is empty ');
                    // . ' m.materia != :materia'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    
          //  ->setParameter(":pass", "")
          // ->getResult();
    }
    
   
}

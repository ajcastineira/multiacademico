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
    
    public function estudiantesNoMatriculados($estudiante=null)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('e')
                    ->from('MultiacademicoBundle:Estudiantes','e')
                    ->where('e.matriculas is empty or e=:estudiante')
                    ->setParameter('estudiante', $estudiante);
                    
                    

    }

    
}

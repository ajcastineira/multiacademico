<?php

namespace MultiacademicoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MultiacademicoBundle\Entity\Aula;


class AsistenciaRepository extends EntityRepository
{
    
   public function asistenciaAula(Aula $aula)
    {
        
        return $this->getEntityManager()
            ->createQuery('SELECT a, m, e '
                    . ' FROM MultiacademicoBundle:Asistencia a'
                    . ' JOIN a.asistencianummatricula m '
                    . ' JOIN m.matriculacodestudiante e'
                    . ' where m.aula=:aula '
                    .' ORDER BY e.estudiante asc '
                    )
            ->setParameter(":aula", $aula)
            ->getResult();
    } 

   
}

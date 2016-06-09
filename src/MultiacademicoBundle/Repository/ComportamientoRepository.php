<?php

namespace MultiacademicoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use MultiacademicoBundle\Entity\Aula;


class ComportamientoRepository extends EntityRepository
{
    
   public function comportamientoAula(Aula $aula)
    {
        
        return $this->getEntityManager()
            ->createQuery('SELECT c, m, e '
                    . ' FROM MultiacademicoBundle:Comportamiento c'
                    . ' JOIN c.comportamientonummatricula m '
                    . ' JOIN m.matriculacodestudiante e'
                    . ' where m.aula=:aula '
                    .' ORDER BY e.estudiante asc '
                    )
            ->setParameter(":aula", $aula)
            ->getResult();
    } 

   
}

<?php

namespace MultiacademicoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RepresentantesRepository extends EntityRepository
{
    
    public function RepresentantesYEstudiantes()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('r')
                    ->from('MultiacademicoBundle:Estudiantes','r')
                    //->where('e.matriculas is empty or e=:estudiante')
                    //->setParameter('estudiante', $estudiante)
                    ;
                    
                    

    }
                    
                    
}

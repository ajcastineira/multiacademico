<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;

class PensionRepository extends EntityRepository
{
    
 
    public function pensionesPendientes($seccion='all')
    {
        $where='f.estado =:estado1 OR f.estado =:estado2';
        $parameters=['estado1'=> EstadoFacturaType::NOPAGADA,
                     'estado2'=> EstadoFacturaType::VENCIDA];
        if ($seccion!='all')
        {
            $where='p.info LIKE :info AND (f.estado =:estado1 OR f.estado =:estado2)';
            $parameters['info']="%$seccion%";
        }
        return $this->getEntityManager()
            ->createQueryBuilder()->select('p')
                    ->from('MultiacademicoBundle:Pension','p')
                    ->innerJoin('p.factura', 'f')
                    ->where($where)
                    ->setParameters($parameters)
                    ->getQuery()->getResult();

    }
   
}

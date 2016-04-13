<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;

class PensionRepository extends EntityRepository
{
    
 
    public function pensionesPendientes()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('p')
                    ->from('MultiacademicoBundle:Pension','p')
                    ->innerJoin('p.factura', 'f')
                    ->where('f.estado =:estado1')
                    ->setParameter('estado1',  EstadoFacturaType::NOPAGADA)
                    ->setParameter('estado2',   EstadoFacturaType::VENCIDA)
                    ->getQuery()->getResult();

    }
   
}

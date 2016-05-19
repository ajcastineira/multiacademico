<?php

namespace MultiacademicoBundle\Repository;

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
    
    public function actualizarPensiones()
    {
        $hoy=new \DateTime();
        $where='f.vencimiento <=:hoy AND (f.estado =:estado1 OR f.estado =:estado2)';
        $parameters=['hoy'=>$hoy,
                     'estado1'=> EstadoFacturaType::NOPAGADA,
                     'estado2'=> EstadoFacturaType::VENCIDA];
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $qb->update('PayPayBundle:Facturas','f')
                    ->set('f.estado',  $qb->expr()->literal(EstadoFacturaType::VENCIDA))
                    ->set('f.statevencido', true)
                    ->where($where)
                    ->setParameters($parameters)
                    ->getQuery()->getResult();

    }
   
}

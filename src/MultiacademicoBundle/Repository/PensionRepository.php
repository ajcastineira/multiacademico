<?php

namespace MultiacademicoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
use Multiservices\PayPayBundle\Entity\Ingresos;

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
    
    
    public function importarPago($id_estudiante,$valorapagar,$que_va_a_pagar,$referencia_doc,$datetime_pago)
    {
        $em=$this->getEntityManager();
        $ingreso_existente = $em->getRepository('PayPayBundle:Ingresos')->findOneByDescripcion($que_va_a_pagar." ".$referencia_doc);
        if (!$ingreso_existente)
        {   
        $pension_a_pagar = $em->getRepository('MultiacademicoBundle:Pension')->findOneBy([
                                                                                           'estudiante'=>$id_estudiante,
                                                                                          'info'=>  $que_va_a_pagar]
                                                                                          );
        $formaPagoBanco=$em->getRepository('PayPayBundle:FormasPagos')->findOneByFormaPago('BANCO');
        $ingreso=new Ingresos();
        $ingreso->setRepresentante($pension_a_pagar->getFactura()->getIdcliente());
        $ingreso->setFecha($datetime_pago);
        $ingreso->setMonto($valorapagar);
        $ingreso->setFormaPago($formaPagoBanco);
        $ingreso->setDescripcion($que_va_a_pagar." ".$referencia_doc);
        $ingreso->setReferencia($que_va_a_pagar." DOCBANCO: ".$referencia_doc);
        $ingreso->addFactura($pension_a_pagar->getFactura());
        $em->persist($ingreso);
        $em->flush();
        return true;
        }else
        {
          return false;  
        }    
        

    }
   
}

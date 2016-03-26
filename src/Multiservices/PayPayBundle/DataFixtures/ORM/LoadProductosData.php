<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadPensionesData
 *
 * @author Leonardo Loyo <cyberedward@gmail.com>
 */

namespace Multiservices\PayPayBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Multiservices\PayPayBundle\Entity\Familias;
use Multiservices\PayPayBundle\Entity\Productos;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Facturaitems;

class LoadProductosData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $familia = new Familias();

        $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

        $familia->setNombre('Familia 1');
        $familia->SetBorrado('S');

        $manager->persist($familia);

        for($i=0 ;$i<12;$i++)
        {
        $pension = new Productos();
        $pension->setDescripcion("Pension Mes ".$meses[$i]);
        $pension->setStock(1);
        $pension->setCodFamilia($familia);
        $pension->setObservaciones("Pension Mes ".$meses[$i]);
        $pension->setTipo("Pension");
        $manager->persist($pension);
        }

        $representante = $manager->getRepository('MultiacademicoBundle:Representantes')->findOneById(1);
        $factura = new Facturas();
        $factura->setIdcliente($representante);
        $factura->setTotal(1000);
        $factura->setIvaIgv(120);
        $factura->setSubTotal(880);
        $manager->persist($factura);

        for($i=73 ;$i<85;$i++)
        {
        $itemfactura = new Facturaitems();
        $itemfactura->setIdfactura($factura);
        // $itemfactura->setIdproducto($i);
        $manager->persist($itemfactura);
        }

        $manager->flush();

    }
}

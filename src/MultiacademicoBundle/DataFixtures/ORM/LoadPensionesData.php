<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadPensionesData
 *
 * @author Leonardo Loyo <cyberedward@gmail.com>
 */

namespace MultiacademicoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Multiservices\PayPayBundle\Entity\Familias;
use Multiservices\PayPayBundle\Entity\Productos;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Facturaitems;

class LoadPensionesData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $familia=$manager->getRepository('PayPayBundle:Familias')->findOneByNombre('PENSIONES');
        if (!$familia)
        {
        $familia = new Familias();
        $familia->setNombre('PENSIONES');
        $familia->SetBorrado('S');
        $manager->persist($familia);
        }
        
        //creando Producto MAtricula
        $matricula=$manager->getRepository('PayPayBundle:Productos')->findOneByDescripcionCorta('MATRICULA ORDINARIA');
        if (!$matricula)
        {
            $matricula = new Productos();
            $matricula->setDescripcion("Matricula Ordinaria");
            $matricula->setDescripcionCorta("MATRICULA ORDINARIA");
            $matricula->setStock(100);
            $matricula->setCodFamilia($familia);
            $matricula->setObservaciones("Matricula");
            $matricula->setTipo("Servicio");
            $manager->persist($matricula);
        }
        //creando producto pensiones
        $meses = ["Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero"];
        
        for($i=0 ;$i<10;$i++)
        {
            $pension=$manager->getRepository('PayPayBundle:Productos')->findOneByDescripcionCorta("PENSION ".($i+1));
            if (!$pension)
            {
                $pension = new Productos();
                $pension->setDescripcion("Pension mes ".$meses[$i]);
                $pension->setDescripcionCorta("PENSION ".($i+1));
                $pension->setStock(1);
                $pension->setCodFamilia($familia);
                $pension->setObservaciones("Pension mes ".$meses[$i]);
                $pension->setTipo("Pension");
                $manager->persist($pension);
            }
        }
        $manager->flush();

    }
}

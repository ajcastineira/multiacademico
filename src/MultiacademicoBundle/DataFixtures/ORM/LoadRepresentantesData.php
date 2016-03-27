<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadActionsData
 *
 * @author Rene Arias <renearias@arxis.la>
 */

namespace MultiacademicoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MultiacademicoBundle\Entity\Representantes;


class LoadRepresentantesData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $representantes=$this->loadRepresentantes($manager);
        foreach($representantes as $representante)
        {
          $manager->persist($representante);
        }
        $manager->flush();
    }

    private function loadRepresentantes(ObjectManager $manager)
    {
        $representantes = [];
        //buscando si existe el representante por defecto
        $representantepordefecto=$manager->getRepository('MultiacademicoBundle:Representantes')->findOneByRepresentante('REPRESENTANTE POR DEFECTO');
        //si no esta se lo crea
        if (!$representantepordefecto)
        {
                $representante = new Representantes();
                $representante->setRepresentante('REPRESENTANTE POR DEFECTO');
                $representante->setMontoMensual(20);
                //$representante->setUsername('rpdefault');
                //$representante->setPassword('alvarado');
                //$representante->setSalt('salt');
                //$representante->setLastlogin(1);
                //$representante->setLastactivity(1);
                $representante->setStatus(true);
                
                $representantes[] = $representante;
        }
        return $representantes;
    }
}

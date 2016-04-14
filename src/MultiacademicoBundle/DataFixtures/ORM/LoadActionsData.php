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
use Multiservices\NotifyBundle\Entity\Actions;
use Multiservices\NotifyBundle\ActionData\ActionParameters;

class LoadActionsData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $actions=$this->loadActions($manager);
        foreach($actions as $action)
        {    
          $manager->persist($action);
        }
        $manager->flush();
    }
    
    private function loadActions(ObjectManager $manager)
    {
        $actions=[];
        
        $dwyaction=$manager->getRepository('NotifyBundle:Actions')->find('docente_write_calificacion_you');
        if (!$dwyaction)
        {
          $dwyaction = new Actions();
          $dwyaction->setAid('docente_write_calificacion_you');
        }
        $dwyaction->setType('estudiante');
        $dwyaction->setCallback('docente_write_calificacion_you');
        $dwyactionparameters=New ActionParameters();
        $dwyactionparameters->icon="fa flaticon-a1";
        $dwyactionparameters->vars=["docente","materia","nota"];
        $dwyaction->setParameters($dwyactionparameters);
        $dwyaction->setLabel('El docente %docente% ha pasado tu calificacion de %materia%');
        
        $actions[]=$dwyaction;
        
            
        return $actions;
    }
}
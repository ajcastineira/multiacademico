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
        
        
        $dstyaction=$manager->getRepository('NotifyBundle:Actions')->find('docente_send_task_you');
        if (!$dstyaction)
        {
          $dstyaction = new Actions();
          $dstyaction->setAid('docente_send_task_you');
        }
        $dstyaction->setType('estudiante');
        $dstyaction->setCallback('docente_write_calificacion_you');
        $dstyactionparameters=New ActionParameters();
        $dstyactionparameters->icon="fa flaticon-teach";
        $dstyactionparameters->vars=["docente","materia","tipo","tema"];
        $dstyaction->setParameters($dwyactionparameters);
        $dstyaction->setLabel('El docente %docente% te ha enviado una %tipo% de %materia% con el tema %tema%');
        
        $actions[]=$dstyaction;
        
            
        return $actions;
    }
}
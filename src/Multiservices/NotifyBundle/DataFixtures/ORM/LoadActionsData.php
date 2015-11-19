<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadActionsData
 *
 * @author Rene Arias <renearias@arxis.la>
 */

namespace Multiservices\NotifyBundle\DataFixtures\ORM;

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
        
        $uisaction=$manager->getRepository('NotifyBundle:Actions')->find('user_init_session');
        if (!$uisaction)
        {
          $uisaction = new Actions();
          $uisaction->setAid('user_init_session');
        }
        $uisaction->setType('user');
        $uisaction->setCallback('user_init_session');
        $uisactionparameters=New ActionParameters();
        $uisactionparameters->icon="fa fa-key";
        $uisactionparameters->iconbgcolor="bg-warning";
        $uisactionparameters->iconshape="circle";
        $uisactionparameters->textcolor="fg-warning";
        $uisactionparameters->vars=["usuario","urlUser"];
        $uisaction->setParameters($uisactionparameters);
        $uisaction->setLabel('<a href="%urlUser%"><strong>%usuario%</strong></a> Ha iniciado sesión');
        
        $actions[]=$uisaction;
        
            
        return $actions;
    }
}
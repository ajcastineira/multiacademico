<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of LoadActionsData
 *
 * @author Rene Arias <renearias@arxis.la>
 */

namespace Arxis\BlogBundle\DataFixtures\ORM;

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
        
        $ppaction=$manager->getRepository('NotifyBundle:Actions')->find('post_publish_action');
        if (!$ppaction)
        {
          $ppaction = new Actions();
          $ppaction->setAid('post_publish_action');
        }
        $ppaction->setType('post');
        $ppaction->setCallback('post_publish_action');
        $ppactionparameters=New ActionParameters();
        //$ppactionparameters->icon="fa fa-image";
        //$ppactionparameters->iconbgcolor="bg-warning";
        //$ppactionparameters->iconshape="circle";
        //$ppactionparameters->textcolor="fg-warning";
        $ppactionparameters->vars=["post","user","userPicture","urlUser"];
        $ppaction->setParameters($ppactionparameters);
        $ppaction->setLabel('%user% Ha escrito %post%');
        
        $actions[]=$ppaction;
        
            
        return $actions;
    }
}
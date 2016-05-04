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

use Multiservices\ArxisBundle\Entity\Usuario;
use Multiservices\ArxisBundle\Entity\Role;

class LoadDefaultUserRolesData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $roles=$this->loadDefaultRoles($manager);
        foreach($roles as $role)
        {    
          $manager->persist($role);
        }
        $manager->flush();
    }
    
    private function loadDefaultRoles(ObjectManager $manager)
    {
        $roles=[];
        
        $rolesuperadmin=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_SUPER_ADMIN');
        if (!$rolesuperadmin)
        {
          $rolesuperadmin = new Role();
          $rolesuperadmin->setName('ROLE_SUPER_ADMIN');
        }
        $roleadmin=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_ADMIN');
        if (!$roleadmin)
        {
          $roleadmin = new Role();
          $roleadmin->setName('ROLE_ADMIN');
        }
        $rolesecretaria=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_SECRETARIA');
        if (!$rolesecretaria)
        {
          $rolesecretaria = new Role();
          $rolesecretaria->setName('ROLE_SECRETARIA');
        }
        $roledocente=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_DOCENTE');
        if (!$roledocente)
        {
          $roledocente = new Role();
          $roledocente->setName('ROLE_DOCENTE');
        }
        $roleestudiante=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_ESTUDIANTE');
        if (!$roleestudiante)
        {
          $roleestudiante = new Role();
          $roleestudiante->setName('ROLE_ESTUDIANTE');
        }
        $rolecolectora=$manager->getRepository('MultiservicesArxisBundle:Role')->findOneByName('ROLE_COLECTORA');
        if (!$rolecolectora)
        {
          $rolecolectora = new Role();
          $rolecolectora->setName('ROLE_COLECTORA');
        }
        
        $roles[]=$rolesuperadmin;
        $roles[]=$roleadmin;
        $roles[]=$rolesecretaria;
        $roles[]=$rolecolectora;
        
            
        return $roles;
    }
    private function loadDefaultUsers(ObjectManager $manager)
    {
        $users=[];
        
        $userarxis=$manager->getRepository('MultiservicesArxisBundle:Usuario')->find(1);
        if (!$userarxis)
        {
          $userarxis = new Usuario();
          //$userarxis->setName('ROLE_SUPER_ADMIN');
        }
        
        
        
        $users[]=$userarxis;
        
        return $users;
    }


}
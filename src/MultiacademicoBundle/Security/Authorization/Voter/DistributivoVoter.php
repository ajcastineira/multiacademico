<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

namespace MultiacademicoBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Multiservices\ArxisBundle\Entity\Usuario;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Description of DistributivoVoter
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class DistributivoVoter extends AbstractVoter {
    
    const VIEW = 'DISTRIBUTIVO_VIEW';
    const EDIT = 'DISTRIBUTIVO_EDIT';

    protected function getSupportedAttributes()
    {
        return array(self::VIEW, self::EDIT);
    }
    
    protected function getSupportedClasses()
    {
        return array('MultiacademicoBundle\Entity\Distributivos');
    }
    
    protected function isGranted($attribute, $distributivo, $user = null)
    {
        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return false;
        }

        // double-check that the User object is the expected entity (this
        // only happens when you did not configure the security system properly)
        if (!$user instanceof Usuario) {
            throw new \LogicException('The user is somehow not our User class!');
        }

        switch($attribute) {
            case self::VIEW:
                // the data object could have for example a method isPrivate()
                // which checks the Boolean attribute $private
                if ($user->getId() === $distributivo->getOwner()->getId()) {
                    return true;
                }

                break;
            case self::EDIT:
                // this assumes that the data object has a getOwner() method
                // to get the entity of the user who owns this data object
                if ($user->getId() === $distributivo->getOwner()->getId()) {
                    return true;
                }

                break;
        }

        return false;
    }
    
    
}

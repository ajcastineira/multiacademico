<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

namespace MultiacademicoBundle\Security\Authorization\Voter;

use Multiservices\ArxisBundle\Entity\Usuario;
use MultiacademicoBundle\Entity\Distributivos;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Description of DistributivoVoter
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class DistributivoVoter extends Voter {
    
    const VIEW = 'DISTRIBUTIVO_VIEW';
    const EDIT = 'DISTRIBUTIVO_EDIT';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Distributivos) {
            return false;
        }

        return true;
    }
    
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var Clubes $proyectoescolar */
        $distributivo = $subject;

        switch($attribute) {
            case self::VIEW:
                return $this->canView($distributivo, $user);
            case self::EDIT:
                return $this->canEdit($distributivo, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }
    
     private function canView(Distributivos $distributivo, Usuario $user)
    {
        // if they can edit, they can view
         
        if ($this->canEdit($distributivo, $user)) {
            return true;
        }else
        {
              return false;
        }
            

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        //return !$proyectoescolar->isPrivate();
    }

    private function canEdit(Distributivos $distributivo, Usuario $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $distributivo->getOwner();
    }
    
    /*protected function isGranted($attribute, $distributivo, $user = null)
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
    }*/
    
    
}

<?php

/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

namespace MultiacademicoBundle\Security\Authorization\Voter;


use Multiservices\ArxisBundle\Entity\Usuario;

//use Symfony\Component\Security\Core\User\UserInterface;

use MultiacademicoBundle\Entity\Clubes;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
/**
 * Description of DistributivoVoter
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class ProyectosEscolaresVoter extends Voter {
    
    const VIEW = 'PROYECTO_VIEW';
    const EDIT = 'PROYECTO_EDIT';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Clubes) {
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
        $proyectoescolar = $subject;

        switch($attribute) {
            case self::VIEW:
                return $this->canView($proyectoescolar, $user);
            case self::EDIT:
                return $this->canEdit($proyectoescolar, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }
    
     private function canView(Clubes $proyecto, Usuario $user)
    {
        // if they can edit, they can view
         
        if ($user->getId() === $proyecto->getClubcoddocente()->getUsuario()->getId()) {
                    return true;
        }else
        {
                       return false;
        }
        /*if ($this->canEdit($proyectoescolar, $user)) {
            return true;
        }*/

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        //return !$proyectoescolar->isPrivate();
    }

    private function canEdit(Clubes $proyecto, Usuario $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $proyecto->getClubcoddocente()->getUsuario();
    }
    
    
}
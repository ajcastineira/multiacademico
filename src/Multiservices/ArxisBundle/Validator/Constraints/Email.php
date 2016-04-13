<?php
namespace Multiservices\ArxisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of UserName
 *
 * @author Rene Arias
 * @Annotation
 */
class Email extends Constraint{
    
    public $message = 'El email: %string% ya esta siendo usado por un usuario';
   
    /*public function getTargets()
    {
        return Constraint::CLASS_CONSTRAINT;
    }*/
    
    public function validatedBy()
    {
        return 'email.validator';
    }
}

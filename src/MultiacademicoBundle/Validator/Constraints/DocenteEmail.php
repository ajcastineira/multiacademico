<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of ConstraintCedula
 *
 * @author Multiservices
 * @Annotation
 */
class DocenteEmail extends Constraint{
    
    public $message = 'El email: %string% ya esta siendo usado por otro usuario';
    //public $errorPath = null;
   
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
    
    


    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}

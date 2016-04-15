<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of ConstraintCedula
 *
 * @author Multiservices
 * @Annotation
 */
class Distributivo extends Constraint{
    
    public $message = 'El aula indicada: %string% no existe';
   
    public function getTargets()
    {
        return Constraint::CLASS_CONSTRAINT;
    }
    
    public function validatedBy()
    {
        return 'distributivo.validator';
    }
}

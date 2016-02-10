<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
/**
 * Description of AlphaSpaceValidator
 *
 * @author Multiservices
 */
class AlphaSpaceValidator extends ConstraintValidator
{
   
   private function es_alphaspace($value)
   {
       if (is_null($value))
       {
           return true;
       }
       else
       {    
            if (!preg_match('/^[[:alpha:]|[:space:]|áéíóúÁÉÍÓÚñÑ]+$/', $value, $matches)) {
                return false;
            }
            else
            {
                return true;  
            }
        }
    }    
    public function validate($value, Constraint $constraint)
    {
        if (!($this->es_alphaspace($value))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}

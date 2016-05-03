<?php
namespace Multiservices\ArxisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use Multiservices\ArxisBundle\Entity\Usuario;
/**
 * Description of EmailValidator
 *
 * @author Rene Arias
 */
class EmailValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
   private function emailExiste($value)
   {
       
       $usuario=$this->entityManager->getRepository('MultiservicesArxisBundle:Usuario')->findOneByEmailCanonical($value);
            if (!$usuario) {
                return false;
            }
            else
            {
                return true;  
            }
       
   }
    public function validate($value, Constraint $constraint)
    {
        if (($this->emailExiste($value))) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}
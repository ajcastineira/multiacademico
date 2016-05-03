<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use MultiacademicoBundle\Entity\Docentes;

/**
 * Description of DistributivoValidator
 *
 * @author Multiservices
 */
class DocenteEmailValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    private function emailExiste(Docentes $value)
   {
        
        $mail=$value->getDocenteemail();
        $usuario=$this->entityManager->getRepository('MultiservicesArxisBundle:Usuario')->findOneByEmailCanonical($mail);
            if (!$usuario) {
                return false;
            }
            else
            {
                if ($usuario->getEmailCanonical()==$value->getUsuario()->getEmailCanonical())
                {
                    return false;
                }
                return true;  
            }
       
   }
    public function validate($value, Constraint $constraint)
    {
        //$errorPath = null !== $constraint->errorPath ? $constraint->errorPath : $fields[0];
        
        if (($this->emailExiste($value))) {
            $this->context->buildViolation($constraint->message, array('%string%' => $value->getDocenteemail()))
            //$this->context->buildViolation($constraint->message)
            ->atPath('docenteemail')
            //->setInvalidValue($invalidValue)
            ->addViolation();
        }
    }
}

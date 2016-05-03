<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use MultiacademicoBundle\Entity\Estudiantes;

/**
 * Description of DistributivoValidator
 *
 * @author Multiservices
 */
class EstudianteEmailValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    private function emailExiste(Estudiantes $value)
   {
        $mail=$value->getMail();
        //var_dump($mail);
        $usuario=$this->entityManager->getRepository('MultiservicesArxisBundle:Usuario')->findOneByEmailCanonical($mail);
        //var_dump($usuario->getEmailCanonical());
        //var_dump($value->getUsuario()->getEmailCanonical());
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
            $this->context->buildViolation($constraint->message, array('%string%' => $value->getMail()))
            //$this->context->buildViolation($constraint->message)
            ->atPath('mail')
            //->setInvalidValue($invalidValue)
            ->addViolation();
        }
    }
}

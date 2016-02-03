<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use MultiacademicoBundle\Entity\Distributivos;
/**
 * Description of DistributivoValidator
 *
 * @author Multiservices
 */
class DistributivoValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
   private function distributivo_tiene_aula_valida(Distributivos $value)
   {
       
       $aula=$this->entityManager->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$value->getDistributivocodcurso()->getId(),
                                                                          'especializacion'=>$value->getDistributivocodespecializacion()->getId(),
                                                                          'paralelo'=>$value->getDistributivoparalelo(),
                                                                          'seccion'=>$value->getDistributivoseccion(),
                                                                          'periodo'=>$value->getDistributivocodperiodo()->getId()
                                                                           )
                                                                    );
            if (!$aula) {
                return false;
            }
            else
            {
                return true;  
            }
       
   }
    public function validate($value, Constraint $constraint)
    {
        if (!($this->distributivo_tiene_aula_valida($value))) {
            $this->context->addViolation($constraint->message, array('%string%' => $value->getCursoName()));
        }
    }
}

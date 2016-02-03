<?php
namespace MultiacademicoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

use MultiacademicoBundle\Entity\Matriculas;
/**
 * Description of MatriculaValidator
 *
 * @author Multiservices
 */
class MatriculaValidator extends ConstraintValidator
{
   private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
   private function matricula_tiene_aula_valida(Matriculas $value)
   {
       
       $aula=$this->entityManager->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$value->getMatriculacodcurso()->getId(),
                                                                          'especializacion'=>$value->getMatriculacodespecializacion()->getId(),
                                                                          'paralelo'=>$value->getMatriculaparalelo(),
                                                                          'seccion'=>$value->getMatriculaseccion(),
                                                                          'periodo'=>$value->getMatriculacodperiodo()->getId()
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
        if (!($this->matricula_tiene_aula_valida($value))) {
            $this->context->addViolation($constraint->message, array('%string%' => $value->getCursoName()));
        }
    }
}

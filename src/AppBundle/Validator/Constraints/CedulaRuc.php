<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of ConstraintCedula
 *
 * @author Multiservices
 * @Annotation
 */
class CedulaRuc extends Constraint{
    public $message = 'El numero "%string%" no es una Cedula o RUC válido';
}

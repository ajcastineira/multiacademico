<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of ConstraintAlphaSpace
 *
 * @author Multiservices
 * @Annotation
 */
class AlphaSpace extends Constraint{
    public $message = 'Este campo debe contener solo letras';
}

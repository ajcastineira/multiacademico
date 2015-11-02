<?php
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
/**
 * Description of CedulaRucValidator
 *
 * @author Multiservices
 */
class CedulaRucValidator extends ConstraintValidator
{
   const digitos_cedula=10;
    const digitos_ruc=13;
    const digito_verificador_cedula=10;
    const digito_verificador_ruccompanias=10;
   const digito_verificador_rucpublicos=9;
   private function es_cedula_valida($value)
   {
       $esvalido=false;
       $len=strlen($value);
       $coeficientes_cedula=[2,1,2,1,2,1,2,1,2];
       $coeficientes_ruc_companias=[4,3,2,7,6,5,4,3,2];
       $coeficientes_ruc_publicos=[3,2,7,6,5,4,3,2];
       if (is_null($value))
       {
           $esvalido=true;
       }
       elseif ($len==self::digitos_cedula||$len==self::digitos_ruc)
       {
         
         if (ctype_digit($value))
            {
            $nro_region=substr($value, 0,2);//extraigo los dos primeros caracteres de izq a der
            $tipo_ruc=substr($value, 2,1);//tipo de ruc
            if ($tipo_ruc<6)
            {$coeficientes=$coeficientes_cedula;
             $restomodulo=10;
             $pos_digitoverificador=self::digito_verificador_cedula;
            }    
            elseif ($tipo_ruc==6)
                {$coeficientes=$coeficientes_ruc_publicos;
                $restomodulo=11;
                 $pos_digitoverificador=self::digito_verificador_rucpublicos;
                } 
            elseif ($tipo_ruc==9)
                {$coeficientes=$coeficientes_ruc_companias;
                $restomodulo=11;
                $pos_digitoverificador=self::digito_verificador_ruccompanias;
                }
            else{
                return $esvalido;
            }
            
                    
            if($nro_region>=1 && $nro_region<=24)
                {// compruebo a que region pertenece esta cedula//
                    $ult_digito=substr($value, $pos_digitoverificador-1,1);//extraigo el ultimo digito de la cedula
                   
              $suma=0;
              for ($c=0;$c<=$pos_digitoverificador-2;$c++)
              {
                    $d=intval(substr($value, $c, 1));
                    $dd=$d*$coeficientes[$c];
                    if(($dd>9)&&($tipo_ruc<6))
                        {$dd=$dd-9;}
                    $suma+=$dd;
                
              }
            $residuo=$suma%$restomodulo;
            // $dis=(substr($suma, 0,1)+1)*10;//extraigo el primer numero de la suma
            //$dis=(($dis + 1)* 10);//luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
            //$digito=($dis - $suma);
            $digito=($restomodulo - $residuo);
            if($residuo==10){$digito=1; }
            if($residuo==0){ $digito=0; }//si la suma nos resulta 10, el decimo digito es cero
            if ($digito==$ult_digito){//comparo los digitos final y ultimo
            
            $esvalido=true;
            }else{
            $esvalido=false;
            }
            }
            }
       }else
       {
         $esvalido=0;   
       }
       
       return $esvalido;
   }
    public function validate($value, Constraint $constraint)
    {
        
        if (!($this->es_cedula_valida($value))) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}

<?php
//-----
function dibujar_encabezado_titulo($entidad, $titulo,$text_periodo,$tipo_reporte){
   echo"<table border=0 width='100%' cellPadding=0 cellSpacing=0>";
   echo"<tr>";
    echo"<td width=120><img src=escudo.png width=120  border=0></td><td>";
      echo"<table border=0 width='100%' cellPadding=0 cellSpacing=0><tr>";
        echo"<tr><td><center><span style='font-size:15.0pt;font-family:Tahoma;color:#000000'><b>$entidad</b></span></center></td></tr>";
        echo"<tr><td><center><span style='font-size:18.0pt;font-family:Tahoma;color:#000000'><b>$titulo</b></span></center></td></tr>";
        echo"<tr><td><center><span style='font-size:10.0pt;font-family:Tahoma;color:#000000'><b>Periodo Lectivo $text_periodo</b></span></center></td></tr>";
        echo"<tr><td><center><span style='font-size:10.0pt;font-family:Tahoma;color:#000000'><b>$tipo_reporte</b></span></center></td></tr>";
      echo "</table>";
   echo "</table>";
   echo "<center><table border=0 width='100%' cellPadding=1 cellSpacing=1><tr height=5><td></td></tr></table>";
   $fecha_hoy=date("d-m-Y");
   echo "<center><table border=0 width=630 cellPadding=1 cellSpacing=1 bgcolor=FFFFFF>";
   echo "<tr height=20 bgcolor=FFFFFF><td width=57><span style='font-size:8.0pt;font-family:Tahoma;color:#000000'><b>Fecha:</b></span></td><td><span style='font-size:8.0pt;font-family:Tahoma;color:#000000'><b> $fecha_hoy</b></span></td></tr>";
   echo "</table></center>";
}

function mayuscula($letra){

switch ($letra){
                        case 'a':  $letra="A";  break;
                        case 'b':  $letra="B";  break;
                        case 'c':  $letra="C";  break;
                        case 'd':  $letra="D";  break;
                        case 'e':  $letra="E";  break;
                        case 'A':  $letra="A";  break;
                        case 'B':  $letra="B";  break;
                        case 'C':  $letra="C";  break;
                        case 'D':  $letra="D";  break;
                        case 'E':  $letra="E";  break;
                                 }
            return ($letra);
 }

function esrojo($nota){


     if ($nota  < 7 ){
         $color="#FF0000";
     }else
      {
         $color="#000000";
      }

     return ($color);
 }
function valida_nota_impresion($nota)
{
 if ($nota>= 1)
 {
     $nota=retornanumero($nota);
    }else
 {
        $nota="";
    }
 return $nota;
}
 
function retornasiglascualidad($cantidad){

     $letra="";
     if ($cantidad  < 4 ){
         $letra="NAR";
     }

     if (($cantidad >= 4 )and($cantidad < 7 )){
       $letra="PAAR";
     }

     if (($cantidad >= 7 )and($cantidad < 9)){
          $letra="AAR";
     }


     if (($cantidad >= 9 )and($cantidad < 10)){
         $letra="DAR";
     }

     if ($cantidad == 10 ){
         $letra="DAR";
     }

     if (strlen($cantidad)==0){
        $letra="";
     }


     return ($letra);
 }
function retornacualidad($cantidad){

     $letra="";
     if ($cantidad  < 4 ){
         $letra="No alcanza los aprendizajes requeridos";
     }

     if (($cantidad >= 4 )and($cantidad < 7 )){
       $letra="Esta proximo a alcanzar los aprendizajes requeridos";
     }

     if (($cantidad >= 7 )and($cantidad < 9)){
          $letra="Alcanza los aprendizajes requeridos";
     }


     if (($cantidad >= 9 )and($cantidad < 10)){
         $letra="Domina los aprendizajes requeridos";
     }

     if ($cantidad == 10 ){
         $letra="Domina los aprendizajes requeridos";
     }

     if (strlen($cantidad)==0){
        $letra="";
     }


     return ($letra);
 }

function retornacualidadconducta($letra){
     switch ($letra)
     {
     case "A":
     {
     $cualidad="Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social";
     break;
     }
     case "B":
     {
     $cualidad="Cumple con los compromisos establecidos para la sana convivencia social";
     break;
     }
     case "C":
     {
     $cualidad="Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia social";
     break;
     }
     case "D":
     {
     $cualidad="Falla reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia social";
     break;
     }
     case "E":
     {
     $cualidad="No cumple con los compromisos establecidos para la sana convivencia social";
     break;
     }
     }

     return ($cualidad);
 }
 function retornasatisfaccion($letra){
     switch ($letra)
     {
     case "A":
     {
     $satisfaccion="Muy Satisfactorio";
     break;
     }
     case "B":
     {
     $satisfaccion="Satisfactorio";
     break;
     }
     case "C":
     {
     $satisfaccion="Poco satisfactorio";
     break;
     }
     case "D":
     {
     $satisfaccion="Mejorable";
     break;
     }
     case "E":
     {
     $satisfaccion="Insatisfactorio";
     break;
     }
     }

     return ($satisfaccion);
 }
 
 
 function siglas_cualidad_letra($letra){
     switch ($letra)
     {
     case "A":     {
     $cualidad="EX";
     break;
     }
     case "B":     {
     $cualidad="MB";
     break;
     }
     case "C":     {
     $cualidad="B";
     break;
     }
     case "D":     {
     $cualidad="R";
     break;
     }
     case "E":     {
     $cualidad="R";
     break;
     }
     }
     return ($cualidad);
 }
 
 function retornainterpretacion($siglascualidad){
     switch ($siglascualidad)
     {
     case "EX":{     $interpretacion="Demuestra destacado desempeño en cada fase del desarrollo del proyecto del club lo que constituye un excelente aporte a su formación integral.";     break;     }
     case "MB":     {     $interpretacion="Demuestra muy buen desempeño en cada fase del desarrollo del proyecto del club lo que constituye un aporte a su formación integral.";     break;     }
     case "B":   {     $interpretacion="Demuestra buen desempeño en cada fase del desarrollo del proyecto del club lo que contribuye a su formación.";     break;     }
     case "R":     {     $interpretacion="Demuestra regular desempeño en cada fase del desarrollo del proyecto del club lo que contribuye escasamente a su formación integral.";     break;     }
     }
     return ($interpretacion);
 }
//-----

//-------------------------------------------------
function retornaletra($cantidad){


     if ($cantidad  <= 4 ){
         $letra="E";
     }

     if (($cantidad >= 4.1 )and($cantidad <= 6.9 )){
       $letra="D";
     }

     if (($cantidad >= 7 )and($cantidad <= 8.9)){
          $letra="C";
     }


     if (($cantidad >= 9 )and($cantidad <= 9.9)){
         $letra="B";
     }

     if ($cantidad == 10 ){
         $letra="A";
     }

     if (strlen($cantidad)==0){
        $letra="";
     }


     return ($letra);
 }
//-------------------------------------------------
function letranumero($letra){

     $numero="";
     if ($letra == "F" ){
         $numero=3;
     }
     if ($letra == "E" ){
         $numero=4;
     }

     if ($letra == "D"){
         $numero=6;
     }

     if ($letra == "C"){
         $numero=8;
     }

     if ($letra == "B"){
        $numero=9;
     }

     if ($letra == "A"){
         $numero=10;
     }

     return ($numero);
 } 
//----------------------------------------------------------------------
function redondear_dos_decimal($valor) { 
   //$float_redondeado=floor($valor * 100) / 100;
   $float_redondeado=round($valor,2,PHP_ROUND_HALF_DOWN);
   return $float_redondeado; 
} 
//----------------------------------------------------------------------
   function validacedula($cedula){
            $c1=substr($cedula,0,1);
            $c2=substr($cedula,1,1);
            $c3=substr($cedula,2,1);
            $c4=substr($cedula,3,1);
            $c5=substr($cedula,4,1);
            $c6=substr($cedula,5,1);
            $c7=substr($cedula,6,1);
            $c8=substr($cedula,7,1);
            $c9=substr($cedula,8,1);
            $c10=substr($cedula,9,1);
            $sumapar=$c2+$c4+$c6+$c8;
            
            $impar[0]=$c1*2;
            $impar[1]=$c3*2;
            $impar[2]=$c5*2;
            $impar[3]=$c7*2;
            $impar[4]=$c9*2;
 
            for ($i=0;$i<=4;$i++){
                if ($impar[$i] > 9){
                    $aux=$impar[$i]-9;
                }else{
                    $aux=$impar[$i];
                }
                    $sumaimpar=$sumaimpar+$aux;
            }

            $suma=($sumapar + $sumaimpar);
            $decena=(substr($suma,0,1)+1)*10;
            $digito=abs($decena-$suma);
            if ($digito == 10){
                $digito=0;
            }
            if($digito == $c10){
               $resultado="true";
            }else{
               $resultado="false";
            }

            return ($resultado);
  }

//----------------------------------------------------------------------
function retornames($mes){
              switch ($mes){
                        case '01':  $mes="Enero";      break;
                        case '02':  $mes="Febrero";    break;
                        case '03':  $mes="Marzo";      break;
                        case '04':  $mes="Abril";      break;
                        case '05':  $mes="Mayo";       break;
                        case '06':  $mes="Junio";      break;
                        case '07':  $mes="Julio";      break;
                        case '08':  $mes="Agosto";     break;
                        case '09':  $mes="Septiembre"; break;
                        case '10':  $mes="Octubre";    break;
                        case '11':  $mes="Noviembre";  break;
                        case '12':  $mes="Diciembre";  break;
                                 }
            return ($mes);
  }
//----------------------------------------------------------------------
function retornadia($dia){
              switch ($dia){
                        case '1':  $dia="Lunes";      break;
                        case '2':  $dia="Martes";     break;
                        case '3':  $dia="Miércoles";  break;
                        case '4':  $dia="Jueves";     break;
                        case '5':  $dia="Viernes";    break;
                        case '6':  $dia="Sábado";     break;
                        case '7':  $dia="Domingo";    break;
                                 }
            return ($dia);
  }
//----------------------------------------------------------------------
function crearceros($valor, $can){
	    $cero='0';
            if ($can==strlen($valor)){
	       $cero='';
	    }
	    $n=$can-strlen($valor);
            for ($i=1; $i<$n;$i++) {
                 $cero="0$cero";
            }
	    $codceros="$cero$valor";
 	    return ($codceros); 
  }
//----------------------------------------------------------------------
function retornanumero($numero){
                  $estado=false;
                  $entero="";
                  $decimal="";
            if (strlen($numero) > 0){
            for ($i=0;$i<=strlen($numero);$i++){
                     $caracter = substr ($numero, $i,1);
                  if ($caracter =="."){
                      $estado=true;
                   }
                  if ($estado==true){
                    $decimal = "$decimal$caracter";
                    }else{
                     $entero = "$entero$caracter";
                    }

                                                           }

                   $decimal= substr ($decimal,1,2);
                   switch (strlen($decimal)){
                     case 0:$decimal="00";break;
                     case 1:$cero=0;$decimal="$decimal$cero";break;
                     case 2:break;
                   }
                   $numero="$entero.$decimal";
                   return ($numero);
         }
}

//----------------------------------------------------------------------
function retornaentero($numero){
                  $estado=false;
                  $entero="";
            for ($i=0;$i<=strlen($numero);$i++){
                      $caracter = substr($numero,$i,1);
                  if ($caracter=="."){
                      $estado=true;
                   }
                  if ($estado==false){
                     $entero = "$entero$caracter";
                  }
                                                                             }
                   return ($entero);
}


//----------------------------------------------------------------------
 
function retornadecimal($numero){
                  $estado=false;
                  $decimal="";
            for ($i=0;$i<=strlen($numero);$i++){
                      $caracter = substr($numero,$i,1);
                  if ($caracter=="."){
                      $estado=true;
                   }
                  if ($estado==true){
                     $decimal = "$decimal$caracter";
                  }
                                                                             
                                               }
                   return (substr($decimal,1,2));
}
     
function nuevenumeros($numero){
         switch ($numero){
                 case 0:
                      return ("Cero");break;
                 case 1:
                      return ("Uno");break;
                 case 2:
                      return ("Dos");break;
                 case 3:
                      return ("Tres");break;
                 case 4:
                      return ("Cuatro");break;
                 case 5:
                      return ("Cinco");break;
                 case 6:
                      return ("Seis");break;
                 case 7:
                      return ("Siete");break;
                 case 8:
                      return ("Ocho");break;
                 case 9:
                      return ("Nueve");break;
          }
}
//----------------------------------------------------------------------


function numeroenletra($numero) {

                  $cantidad=strlen($numero);
          switch ($cantidad){
                case 1:

                     return (nuevenumeros($numero));

                case 2:
                   switch ($numero){
                          case '00':
                                return ("Cero Cero");break;
                          case '01':
                                return ("Cero Uno");break;
                          case '02':
                                return ("Cero Dos");break;
                          case '03':
                                return ("Cero Tres");break;
                          case '04':
                                return ("Cero Cuatro");break;
                          case '05':
                                return ("Cero Cinco");break;
                          case '06':
                                return ("Cero Seis");break;
                          case '07':
                                return ("Cero Siete");break;
                          case '08':
                                return ("Cero Ocho");break;
                          case '09':
                                return ("Cero Nueve");break;
                   }

                   If (($numero >= 10) and ($numero <= 19)) {
                            switch ($numero){
                            case 10:
                                 return ("Diez");break;
                            case 11:
                                 return ("Once");break;
                            case 12:
                                 return ("Doce");break;
                            case 13:
                                 return ("Trece");break;
                            case 14:
                                return ("Catorce");break;
                            case 15:
                                return ("Quince");break;
                            case 16:
                                 return ("Dieciseis");break;
                            case 17:
                                 return ("Diecisiete");break;
                            case 18:
                                 return ("Dieciocho");break;
                            case 19:
                                 return ("Diecinueve");break;
                            }
                                
                   }else{

                                       $d1=substr ($numero, 0,1);
                                       $d2=substr ($numero, 1,1);
                                       $d1=$d1+0;
                                       $d2=$d2+0;
                                     
                                        if ($numero == 20){
                                             return ("Veinte");
                                        }
                                        if ($d1 == 2){
                                              return ("Veinte y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 30){
                                             return ("Treinta");
                                        }
                                        if ($d1 == 3){
                                              return ("Treinta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 40){
                                             return ("Cuarenta");
                                        }
                                        if ($d1 == 4){
                                              return ("Cuarenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 50){
                                             return ("Cincuenta");
                                        }
                                        if ($d1 == 5){
                                              return ("Cincuenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 60){
                                             return ("Sesenta");
                                        }
                                        if ($d1 == 6){
                                              return ("Sesenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 70){
                                             return ("Setenta");
                                        }
                                        if ($d1 == 7){
                                              return ("Setenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 80){
                                             return ("Ochenta");
                                        }
                                        if ($d1 == 8){
                                              return ("Ochenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 90){
                                             return ("Noventa");
                                        }
                                        if ($d1 == 9){
                                              return ("Noventa y ".nuevenumeros($d2)." ");
                                        }
                   }

                  case 3:    
                                        $cantidad=substr($numero,0,1);
                                        switch ($cantidad){
                                              case 1:
                                                   if ((substr($numero,1,1)==0)and(substr($numero,2,1)==0)){
                                                      return ("Cien");
                                                   }else{
                                                      if (substr($numero,1,1)==0){
                                                       $texto=nuevenumeros(substr($numero,2,1));
                                                       return ("Ciento $texto");
                                                      }else{
                                                               $numero=substr($numero,1,2);
                                                          If (($numero >= 10) and ($numero <= 19)) {
                                                              switch ($numero){
                                                                      case 10:
                                                                         return ("Ciento Diez");break;
                                                                      case 11:
                                                                         return ("Ciento Once");break;
                                                                      case 12:
                                                                         return ("Ciento Doce");break;
                                                                      case 13:
                                                                         return ("Ciento Trece");break;
                                                                      case 14:
                                                                         return ("Ciento Catorce");break;
                                                                      case 15:
                                                                         return ("Ciento Quince");break;
                                                                      case 16:
                                                                         return ("Ciento Dieciseis");break;
                                                                      case 17:
                                                                         return ("Ciento Diecisiete");break;
                                                                      case 18:
                                                                         return ("Ciento Dieciocho");break;
                                                                      case 19:
                                                                         return ("Ciento Diecinueve");break;
                                                                              }
                                                          }else{

                                       $d1=substr ($numero, 0,1);
                                       $d2=substr ($numero, 1,1);
                                       $d1=$d1+0;
                                       $d2=$d2+0;
                                     
                                        if ($numero == 20){
                                             return ("Ciento Veinte");
                                        }
                                        if ($d1 == 2){
                                              return ("Ciento Veinte y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 30){
                                             return ("Ciento Treinta");
                                        }
                                        if ($d1 == 3){
                                              return ("CientoTreinta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 40){
                                             return ("Ciento Cuarenta");
                                        }
                                        if ($d1 == 4){
                                              return ("Cuarenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 50){
                                             return ("Ciento Cincuenta");
                                        }
                                        if ($d1 == 5){
                                              return ("Ciento Cincuenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 60){
                                             return ("Ciento Sesenta");
                                        }
                                        if ($d1 == 6){
                                              return ("Ciento Sesenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 70){
                                             return ("Ciento Setenta");
                                        }
                                        if ($d1 == 7){
                                              return ("Ciento Setenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 80){
                                             return ("Ciento Ochenta");
                                        }
                                        if ($d1 == 8){
                                              return ("Ciento Ochenta y ".nuevenumeros($d2)." ");
                                        }
                                        if ($numero == 90){
                                             return ("Ciento Noventa");
                                        }
                                        if ($d1 == 9){
                                              return ("Ciento Noventa y ".nuevenumeros($d2)." ");
                                        }

                                                          }

                                                      }
                                                   }
                                                   
                                                   break;
                                              case 2:
                                                   return ("Dos ciento");break;
                                        }
                                        

         }
                  
}
//----------------------------------------------------------------------
      
?>


<?php
namespace MultiacademicoBundle\Libs;
/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of Letra
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class Letra {
    
    public static function letranumero($letra){

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
 /**
  * 
  * @param integer $cantidad
  * @return string
  */
 public static function retornaletra($cantidad){


     if ($cantidad  <= 4 ){
         $letra="E";
     }

     if (($cantidad > 4 )and($cantidad < 7 )){
       $letra="D";
     }

     if (($cantidad >= 7 )and($cantidad < 9)){
          $letra="C";
     }


     if (($cantidad >= 9 )and($cantidad < 10)){
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
 /**
  * 
  * @param integer $numero
  * @return integer
  */
 public static function retornaentero($numero){
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


}

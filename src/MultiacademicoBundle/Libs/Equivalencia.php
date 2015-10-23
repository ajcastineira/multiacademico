<?php
namespace MultiacademicoBundle\Libs;
/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of Equivalencia
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class Equivalencia {
    
    public static function retornasiglascualidad($cantidad){

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
public static function retornacualidad($cantidad){

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

public static function retornacualidadconducta($letra){
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
 public static function retornasatisfaccion($letra){
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
 
 
 public static function siglas_cualidad_letra($letra){
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
 
 public static function retornainterpretacion($siglascualidad){
     switch ($siglascualidad)
     {
     case "EX":{     $interpretacion="Demuestra destacado desempeño en cada fase del desarrollo del proyecto del club lo que constituye un excelente aporte a su formación integral.";     break;     }
     case "MB":     {     $interpretacion="Demuestra muy buen desempeño en cada fase del desarrollo del proyecto del club lo que constituye un aporte a su formación integral.";     break;     }
     case "B":   {     $interpretacion="Demuestra buen desempeño en cada fase del desarrollo del proyecto del club lo que contribuye a su formación.";     break;     }
     case "R":     {     $interpretacion="Demuestra regular desempeño en cada fase del desarrollo del proyecto del club lo que contribuye escasamente a su formación integral.";     break;     }
     }
     return ($interpretacion);
 }

    
}

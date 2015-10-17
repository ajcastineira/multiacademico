<?php
class calificacion
{
  public $nota;
  public $color;
  public $cualidad;
  function __construct($nota)
  {
      $this->nota=$nota;
      $this->color=esrojo($nota);
  }
}
   $camposcalificaciones="calificacionnummatricula,calificacioncodmateria,q1_p1_n1,q1_p1_n2,q1_p1_n3,q1_p1_n4,q1_p1_n5,q1_p1_co,q1_p2_n1,q1_p2_n2,q1_p2_n3,q1_p2_n4,q1_p2_n5,q1_p2_co,q1_p3_n1,q1_p3_n2,q1_p3_n3,q1_p3_n4,q1_p3_n5,q1_p3_co,q1_ex,q2_p1_n1,q2_p1_n2,q2_p1_n3,q2_p1_n4,q2_p1_n5,q2_p1_co,q2_p2_n1,q2_p2_n2,q2_p2_n3,q2_p2_n4,q2_p2_n5,q2_p2_co,q2_p3_n1,q2_p3_n2,q2_p3_n3,q2_p3_n4,q2_p3_n5,q2_p3_co,q2_ex,mejoramiento,supletorio,gracia";
   $valuesblancoscalificaciones="'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',''";
   if (!isset($nummatricula)){ $nummatricula="";}
   if (!isset($codmateria)){$codmateria="";}
   $sqlinsertnotas="Insert Into calificaciones ($camposcalificaciones) values ('$nummatricula','$codmateria',$valuesblancoscalificaciones)";
function calificaciones_estudiante($nummatricula)
   {
    
    require "conexion.php";
    $calificaciones_query="Select calificaciones.* From calificaciones
             INNER JOIN matriculas ON matriculanummatricula=calificacionnummatricula
                  INNER JOIN distributivos
                    ON distributivocodcurso=matriculacodcurso
                    AND distributivocodespecializacion=matriculacodespecializacion
                    AND distributivoparalelo=matriculaparalelo
                    AND distributivocodperiodo=matriculacodperiodo
                    AND distributivoseccion=matriculaseccion
                    AND distributivocodmateria=calificacioncodmateria
                  WHERE (calificacionnummatricula= :nummatricula )";
    $calificaciones= $db->prepare($calificaciones_query);
        $calificaciones->bindParam(':nummatricula',$nummatricula, PDO::PARAM_STR);
        $calificaciones->execute();                   
        $row =$calificaciones->rowCount();
        if ($row>=1)
        {
            $calificaciones_estudiante=$calificaciones->fetchAll();
            return $calificaciones_estudiante;
        }
        else
            return false;
            
            
}
function calificaciones_estudiante_materia($nummatricula,$codmateria)
   {
    
    require "conexion.php";
    $calificaciones_query="Select * From calificaciones Where (calificacionnummatricula= :nummatricula AND calificacioncodmateria=:codmateria)";
    $calificaciones= $db->prepare($calificaciones_query);
        $calificaciones->bindParam(':nummatricula',$nummatricula, PDO::PARAM_STR);
        $calificaciones->bindParam(':codmateria',$codmateria, PDO::PARAM_STR);
        $calificaciones->execute();                   
        $row =$calificaciones->rowCount();
        if ($row==1)
        {
            $calificaciones_estudiante=$calificaciones->fetch();
            return $calificaciones_estudiante;
        }
        else
            return false;
            
            
}
function comportamiento_estudiante($nummatricula)
   {
    
    require "conexion.php";
    $comportamiento_query="Select * From comportamiento Where (comportamientonummatricula= :nummatricula )";
    $comportamiento= $db->prepare($comportamiento_query);
        $comportamiento->bindParam(':nummatricula',$nummatricula, PDO::PARAM_STR);
        $comportamiento->execute();                   
        $row =$comportamiento->rowCount();
        if ($row==1)
        {
            $comportamiento_estudiante=$comportamiento->fetch();
            return $comportamiento_estudiante;
        }
        else
            return false;
            
            
}
function faltas_estudiante($nummatricula)
   {
    
    require "conexion.php";
    $faltas_query="Select * From asistencia Where (asistencianummatricula=:nummatricula)";
    $faltas= $db->prepare($faltas_query);
        $faltas->bindParam(':nummatricula',$nummatricula, PDO::PARAM_STR);
        $faltas->execute();       
        $row = $faltas->rowCount();
        if ($row==1)
        {
            $faltas_estudiante=$faltas->fetch();
            return  $faltas_estudiante;
        }
        else
            return false;
            
            
}   
function clubes_estudiante($nummatricula)
   {
    
    require "conexion.php";
    $clubes_query="Select * From clubes,clubes_detalle,matriculas Where (clubes.codclub=clubes_detalle.codclub and matriculanummatricula=:nummatricula and clubescodestudiante=matriculacodestudiante)";
    $clubes= $db->prepare($clubes_query);
        $clubes->bindParam(':nummatricula',$nummatricula, PDO::PARAM_STR);
        $clubes->execute();       
        $row =$clubes->rowCount();
        if ($row==1)
        {
            $clubes_estudiante=$clubes->fetch();
            return $clubes_estudiante;
        }
        else
            return false;
            
            
}   
function promedio_final($quimestre1,$quimestre2,$mejoramiento,$supletorio,$remedial,$gracia)
{
  $promedio_quimestres=round((($quimestre1+$quimestre2)/2),2,PHP_ROUND_HALF_DOWN);
  $quimestre_mayor=0;
  $quimestre_menor=0;
  $quimestre_mejorado=0;
  if ($quimestre1>$quimestre2)
  {
   $quimestre_mayor=$quimestre1;
   $quimestre_menor=$quimestre2;
  }
  else
  {
   $quimestre_mayor=$quimestre2;
   $quimestre_menor=$quimestre1;
  }

  if ($quimestre_menor<$mejoramiento)
  {
    $quimestre_mejorado=$mejoramiento;
  }
  else
  {
    $quimestre_mejorado=$quimestre_menor;
  }

  $promedio_mejorado=round((($quimestre_mayor+$quimestre_mejorado)/2),2,PHP_ROUND_HALF_DOWN);

  if($promedio_quimestres>=7)
  {
  return $promedio_quimestres;
  }
  elseif($promedio_mejorado>=7)
  {
   return $promedio_mejorado;
  }
  elseif($promedio_mejorado>=4)
  {
     if ($supletorio>=7)
      {return 7;}
     elseif ($remedial>=7)
      {return 7;}
     elseif ($gracia>=7)
      {return 7;}
     else
       {return $promedio_mejorado;}          
      
   }

  
  elseif($promedio_mejorado<4)
  {
    if ($remedial>=7)
       {return 7;}
       elseif ($gracia>=7)
      {return 7;}
      else
       {return $promedio_mejorado;}
  }
  else
  {
    return $promedio_mejorado;
  }

}
function aprueba_anio_lectivo($quimestre1,$quimestre2,$mejoramiento,$supletorio,$remedial,$gracia)
{
  if(promedio_final($quimestre1,$quimestre2,$mejoramiento,$supletorio,$remedial,$gracia)>=7)
  return true;
   else
  return false;

}
function nota_en_letras($nota)
{
  require_once("enletras.php");
  $notaenletras=new EnLetras();
 return $notaenletras->ValorEnLetras($nota,"");

}
?>

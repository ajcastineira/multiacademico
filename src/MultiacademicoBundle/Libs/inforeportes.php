<?php
//namespace MultiacademicoBundle;
//use MultiacademicoBundle\entity\Estudiante;
require 'entity/Estudiante.php';
class certificado
{
  //public $logoiz="logodefault.jpg";
  //public $logocenter="logodefault.jpg";
  public $logoiz="ministerio.png";
  public $logocenter="ecuador.png";
  public $logoder="escudo.png";
  public $posfecha="left";
  public $codigoamie="--H-----";
  public $cualitativas=false;
  public $numeroenletras=true;
  public $proyectosescolares=false;
  public $titulo="Certificado";
  public $footer;
  function __construct()
  {
    require_once("conexion.php");
    $this->dia=date('d');
    $this->mes=date('m');
    $this->anio=date('Y');
    $this->diasemana=date('N');
    
    /*$this->dia=7;
    $this->mes=3;
    $this->anio=2014;
    $this->diasemana=5;*/
    require("infoentidad.php");
       $ciudad= $entidades["ciudad"];
       $direccion=$entidades["direccion"];
       $email=$entidades["email"];
       $telefono=$entidades["telefono"];
if (isset($entidades["data"]))
{
   $dataentidad=json_decode($entidades["data"]);
   
   if (isset($dataentidad)&&isset($dataentidad->logoiz)&&isset($dataentidad->logocenter)&&isset($dataentidad->logoder))
   {
       $this->actualizar_logos($dataentidad->logoiz,$dataentidad->logocenter,$dataentidad->logoder);
       $this->posfecha=$dataentidad->certpromo->posfecha;
   }
   if (isset($dataentidad)&&isset($dataentidad->certpromo->cualitativas)&&isset($dataentidad->certpromo->numeroenletras))
   {
       $this->cualitativas=$dataentidad->certpromo->cualitativas;
       $this->numeroenletras=$dataentidad->certpromo->numeroenletras;
   }
   if (isset($dataentidad)&&isset($dataentidad->codamie))
   {
       $this->codigoamie=$dataentidad->codamie;
   }
    if (isset($dataentidad)&&isset($dataentidad->certpromo->fechapromo))
    {
        $this->fechapromo=strtotime($dataentidad->certpromo->fechapromo);
        $this->dia=date('d',$this->fechapromo);
        $this->mes=date('m',$this->fechapromo);
        $this->anio=date('Y',$this->fechapromo);
        $this->diasemana=date('N',$this->fechapromo);
    }
     if (isset($dataentidad)&&isset($dataentidad->certpromo->proyectosescolares))
     {
        $this->proyectosescolares=true; 
     }
   
}
   $periodo_sql = "Select * From periodos Where (periodoestado='Activo') ";
                $periodo_pdo=$db->prepare($periodo_sql);
                $periodo_pdo->execute();$result_periodo=$periodo_pdo->fetch();
                $codperiodo=$result_periodo["codperiodo"];
                $periodo=$result_periodo["periodo"];
    
    $this->entidad=mb_strtoupper("$entidad"." "."$titulo");
    $this->tipoentidad=mb_strtoupper($entidad);
    
    $this->nombreentidad=mb_strtoupper($titulo);
    $this->subt1="AÑO LECTIVO $periodo";
    $this->ciudad=$ciudad;
    $this->lugar=$lugar;
    $this->direccion=$direccion;
    $this->telefono=$telefono;
    $this->mail=$email;
    $this->periodo=$periodo;
  }
  function actualizar_logos($logoiz="logodefault.jpg",$logocenter="logodefault.jpg",$logoder="ministerio.png")
      {
      $this->logoiz=$logoiz;
      $this->logocenter=$logocenter;
      $this->logoder=$logoder;
      }
  public function actualizar_encabezado($entidad,$titulo,$subt1,$subt2)
      {
      $this->entidad=$entidad;
      $this->titulo=$titulo;
      $this->subt1=$subt1;
      $this->subt2=$subt2;
      }
   
}
class cuadro_calificaciones extends certificado
{
  
  public $materias;
  public $curso;
  public $paralelo;
  public $jornada;
  public $aniolectivo;
  public $titulo="CUADRO DE CALIFICACIONES FINALES";
  
  public $estudiantes;
  function __construct($curso,$especializacion,$seccion,$paralelo,$quimestre)
  {
     parent::__construct();
     $this->paralelo=$paralelo;
     $this->jornada=substr($seccion, 0, -1)."a";
     
     $this->setCurso($curso,$especializacion);
     $this->setMaterias($curso,$especializacion,$seccion,$paralelo);
     $this->setEstudiantes($curso, $especializacion, $seccion, $paralelo);
  }
  public function setMaterias($curso,$especializacion,$seccion,$paralelo)
  {
      require 'conexion.php';
      require 'infocursos.php';
      $stringcurso="01"."$curso"."$especializacion"."$seccion"."$paralelo";
      $materiaspdo=$db->prepare(sql_materiasxcurso($stringcurso));
      $materiaspdo->execute();
      $materias=$materiaspdo->fetchAll();
      $this->materias=$materias;
      
      return $this;
  }
  public function setCurso($codcurso,$codespecializacion)
  {
      require 'conexion.php';
      $sqlcurso="Select * From cursos  Where codcurso=:codcurso";
      
      $cursopdo=$db->prepare($sqlcurso);
      $cursopdo->bindParam("codcurso",$codcurso);
      $cursopdo->execute();
      $curso = $cursopdo->fetch();
      $sqlespecializacion="Select * From especializaciones  Where codespecializacion=:codespecializacion";
      $especializacionpdo=$db->prepare($sqlespecializacion);
      $especializacionpdo->bindParam("codespecializacion",$codespecializacion);
      $especializacionpdo->execute();
      $especializacion = $especializacionpdo->fetch();
      $this->idcurso=$curso['codcurso'];
      $this->curso=$curso['curso'].' de '.$especializacion['especializacion'];
      return $this;
  }
  public function setEstudiantes($curso,$especializacion,$seccion,$paralelo)
  {
      require 'conexion.php';
      $estudiantessql="Select codestudiante, estudiante, matriculanummatricula, matriculaestado From estudiantes,matriculas Where (matriculaparalelo='$paralelo')and(matriculaseccion='$seccion')and(matriculacodcurso='$curso')and(matriculacodespecializacion='$especializacion')and(codestudiante=matriculacodestudiante)  Order by estudiante"; 
      $estudiantespdo=$db->prepare($estudiantessql);
      $estudiantespdo->execute();
      $estudianteslist=$estudiantespdo->fetchAll();
      foreach ($estudianteslist as $estudiante)
      {
          $estudianten=New Estudiante($estudiante['matriculanummatricula']);
          $estudianten->setNombre($estudiante['estudiante']);
          $estudiantes[]=$estudianten;
      }
      $this->estudiantes=$estudiantes;
  }
  
     public function esbasico()
  {
   if ($this->idcurso<=3)
   {    
   return true;
   }
   else
   {    
   return false;
   }    
  }  
}

class cuadro_calificaciones_comportamiento extends cuadro_calificaciones
{
  
  
  public $titulo="REGISTRO DE EVALUACIÓN DEL COMPORTAMIENTO";
  
 
}

class cuadro_calificaciones_quimestrales extends cuadro_calificaciones
{
  
  
  public $titulo="CUADRO DE PROMEDIOS DE LOS DOS QUIMESTRES";
 
}

class cuadro_calificaciones_quimestre extends cuadro_calificaciones
{
  
  
  public $titulo="CUADRO DE CALIFICACIONES DEL PRIMER QUIMESTRE";
  
  function __construct($curso,$especializacion,$seccion,$paralelo,$quimestre)
  {
     parent::__construct($curso, $especializacion, $seccion, $paralelo, $quimestre);
     if ($quimestre==1)
     {
     $this->titulo="CUADRO DE CALIFICACIONES DEL PRIMER QUIMESTRE";
     }else
     {
       $this->titulo="CUADRO DE CALIFICACIONES DEL SEGUNDO QUIMESTRE";
     }    
    // $this->paralelo=$paralelo;
    // $this->jornada=substr($seccion, 0, -1)."a";
     
    // $this->setCurso($curso,$especializacion);
    // $this->setMaterias($curso,$especializacion,$seccion,$paralelo);
   //  $this->setEstudiantes($curso, $especializacion, $seccion, $paralelo);
  }
  
 
}

class certificado_matricula extends certificado
{
  public $titulo="CERTIFICADO DE MATRICULA";
   public $nombre="ALMACHE SOTO GEOVANNA ELIZABETH";
   public $curso="SÉPTIMO AÑO DE EDUCACION GENERAL BASICA";
  function __construct($codigo,$quimestre)
  {
     parent::__construct();

            $result_curso = mysql_query("Select * From estudiantes,matriculas,especializaciones,cursos  Where (matriculacodcurso=codcurso)and(matriculacodespecializacion=codespecializacion)and(matriculacodestudiante=codestudiante)and(matriculanummatricula='$codigo')  ");
            $row = mysql_num_rows($result_curso);

            $idcurso=mysql_result($result_curso,0,"codcurso");
            $curso=mysql_result($result_curso,0,"curso");
            $especializacion=mysql_result($result_curso,0,"especializacion");
            $paralelo=mysql_result($result_curso,0,"matriculaparalelo");
            $seccion=mysql_result($result_curso,0,"matriculaseccion");
            $jornada = substr($seccion, 0, -1)."a";


            $estudiante_cedula=mysql_result($result_curso,0,"estudiante_cedula");
            $estudiante=mysql_result($result_curso,0,"estudiante");
            $genero=mysql_result($result_curso,0,"estudiante_genero");
            $nummatricula=mysql_result($result_curso,0,"matriculanummatricula");
            $matriculafecha=mysql_result($result_curso,0,"matriculafecha");
            $matriculatipo=strtoupper(mysql_result($result_curso,0,"matriculatipo"));

            $this->subt2=mb_strtoupper("JORNADA $jornada");
            
            $this->estudiante=$estudiante;
            $this->nummatricula=$nummatricula;

            $this->estudiante=$estudiante;
            $this->curso=mb_strtoupper("$curso de $especializacion");
            $this->paralelo=mb_strtoupper("$paralelo");
            $this->seccion=mb_strtoupper("$seccion");
            $this->especializacion=mb_strtoupper("$especializacion");
       
    
              $result_secretaria_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='04')";
              
              $result_secretaria_pdo=$db->prepare($result_secretaria_sql);
              $result_secretaria_pdo->execute();
              $result_secretaria=$result_secretaria_pdo->fetch();
              $trato_s=$result_secretaria["usuariotrato"];
              $secretaria=$result_secretaria["usuario"];
              $cargo_s=$result_secretaria["cargo"];

              $result_rector_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='03')";
              $result_rector_pdo=$db->prepare($result_rector_sql);
              $result_rector_pdo->execute();
              $result_rector=$result_rector_pdo->fetch();
              $trato_r=$result_rector["usuariotrato"];
              $rector=$result_rector["usuario"];
              $cargo_r=$result_rector["cargo"];

      
              if ($cargo_r=="Rector")  {   $pron_r="el";    }
                else   {     $pron_r="la";     }
              if ($cargo_s=="Secretario")  {   $pron_s="el";    }
                else   {     $pron_s="la";     }
      
           $this->rector=mb_strtoupper("$trato_r $rector");
           $this->cargorector=mb_strtoupper("$cargo_r");
           $this->elrector="$pron_r $cargo_r";
           $this->secretaria=mb_strtoupper("$trato_s $secretaria");
           $this->cargosecretaria=mb_strtoupper("$cargo_s");
           $this->lasecretaria="$pron_s $cargo_s";
           
           
           
          
          
          
  }
  
  function textosuperior()
  {
   /*$texto="De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica
   de Educación Intercultural y demás normativas vigentes, certifica que el/la estudiante
     <b>$this->estudiante</b> del <b>$this->curso</b>, Paralelo \"$this->paralelo\", Sección $this->seccion
     obtuvo las siguientes calificaciones durante el presente año lectivo:";*/
   $texto="Que el/la señor/señorita <b>$this->estudiante</b> estudiante del  <b> $this->curso  Paralelo $this->paralelo</b>, con matricula  <b># $this->nummatricula </b> del <b> Periodo Lectivo $this->periodo </b> se encuentra legalmente matriculado/a en el Plantel, previo cumplimiento de los requisitos legales y reglamentarios de Educación. <br><br><br> Certificación que se extiende una vez revisados los libros de matriculas que se llevan en esta Secretaría y el interesado le dá el uso conveniente.";
   return $texto;
  }
  function textoinferior()
  {
      $texto="";  
  return $texto;
  }

}
class certificado_promocion extends certificado
{
  public $titulo="C&nbsp;E&nbsp;R T I F I C A D O  D E  P R O M O C I Ó N";
   public $nombre="ALMACHE SOTO GEOVANNA ELIZABETH";
   public $curso="SÉPTIMO AÑO DE EDUCACION GENERAL BASICA";
   public $sigcurso="OCTAVO AÑO DE EDUCACION GENERAL BASICA";
   public $idcurso=3;
  function __construct($codigo,$quimestre)
  {
      require("conexion.php");
      parent::__construct();
           
            $result_curso_sql = "Select * From estudiantes,matriculas,especializaciones,cursos  Where (matriculacodcurso=codcurso)and(matriculacodespecializacion=codespecializacion)and(matriculacodestudiante=codestudiante)and(matriculanummatricula='$codigo')  ";
            $result_curso_pdo=$db->prepare($result_curso_sql);
            $result_curso_pdo->execute();
            $result_curso=$result_curso_pdo->fetch();
            $row = count($result_curso);

            $idcurso=$result_curso["codcurso"];
            $curso=$result_curso["curso"];
            $especializacion=$result_curso["especializacion"];
            $paralelo=$result_curso["matriculaparalelo"];
            $seccion=$result_curso["matriculaseccion"];
            $jornada = substr($seccion, 0, -1)."a";
            $this->jornada = $jornada;

            $estudiante_cedula=$result_curso["estudiante_cedula"];
            $estudiante=$result_curso["estudiante"];
            $genero=$result_curso["estudiante_genero"];
            $nummatricula=$result_curso["matriculanummatricula"];
            $matriculafecha=$result_curso["matriculafecha"];
            $matriculatipo=strtoupper($result_curso["matriculatipo"]);

            $this->subt2=mb_strtoupper("JORNADA $jornada");
            $this->estudiante=$estudiante;
            $this->nummatricula=$nummatricula;
            $this->idcurso=$idcurso;
            if ($idcurso<6)
               {$nextidcurso=$idcurso+1;
               $result_next_curso_sql="Select * From cursos where codcurso=0$nextidcurso";
               $result_next_curso_pdo=$db->prepare($result_next_curso_sql);
               $result_next_curso_pdo->execute();
               $result_next_curso=$result_next_curso_pdo->fetch();
               $siguientecurso=$result_next_curso["curso"];
               if ($nextidcurso<4)
                {
                  $siguientecurso.=" de Educación General Básica";
                }
                else
                {
                  $siguientecurso.=" General Unificado";
                }
               }
               else
               {
               $siguientecurso="Bachillerato";
               }
            $this->estudiante=$estudiante;
            $this->curso=mb_strtoupper("$curso $especializacion");
            $this->paralelo=mb_strtoupper("$paralelo");
            $this->seccion=mb_strtoupper("$seccion");
            $this->sigcurso=mb_strtoupper("$siguientecurso");
            $this->num_materias=$this->contar_materias($codigo);
           $this->calificaciones=$this->cargar_calificaciones($codigo,$quimestre);
           $this->reprobadas=$this->materias_reprobadas($codigo,$quimestre);
           
           $this->comportamiento=$this->cargar_comportamiento($codigo,$quimestre);
           $this->suma_general=$this->retorna_suma($codigo);
           $this->suma_general_en_letras=mb_strtoupper(nota_en_letras($this->suma_general));
           $this->promedio_general=$this->retorna_promedio($codigo,$quimestre);
           $this->promedio_general_en_letras=mb_strtoupper(nota_en_letras($this->promedio_general));
           $this->promedio_general_cualitativa=  retornacualidad($this->promedio_general);
           $this->cualidadcomportamiento=retornacualidadconducta($this->comportamiento);
           
           $this->clubes=$this->cargar_clubes($codigo,$quimestre);

              $result_secretaria_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='04')";
              
              $result_secretaria_pdo=$db->prepare($result_secretaria_sql);
              $result_secretaria_pdo->execute();
              $result_secretaria=$result_secretaria_pdo->fetch();
              $trato_s=$result_secretaria["usuariotrato"];
              $secretaria=$result_secretaria["usuario"];
              $cargo_s=$result_secretaria["cargo"];

              $result_rector_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='03')";
              $result_rector_pdo=$db->prepare($result_rector_sql);
              $result_rector_pdo->execute();
              $result_rector=$result_rector_pdo->fetch();
              $trato_r=$result_rector["usuariotrato"];
              $rector=$result_rector["usuario"];
              $cargo_r=$result_rector["cargo"];

      
              if ($cargo_r=="Rector")  {   $pron_r="el";    }
                else   {     $pron_r="la";     }
              if ($cargo_s=="Secretario")  {   $pron_s="el";    }
                else   {     $pron_s="la";     }
      
           $this->rector=mb_strtoupper("$trato_r $rector");
           $this->cargorector=mb_strtoupper("$cargo_r");
           $this->elrector="$pron_r $cargo_r";
           $this->secretaria=mb_strtoupper("$trato_s $secretaria");
           $this->cargosecretaria=mb_strtoupper("$cargo_s");
           $this->lasecretaria="$pron_s $cargo_s";
           
           
           
          
          
          
  }

   public function esbasico()
  {
   if ($this->idcurso<=3)
   {    
   return true;
   }
   else
   {    
   return false;
   }    
  }  
  function cargar_clubes($codigo,$quimestre)
  {
      require("conexion.php");
    require_once("modulo.php");
    require_once("infoparciales.php");
    $club=new \stdClass();
    $club->club="";
    $club->campoaccion="";
    $club->calificacion="";
    $club->satisfaccion="";
    $qactivo=$quimestre;
    $nummatricula=$codigo;
    $notaclubsql="SELECT estudiantes.estudiante, matriculas.matriculanummatricula, clubes.*, clubes_detalle.* FROM clubes 
                    INNER JOIN clubes_detalle ON clubes.codclub=clubes_detalle.codclub
                    INNER JOIN estudiantes ON clubes_detalle.clubescodestudiante=estudiantes.codestudiante
                    INNER JOIN matriculas ON estudiantes.codestudiante=matriculas.matriculacodestudiante
                    WHERE matriculas.matriculanummatricula= :nummatricula";
    
      
      $notasclub_pdo=$db->prepare($notaclubsql);
      $notasclub_pdo->bindParam(':nummatricula', $nummatricula);
      $notasclub_pdo->execute();
      
      $row_c=$notasclub_pdo->rowCount();
      
      $notasclub=$notasclub_pdo->fetch();
      $club->club=$notasclub["club"];
      $club->campoaccion=$notasclub["campoaccion"];
      $sumanio=0;
      for($q=1;$q<=2;$q++)
                {
                $sum=0;
                 for($p=1;$p<=3;$p++)
                  {
                     $notavar="nota_q".$q."_p".$p;
                     $sum+=letranumero($notasclub[$notavar]);
                  }
                  
                  ${"promedioclub_q$q"}=retornaletra(retornaentero($sum/3));
                  $sumanio+=letranumero(${"promedioclub_q$q"});
                 
                  
                 }
                 $promedioclub_anual=retornaletra(retornaentero($sumanio/2));
                 
                 
     switch ($qactivo)
             {
               case 1:
               {
               $club->calificacion=$promedioclub_q1;
               break;
               }
               case 2:
               {
               $club->calificacion=$promedioclub_q2;
               break;
               }
               case 3:
               {
               $club->calificacion=$promedioclub_anual;
               break;
               }
            }
            $club->satisfaccion=retornasatisfaccion($club->calificacion);
          return $club;
    
  }        
  function cargar_comportamiento($codigo,$quimestre)
  {
    require("conexion.php");
    require_once("modulo.php");
    //require_once("consultas.php");
    require_once("infoparciales.php");
    $qactivo=$quimestre;
    $nummatricula=$codigo;
    $color='000000';

        $result_c_sql = "Select * From comportamiento Where (comportamientonummatricula=$nummatricula)";
        $result_c_pdo=$db->prepare($result_c_sql);
             $result_c_pdo->execute();
             $result_c= $result_c_pdo->fetch();

        if ($result_c){

           for($q=1;$q<=2;$q++)
                {
                 for($p=1;$p<=3;$p++)
                  {
                           $agdcvar="agdc_q".$q."_p".$p;
                           ${"$agdcvar"}=$result_c[$agdcvar];
                           $estabienvar="estabien_q".$q."_p".$p;
                           ${"$estabienvar"}=$result_c[$estabienvar];
                           $mejoravar="mejorar_q".$q."_p".$p;
                           ${"$mejoravar"}=$result_c[$mejoravar];
                           $recvar="crecomendacion_q".$q."_p".$p;
                           ${"$recvar"}=$result_c[$recvar];
                   }

                   $agdcvar="agdc_q".$q;
                   ${"$agdcvar"}=$result_c["$agdcvar"];
                   $estabienvar="estabien_q".$q;
                   ${"$estabienvar"}=$result_c["$estabienvar"];
                   $mejoravar="mejorar_q".$q;
                   ${"$mejoravar"}=$result_c["$mejoravar"];
                   $recvar="crecomendacion_q".$q;
                   ${"$recvar"}=$result_c["$recvar"];
              }
            if ($agdc_q1=="")
             {
              $agdcpromedio_q1=retornaletra(retornaentero((letranumero($agdc_q1_p1)+letranumero($agdc_q1_p2)+letranumero($agdc_q1_p3))/3));
             }
             else
             {
              $agdcpromedio_q1=$agdc_q1;
             }

            if ($agdc_q2=="")
             {
              $agdcpromedio_q2=retornaletra(retornaentero((letranumero($agdc_q2_p1)+letranumero($agdc_q2_p2)+letranumero($agdc_q2_p3))/3));
             }
             else
             {
              $agdcpromedio_q2=$agdc_q2;
             }
            }

            $promedio_dis=retornaletra(retornaentero((letranumero($agdcpromedio_q1)+letranumero($agdcpromedio_q2))/2));
    
            switch ($qactivo)
             {
               case 1:
               {
               return $agdcpromedio_q1;
               break;
               }
               case 2:
               {
               return $agdcpromedio_q2;
               break;
               }
               case 3:
               {
               return $promedio_dis;
               break;
               }
            }
  }
  function contar_materias($codigo)
  {
      require ("conexion.php");
    require_once("infoestudiantes.php");
    $result_mat_pdo=$db->prepare(materiasxestudiante_sql($codigo));
    $result_mat_pdo->execute();
    $row_mat=$result_mat_pdo->rowCount();
    return $row_mat;

  }
  function materias_reprobadas($codigo,$quimestre)
  {
    $reprobadas=0;
      foreach ($this->calificaciones as $calificacion)
            {
             
                
                if ($calificacion['nota']<7)
                {
                 $reprobadas++;   
                }
            }
            return $reprobadas;
                
  }
  function cargar_calificaciones($codigo,$quimestre)
  {
    require("conexion.php");
    require_once("modulo.php");
    require_once("infoestudiantes.php");
    require_once("infoparciales.php");
    require_once("infocalificaciones.php");
    $qactivo=$quimestre;
    $nummatricula=$codigo;
    $total_q1=0;
    $total_q2=0;
    $color='000000';
    $materias[]=NULL;
    $notas[]=NULL;
    $calificaciones=NULL;
    $num_materias=$this->contar_materias($codigo);
    $result_mat_pdo=$db->prepare(materiasxestudiante_sql($codigo));
    $result_mat_pdo->execute();
    $result_mat=$result_mat_pdo->fetchAll();
      for($i=0;$i<$num_materias;$i++)
        {
            $codmateria=$result_mat[$i]["codmateria"];
            $result_c_sql = "Select * From calificaciones Where (calificacionnummatricula=$nummatricula)and(calificacioncodmateria='$codmateria')";
             $result_c_pdo=$db->prepare($result_c_sql);
             $result_c_pdo->execute();
             $result_c= $result_c_pdo->fetch();
            //$row_c = count($result_c);
            if ($result_c){
               for($q=1;$q<=2;$q++)
                {
                 for($p=1;$p<=3;$p++)
                 {
                   $sumpar=0;
                   for ($n=1;$n<=5;$n++)
                           {
                               $nvar="q".$q."_p".$p."_n".$n;
                               ${"$nvar"}=$result_c["$nvar"];
                               $sumpar+=${"$nvar"};
                           }
                   $promediovar="promedio_q".$q."_p".$p;
                   ${"$promediovar"}=redondear_dos_decimal($sumpar/5);
                   $cualidadvar="cualidad_q".$q."_p".$p;
                   ${"$cualidadvar"}=retornacualidad(${"$promediovar"});
                   $colorvar="color_q".$q."_p".$p;
                   ${"$colorvar"}=esrojo(${"$promediovar"});
                 }
                 $examenvar="q".$q."_ex";
                 ${"$examenvar"}=$result_c["$examenvar"];

                }
             $mejoramiento=$result_c["mejoramiento"];
             if (!isset($mejoramiento)){$mejoramiento="";}
             $supletorio=$result_c["supletorio"];
             if (!isset($supletorio)){$supletorio="";}
             $remedial=$result_c["remedial"];
             if (!isset($remedial)){$remedial="";}
             $gracia=$result_c["gracia"];
             if (!isset($gracia)){$gracia="";}
            }


          ///calculo de promedios

             $promedio_q1_pa=redondear_dos_decimal(($promedio_q1_p1+$promedio_q1_p2+$promedio_q1_p3)/3);
             $promedio_q1_pa_80=redondear_dos_decimal(($promedio_q1_pa)*0.8);
             $promedio_q1_ex_20=redondear_dos_decimal($q1_ex*0.2);
             $promedio_q1=redondear_dos_decimal(($promedio_q1_pa_80+$promedio_q1_ex_20));

             $promedio_q2_pa=redondear_dos_decimal(($promedio_q2_p1+$promedio_q2_p2+$promedio_q2_p3)/3);
             $promedio_q2_pa_80=redondear_dos_decimal(($promedio_q2_pa)*0.8);
             $promedio_q2_ex_20=redondear_dos_decimal($q2_ex*0.2);
             $promedio_q2=redondear_dos_decimal(($promedio_q2_pa_80+$promedio_q2_ex_20));

            $promedio_final=promedio_final($promedio_q1,$promedio_q2,$mejoramiento,$supletorio,$remedial,$gracia);






            $materias[$i]=mb_strtoupper($result_mat[$i]["materia"]);
               switch ($qactivo)
               {
               case 1:
                   {
                   $notas[$i]=$promedio_q1;
                   break;}
               case 2:
                   {
                   $notas[$i]=$promedio_q2;
                   break;}
               case 3:
                   {
                   $notas[$i]=$promedio_final;
                   break;}
               }
                $letras[$i]="letras";
            $calificaciones[$i]["materia"]=$materias[$i];
            $calificaciones[$i]["nota"]=$notas[$i];
         
            $calificaciones[$i]["notaenletras"]=mb_strtoupper(nota_en_letras($notas[$i]));
            $calificaciones[$i]["cualitativa"]=  retornacualidad($notas[$i]);
        }
        /*$calificaciones=array(
                              'materia'=>$materias,
                              'nota'=>$notas,
                              'letra'=>$letras); */
        return $calificaciones;
  }
  function retorna_suma($codigo)
  {
    if (!((isset($this->num_materias))and(isset($this->calificaciones))))
    {
        $this->num_materias=$this->contar_materias($codigo);
        $this->calificaciones=$this->cargar_calificaciones($codigo,$quimestre);
    }
    $suma=0;
    foreach ($this->calificaciones as $calificacion)
            {
             $suma+=$calificacion['nota'];




            }
    



    return $suma;
  }
  function retorna_promedio($codigo)
  {
    if (!((isset($this->num_materias))and(isset($this->calificaciones))))
    {
        $this->num_materias=$this->contar_materias($codigo);
        $this->calificaciones=$this->cargar_calificaciones($codigo,$quimestre);
    }
    $suma=0;
    foreach ($this->calificaciones as $calificacion)
            {
             $suma+=$calificacion['nota'];




            }
    $promedio=redondear_dos_decimal($suma/$this->num_materias);



    return $promedio;
  }
  function textosuperior()
  {
      
   $texto="De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica
   de Educación Intercultural y demás normativas vigentes, certifica que el/la estudiante<br/>
     <span style='text-align:center;display: block;'><b>$this->estudiante</b></span>del <b>$this->curso</b>, Paralelo \"$this->paralelo\", Jornada $this->jornada
      obtuvo las siguientes calificaciones durante el presente año lectivo:";
   /*$texto="De conformidad con que dispone la Ley Orgánica
   de Educación Intercultural y demás normativas vigentes, Certifico: que el(la) estudiante
     <b>$this->estudiante</b> del <b>$this->curso</b>, Paralelo \"$this->paralelo\", Jornada $this->jornada
     ha obtenido las siguientes calificaciones promediales";*/
   return $texto;
  }
  function textoinferior()
  {
    $sigcurso=$this->sigcurso;
    if  ($this->reprobadas==0)
    {
      $siono="";  
    }
    else
    {     $siono="NO";
    }
      //require_once("conexion.php");  
      
    //$texto="Por lo tanto $siono es promovido/a  al <b>$sigcurso.</b> Para certificar suscriben en unidad de acto el/ la Rector/a con el/ la Secretario/a General del Plantel.";
      $texto="Por lo tanto $siono se le promueve al <b>$sigcurso</b> y para <b>Certificar</b> suscriben en unidad de acto $this->elrector y $this->lasecretaria General del Plantel.";  
  return $texto;
  }

}
class reporte_calificaciones extends certificado
{
  
   public $nombre="ALMACHE SOTO GEOVANNA ELIZABETH";
   public $curso="SÉPTIMO AÑO DE EDUCACION GENERAL BASICA";
   public $logoiz="escudo.png";
   
   function __construct($codigo,$parcial,$quimestre)
  {
       require ('conexion.php');
       parent::__construct();

            $this->logoiz="escudo.png";
            $this->logoder="ministerio.png";
            if($quimestre<3)
               {
                 if($parcial<=3)
                 {$tipo="Parcial";}
                 else
                 {$tipo="Quimestral";}
                   }
            if($quimestre==3)$tipo="Anual";
            $this->titulo="Informe $tipo de Aprendizaje";
            $result_curso_sql = "Select * From estudiantes,matriculas,especializaciones,cursos  Where (matriculacodcurso=codcurso)and(matriculacodespecializacion=codespecializacion)and(matriculacodestudiante=codestudiante)and(matriculanummatricula='$codigo')  ";
            $result_curso_pdo=$db->prepare($result_curso_sql);
            $result_curso_pdo->execute();
            $result_curso=$result_curso_pdo->fetch();
            $row = count($result_curso);

            $idcurso=$result_curso["codcurso"];
            $curso=$result_curso["curso"];
            $cursoabreviado=$result_curso["cursoabreviatura"];
            $especializacion=$result_curso["especializacion"];
            $paralelo=$result_curso["matriculaparalelo"];
            $seccion=$result_curso["matriculaseccion"];
            $jornada = substr($seccion, 0, -1)."a";
            $this->jornada=$jornada;

            $estudiante_cedula=$result_curso["estudiante_cedula"];
            $estudiante=$result_curso["estudiante"];
            $genero=$result_curso["estudiante_genero"];
            $nummatricula=$result_curso["matriculanummatricula"];
            $matriculafecha=$result_curso["matriculafecha"];
            $matriculatipo=strtoupper($result_curso["matriculatipo"]);

            $this->subt2=mb_strtoupper("JORNADA $jornada");
            $this->estudiante=$estudiante;
            $this->nummatricula=$nummatricula;

            if ($idcurso<6)
               {
               
               $nextidcurso=$idcurso+1;
               $result_next_curso_sql="Select * From cursos where codcurso=0$nextidcurso";
               $result_next_curso_pdo=$db->prepare($result_next_curso_sql);
               $result_next_curso_pdo->execute();
               $result_next_curso=$result_next_curso_pdo->fetch();
               $siguientecurso=$result_next_curso["curso"];
               if ($nextidcurso<4)
                {
                  $siguientecurso.=" de Educación General Básica";
                }
                else
                {
                  $siguientecurso.=" de Bachillerato";
                }
               }
               else
               {
               $siguientecurso="Bachillerato";
               }
            $this->estudiante=$estudiante;
            $this->curso="$cursoabreviado $paralelo $especializacion $seccion";
            $this->paralelo="$paralelo";
            $this->seccion="$seccion";
            $this->sigcurso=mb_strtoupper("$siguientecurso");
            $this->num_materias=$this->contar_materias($codigo);
           $this->calificaciones=$this->cargar_calificaciones($codigo,$parcial,$quimestre);
          
           //$this->reprobadas=$this->materias_reprobadas($codigo,$quimestre);
           
           //$this->comportamiento=$this->cargar_comportamiento($codigo,$parcial,$quimestre);
           //$this->promedio_general=$this->retorna_promedio($codigo,$quimestre);
           //$this->promedio_general_en_letras=mb_strtoupper(nota_en_letras($this->promedio_general));
           //$this->promedio_general_cualitativa=  retornacualidad($this->promedio_general);
           //$this->cualidadcomportamiento=retornacualidadconducta($this->comportamiento);
           

             $result_secretaria_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='04')";
              
              $result_secretaria_pdo=$db->prepare($result_secretaria_sql);
              $result_secretaria_pdo->execute();
              $result_secretaria=$result_secretaria_pdo->fetch();
              $trato_s=$result_secretaria["usuariotrato"];
              $secretaria=$result_secretaria["usuario"];
              $cargo_s=$result_secretaria["cargo"];

              $result_rector_sql = "Select * From usuarios,cargos  Where (usuariocodcargo=codcargo)and(codcargo='03')";
              $result_rector_pdo=$db->prepare($result_rector_sql);
              $result_rector_pdo->execute();
              $result_rector=$result_rector_pdo->fetch();
              $trato_r=$result_rector["usuariotrato"];
              $rector=$result_rector["usuario"];
              $cargo_r=$result_rector["cargo"];
      
              if ($cargo_r=="Rector")  {   $pron_r="el";    }
                else   {     $pron_r="la";     }
              if ($cargo_s=="Secretario")  {   $pron_s="el";    }
                else   {     $pron_s="la";     }
      
           $this->rector=mb_strtoupper("$trato_r $rector");
           $this->cargorector=mb_strtoupper("$cargo_r");
           $this->elrector="$pron_r $cargo_r";
           $this->secretaria=mb_strtoupper("$trato_s $secretaria");
           $this->cargosecretaria=mb_strtoupper("$cargo_s");
           $this->lasecretaria="$pron_s $cargo_s";
           
           
           
          
          
          
  }

  
  function cargar_comportamiento($codigo,$parcial,$quimestre)
  {
    require("conexion.php");
    require_once("modulo.php");
    require_once("consultas.php");
    require_once("infoparciales.php");
    $qactivo=$quimestre;
    $nummatricula=$codigo;
    $color='000000';

        $result_c_sql = "Select * From comportamiento Where (comportamientonummatricula=$nummatricula)";
         $result_c_pdo=$db->prepare($result_c_sql);
        $result_c_pdo->execute();
        $result_c=$result_c_pdo->fetch();
       

        if ($result_c){

           for($q=1;$q<=2;$q++)
                {
                 for($p=1;$p<=3;$p++)
                  {
                           $agdcvar="agdc_q".$q."_p".$p;
                           ${"$agdcvar"}=$result_c["$agdcvar"];
                           $estabienvar="estabien_q".$q."_p".$p;
                           ${"$estabienvar"}=$result_c["$estabienvar"];
                           $mejoravar="mejorar_q".$q."_p".$p;
                           ${"$mejoravar"}=$result_c["$mejoravar"];
                           $recvar="crecomendacion_q".$q."_p".$p;
                           ${"$recvar"}=$result_c["$recvar"];
                   }

                   $agdcvar="agdc_q".$q;
                   ${"$agdcvar"}=$result_c[$agdcvar];
                   $estabienvar="estabien_q".$q;
                   ${"$estabienvar"}=$result_c[$estabienvar];
                   $mejoravar="mejorar_q".$q;
                   ${"$mejoravar"}=$result_c[$mejoravar];
                   $recvar="crecomendacion_q".$q;
                   ${"$recvar"}=$result_c[$recvar];
              }
            if ($agdc_q1=="")
             {
              $agdcpromedio_q1=retornaletra(retornaentero((letranumero($agdc_q1_p1)+letranumero($agdc_q1_p2)+letranumero($agdc_q1_p3))/3));
             }
             else
             {
              $agdcpromedio_q1=$agdc_q1;
             }

            if ($agdc_q2=="")
             {
              $agdcpromedio_q2=retornaletra(retornaentero((letranumero($agdc_q2_p1)+letranumero($agdc_q2_p2)+letranumero($agdc_q2_p3))/3));
             }
             else
             {
              $agdcpromedio_q2=$agdc_q2;
             }
            }

            $promedio_dis=retornaletra(retornaentero((letranumero($agdcpromedio_q1)+letranumero($agdcpromedio_q2))/2));
    
            switch ($qactivo)
             {
               case 1:
               {
               return $agdcpromedio_q1;
               break;
               }
               case 2:
               {
               return $agdcpromedio_q2;
               break;
               }
               case 3:
               {
               return $promedio_dis;
               break;
               }
            }
  }
  function contar_materias($codigo)
  {
    require ("conexion.php");
    require_once("infoestudiantes.php");
    $result_mat_pdo=$db->prepare(materiasxestudiante_sql($codigo));
    $result_mat_pdo->execute();
    $row_mat=$result_mat_pdo->rowCount();
    return $row_mat;

  }
  function cargar_calificaciones($codigo,$parcial,$quimestre)
  {
    require("conexion.php");
    require_once("modulo.php");
    require_once("consultas.php");
    require_once("infoparciales.php");
    require_once("infocalificaciones.php");
    $qactivo=$quimestre;
    $nummatricula=$codigo;
    $total_q1=0;
    $total_q2=0;
    $color='000000';
    $materias[]=NULL;
    $notas[]=NULL;
    $calificaciones=NULL;

    
    //$result_mat=mysql_query(sql_materiasxestudiante($codigo));
    $result_pdo_mat=$db->prepare(sql_materiasxestudiante($codigo));
    $result_pdo_mat->execute();
    $i=0;
    foreach ($result_pdo_mat as $materia)
    {
      set_time_limit(30);      
     //var_dump($materia);
      $codmateria=$materia["codmateria"];
      $calificaciones_query = "Select * From calificaciones Where (calificacionnummatricula=$nummatricula)and(calificacioncodmateria='$codmateria')";
      $calificaciones_pdo=$db->prepare($calificaciones_query);
      $calificaciones_pdo->execute();
      $row_c=$calificaciones_pdo->rowCount();
      $calificaciones_materia=$calificaciones_pdo->fetch();
      $calificaciones[$i]["materia"]=$materia["materia"];
       if ($row_c == 1){
          // var_dump($calificaciones_materia);
               $sumanio=0;
               for($q=1;$q<=2;$q++)
                {
                 $sumquim=0;
                 for($p=1;$p<=3;$p++)
                 {
                   $sumpar=0;
                   for ($n=1;$n<=5;$n++)
                           {
                               $nvar="q".$q."_p".$p."_n".$n;
                               ${$nvar}=$calificaciones_materia[$nvar];
                               $sumpar+=${$nvar};
                               /*if (($p==$parcial) and ($q==$quimestre))
                               {      
                                   $calificaciones[$i][$nvar]=${$nvar};
                               }*/
                           }
                   $promediovar="promedio_q".$q."_p".$p;
                   ${$promediovar}=redondear_dos_decimal($sumpar/5);
                   $sumquim+=${$promediovar};
                   $recvar="q".$q."_p".$p."_recomendacion";
                   ${"$recvar"}=$calificaciones_materia[$recvar];
                   $mejoravar="q".$q."_p".$p."_planmejora";
                   ${"$mejoravar"}=$calificaciones_materia[$mejoravar];
                   $cualidadvar="cualidad_q".$q."_p".$p;
                   ${"$cualidadvar"}=retornacualidad(${"$promediovar"});
                   $colorvar="color_q".$q."_p".$p;
                   ${"$colorvar"}=esrojo(${"$promediovar"});
                       if (($p==$parcial) and ($quimestre==$q))
                               {      
                                    $calificaciones[$i][$cualidadvar]=new calificacion(${$cualidadvar});                                   
                                    $calificaciones[$i][$cualidadvar]->color=esrojo(${$promediovar});
                                    $calificaciones[$i][$promediovar]=new calificacion(${$promediovar});
                                    $calificaciones[$i][$recvar]=${$recvar};
                                    $calificaciones[$i][$mejoravar]=${$mejoravar};
                                    
                               }
                      if ($parcial>=4 and $quimestre==$q)
                      {
                        $calificaciones[$i][$promediovar]=new calificacion(${$promediovar});   
                      }
                 }
                 
                 $promedioquimvar="promedio_q".$q."_pa";
                 $promedio_80_var="promedio_q".$q."_pa_80";
                 $examenvar="q".$q."_ex";
                 $promedio_ex_20_var="promedio_q".$q."_ex_20";
                 $promedio_qvar="promedio_q".$q;
                 $recvar="q".$q."_recomendacion";
                 $mejoravar="q".$q."_planmejora";
                 ${$recvar}=$calificaciones_materia[$recvar];
                 ${$mejoravar}=$calificaciones_materia[$mejoravar];
                 ${$promedioquimvar}=redondear_dos_decimal($sumquim/3);
                 ${$promedio_80_var}=redondear_dos_decimal(${$promedioquimvar}*0.8);                 
                 ${$examenvar}=$calificaciones_materia["$examenvar"]; 
                 ${$promedio_ex_20_var}=redondear_dos_decimal(${$examenvar}*0.2);
                 ${$promedio_qvar}=redondear_dos_decimal(${$promedio_80_var}+ ${$promedio_ex_20_var});
                 if (($parcial>=4) and ($quimestre==$q))
                 {
                     $calificaciones[$i][$promedioquimvar]=new calificacion(${$promedioquimvar});
                     $calificaciones[$i][$promedio_80_var]=${$promedio_80_var};
                     $calificaciones[$i][$examenvar]=${$examenvar};
                     $calificaciones[$i][$promedio_ex_20_var]=${$promedio_ex_20_var};
                     $calificaciones[$i][$promedio_qvar]=new calificacion(${$promedio_qvar});
                     $calificaciones[$i]['cualitativa']= new calificacion(retornasiglascualidad(${$promedio_qvar}));
                     $calificaciones[$i]['cualitativa']->color=esrojo(${$promedio_qvar});
                     $calificaciones[$i][$recvar]=${$recvar};
                     $calificaciones[$i][$mejoravar]=${$mejoravar};
                 }
                 $sumanio+=${$promedio_qvar};
                    if ($quimestre==3)
                     {
                        $calificaciones[$i][$promedio_qvar]=new calificacion(${$promedio_qvar});
                     
                    }

                }
             $promedio_anual=  redondear_dos_decimal($sumanio/2);
             $mejoramiento=$calificaciones_materia["mejoramiento"];
             $supletorio=$calificaciones_materia["supletorio"];
             $remedial=$calificaciones_materia["remedial"];
             $gracia=$calificaciones_materia["gracia"];
             $promedio_final=promedio_final($promedio_q1,$promedio_q2,$mejoramiento,$supletorio,$remedial,$gracia);
             if (aprueba_anio_lectivo($promedio_q1,$promedio_q2,$mejoramiento,$supletorio,$remedial,$gracia))
                {$status="Aprobado";}
                else
                {$status="Reprobado";}
             if ($quimestre==3)
             {
                 $calificaciones[$i]['anual']=new calificacion($promedio_anual);
                 $calificaciones[$i]['mejoramiento']=new calificacion($mejoramiento);
                 $calificaciones[$i]['supletorio']=new calificacion($supletorio);
                 $calificaciones[$i]['remedial']=new calificacion($remedial);
                 $calificaciones[$i]['gracia']=new calificacion($gracia);
                 $calificaciones[$i]['promedio_final']=new calificacion($promedio_final);
                 $calificaciones[$i]['status']=new calificacion($status);
                 $calificaciones[$i]['status']->color=esrojo($promedio_final);
                
                 
             }
            }
         $i++;   
    }
          return $calificaciones;
  }
  function textosuperior()
  {
   /*$texto="De conformidad con lo prescrito en el Art. 197 del Reglamento General a la Ley Orgánica
   de Educación Intercultural y demás normativas vigentes, certifica que el/la estudiante
     <b>$this->estudiante</b> del <b>$this->curso</b>, Paralelo \"$this->paralelo\", Sección $this->seccion
     obtuvo las siguientes calificaciones durante el presente año lectivo:";*/
   $texto="";
   return $texto;
  }
  function textoinferior()
  {
      $texto="";  
  return $texto;
  }

}
function certificados_promocion_curso($curso,$especializacion,$seccion,$paralelo,$quimestre)
   {
     require_once("conexion.php"); 
     $result_sql = "Select * From estudiantes,matriculas Where (matriculaparalelo='$paralelo')and(matriculaseccion='$seccion')and(matriculacodcurso='$curso')and(matriculacodespecializacion='$especializacion')and(matriculacodestudiante=codestudiante)  Order by estudiante";
     $result_pdo=$db->prepare($result_sql);
     $result_pdo->execute();
     $result=$result_pdo->fetchAll();
     $row = count($result);
     if ($row > 0){


    $i=0;
    set_time_limit(480);
    while ($row != $i){

          $codigo=$result[$i]["matriculanummatricula"];
          $certificados[$i]= new certificado_promocion($codigo,$quimestre);
        
          
          $i++;

     }
   
   }
   return $certificados;
}
function certificados_matricula_curso($curso,$especializacion,$seccion,$paralelo,$quimestre)
   {
     require("conexion.php"); 
      $result_sql = "Select * From estudiantes,matriculas Where (matriculaparalelo='$paralelo')and(matriculaseccion='$seccion')and(matriculacodcurso='$curso')and(matriculacodespecializacion='$especializacion')and(matriculacodestudiante=codestudiante)  Order by estudiante";
     $result_pdo=$db->prepare($result_sql);
     $result_pdo->execute();
     $result=$result_pdo->fetchAll();
     $row = count($result);
     if ($row > 0){


    $i=0;
    set_time_limit(480);
    while ($row != $i){

          $codigo=$result[$i]["matriculanummatricula"];
          $certificados[$i]= new certificado_matricula($codigo,$quimestre);
        
          
          $i++;

     }
   
   }
   return $certificados;
}
function reporte_calificaciones_curso($curso,$especializacion,$seccion,$paralelo,$parcial,$quimestre)
   {
     require("conexion.php"); 
     $result_sql = "Select * From estudiantes,matriculas Where (matriculaparalelo='$paralelo')and(matriculaseccion='$seccion')and(matriculacodcurso='$curso')and(matriculacodespecializacion='$especializacion')and(matriculacodestudiante=codestudiante)  Order by estudiante";
     $result_pdo=$db->prepare($result_sql);
     $result_pdo->execute();
     $result=$result_pdo->fetchAll();
     $row = count($result);
     if ($row > 0){
       $i=0;set_time_limit(480);
       while ($row != $i){
          $codigo=$result[$i]["matriculanummatricula"];
          $certificados[$i]= new reporte_calificaciones($codigo,$parcial,$quimestre);
          $i++;}
     }return $certificados;
}
function cuadro_de_calificaciones_curso($curso,$especializacion,$seccion,$paralelo,$quimestre)
{
   $cuadrocalificacion= new cuadro_calificaciones($curso,$especializacion,$seccion,$paralelo,$quimestre);
 
   return $cuadrocalificacion; 
}

function cuadro_de_calificaciones_quimestrales_curso($curso,$especializacion,$seccion,$paralelo,$quimestre)
{
   $cuadrocalificacion= new cuadro_calificaciones_quimestrales($curso,$especializacion,$seccion,$paralelo,$quimestre);
 
   return $cuadrocalificacion; 
}

function cuadro_de_calificaciones_quimestre($curso,$especializacion,$seccion,$paralelo,$quimestre)
{
   $cuadrocalificacion= new cuadro_calificaciones_quimestre($curso,$especializacion,$seccion,$paralelo,$quimestre);
 
   return $cuadrocalificacion; 
}


function cuadro_de_calificaciones_comportamiento_curso($curso,$especializacion,$seccion,$paralelo,$quimestre)
{
   $cuadrocalificacion= new cuadro_calificaciones_comportamiento($curso,$especializacion,$seccion,$paralelo,$quimestre);
 
   return $cuadrocalificacion; 
}

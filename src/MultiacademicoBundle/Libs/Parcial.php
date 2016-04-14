<?php
namespace MultiacademicoBundle\Libs;

class Parcial
{
    /**
     *
     * @var integer
     */
    private $q; //quimestre
    /**
     *
     * @var integer
     */
    private $p; //parcial
    
    public function getQ() {
        return $this->q;
    }

    public function getP() {
        return $this->p;
    }

    public function setQ($q) {
        $this->q = $q;
        return $this;
    }

    public function setP($p) {
        $this->p = $p;
        return $this;
    }

    
    public function __construct($q=1,$p=1) {
        $this->q=$q;
        $this->p=$p;
    }        

    public function cod_parcial()
    {
      $parcial=$this->p;
        switch ($parcial) {
            case 1:
                 $cpar="P1";
                 break;
            case 2:
                 $cpar="P2";
                 break;
            case 3:
                 $cpar="P3";
                 break;
         }
      return $cpar;
    }
    public function text_parcial()
    {
        $parcial=$this->p;
      switch ($parcial) {
            case 1:
                 $cpar="1er Parcial";
                 break;
            case 2:
                 $cpar="2do Parcial";
                 break;
            case 3:
                 $cpar="3er Parcial";
                 break;
            case 4:
                 $cpar="Total Parciales";
                 break;
            case 5:
                 $cpar="Totales Quimestre";
                 break;
         }
      return $cpar;
    }
    public function textalt_parcial()
    {
        $parcial=$this->p;
     $cpar="";
        switch ($parcial) {
            case 1:
                 $cpar="Primer Parcial";
                 break;
            case 2:
                 $cpar="Segundo Parcial";
                 break;
            case 3:
                 $cpar="Tercer Parcial";
                 break;
             case 4:
                 $cpar="Total Parciales";
                 break;
            case 5:
                 $cpar="Totales Quimestre";
                 break;
         }
      return $cpar;
    }

    public function textnota_parcial($quimestre=1)
    {
        $parcial=$this->p;
      switch ($parcial) {
            case 1:
                 $cpar="Primera Nota Parcial";break;
            case 2:
                 $cpar="Segunda Nota Parcial";break;
            case 3:
                 $cpar="Tercera Nota Parcial";break;
             case 4:
                 $cpar="PROMEDIO PARCIALES";break;
            case 5:
                 $cpar="PROMEDIO PARCIALES";break;
         }
         if($quimestre==3)
                    {
                        $cpar="PROMEDIO QUIMESTRES";             
                    }    
      return $cpar;
    }
    public function cod_quimestre()
    {
        $quimestre=$this->q;
        switch ($quimestre) {
               case 1:
            $cquim="Q1";
            break;
                case 2:
            $cquim="Q2";
            break;
           }
           return $cquim;

     }
    public function text_quimestre()
    {
        $quimestre=$this->q;  
        switch ($quimestre) {
               case 1:
            $cquim="PRIMER QUIMESTRE";
            break;
                case 2:
            $cquim="SEGUNDO QUIMESTRE";
            break;
            case 3:
            $cquim="ANUAL";
            break;
           }
           return $cquim;

     }
    public function text_alt_quimestre()
    {
        $quimestre=$this->q;    
        switch ($quimestre) {
               case 1:
            $cquim="Primer Quimestre";
            break;
                case 2:
            $cquim="Segundo Quimestre";
            break;
            case 3:
            $cquim="Anual";
            break;
           }
           return $cquim;

    }
   /* public function consulta_estado_parcial($parcial,$quimestre)
     {
       $cpar=cod_parcial($parcial);
       If (consulta_estado_quimestre($quimestre) == "Activo")
       {
          // $result_px = mysql_query("Select * From permisos Where (permisoestado='Activo')and(permisocodigo='$cpar')");
          // $row_px = mysql_num_rows($result_px);
       If ($row_px == 1){
           $estado="Activo";
       }
       else {
           $estado="Inactivo";
       }
             }else{
           $estado="Inactivo";
       }
      return $estado;
     }
    public  function consulta_estado_quimestre($quimestre)
     {
       $cquim=cod_quimestre($quimestre);
       //$result_qx = mysql_query("Select * From permisos Where (permisoestado='Activo')and(permisocodigo='$cquim')");
      // $row_qx = mysql_num_rows($result_qx);
       If ($row_qx == 1)
       {
           $estado="Activo";
            }
         else
          {
           $estado="Inactivo";
        }
      return $estado;
     }
   public function quimestre_activo()
     {
       If (consulta_permiso_activo("Q1") == "Activo"){
           $qm=1;
       }else{
           $qm=2;
       }
       return $qm;
     }
     function parcial_activo()
      {

       If (consulta_permiso_activo("P1") == "Activo"){
           $pr=1;
       }

       If (consulta_permiso_activo("P2") == "Activo"){
           $pr=2;
       }
        If (consulta_permiso_activo("P3") == "Activo"){
           $pr=3;
       }
       return $pr;
       }
      function consulta_permiso_activo($tipo)
     {
       //require("conexion.php");
       //$result_p_sql = "Select * From permisos Where (permisoestado='Activo')and(permisocodigo='$tipo')";
       //$result_p_pdo=$db->prepare($result_p_sql);
       //$result_p_pdo->execute();
       //$result_p=$result_p_pdo->fetchAll();
       $row_p = count($result_p);
       If ($row_p == 1)
       {
           $estado="Activo";
            }
         else
          {
           $estado="Inactivo";
        }
      return $estado;
     }*/
    
}   

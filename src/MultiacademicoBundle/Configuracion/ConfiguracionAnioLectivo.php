<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;

/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 * @Serializer\ExclusionPolicy("all")
 */
class ConfiguracionAnioLectivo {

    /**
     *
     * @var integer
     * @Serializer\Type("string")
     */
    private $anio;
    
    /**
     *
     * @var boolean
     * @Serializer\Type("string")
     */
    private $estado;
    
    /**
     *
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaInicioAnio;
    /**
     *
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaFinAnio;
    
    /**
     *
     * var array
     * Serializer\Type("MultiacademicoBundle\Configuracion\ConfiguracionQuimestres")
     * Serializer\Type("array")
     * Serializer\Expose()
     * Serializer\Groups({"details"})
     
     */
    //private $configuracionQuimestres;
    
    
    /**
     *
     * @var string
     * Serializer\Type("MultiacademicoBundle\Configuracion\ConfiguracionQuimestre")
     * @Serializer\Type("array")
     * @Serializer\Expose()
     * @Serializer\Groups({"details"})
     */
    private $quimestre1;
    
    /**
     *
     * @var string
     * Serializer\Type("MultiacademicoBundle\Configuracion\ConfiguracionQuimestre")
     * @Serializer\Type("array")
     * @Serializer\Expose()
     * @Serializer\Groups({"details"})
     */
    private $quimestre2;
    
    public function __construct() {
        $this->configuracionQuimestres=new ConfiguracionQuimestres();
        $this->quimestre1= new ConfiguracionQuimestre();
        $this->quimestre2= new ConfiguracionQuimestre();
    
    }

    public function getQuimestre1() {
        return $this->quimestre1;
    }

    public function getQuimestre2() {
        return $this->quimestre2;
    }

    public function setQuimestre1($quimestre1) {
        $this->quimestre1 = $quimestre1;
        return $this;
    }

    public function setQuimestre2($quimestre2) {
        $this->quimestre2 = $quimestre2;
        return $this;
    }
    
    
    public function getAnio() {
        return $this->anio;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFechaInicioAnio() {
        return $this->fechaInicioAnio;
    }

    public function getFechaFinAnio() {
        return $this->fechaFinAnio;
    }

    public function setAnio($anio) {
        $this->anio = $anio;
        return $this;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    public function setFechaInicioAnio($fechaInicioAnio) {
        $this->fechaInicioAnio = $fechaInicioAnio;
        return $this;
    }

    public function setFechaFinAnio($fechaFinAnio) {
        $this->fechaFinAnio = $fechaFinAnio;
        return $this;
    }
    /**
     * 
     * @return ConfiguracionQuimestres
     * 
     */
    public function getConfiguracionQuimestres() {
        //var_dump($this->configuracionQuimestres);
        return $this->configuracionQuimestres;
    }

    public function setConfiguracionQuimestres($configuracionQuimestres) {
        $this->configuracionQuimestres = $configuracionQuimestres;
        return $this;
    }


}

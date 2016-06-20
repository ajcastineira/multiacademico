<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;

/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
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
     * @Serializer\Type("string")
     */
    private $fechaInicioAnio;
    /**
     *
     * @var \DateTime
     * @Serializer\Type("string")
     */
    private $fechaFinAnio;
    
    /**
     *
     * @var array
     * @Serializer\Type("array")
     */
    private $configuracionQuimestres=[];
    
    public function __construct() {
        $this->$configuracionQuimestres[]=new ConfiguracionQuimestre();
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

    public function setFechaInicioAnio($fecha_inicio_anio) {
        $this->fechaInicioAnio = $fecha_inicio_anio;
        return $this;
    }

    public function setFechaFinAnio($fecha_fin_anio) {
        $this->fechaFinAnio = $fecha_fin_anio;
        return $this;
    }
    public function getConfiguracionQuimestres() {
        return $this->configuracionQuimestres;
    }

    public function setConfiguracionQuimestres($configuracionQuimestres) {
        $this->configuracionQuimestres = $configuracionQuimestres;
        return $this;
    }


}

<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Serializer;

/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class ConfiguracionAnioLectivo {

    /**
     *
     * @var integer
     */
    private $anio;
    
    /**
     *
     * @var boolean
     */
    private $estado;
    
    /**
     *
     * @var \DateTime
     */
    private $fechaInicioAnio;
    /**
     *
     * @var \DateTime
     */
    private $fechaFinAnio;
    
    /**
     *
     * @var array
     */
    //private $configuracionQuimestres=[];
    
    public function __construct() {
        //$this->configuracionParciales[]=new ConfiguracionParcial();
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

}

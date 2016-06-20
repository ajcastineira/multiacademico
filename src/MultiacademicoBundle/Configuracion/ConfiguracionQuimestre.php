<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;
/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class ConfiguracionQuimestre {

    /**
     *
     * @var integer
     */
    private $q;
    
    /**
     *
     * @var boolean
     */
    private $estado;
    
    /**
     *
     * @var \DateTime
     */
    private $fecha_inicio_q;
    /**
     *
     * @var \DateTime
     */
    private $fecha_fin_q;
    
    /**
     *
     * @var array
     */
    private $configuracionParciales=[];
    
    public function __construct() {
        //$this->configuracionParciales[]=new ConfiguracionParcial();
    }
    public function getQ() {
        return $this->q;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFecha_inicio_q() {
        return $this->fecha_inicio_q;
    }

    public function getFecha_fin_q() {
        return $this->fecha_fin_q;
    }

    public function getConfiguracionParciales() {
        return $this->configuracionParciales;
    }

    public function setQ($q) {
        $this->q = $q;
        return $this;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    public function setFecha_inicio_q(\DateTime $fecha_inicio_q) {
        $this->fecha_inicio_q = $fecha_inicio_q;
        return $this;
    }

    public function setFecha_fin_q(\DateTime $fecha_fin_q) {
        $this->fecha_fin_q = $fecha_fin_q;
        return $this;
    }

    public function setConfiguracionParciales($configuracionParciales) {
        $this->configuracionParciales = $configuracionParciales;
        return $this;
    }


    
}

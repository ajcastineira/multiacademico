<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;

/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 * @Serializer\ExclusionPolicy("all")
 */
class ConfiguracionVencimiento {
    /**
     *
     * @var boolean
     * Serializer\Type("string")
     */
    private $estado;
    /**
     *
     * @var integer
     */
    private $time;
    
    public function getEstado() {
        return $this->estado;
    }

    public function getTime() {
        return $this->time;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    public function setTime($time) {
        $this->time = $time;
        return $this;
    }
}

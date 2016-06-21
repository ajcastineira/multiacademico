<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;
/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 * @Serializer\ExclusionPolicy("all")
 */
class ConfiguracionParciales {
    /**
     *
     * @var boolean
     */
    private $estado;
    /**
     *
     * @var integer
     */
    private $time;
    /**
     *
     * @var string
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"}) 
     */
    private $fechaInicioParcial1;
    /**
     *
     * @var string 
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaFinParcial1;
    /**
     *
     * @var string 
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaInicioParcial2;
    /**
     *
     * @var string 
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaFinParcial2;
    /**
     *
     * @var string 
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaInicioParcial3;
    /**
     *
     * @var string 
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @Serializer\Expose
     * @Serializer\Groups({"details"})
     */
    private $fechaFinParcial3;
    
    
    public function getEstado() {
        return $this->estado;
    }

    public function getTime() {
        return $this->time;
    }

    public function getFechaInicioParcial1() {
        return $this->fechaInicioParcial1;
    }

    public function getFechaFinParcial1() {
        return $this->fechaFinParcial1;
    }

    public function getFechaInicioParcial2() {
        return $this->fechaInicioParcial2;
    }

    public function getFechaFinParcial2() {
        return $this->fechaFinParcial2;
    }

    public function getFechaInicioParcial3() {
        return $this->fechaInicioParcial3;
    }

    public function getFechaFinParcial3() {
        return $this->fechaFinParcial3;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
        return $this;
    }

    public function setTime($time) {
        $this->time = $time;
        return $this;
    }

    public function setFechaInicioParcial1($fechaInicioParcial1) {
        $this->fechaInicioParcial1 = $fechaInicioParcial1;
        return $this;
    }

    public function setFechaFinParcial1($fechaFinParcial1) {
        $this->fechaFinParcial1 = $fechaFinParcial1;
        return $this;
    }

    public function setFechaInicioParcial2($fechaInicioParcial2) {
        $this->fechaInicioParcial2 = $fechaInicioParcial2;
        return $this;
    }

    public function setFechaFinParcial2($fechaFinParcial2) {
        $this->fechaFinParcial2 = $fechaFinParcial2;
        return $this;
    }

    public function setFechaInicioParcial3($fechaInicioParcial3) {
        $this->fechaInicioParcial3 = $fechaInicioParcial3;
        return $this;
    }

    public function setFechaFinParcial3($fechaFinParcial3) {
        $this->fechaFinParcial3 = $fechaFinParcial3;
        return $this;
    }


}

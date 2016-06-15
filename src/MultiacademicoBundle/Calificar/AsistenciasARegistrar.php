<?php
namespace MultiacademicoBundle\Calificar;
/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of AsistenciasARegistrar
 *
 * @author Rene Arias <renearias@arxis.la>
 */
use Doctrine\Common\Collections\ArrayCollection;
use MultiacademicoBundle\Libs\Parcial;
use MultiacademicoBundle\Entity\Asistencia;

class AsistenciasARegistrar {
    /**
     *
     * @var integer
     */
    private $aulaId;
    /**
     *
     * @var array
     */
    private $asistencias;
    /**
     *
     * @var Parcial
     */
    private $parcial;
    
    public function __construct($aulaId,Parcial $parcial) {
        
        $this->aulaId=$aulaId;
        $this->parcial=$parcial;
    }
    
    public function getAsistencias() {
        return $this->asistencias;
    }
    
    public function addAsistencias(Asistencia $asistencia) {
        $this->asistencias[]=$asistencia;
        return $this;
    }

    public function setAsistencias($asistencias) {
        $this->asistencias = $asistencias;
        return $this;
    }
    /**
     * 
     * @return integer
     */
    public function getAulaId() {
        return $this->aulaId;
    }
    /**
     * 
     * @param integer $aulaId
     * @return \MultiacademicoBundle\Calificar\AsistenciasARegistrar
     */
    public function setAulaId($aulaId) {
        $this->aulaId = $aulaId;
        return $this;
    }
    /**
     * 
     * @return Parcial
     */
    public function getParcial() {
        return $this->parcial;
    }
    /**
     * 
     * @param Parcial $parcial
     * @return \MultiacademicoBundle\Calificar\AsistenciasARegistrar
     */
    public function setParcial(Parcial $parcial) {
        $this->parcial = $parcial;
        return $this;
    }


}

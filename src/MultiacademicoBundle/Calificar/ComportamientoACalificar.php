<?php
namespace MultiacademicoBundle\Calificar;
/*
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of CursoACalificar
 *
 * @author Rene Arias <renearias@arxis.la>
 */
use Doctrine\Common\Collections\ArrayCollection;
use MultiacademicoBundle\Libs\Parcial;

class ComportamientoACalificar {
    /**
     *
     * @var integer
     */
    private $aulaId;
    /**
     *
     * @var array
     */
    private $calificaciones;
    /**
     *
     * @var Parcial
     */
    private $parcial;
    
    public function __construct($aulaId,Parcial $parcial) {
        
        $this->aulaId=$aulaId;
        $this->parcial=$parcial;
    }
    
    public function getCalificaciones() {
        return $this->calificaciones;
    }
    
    public function addCalificacione(\MultiacademicoBundle\Entity\Comportamiento $calificacion) {
        $this->calificaciones[]=$calificacion;
        return $this;
    }

    public function setCalificaciones($calificaciones) {
        $this->calificaciones = $calificaciones;
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
     * @return \MultiacademicoBundle\Calificar\CursoACalificar
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
     * @return \MultiacademicoBundle\Calificar\ProyectoACalificar
     */
    public function setParcial(Parcial $parcial) {
        $this->parcial = $parcial;
        return $this;
    }

}

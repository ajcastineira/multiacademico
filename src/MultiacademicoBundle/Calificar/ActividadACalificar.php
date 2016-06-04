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
use MultiacademicoBundle\Entity\ActividadAcademica;
use MultiacademicoBundle\Entity\ActividadAcademicaDetalle;

class ActividadACalificar {
    /**
     *
     * @var integer
     */
    private $actividadId;
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
    
    public function __construct($actividadId) {
        
        $this->actividadId=$actividadId;
    }
    
    public function getCalificaciones() {
        return $this->calificaciones;
    }
    
    public function addCalificacione(ActividadAcademicaDetalle $calificacion) {
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
    public function getActividadId() {
        return $this->actividadId;
    }
    /**
     * 
     * @param integer $actividadId
     * @return \MultiacademicoBundle\Calificar\CursoACalificar
     */
    public function setActividadId($actividadId) {
        $this->actividadId = $actividadId;
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

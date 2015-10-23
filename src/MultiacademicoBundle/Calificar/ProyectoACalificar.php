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

class ProyectoACalificar {
    /**
     *
     * @var integer
     */
    private $proyectoId;
    /**
     *
     * @var array
     */
    private $calificaciones;
    
    public function __construct($proyectoId) {
        
        $this->proyectoId=$proyectoId;
    }
    
    public function getCalificaciones() {
        return $this->calificaciones;
    }
    
    public function addCalificacione(\MultiacademicoBundle\Entity\Calificaciones $calificacion) {
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
    public function getProyectoId() {
        return $this->proyectoId;
    }
    /**
     * 
     * @param integer $proyectoId
     * @return \MultiacademicoBundle\Calificar\ProyectoACalificar
     */
    public function setProyectoId($proyectoId) {
        $this->proyectoId = $proyectoId;
        return $this;
    }


}

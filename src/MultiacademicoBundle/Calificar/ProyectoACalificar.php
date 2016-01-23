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
    /**
     *
     * @var Parcial
     */
    private $parcial;
    
    public function __construct($proyectoId,Parcial $parcial) {
        
        $this->proyectoId=$proyectoId;
        $this->parcial=$parcial;
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

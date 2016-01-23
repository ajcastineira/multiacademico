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

class CursoACalificar {
    /**
     *
     * @var integer
     */
    private $distributivoId;
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
    
    public function __construct($distributivoId,Parcial $parcial) {
        
        $this->distributivoId=$distributivoId;
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
    public function getDistributivoId() {
        return $this->distributivoId;
    }
    /**
     * 
     * @param integer $distributivoId
     * @return \MultiacademicoBundle\Calificar\CursoACalificar
     */
    public function setDistributivoId($distributivoId) {
        $this->distributivoId = $distributivoId;
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

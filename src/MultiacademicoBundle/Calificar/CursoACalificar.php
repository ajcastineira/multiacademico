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
    
    public function __construct($distributivoId) {
        
        $this->distributivoId=$distributivoId;
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


}

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
     * @var array;
     */
    private $calificaciones;
    
    public function __construct() {
        //$this->calificaciones= new ArrayCollection();
        //$this->calificaciones= [];
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


}

<?php

namespace MultiacademicoBundle\ActionData;

use Multiservices\NotifyBundle\ActionData\ActionDataInterface;

/**
 * Description of DocenteWtriteCalificacionYou
 *
 * @author Multiservices
 */
class DocenteSendTaskYou implements ActionDataInterface{
    
    /**
     *
     * @var string
     */
    private $actionid='docente_send_task_you';
    /**
     *
     * @var string
     */
    public $docente;
    /**
     *
     * @var string
     */
    public $materia;
    /**
     *
     * @var string
     */
    public $tipo;
    /**
     *
     * @var string
     */
    public $tema;
    
    public function getActionid() {
        return $this->actionid;
    }

    public function getDocente() {
        return $this->docente;
    }

    public function getMateria() {
        return $this->materia;
    }

    public function setActionid($actionid) {
        $this->actionid = $actionid;
        return $this;
    }

    public function setDocente($docente) {
        $this->docente = $docente;
        return $this;
    }

    public function setMateria($materia) {
        $this->materia = $materia;
        return $this;
    }
    public function getTipo() {
        return $this->tipo;
    }

    public function getTema() {
        return $this->tema;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setTema($tema) {
        $this->tema = $tema;
        return $this;
    }



}

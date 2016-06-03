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


}

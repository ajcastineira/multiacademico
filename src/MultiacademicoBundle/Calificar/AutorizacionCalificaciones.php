<?php

namespace MultiacademicoBundle\Calificar;

/**
 * Description of AutorizacionCalificaciones
 *
 * @author Rene Arias <renearias@arxis.la>
 */

class AutorizacionCalificaciones {
    
    /**
     *
     * @var integer
     */
    public $parcial;
    /**
     *
     * @var integer
     */
    public $quimestre;
    
    /**
     *
     * @var Datetime
     * Serializer\Type("DateTime<'Y-m-d'>")
     * Serializer\Expose
     * Serializer\Groups({"details"}) 
     */
    public $fechaInicio;
    /**
     *
     * @var Datetime
     * Serializer\Type("DateTime<'Y-m-d'>")
     * Serializer\Expose
     * Serializer\Groups({"details"})
     */
    public $fechaFin;

    
}

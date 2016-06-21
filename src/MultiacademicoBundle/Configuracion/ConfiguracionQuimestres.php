<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;
/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 * @Serializer\ExclusionPolicy("all")
 */
class ConfiguracionQuimestres {

    /**
     *
     * @var string
     * Serializer\Type("MultiacademicoBundle\Configuracion\ConfiguracionQuimestre")
     * @Serializer\Type("array")
     * @Serializer\Expose()
     * @Serializer\Groups({"details"})
     */
    private $quimestre1;
    
    /**
     *
     * @var string
     * Serializer\Type("MultiacademicoBundle\Configuracion\ConfiguracionQuimestre")
     * @Serializer\Type("array")
     * @Serializer\Expose()
     * @Serializer\Groups({"details"})
     */
    private $quimestre2;
    
    public function __construct() {
        $this->quimestre1= new ConfiguracionQuimestre();
        $this->quimestre2= new ConfiguracionQuimestre();
    }

    public function getQuimestre1() {
        return $this->quimestre1;
    }

    public function getQuimestre2() {
        return $this->quimestre2;
    }

    public function setQuimestre1($quimestre1) {
        $this->quimestre1 = $quimestre1;
        return $this;
    }

    public function setQuimestre2($quimestre2) {
        $this->quimestre2 = $quimestre2;
        return $this;
    }


}

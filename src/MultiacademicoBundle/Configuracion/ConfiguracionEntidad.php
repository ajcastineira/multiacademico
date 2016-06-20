<?php

namespace MultiacademicoBundle\Configuracion;

use JMS\Serializer\Annotation as Serializer;
use MultiacademicoBundle\Configuracion\ConfiguracionAnioLectivo;

/**
 * Description of ConfiguracionEntidad
 *
 * @author Rene Arias <renearias@arxis.la>
 */
class ConfiguracionEntidad {
    /**
     *
     * @var string
     * @Serializer\Type("string")
     */
    private $logoiz;
    /**
     *
     * @var string
     * @Serializer\Type("string")
     */
    private $logoder;
    /**
     *
     * @Serializer\Type("string")
     */
    private $logocenter;
    /**
     *
     * @var string
     * @Serializer\Type("string")
     */
    private $codamie;
    /**
     *
     * @var string
     * @Serializer\Type("array")
     */
    private $certpromo;
    /**
     *
     * @var string
     * @Serializer\Type("array")
     */
    private $vencimiento;
    
    /**
     *
     * @var string
     * @Serializer\Type("array")
     */
    private $configuracionAnioLectivo;
    
    

/*"certpromo":{"posfecha":"left",
		    "cualitativas":false,
		     "numeroenletras":true,
			"proyectosescolares":true,
			"fechapromo":"2016-03-03"
	           }*/
    
    public function getLogoiz() {
        return $this->logoiz;
    }

    public function getLogoder() {
        return $this->logoder;
    }

    public function getLogocenter() {
        return $this->logocenter;
    }

    public function getCodamie() {
        return $this->codamie;
    }

    public function getCertpromo() {
        return $this->certpromo;
    }

    public function getVencimiento() {
        return $this->vencimiento;
    }

    public function setLogoiz($logoiz) {
        $this->logoiz = $logoiz;
        return $this;
    }

    public function setLogoder($logoder) {
        $this->logoder = $logoder;
        return $this;
    }

    public function setLogocenter($logocenter) {
        $this->logocenter = $logocenter;
        return $this;
    }

    public function setCodamie($codamie) {
        $this->codamie = $codamie;
        return $this;
    }

    public function setCertpromo($certpromo) {
        $this->certpromo = $certpromo;
        return $this;
    }

    public function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;
        return $this;
    }
    public function getConfiguracionAnioLectivo() {
        return $this->configuracionAnioLectivo;
    }

    public function setConfiguracionAnioLectivo($configuracionAnioLectivo) {
        $this->configuracionAnioLectivo = $configuracionAnioLectivo;
        return $this;
    }

}

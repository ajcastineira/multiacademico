<?php

namespace MultiacademicoBundle\Twig\Extension;

use MultiacademicoBundle\Servicios\EntidadData;

class EntidadExtension extends \Twig_Extension
{
    /**
     * @var EntidadData
     */
    protected $entidadData;
 
    public function __construct(EntidadData $entidadData)
    {
        $this->entidadData = $entidadData;
    }
    
    
    public function getGlobals()
    {
        return array('entidad' => $this->entidadData->getEntidad());
    }
     /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'entidad_extension';
    }
}

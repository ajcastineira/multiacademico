<?php

namespace MultiacademicoBundle\Twig\Extension;

class EntidadExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    protected $em;
 
    public function __construct($em)
    {
        $this->em = $em;
    }
    
    /**
     * Get Entidad value
     *
     * @return \MultiacademicoBundle\Entity\Entidad
     */
    public function getEntidad()
    {
        $entidad = $this->em->getRepository('MultiacademicoBundle:Entidad')->find(1);
        if (!$entidad) {
            throw $this->createNotFoundException('La entidad o institucion no esta configurada.');
        }
        return $entidad;
    }
    public function getGlobals()
    {
        return array('entidad' => $this->getEntidad());
    }
     /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Entidad Extension';
    }
}

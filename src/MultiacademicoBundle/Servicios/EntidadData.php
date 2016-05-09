<?php

/*
 * Todos los derechos reservados
 */
namespace MultiacademicoBundle\Servicios;

use Doctrine\ORM\EntityManager;
use MultiacademicoBundle\Entity\Entidad;
/**
 * Description of EntidadData
 *
 * @author Rene Arias <renearas@arxis.la>
 */
class EntidadData extends Entidad {
    
    /**
     * @var EntityManager
     */
    protected $em;
 
    public function __construct(EntityManager $em)
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
}

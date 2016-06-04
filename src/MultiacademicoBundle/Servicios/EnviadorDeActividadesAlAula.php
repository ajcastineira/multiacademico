<?php

/*
 * Todos los derechos reservados
 */
namespace MultiacademicoBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use MultiacademicoBundle\Entity\Aula;
use MultiacademicoBundle\Entity\ActividadAcademica;
use MultiacademicoBundle\Entity\ActividadAcademicaDetalle;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;
/**
 * Description of NotificadorDeAula
 *
 * @author Rene Arias <renearas@arxis.la>
 */
class EnviadorDeActividadesAlAula {
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;
    
    
    /**
     * @var 
     */
    protected $container;
 
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

    }
    
    /**
     * Notificar a toda el Aula
     *
     * @return array
     */
    public function preEnviarActividadAula(Aula $aula, ActividadAcademica $actividadAcademica)
    {
        $estudiantes=$aula->getMatriculados();
        $actividades=[];
        foreach ($estudiantes as $estudiante)
        {
           $actividad=new ActividadAcademicaDetalle();
           $actividad->setMatricula($estudiante);
           $actividad->setActividad($actividadAcademica);
           
           $actividades[]=$actividad;
        }
        
        return $actividades;
    }
}

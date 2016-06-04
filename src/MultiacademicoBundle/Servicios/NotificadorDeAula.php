<?php

/*
 * Todos los derechos reservados
 */
namespace MultiacademicoBundle\Servicios;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use MultiacademicoBundle\Entity\Aula;
use Multiservices\NotifyBundle\Servicios\Notificador;

/**
 * Description of EntidadData
 *
 * @author Rene Arias <renearas@arxis.la>
 */
class NotificadorDeAula extends Entidad {
    
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
 
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container, EntityManager $em)
    {
        $this->em = $em;
        $this->container = $container;
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * Notificar a toda el Aula
     *
     * @return \MultiacademicoBundle\Entity\Entidad
     */
    public function notificarAula(Aula $aula, $action='', $titulo, $data=null)
    {
        $notificador=new Notificador($this->em);
        $estudiantes=$aula->getMatriculados();
        $usuarios=[];
        foreach ($estudiantes as $estudiante)
        {
            $usuarios[]=$estudiante->getMatriculacodestudiante()->getUsuario();
        }
        $notificador->notificarAVarios($accion, $titulo, $usuarios, $data);
    }
}

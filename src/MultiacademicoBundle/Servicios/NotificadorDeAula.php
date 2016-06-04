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
 * Description of NotificadorDeAula
 *
 * @author Rene Arias <renearas@arxis.la>
 */
class NotificadorDeAula {
    
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
     * @return array
     */
    public function preNotificarAula(Aula $aula, $accion='', $titulo, $data=null)
    {
        $notificador=new Notificador($this->em);
        $estudiantes=$aula->getMatriculados();
        $usuarios=[];
        foreach ($estudiantes as $estudiante)
        {
            $usuarios[]=$estudiante->getMatriculacodestudiante()->getUsuario();
        }
        $notificaciones= $notificador->preNotificarAVarios($accion, $titulo, $usuarios, $data);
        return $notificaciones;
    }
}

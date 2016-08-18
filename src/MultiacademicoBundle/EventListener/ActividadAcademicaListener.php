<?php

/*
 *Todos los derechos reservados
 */

namespace MultiacademicoBundle\EventListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use MultiacademicoBundle\Entity\ActividadAcademica;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of CalificacionesListener
 *
 * @author Rene Arias
 */
class ActividadAcademicaListener  {
    
   
    protected $container;
    protected $tokenStorage;
    private $actividadesPorEnviar = [];
    private $tareasPorNotificar = [];

    /**
     * @param TokenStorage $securityContext
     * @param Router $router The router
     */
    public function __construct(TokenStorage $tokenStorage, ContainerInterface $container)
    {
        $this->tokenStorage = $tokenStorage;
        $this->container=$container;
  
    }
    public function prePersist(ActividadAcademica $actividadAcademica, LifecycleEventArgs $args)
    {
            $user = $this->tokenStorage->getToken()->getUser();
            $docente=$this->container
                            ->get('doctrine')->getManager()
                            ->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($user);
            $actividadAcademica->setSendBy($docente);
            $actividadAcademica->setFechaEnvio(new \Datetime());
            $actividadAcademica->setEstado(EstadoActividadAcademicaType::ENVIADA);
            $actividadAcademica->preUpload();
            $this->preEnviarActvidadAEstudiantes($actividadAcademica);
            $this->preNotificar($actividadAcademica);
            
    }
    public function postPersist(ActividadAcademica $actividadAcademica, LifecycleEventArgs $args)
    {
        $actividadAcademica->upload();
    }
    public function preUpdate(ActividadAcademica $actividadAcademica, PreUpdateEventArgs $args)
    {
        $actividadAcademica->preUpload($actividadAcademica);    
        $this->preNotificar($actividadAcademica);
    }
    public function postUpdate(ActividadAcademica $actividadAcademica, LifecycleEventArgs $args)
    {
        $actividadAcademica->upload();
    }
    public function postRemove(ActividadAcademica $actividadAcademica, LifecycleEventArgs $args)
    {
        $actividadAcademica->removeUpload();
    }


   
    
    public function postFlush(PostFlushEventArgs $args)
    {
        if (!empty($this->actividadesPorEnviar)) {
            $em = $args->getEntityManager();
            foreach ($this->actividadesPorEnviar as $actividad) {
                $em->persist($actividad);
            }
            $this->actividadesPorEnviar=[];
            $em->flush();
       }
        if (!empty($this->tareasPorNotificar)) {
            $em = $args->getEntityManager();
            foreach ($this->tareasPorNotificar as $notificacion) {
                $em->persist($notificacion);
            }
            $this->tareasPorNotificar=[];
            $em->flush();
       }
        
    }
    private function preEnviarActvidadAEstudiantes($actividadAcademica)
    {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            
            $enviador=$this->container->get('enviadorDeActividadesAlAula');
            $aula=$actividadAcademica->getDistributivo()->getAula();
            
            $actividades=$enviador->preEnviarActividadAula($aula, $actividadAcademica);
            
            $this->actividadesPorEnviar = $actividades;
    }
    private function preNotificar($actividadAcademica)
    {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            
            $notificador=$this->container->get('notificadorDeAula');
            $aula=$actividadAcademica->getDistributivo()->getAula();
            $matriculados=$aula->getMatriculados();
            
            $actiondata=new \MultiacademicoBundle\ActionData\DocenteSendTaskYou();
            $actiondata->setDocente($user->getName());
            $actiondata->setMateria($actividadAcademica->getDistributivo()->getDistributivocodmateria()->getMateria());
            $actiondata->setTipo($actividadAcademica->getTipo());
            $actiondata->setTema($actividadAcademica->getTitulo());
                    
            $notificaciones=$notificador->preNotificarAula($aula, $actiondata->getActionid(), 'titulo', $actiondata);
            
            $this->tareasPorNotificar = $notificaciones;
    }
}

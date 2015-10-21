<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Clubes;
use MultiacademicoBundle\Form\CalificarProyectoEscolarType;
use MultiacademicoBundle\Calificar\ProyectoACalificar;
use MultiacademicoBundle\Libs\Parcial;

/**
 * Distributivos controller.
 *
 * @Route("/midistributivo/proyectos")
 */
class MiDistributivoClubesController extends Controller
{

    /**
     * Menu de proyecto escolar
     *
     * @Route("/{id}", name="menu_proyectos_escolares", options={"expose":true})
     * @Method("GET")
     */
    public function menuProyectosEscolaresAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/api", name="menu_proyectos_escolares_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menuproyectos.html.twig")
     */
    public function menuProyectosEscolaresApiAction($id)
    {
        //$em = $this->getDoctrine()->getManager();
        
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        //$docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        //$entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);

        return array(
            null
        );
    }
    
    /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/calificaciones/{q}/{p}", name="calificaciones_proyecto", options={"expose":true})
     * @Method("GET")
     */
    public function calificacionesProyectoAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/calificaciones/{q}/{p}/api", name="calificaciones_proyecto_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:calificarproyecto.html.twig")
     */
    public function calificacionesProyectoApiAction($id,$q,$p)
    {
        $em = $this->getDoctrine()->getManager();
        $proyectoescolar = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);
        if (!$proyectoescolar) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $proyectoACalificar=new ProyectoACalificar($id,$qactivo,$pactivo);
        $listado = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->findByCodclub($id);
        $proyectoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarProyectoForm($proyectoACalificar,$qactivo,$pactivo);
        //$proyecto=$distributivo->getCursoName();
        //$curso=$distributivo->getCursoName();
        //$materia=$distributivo->getDistributivocodmateria();
        return array(
            
            'proyectoescolar'=>$proyectoescolar,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Creates a form to create a Calificaciones entity.
     *
     * @param ProyectoACalificar $proyectoACalificar The curso a califcar
     * @param integer $q El quimestre
     * @param integer $p El parcial
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarProyectoForm(ProyectoACalificar $proyectoACalificar,$q,$p)
    {
        $form = $this->createForm(new CalificarProyectoEscolarType($q,$p), $proyectoACalificar, array(
          //  'action' => $this->generateUrl('pasar_calificaciones_api',array('id'=>$proyectoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', 'submit', array('label' => 'Guardar'));

        return $form;
    }
    /**
     * Edits an existing Calificaciones entity.
     *
     * @Route("/{id}/calificaciones/{q}/{p}/api", name="pasar_calificaciones_proyecto_api", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Calificaciones:calificarproyecto.html.twig")
     */
    public function pasarCalificacionesProyectoAction(Request $request,$id,$q,$p)
    {
        $em = $this->getDoctrine()->getManager();
        $proyectoescolar = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);
        if (!$proyectoescolar) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $proyectoACalificar=new ProyectoACalificar($id,$qactivo,$pactivo);
        $listado = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->findByCodclub($id);
        $proyectoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarProyectoForm($proyectoACalificar,$qactivo,$pactivo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_proyecto_api', array('id'=>$id,'q'=>$q,'p'=>$p)));
            
        }

        return array(
            
            'proyectoescolar'=>$proyectoescolar,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'form'   => $form->createView(),
        );
        
    }
        
    



    
}

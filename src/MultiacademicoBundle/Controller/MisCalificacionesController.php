<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * Distributivos controller.
 *
 * @Route("/miscalificaciones")
 *  @Rest\RouteResource("MisCalificaciones")
 * 
 */
class MisCalificacionesController extends Controller
{

    /**
     * Lists Routes Front.
     *
     * @Route("", name="miscalificaciones")
     * @Route("/{q}/{p}", requirements={"q":"\d+","p":"\d+"}, name="miscalificaciones_informe")
     * @Method("GET")
     * @Security("has_role('ROLE_ESTUDIANTE')")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    
    /**
     * @Route("/informe/api", name="miscalificaciones_informe_api", options={"expose":true})
     * @Method("GET")
     * @Security("has_role('ROLE_ESTUDIANTE')")
     */
    public function informeCalificacionesEstudianteAction()
    {
       $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('MultiacademicoBundle:Periodos')->find(1);
        if (!$periodo) {
            throw $this->createNotFoundException('El periodo no esta configurado.');
        }
        
        return $this->render('MultiacademicoBundle:Informes:informeCalificacionesEstudiante.html.twig',array(
            'periodo'=>$periodo));
    }

     /**
     * Lists aula.
     * @Rest\View(serializerGroups={"detail"})
     * @Security("has_role('ROLE_ESTUDIANTE')")
     */
    public function getAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();

        $estudiante=$em->getRepository('MultiacademicoBundle:Estudiantes')->findOneByUsuario($user);
        
        if (!$estudiante) {
            throw $this->createNotoundException('Unable to find Estudiante.');
        }

        $matricula=$estudiante->getMatriculaVigente();
        return array(
            'estudiante' => $matricula,
           
        );
    }
    
    
}

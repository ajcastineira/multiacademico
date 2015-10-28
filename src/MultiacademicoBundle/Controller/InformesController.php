<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Materias controller.
 *
 * @Route("")
 * @Security("has_role('ROLE_ADMIN')")
 */
class InformesController extends Controller
{

    /**
     * Lists all Materias entities.
     *
     * @Route("/informes", name="malla-normal")
     * @Route("/informes/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/{q}/{p}", name="informes-front")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    /**
     * Lists all Materias entities.
     *
     * @Route("/api/informeaprendizaje", name="informe-aprendizaje-api", options={"expose":true})
     * @Method("GET")
     * @Template()
     */
    public function informeAprendizajeAction()
    {
       $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('MultiacademicoBundle:Entidad')->find(1);
        if (!$entidad) {
            throw $this->createNotFoundException('La entidad o institucion no esta configurada.');
        }
        $periodo = $em->getRepository('MultiacademicoBundle:Periodos')->find(1);
        if (!$entidad) {
            throw $this->createNotFoundException('El periodo no esta configurado.');
        }
        $titulo="CUADRO DE CALIFICACIONES FINALES";
        return array(
            'entidad'=>$entidad,
            'titulo'=>$titulo,
            'periodo'=>$periodo,);
    }

}

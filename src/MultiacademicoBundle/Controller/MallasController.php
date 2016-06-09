<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Materias controller.
 *
 * 
 */
class MallasController extends Controller
{

    /**
     * Lists all Materias entities.
     *
     * @Route("/malla-normal", name="malla-normal")
     * @Route("/malla-normal/aula/{aula}/{q}/{p}", name="malla-normal-front")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    /**
     * Lists all Materias entities.
     *
     * @Route("/api/malla-normal", name="malla-normal-api", options={"expose":true})
     * @Method("GET")
     * @Template()
     */
    public function mallaNormalAction()
    {
       $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('MultiacademicoBundle:Periodos')->find(1);
        if (!$periodo) {
            throw $this->createNotFoundException('El periodo no esta configurado.');
        }
        $titulo="CUADRO DE CALIFICACIONES FINALES";
        return array(
            'titulo'=>$titulo,
            'periodo'=>$periodo,);
    }

}

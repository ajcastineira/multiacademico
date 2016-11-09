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
class JuntaDeAreaController extends Controller
{

    /**
     * Lists all Materias entities.
     *
     * @Route("/junta-de-area", name="junta-de-area")
     * @Route("/junta-de-area/{area}/{q}/{p}", name="junta-de-area-reunion")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    /**
     * Lists all Materias entities.
     *
     * @Route("/api/junta-de-area", name="junta-de-area-api", options={"expose":true})
     * @Method("GET")
     * @Template()
     */
    public function juntaDeAreaAction()
    {
       $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('MultiacademicoBundle:Periodos')->find(1);
        if (!$periodo) {
            throw $this->createNotFoundException('El periodo no esta configurado.');
        }
        $titulo="INFORMACIÓN DEL DESEMPEÑO ESTUDIANTIL PARA LA JUNTA DE ÁREA / ACADÉMICA";
        return array(
            'titulo'=>$titulo,
            'periodo'=>$periodo,);
    }
    

}

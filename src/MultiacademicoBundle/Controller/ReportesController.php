<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Distributivos;
use MultiacademicoBundle\Form\DistributivosType;
use MultiacademicoBundle\Form\CalificarCursoType;
use MultiacademicoBundle\Calificar\CursoACalificar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


/**
 * Reportes controller.
 *  @Rest\RouteResource("Reporte")
 */
class ReportesController extends FOSRestController
{


    /**
     * Lists all Distributivos entities.
     *
     
     * @Method("GET")
     * @Rest\View
     */
    public function reportesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        $entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);
        
        $misclubes= $em->getRepository('MultiacademicoBundle:Clubes')->misClubes($docente);

        return array(
            'entities' => $entities,
            'misclubes' => $misclubes,
        );
    }
    
   
    
}

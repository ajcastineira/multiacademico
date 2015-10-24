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
 *  @Rest\RouteResource("Aula")
 */
class AulasController extends FOSRestController
{


    /**
     * Lists all Distributivos entities.
     *
     * @Method("GET")
     * @Rest\View(serializerGroups={"list"})
     */
    public function cgetAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        $aulas=$em->getRepository('MultiacademicoBundle:Aula')->findAll();
       

        return array(
            'aulas' => $aulas,
           
        );
    }
    
    
    /**
     * Lists aula.
     * @Rest\Get("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}")
     * @Rest\View(serializerGroups={"detail"})
     */
    public function getAction(Request $request,$curso,$especializacion,$paralelo,$seccion,$periodo)
    {
        $em = $this->getDoctrine()->getManager();

        $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$curso,
                                                                          'especializacion'=>$especializacion,
                                                                          'paralelo'=>$paralelo,
                                                                          'seccion'=>$seccion,
                                                                          'periodo'=>$periodo
                                                                           )
                                                                    );
        if (!$aula) {
            throw $this->createNotFoundException('Unable to find Aula.');
        }
       

        return array(
            'aula' => $aula,
           
        );
    }
   
    
}

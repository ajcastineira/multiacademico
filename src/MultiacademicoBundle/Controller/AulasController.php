<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;


/**
 * Reportes controller.
 *  @Rest\RouteResource("Aula")
 * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_ADMIN')")
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
        
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
        $aulas=$em->getRepository('MultiacademicoBundle:Aula')->findAll();
        }else
        {
          $aulas=$em->getRepository('MultiacademicoBundle:Aula')->misAulasByUser($user);  
        }    

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

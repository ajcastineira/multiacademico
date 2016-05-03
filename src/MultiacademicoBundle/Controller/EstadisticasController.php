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
 *  @Rest\RouteResource("Estadistica")
 * 
 */
class EstadisticasController extends FOSRestController
{


    /**
     * Lists all Distributivos entities.
     *
     * @Method("GET")
     * @Rest\View(serializerGroups={"estadisticas"})
     */
    public function cgetAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $q=2;
        $p=1;
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        
        $mejoresparcial=$em->getRepository('MultiacademicoBundle:Calificaciones')->MejoresEstudiantesGeneralParcial($q,$p);
        $mejoresquimestre=$em->getRepository('MultiacademicoBundle:Calificaciones')->MejoresEstudiantesGeneralQuimestre($q);
        if ($this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA'))
        {
        //$aulas=$em->getRepository('MultiacademicoBundle:Aula')->findAll();
        }else
        {
          //$aulas=$em->getRepository('MultiacademicoBundle:Aula')->misAulasByUser($user);  
        }    

        return array(
            'mejoresparcial' => $mejoresparcial,
            'mejoresquimestre' => $mejoresquimestre,
           
        );
    }
    
    public function matriculadosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matriculados=$em->getRepository('MultiacademicoBundle:Aula')->matriculadosPorSexo();
        $view = $this->view($matriculados,200)
            ->setTemplate("MultiacademicoBundle:Reportes:matriculados.html.twig")
            ->setTemplateVar('matriculados')
            ;
        return $this->handleView($view);
    }
    
    
   
    
}

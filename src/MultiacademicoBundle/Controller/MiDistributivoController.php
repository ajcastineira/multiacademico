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

/**
 * Distributivos controller.
 *
 * @Route("/midistributivo")
 */
class MiDistributivoController extends Controller
{

    /**
     * Lists all Distributivos entities.
     *
     * @Route("", name="midistributivo")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Distributivos entities.
     *
     * @Route("/api", name="midistributivo_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:index.html.twig")
     */
    public function miDistributivoAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        $entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}", name="menu_calificar", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menu.html.twig")
     */
    public function menuCalificarAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/api", name="menu_calificar_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menu.html.twig")
     */
    public function menuCalificarApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        $entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);

        return array(
            'entities' => $entities,
        );
    }
    
    
}

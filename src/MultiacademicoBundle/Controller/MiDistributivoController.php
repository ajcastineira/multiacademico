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
     * @Route("/menu/{id}/calificaciones/{q}/{p}", name="calificaciones", options={"expose":true})
     * @Method("GET")
     */
    public function calificacionesAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/api", name="calificaciones_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     */
    public function calificacionesApiAction($id,$q,$p)
    {
        $em = $this->getDoctrine()->getManager();
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);
        if (!$distributivo) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $cursoACalificar=new CursoACalificar();
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        $c1=$listado[0]->getPromedioParcial($qactivo,1);
        $c2=$listado[0]->getPromedioParcial($qactivo,2);
        $c3=$listado[0]->getPromedioParcial($qactivo,3);
        $c=$listado[0]->getPromedioParciales($qactivo,$pactivo);
        var_dump($c1,$c2,$c3,$c);
        
        return array(
            'curso'=>$curso, 'materia'=>$materia,
            'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Creates a form to create a Calificaciones entity.
     *
     * @param CursoACalificar $cursoACalificar The curso a califcar
     * @param integer $q El quimestre
     * @param integer $p El parcial
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarForm(CursoACalificar $cursoACalificar,$q,$p)
    {
        $form = $this->createForm(new CalificarCursoType($q,$p), $cursoACalificar, array(
            //'action' => $this->generateUrl('calificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('guardar', 'submit', array('label' => 'Guardar'));

        return $form;
    }
    
    
}

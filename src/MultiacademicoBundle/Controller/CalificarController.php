<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Calificaciones;
use MultiacademicoBundle\Form\CalificarCursoType;
use MultiacademicoBundle\Calificar\CursoACalificar;

/**
 * Calificar controller.
 *
 * @Route("/calificar")
 */
class CalificarController extends Controller
{

    /**
     * Lists all Calificaciones entities.
     *
     * @Route("", name="calificar")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Calificaciones entities.
     *
     * @Route("/api", name="calificar_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     */
    public function calificarApiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cursoACalificar=new CursoACalificar();
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find(358);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        
        //var_dump($cursoACalificar);
        
        //$cursoACalificar->setEstudiantes();
        
        $form = $this->createCalificarForm($cursoACalificar);
        //$form->handleRequest($request);

        return array(
                'listado'=> $listado,
                'form'   => $form->createView(),
                //'entities' => $entities,
        );
    }
    /**
     * Creates a form to create a Calificaciones entity.
     *
     * @param CursoACalificar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarForm(CursoACalificar $cursoACalificar)
    {
        $form = $this->createForm(new CalificarCursoType(), $cursoACalificar, array(
            //'action' => $this->generateUrl('calificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }

}

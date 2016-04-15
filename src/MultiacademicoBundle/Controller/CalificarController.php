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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * Creates a form to create a Calificaciones entity.
     *
     * @param CursoACalificar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarForm(CursoACalificar $cursoACalificar)
    {
        $form = $this->createForm(CalificarCursoType::class, $cursoACalificar, array(
            //'action' => $this->generateUrl('calificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Guardar'));

        return $form;
    }
    
}

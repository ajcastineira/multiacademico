<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\ActividadAcademica;
use MultiacademicoBundle\Form\ActividadAcademicaType;
use MultiacademicoBundle\Form\CalificarActividadAcademicaType;
use MultiacademicoBundle\Calificar\ActividadACalificar;
use MultiacademicoBundle\Libs\Parcial;

use AppBundle\Lib\ResultsCorrector;

/**
 * ActividadAcademica controller.
 * @Route("actividadacademicas")
 * @Rest\RouteResource("Actividadacademica")
 */
class ActividadAcademicaController extends FOSRestController
{
    /**
     * Lists all ActividadAcademica entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$actividadAcademicas = $em->getRepository('MultiacademicoBundle:ActividadAcademica')->findAll();

        $actividadAcademicas_datatable = $this->get("multiacademicobundle_datatable.actividadAcademicas");
        $actividadAcademicas_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:ActividadAcademica:index.html.twig', array(
            //'actividadAcademicas' => $actividadAcademicas,
            'datatable'=>$actividadAcademicas_datatable
        ));
    }

    /**
     * Get results from ActividadAcademica entity.
     *
     */
    public function resultsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $datatable = $this->get('multiacademicobundle_datatable.actividadAcademicas');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);
        $query->buildQuery();
        $qb = $query->getQuery();
        $qb->addSelect('partial especializacion.{id,especializacion}')
             ->leftJoin('aula_curso.especializacion','especializacion');
        $qb->addSelect('partial distributivocodmateria.{id,materia}')
             ->leftJoin('distributivo_aula_curso.distributivocodmateria','distributivocodmateria');
        
        $valorBuscado="distributivo_aula_curso.distributivocodmateria";
        $valorNuevo="distributivocodmateria.materia";
        $valorBuscado2="aula_curso.especializacion";
        $valorNuevo2="especializacion.especializacion";
        $partesvalidasPre=[];
        $partesvalidas=[];
        $where=$qb->getDqlPart('where');
        if (isset($where)){
            $qb_where_parts = $where->getParts();
            foreach ($qb_where_parts as $qb_where_part)
             {
                $partesvalidas[]=ResultsCorrector::obtenerPartesValidas(ResultsCorrector::obtenerPartesValidas($qb_where_part, $valorBuscado, $valorNuevo),$valorBuscado2,$valorNuevo2);
             }
         }
        if (!empty($partesvalidas)){
            $qb->resetDQLPart('where');
            $clasew=get_class($where);
            $qb->add('where',new $clasew($partesvalidas));
          }
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($user);  
        $qb->andWhere('sendBy.id = :docente')->setParameter('docente',$docente);
        $query->setQuery($qb);
        return $query->getResponse(false);
    }

    /**
     * Creates a new ActividadAcademica entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/actividadacademicas/new", name="new_actividadAcademica") 
     */
    public function newAction(Request $request)
    {
        $actividadAcademica = new ActividadAcademica();
        $form = $this->createForm('MultiacademicoBundle\Form\ActividadAcademicaType', $actividadAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actividadAcademica);
            $em->flush();

            return $this->redirectToRoute('show_actividadacademica', array('actividadAcademica' => $actividadAcademica->getId()));
        }

        return $this->render('MultiacademicoBundle:ActividadAcademica:new.html.twig', array(
            'actividadAcademica' => $actividadAcademica,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ActividadAcademica entity.
     * @Rest\Post() 
     * @Rest\Get("/actividadacademicas/{actividadAcademica}/show", name="show_actividadAcademica")
     */
    public function showAction(Request $request, ActividadAcademica $actividadAcademica)
    {
        $deleteForm = $this->createDeleteForm($actividadAcademica);
        $listado=new ActividadACalificar($actividadAcademica->getId());
        $listado->setCalificaciones($actividadAcademica->getDetalle());
        $form = $this->createForm(CalificarActividadAcademicaType::class, $listado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('show_actividadacademica', array('actividadAcademica' => $actividadAcademica->getId()));
        }
        return $this->render('MultiacademicoBundle:ActividadAcademica:show.html.twig', array(
            'actividadAcademica' => $actividadAcademica,
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ActividadAcademica entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/actividadacademicas/{actividadAcademica}/edit", name="edit_actividadAcademica") 
     */
    public function editAction(Request $request, ActividadAcademica $actividadAcademica)
    {
        $deleteForm = $this->createDeleteForm($actividadAcademica);
        $editForm = $this->createForm('MultiacademicoBundle\Form\ActividadAcademicaType', $actividadAcademica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actividadAcademica);
            $em->flush();

            return $this->redirectToRoute('edit_actividadacademica', array('actividadAcademica' => $actividadAcademica->getId()));
        }

        return $this->render('MultiacademicoBundle:ActividadAcademica:edit.html.twig', array(
            'actividadAcademica' => $actividadAcademica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ActividadAcademica entity.
     *
     */
    public function deleteAction(Request $request, ActividadAcademica $actividadAcademica)
    {
        $form = $this->createDeleteForm($actividadAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actividadAcademica);
            $em->flush();
        }

        return $this->redirectToRoute('actividadacademica_index');
    }

    /**
     * Creates a form to delete a ActividadAcademica entity.
     *
     * @param ActividadAcademica $actividadAcademica The ActividadAcademica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ActividadAcademica $actividadAcademica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_actividadacademica', array('actividadAcademica' => $actividadAcademica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

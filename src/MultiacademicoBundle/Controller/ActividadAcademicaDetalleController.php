<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\ActividadAcademicaDetalle;
use MultiacademicoBundle\Form\ActividadAcademicaDetalleType;

/**
 * ActividadAcademicaDetalle controller.
 * @Route("misactividadesacademica")
* @Rest\RouteResource("Actividadacademicadetalle")
 */
class ActividadAcademicaDetalleController extends FOSRestController
{
    /**
     * Lists all ActividadAcademicaDetalle entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$actividadAcademicaDetalles = $em->getRepository('MultiacademicoBundle:ActividadAcademicaDetalle')->findAll();

        $actividadAcademicaDetalles_datatable = $this->get("multiacademicobundle_datatable.actividadAcademicaDetalles");
        $actividadAcademicaDetalles_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:ActividadAcademicaDetalle:index.html.twig', array(
            //'actividadAcademicaDetalles' => $actividadAcademicaDetalles,
            'datatable'=>$actividadAcademicaDetalles_datatable
        ));
    }

    /**
     * Get results from ActividadAcademicaDetalle entity.
     *
     */
    public function resultsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        $datatable = $this->get('multiacademicobundle_datatable.actividadAcademicaDetalles');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);
        
        $matricula=$em->getRepository('MultiacademicoBundle:Estudiantes')->findOneByUsuario($user)->getMatriculaVigente(); 
        
        $function = function($qb) use ($matricula)
        {
         $qb->andWhere('matricula.id = :matricula')->setParameter('matricula',$matricula);
        };
        
        $query->addWhereResult($function);
        return $query->getResponse();
    }

    /**
     * Creates a new ActividadAcademicaDetalle entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/actividadacademicadetalle/new", name="new_actividadAcademicaDetalle") 
     */
    public function newAction(Request $request)
    {
        $actividadAcademicaDetalle = new ActividadAcademicaDetalle();
        $form = $this->createForm('MultiacademicoBundle\Form\ActividadAcademicaDetalleType', $actividadAcademicaDetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actividadAcademicaDetalle);
            $em->flush();

            return $this->redirectToRoute('show_actividadacademicadetalle', array('actividadAcademicaDetalle' => $actividadAcademicaDetalle->getId()));
        }

        return $this->render('MultiacademicoBundle:ActividadAcademicaDetalle:new.html.twig', array(
            'actividadAcademicaDetalle' => $actividadAcademicaDetalle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ActividadAcademicaDetalle entity.
     *
     * @Rest\Get() 
     */
    public function showAction(ActividadAcademicaDetalle $actividadAcademicaDetalle)
    {
        $deleteForm = $this->createDeleteForm($actividadAcademicaDetalle);

        return $this->render('MultiacademicoBundle:ActividadAcademicaDetalle:show.html.twig', array(
            'actividadAcademicaDetalle' => $actividadAcademicaDetalle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ActividadAcademicaDetalle entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/actividadacademicadetalle/{actividadAcademicaDetalle}/edit", name="edit_actividadAcademicaDetalle") 
     */
    public function editAction(Request $request, ActividadAcademicaDetalle $actividadAcademicaDetalle)
    {
        $deleteForm = $this->createDeleteForm($actividadAcademicaDetalle);
        $editForm = $this->createForm('MultiacademicoBundle\Form\ActividadAcademicaDetalleType', $actividadAcademicaDetalle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actividadAcademicaDetalle);
            $em->flush();

            return $this->redirectToRoute('actividadacademicadetalle', array('page' => $actividadAcademicaDetalle->getId().'/edit'));
        }

        return $this->render('MultiacademicoBundle:ActividadAcademicaDetalle:edit.html.twig', array(
            'actividadAcademicaDetalle' => $actividadAcademicaDetalle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ActividadAcademicaDetalle entity.
     *
     */
    public function deleteAction(Request $request, ActividadAcademicaDetalle $actividadAcademicaDetalle)
    {
        $form = $this->createDeleteForm($actividadAcademicaDetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actividadAcademicaDetalle);
            $em->flush();
        }

        return $this->redirectToRoute('actividadacademicadetalle_index');
    }

    /**
     * Creates a form to delete a ActividadAcademicaDetalle entity.
     *
     * @param ActividadAcademicaDetalle $actividadAcademicaDetalle The ActividadAcademicaDetalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ActividadAcademicaDetalle $actividadAcademicaDetalle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_actividadAcademicaDetalle', array('actividadAcademicaDetalle' => $actividadAcademicaDetalle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\Asistencia;
use MultiacademicoBundle\Form\AsistenciaType;

/**
 * Asistencia controller.
* @Route("/asistencia")
* @Rest\RouteResource("Asistencia")
 */
class AsistenciaController extends FOSRestController
{
    /**
     * Lists all Asistencia entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$asistencias = $em->getRepository('MultiacademicoBundle:Asistencia')->findAll();

        $asistencias_datatable = $this->get("multiacademicobundle_datatable.asistencias");
        $asistencias_datatable->buildDatatable();

        return $this->render('asistencia/index.html.twig', array(
            //'asistencias' => $asistencias,
            'datatable'=>$asistencias_datatable
        ));
    }

    /**
     * Get results from Asistencia entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademicobundle_datatable.asistencias');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Asistencia entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/asistencia/new", name="new_asistencium") 
     */
    public function newAction(Request $request)
    {
        $asistencium = new Asistencia();
        $form = $this->createForm('MultiacademicoBundle\Form\AsistenciaType', $asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asistencium);
            $em->flush();

            return $this->redirectToRoute('show_asistencia', array('asistencium' => $asistencia->getId()));
        }

        return $this->render('asistencia/new.html.twig', array(
            'asistencium' => $asistencium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Asistencia entity.
     *
     * @Rest\Get() 
     */
    public function showAction(Asistencia $asistencium)
    {
        $deleteForm = $this->createDeleteForm($asistencium);

        return $this->render('asistencia/show.html.twig', array(
            'asistencium' => $asistencium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Asistencia entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/asistencia/{asistencium}/edit", name="edit_asistencium") 
     */
    public function editAction(Request $request, Asistencia $asistencium)
    {
        $deleteForm = $this->createDeleteForm($asistencium);
        $editForm = $this->createForm('MultiacademicoBundle\Form\AsistenciaType', $asistencium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asistencium);
            $em->flush();

            return $this->redirectToRoute('asistencia', array('page' => $asistencium->getId().'/edit'));
        }

        return $this->render('asistencia/edit.html.twig', array(
            'asistencium' => $asistencium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Asistencia entity.
     *
     */
    public function deleteAction(Request $request, Asistencia $asistencium)
    {
        $form = $this->createDeleteForm($asistencium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asistencium);
            $em->flush();
        }

        return $this->redirectToRoute('asistencia_index');
    }

    /**
     * Creates a form to delete a Asistencia entity.
     *
     * @param Asistencia $asistencium The Asistencia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asistencia $asistencium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_asistencium', array('asistencium' => $asistencium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

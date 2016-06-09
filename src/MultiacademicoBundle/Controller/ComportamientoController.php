<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\Comportamiento;
use MultiacademicoBundle\Form\ComportamientoType;

/**
 * Comportamiento controller.
 * @Route("/comportamiento")
* @Rest\RouteResource("Comportamiento")
 */
class ComportamientoController extends FOSRestController
{
    /**
     * Lists all Comportamiento entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$comportamientos = $em->getRepository('MultiacademicoBundle:Comportamiento')->findAll();

        $comportamientos_datatable = $this->get("multiacademicobundle_datatable.comportamientos");
        $comportamientos_datatable->buildDatatable();

        return $this->render('comportamiento/index.html.twig', array(
            //'comportamientos' => $comportamientos,
            'datatable'=>$comportamientos_datatable
        ));
    }

    /**
     * Get results from Comportamiento entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademicobundle_datatable.comportamientos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Comportamiento entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/comportamiento/new", name="new_comportamiento") 
     */
    public function newAction(Request $request)
    {
        $comportamiento = new Comportamiento();
        $form = $this->createForm('MultiacademicoBundle\Form\ComportamientoType', $comportamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comportamiento);
            $em->flush();

            return $this->redirectToRoute('show_comportamiento', array('comportamiento' => $comportamiento->getId()));
        }

        return $this->render('comportamiento/new.html.twig', array(
            'comportamiento' => $comportamiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comportamiento entity.
     *
     * @Rest\Get() 
     */
    public function showAction(Comportamiento $comportamiento)
    {
        $deleteForm = $this->createDeleteForm($comportamiento);

        return $this->render('comportamiento/show.html.twig', array(
            'comportamiento' => $comportamiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Comportamiento entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/comportamiento/{comportamiento}/edit", name="edit_comportamiento") 
     */
    public function editAction(Request $request, Comportamiento $comportamiento)
    {
        $deleteForm = $this->createDeleteForm($comportamiento);
        $editForm = $this->createForm('MultiacademicoBundle\Form\ComportamientoType', $comportamiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comportamiento);
            $em->flush();

            return $this->redirectToRoute('comportamiento', array('page' => $comportamiento->getId().'/edit'));
        }

        return $this->render('comportamiento/edit.html.twig', array(
            'comportamiento' => $comportamiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Comportamiento entity.
     *
     */
    public function deleteAction(Request $request, Comportamiento $comportamiento)
    {
        $form = $this->createDeleteForm($comportamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comportamiento);
            $em->flush();
        }

        return $this->redirectToRoute('comportamiento_index');
    }

    /**
     * Creates a form to delete a Comportamiento entity.
     *
     * @param Comportamiento $comportamiento The Comportamiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comportamiento $comportamiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_comportamiento', array('comportamiento' => $comportamiento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

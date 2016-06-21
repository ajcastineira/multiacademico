<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\Entidad;
use MultiacademicoBundle\Form\EntidadType;

/**
 * Entidad controller.
 * @Route("/entidad")
* @Rest\RouteResource("Entidad")
 */
class EntidadController extends FOSRestController
{
    /**
     * Lists all Entidad entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$entidads = $em->getRepository('MultiacademicoBundle:Entidad')->findAll();

       // $entidads_datatable = $this->get("multiacademicobundle_datatable.entidads");
       // $entidads_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:Entidad:index.html.twig', array(
            //'entidads' => $entidads,
            //'datatable'=>$entidads_datatable
        ));
     }

    /**
     * Get results from Entidad entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademicobundle_datatable.entidads');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Entidad entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/entidad/new", name="new_entidad") 
     */
    public function newAction(Request $request)
    {
        $entidad = new Entidad();
        $form = $this->createForm('MultiacademicoBundle\Form\EntidadType', $entidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();

            return $this->redirectToRoute('show_entidad', array('entidad' => $entidad->getId()));
        }

        return $this->render('MultiacademicoBundle:Entidad:new.html.twig', array(
            'entidad' => $entidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Entidad entity.
     *
     * @Rest\Get() 
     */
    public function showAction(Entidad $entidad)
    {
        $deleteForm = $this->createDeleteForm($entidad);

        return $this->render('MultiacademicoBundle:Entidad:show.html.twig', array(
            'entidad' => $entidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Entidad entity.
     *
     * @Rest\Post() 
     * @Rest\Get("entidads/{entidad}/edit", name="edit_entidad") 
     */
    public function editAction(Request $request, Entidad $entidad)
    {
        $deleteForm = $this->createDeleteForm($entidad);
        $editForm = $this->createForm('MultiacademicoBundle\Form\EntidadType', $entidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();

            return $this->redirectToRoute('edit_entidad', array('entidad' => $entidad->getId()));
        }

        return $this->render('MultiacademicoBundle:Entidad:edit.html.twig', array(
            'entidad' => $entidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Entidad entity.
     *
     */
    public function deleteAction(Request $request, Entidad $entidad)
    {
        $form = $this->createDeleteForm($entidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entidad);
            $em->flush();
        }

        return $this->redirectToRoute('entidad_index');
    }

    /**
     * Creates a form to delete a Entidad entity.
     *
     * @param Entidad $entidad The Entidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Entidad $entidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_entidad', array('entidad' => $entidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

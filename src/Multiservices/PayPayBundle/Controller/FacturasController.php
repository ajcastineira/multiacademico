<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Form\FacturasType;

/**
 * Facturas controller.
 *
* @Rest\RouteResource("Factura")
 */
class FacturasController extends FOSRestController
{
    /**
     * Lists all Facturas entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$facturas = $em->getRepository('PayPayBundle:Facturas')->findAll();

        $facturas_datatable = $this->get("paypaybundle_datatable.facturas");
        $facturas_datatable->buildDatatable();

        return $this->render('facturas/index.html.twig', array(
            //'facturas' => $facturas,
            'datatable'=>$facturas_datatable
        ));
    }

    /**
     * Get results from Facturas entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('paypaybundle_datatable.facturas');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Facturas entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/facturas/new", name="new_factura") 
     */
    public function newAction(Request $request)
    {
        $factura = new Facturas();
        $form = $this->createForm('Multiservices\PayPayBundle\Form\FacturasType', $factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($factura);
            $em->flush();

            return $this->redirectToRoute('facturas', array('page' => $facturas->getId()));
        }

        return $this->render('facturas/new.html.twig', array(
            'factura' => $factura,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Facturas entity.
     *
     * @Rest\Get() 
     */
    public function showAction(Facturas $factura)
    {
        $deleteForm = $this->createDeleteForm($factura);

        return $this->render('facturas/show.html.twig', array(
            'factura' => $factura,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Facturas entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/facturas/{factura}/edit", name="edit_factura") 
     */
    public function editAction(Request $request, Facturas $factura)
    {
        $deleteForm = $this->createDeleteForm($factura);
        $editForm = $this->createForm('Multiservices\PayPayBundle\Form\FacturasType', $factura);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($factura);
            $em->flush();

            return $this->redirectToRoute('facturas', array('page' => $factura->getId().'/edit'));
        }

        return $this->render('facturas/edit.html.twig', array(
            'factura' => $factura,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Facturas entity.
     *
     */
    public function deleteAction(Request $request, Facturas $factura)
    {
        $form = $this->createDeleteForm($factura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($factura);
            $em->flush();
        }

        return $this->redirectToRoute('facturas_index');
    }

    /**
     * Creates a form to delete a Facturas entity.
     *
     * @param Facturas $factura The Facturas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Facturas $factura)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_factura', array('factura' => $factura->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

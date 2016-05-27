<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\JsonResponse;

use Multiservices\PayPayBundle\Entity\Ingresos;
use Multiservices\PayPayBundle\Form\IngresosType;

/**
 * Ingresos controller.
 *
* @Rest\RouteResource("Ingreso")
 */
class IngresosController extends FOSRestController
{
    /**
     * Lists all Ingresos entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$ingresos = $em->getRepository('PayPayBundle:Ingresos')->findAll();

        $ingresos_datatable = $this->get("paypaybundle_datatable.ingresos");
        $ingresos_datatable->buildDatatable();

        return $this->render('PayPayBundle:Ingresos:index.html.twig', array(
            //'ingresos' => $ingresos,
            'datatable'=>$ingresos_datatable
        ));
    }

    /**
     * Get results from Ingresos entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('paypaybundle_datatable.ingresos');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);
        
        $function = function($qb)
        {
        // $qb->addSelect('partial estudiante.{id,estudiante}');
        //$qb->join ('ingresos.facturas','facturas');
         //$qb->join ('facturas.pension','facturas_pension');
        //$qb->innerJoin ('pension_estudiante.estudiante','estudiante');
        };

    $query->addWhereResult($function);

        return $query->getResponse();
    }

    /**
     * Creates a new Ingresos entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/ingresos/new", name="new_ingreso") 
     */
    public function newAction(Request $request)
    {
        $ingreso = new Ingresos();
        $form = $this->createForm('Multiservices\PayPayBundle\Form\IngresosType', $ingreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //$ingreso->registrarPagoEnFacturas();
            //$user = $this->getUser();
            //$ingreso->setCollectedby($user);
            
            $em->persist($ingreso);
            $em->flush();

            //return $this->redirectToRoute('ingresos', array('page' => $ingresos->getId()));
                $response_redir=new JsonResponse();
                $response_redir->setData(array('id'=>$ingreso->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
        }

        return $this->render('PayPayBundle:Ingresos:new.html.twig', array(
            'ingreso' => $ingreso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ingresos entity.
     *
     * @Rest\Get() 
     */
    public function showAction(Ingresos $ingreso)
    {
        $deleteForm = $this->createDeleteForm($ingreso);

        return $this->render('PayPayBundle:Ingresos:show.html.twig', array(
            'ingreso' => $ingreso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ingresos entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/ingresos/{ingreso}/edit", name="edit_ingreso") 
     */
    public function editAction(Request $request, Ingresos $ingreso)
    {
        $deleteForm = $this->createDeleteForm($ingreso);
        $montoAnterior=$ingreso->getMonto();
        $editForm = $this->createForm('Multiservices\PayPayBundle\Form\IngresosType', $ingreso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$ingreso->modificarPagoEnFacturas($montoAnterior);
            $em->persist($ingreso);
            $em->flush();

            return $this->redirectToRoute('edit_ingreso', array('ingreso' => $ingreso->getId()));
        }

        return $this->render('PayPayBundle:Ingresos:edit.html.twig', array(
            'ingreso' => $ingreso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ingresos entity.
     *
     */
    public function deleteAction(Request $request, Ingresos $ingreso)
    {
        $form = $this->createDeleteForm($ingreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$ingreso->revertirPagoEnFacturas();
            $em->remove($ingreso);
            $em->flush();
        }

        return $this->redirectToRoute('ingresos');
    }

    /**
     * Creates a form to delete a Ingresos entity.
     *
     * @param Ingresos $ingreso The Ingresos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ingresos $ingreso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_ingreso', array('ingreso' => $ingreso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Component\HttpFoundation\JsonResponse;
use MultiacademicoBundle\Entity\Representantes;
use MultiacademicoBundle\Form\RepresentantesType;

/**
 * Representantes controller.
 * @Route("/representantes")
* @Rest\RouteResource("Representante")
 * @Security("has_role('ROLE_SECRETARIA') or has_role('ROLE_COLECTORA')")
 */
class RepresentantesController extends FOSRestController
{
    /**
     * Lists all Representantes entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$representantes = $em->getRepository('MultiacademicoBundle:Representantes')->findAll();

        $representantes_datatable = $this->get("multiacademicobundle_datatable.representantes");
        $representantes_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:Representantes:index.html.twig', array(
            //'representantes' => $representantes,
            'datatable'=>$representantes_datatable
        ));
    }

    /**
     * Get results from Representantes entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademicobundle_datatable.representantes');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Representantes entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/representantes/new", name="new_representante") 
     */
    public function newAction(Request $request)
    {
        $representante = new Representantes();
        $form = $this->createForm('MultiacademicoBundle\Form\RepresentantesType', $representante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($representante);
            $em->flush();
            
                $response_redir=new JsonResponse();
                $response_redir->setData(array('id'=>$representante->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
            
            //return $this->redirectToRoute('representantes', array('page' => $representantes->getId()));
        }

        return $this->render('MultiacademicoBundle:Representantes:new.html.twig', array(
            'representante' => $representante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Representantes entity.
     *
     * @Rest\Get("/representantes/{representante}") 
     */
    public function getAction(Representantes $representante)
    {
        $deleteForm = $this->createDeleteForm($representante);

        return $this->render('MultiacademicoBundle:Representantes:show.html.twig', array(
            'representante' => $representante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Representantes entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/representantes/{representante}/edit", name="edit_representante") 
     */
    public function editAction(Request $request, Representantes $representante)
    {
        $deleteForm = $this->createDeleteForm($representante);
        $editForm = $this->createForm('MultiacademicoBundle\Form\RepresentantesType', $representante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($representante);
            $em->flush();

            return $this->redirectToRoute('edit_representante', array('representante' => $representante->getId()));
        }

        return $this->render('MultiacademicoBundle:Representantes:edit.html.twig', array(
            'representante' => $representante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Representantes entity.
     *
     */
    public function deleteAction(Request $request, Representantes $representante)
    {
        $form = $this->createDeleteForm($representante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($representante);
            $em->flush();
        }

        return $this->redirectToRoute('representantes');
    }

    /**
     * Creates a form to delete a Representantes entity.
     *
     * @param Representantes $representante The Representantes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Representantes $representante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_representante', array('representante' => $representante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

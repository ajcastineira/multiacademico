<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MultiacademicoBundle\Entity\Matriculas;
use MultiacademicoBundle\Form\MatriculasType;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Matriculas controller.
 *
 * @Route("/matriculas")
 * @Rest\RouteResource("Matricula")
 */
class MatriculasController extends Controller
{
    /**
     * Lists all Matriculas entities.
     *
     * @Route("/", name="matriculas_index")
     * @Rest\Get()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matriculas = $em->getRepository('MultiacademicoBundle:Matriculas')->findAll();

        return $this->render('MultiacademicoBundle:Matriculas:index.html.twig', array(
            'matriculas' => $matriculas,
        ));
    }

    /**
     * Creates a new Matriculas entity.
     *
     * @Route("/new", name="matriculas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $matricula = new Matriculas();
        $form = $this->createForm('MultiacademicoBundle\Form\MatriculasType', $matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matricula);
            $em->flush();

            return $this->redirectToRoute('matriculas_show', array('id' => $matriculas->getId()));
        }

        return $this->render('MultiacademicoBundle:Matriculas:new.html.twig', array(
            'matricula' => $matricula,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Matriculas entity.
     *
     * @Route("/{id}", name="matriculas_show")
     * @Method("GET")
     */
    public function showAction(Matriculas $matricula)
    {
        $deleteForm = $this->createDeleteForm($matricula);

        return $this->render('MultiacademicoBundle:Matriculas:show.html.twig', array(
            'matricula' => $matricula,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Matriculas entity.
     *
     * @Route("/{id}/edit", name="matriculas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Matriculas $matricula)
    {
        $deleteForm = $this->createDeleteForm($matricula);
        $editForm = $this->createForm('MultiacademicoBundle\Form\MatriculasType', $matricula);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matricula);
            $em->flush();

            return $this->redirectToRoute('matriculas_edit', array('id' => $matricula->getId()));
        }

        return $this->render('MultiacademicoBundle:Matriculas:edit.html.twig', array(
            'matricula' => $matricula,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Matriculas entity.
     *
     * @Route("/{id}", name="matriculas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Matriculas $matricula)
    {
        $form = $this->createDeleteForm($matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matricula);
            $em->flush();
        }

        return $this->redirectToRoute('matriculas_index');
    }

    /**
     * Creates a form to delete a Matriculas entity.
     *
     * @param Matriculas $matricula The Matriculas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Matriculas $matricula)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matriculas_delete', array('id' => $matricula->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MultiacademicoBundle\Entity\Cargos;
use MultiacademicoBundle\Form\CargosType;

/**
 * Cargos controller.
 *
 * @Route("/cargos")
 */
class CargosController extends Controller
{
    /**
     * Lists all Cargos entities.
     *
     * @Route("/", name="cargos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cargos = $em->getRepository('MultiacademicoBundle:Cargos')->findAll();

        return $this->render('cargos/index.html.twig', array(
            'cargos' => $cargos,
        ));
    }

    /**
     * Creates a new Cargos entity.
     *
     * @Route("/new", name="cargos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cargo = new Cargos();
        $form = $this->createForm('MultiacademicoBundle\Form\CargosType', $cargo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cargo);
            $em->flush();

            return $this->redirectToRoute('cargos_show', array('id' => $cargos->getId()));
        }

        return $this->render('cargos/new.html.twig', array(
            'cargo' => $cargo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cargos entity.
     *
     * @Route("/{id}", name="cargos_show")
     * @Method("GET")
     */
    public function showAction(Cargos $cargo)
    {
        $deleteForm = $this->createDeleteForm($cargo);

        return $this->render('cargos/show.html.twig', array(
            'cargo' => $cargo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cargos entity.
     *
     * @Route("/{id}/edit", name="cargos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cargos $cargo)
    {
        $deleteForm = $this->createDeleteForm($cargo);
        $editForm = $this->createForm('MultiacademicoBundle\Form\CargosType', $cargo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cargo);
            $em->flush();

            return $this->redirectToRoute('cargos_edit', array('id' => $cargo->getId()));
        }

        return $this->render('cargos/edit.html.twig', array(
            'cargo' => $cargo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cargos entity.
     *
     * @Route("/{id}", name="cargos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cargos $cargo)
    {
        $form = $this->createDeleteForm($cargo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cargo);
            $em->flush();
        }

        return $this->redirectToRoute('cargos_index');
    }

    /**
     * Creates a form to delete a Cargos entity.
     *
     * @param Cargos $cargo The Cargos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cargos $cargo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cargos_delete', array('id' => $cargo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

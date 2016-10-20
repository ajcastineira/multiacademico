<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use MultiacademicoBundle\Entity\AreaAcademica;
use MultiacademicoBundle\Form\AreaAcademicaType;

/**
 * AreaAcademica controller.
 * @Route("areaacademicas")
 * @Rest\RouteResource("Areaacademica")
 */
class AreaAcademicaController extends FOSRestController
{
    /**
     * Lists all AreaAcademica entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$areaAcademicas = $em->getRepository('MultiacademicoBundle:AreaAcademica')->findAll();

        $areaAcademicas_datatable = $this->get("multiacademicobundle_datatable.areaAcademicas");
        $areaAcademicas_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:AreaAcademica:index.html.twig', array(
            //'areaAcademicas' => $areaAcademicas,
            'datatable'=>$areaAcademicas_datatable
        ));
    }

    /**
     * Get results from AreaAcademica entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademicobundle_datatable.areaAcademicas');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new AreaAcademica entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/areaacademicas/new", name="new_areaAcademica") 
     */
    public function newAction(Request $request)
    {
        $areaAcademica = new AreaAcademica();
        $form = $this->createForm('MultiacademicoBundle\Form\AreaAcademicaType', $areaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($areaAcademica);
            $em->flush();

            //return $this->redirectToRoute('show_areaacademica', array('areaAcademica' => $areaacademica->getId()));
            $response_redir=new JsonResponse();
             $response_redir->setData(array('id'=>$areaAcademica->getId()));
             $response_redir->setStatusCode(201);
             return $response_redir;
        }

        return $this->render('MultiacademicoBundle:AreaAcademica:new.html.twig', array(
            'areaAcademica' => $areaAcademica,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AreaAcademica entity.
     *
     * @Rest\Get() 
     */
    public function showAction(AreaAcademica $areaAcademica)
    {
        $deleteForm = $this->createDeleteForm($areaAcademica);

        return $this->render('MultiacademicoBundle:AreaAcademica:show.html.twig', array(
            'areaAcademica' => $areaAcademica,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AreaAcademica entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/areaacademicas/{areaAcademica}/edit", name="edit_areaAcademica") 
     */
    public function editAction(Request $request, AreaAcademica $areaAcademica)
    {
        $deleteForm = $this->createDeleteForm($areaAcademica);
        $editForm = $this->createForm('MultiacademicoBundle\Form\AreaAcademicaType', $areaAcademica);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($areaAcademica);
            $em->flush();

            return $this->redirectToRoute('show_areaacademica', array('areaAcademica' => $areaAcademica->getId()));
        }

        return $this->render('MultiacademicoBundle:AreaAcademica:edit.html.twig', array(
            'areaAcademica' => $areaAcademica,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AreaAcademica entity.
     *
     */
    public function deleteAction(Request $request, AreaAcademica $areaAcademica)
    {
        $form = $this->createDeleteForm($areaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($areaAcademica);
            $em->flush();
        }

        return $this->redirectToRoute('areaacademica');
    }

    /**
     * Creates a form to delete a AreaAcademica entity.
     *
     * @param AreaAcademica $areaAcademica The AreaAcademica entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AreaAcademica $areaAcademica)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_areaacademica', array('areaAcademica' => $areaAcademica->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

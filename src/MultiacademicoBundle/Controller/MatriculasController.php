<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
class MatriculasController extends FOSRestController
{
    /**
     * Lists all Matriculas entities.
     *
     * 
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
 
     * @Rest\Post() 
     * @Rest\Get("/matriculas/new", name="new_matricula") 
     */
    public function newAction(Request $request)
    {
        $matricula = new Matriculas();
       $form = $this->createForm('MultiacademicoBundle\Form\MatriculasType', $matricula);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$matricula->getMatriculacodcurso()->getId(),
                                                                          'especializacion'=>$matricula->getMatriculacodespecializacion()->getId(),
                                                                          'paralelo'=>$matricula->getMatriculaparalelo(),
                                                                          'seccion'=>$matricula->getMatriculaseccion(),
                                                                          'periodo'=>$matricula->getMatriculacodperiodo()->getId()
                                                                           )
                                                                    );
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $matricula->setMatriculausuario($user);
            $matricula->setAula($aula);
            $em->persist($matricula);
            $em->flush();

            return $this->redirectToRoute('get_matricula', array('matricula' => $matricula->getId()));
        }

        return $this->render('MultiacademicoBundle:Matriculas:new.html.twig', array(
            'matricula' => $matricula,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Matriculas entity.
     *
     */
    public function getAction(Matriculas $matricula)
    {
        $deleteForm = $this->createDeleteForm($matricula);

        return $this->render('MultiacademicoBundle:Matriculas:show.html.twig', array(
            'matricula' => $matricula,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Matriculas entity.
     * @Rest\Post() 
     * @Rest\Get("/matriculas/{matricula}/edit", name="edit_matricula") 
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

            return $this->redirectToRoute('edit_matricula', array('matricula' => $matricula->getId()));
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

        return $this->redirectToRoute('matriculas');
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
            ->setAction($this->generateUrl('delete_matricula', array('matricula' => $matricula->getId() )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

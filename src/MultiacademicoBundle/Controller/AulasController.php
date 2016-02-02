<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use MultiacademicoBundle\Entity\Aula;

/**
 * Reportes controller.
 *  @Rest\RouteResource("Aula")
 * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_ADMIN')")
 */
class AulasController extends FOSRestController
{


    /**
     * Lists all Distributivos entities.
     *
     * @Method("GET")
     * @Rest\View(serializerGroups={"list"})
     */
    public function cgetAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            $aulas=$em->getRepository('MultiacademicoBundle:Aula')->findAll();
        }else
        {
          $aulas=$em->getRepository('MultiacademicoBundle:Aula')->misAulasByUser($user);  
        }    

        return array(
            'aulas' => $aulas,
           
        );
    }
    
    
    /**
     * Lists aula.
     * @Rest\Get("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}")
     * @Rest\View(serializerGroups={"detail"})
     */
    public function getAction(Request $request,$curso,$especializacion,$paralelo,$seccion,$periodo)
    {
        $em = $this->getDoctrine()->getManager();

        $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$curso,
                                                                          'especializacion'=>$especializacion,
                                                                          'paralelo'=>$paralelo,
                                                                          'seccion'=>$seccion,
                                                                          'periodo'=>$periodo
                                                                           )
                                                                    );
        if (!$aula) {
            throw $this->createNotFoundException('Unable to find Aula.');
        }
       

        return array(
            'aula' => $aula,
           
        );
    }
    
    
     /**
     * Creates a new Aula entity.
     *
     * @Rest\Post()
     * @Rest\Get("/aulas/new",name="new_aula")
     *
     */
    public function newAction(Request $request)
    {
        $aula = new Aula();
        $aula->setEstado("Activo");
        $form = $this->createForm('MultiacademicoBundle\Form\AulasType', $aula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($aula);
            $em->flush();

            return $this->redirectToRoute('get_aula', array('curso' => $aula->getCurso()->getId(),
                                                            'especializacion' => $aula->getEspecializacion()->getId(),
                                                            'paralelo' => $aula->getParalelo(),
                                                            'seccion' => $aula->getSeccion(),
                                                            'periodo' => $aula->getPeriodo()->getId(),
                                                            '_format'=>'html'
                                                            ));
        }

        return $this->render('MultiacademicoBundle:Aulas:new.html.twig', array(
            'aula' => $aula,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Aula entity.
     * @Rest\Post("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/edit") 
     * @Rest\Get("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/edit", name="edit_aula") 
     */
    public function editAction(Request $request, Aula $aula)
    {
        //$deleteForm = $this->createDeleteForm($aula);
        $editForm = $this->createForm('MultiacademicoBundle\Form\AulasType', $aula);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aula);
            $em->flush();

            //return $this->redirectToRoute('cargos_edit', array('id' => $cargo->getId()));
             return $this->redirectToRoute('get_aula', array('curso' => $aula->getCurso()->getId(),
                                                            'especializacion' => $aula->getEspecializacion()->getId(),
                                                            'paralelo' => $aula->getParalelo(),
                                                            'seccion' => $aula->getSeccion(),
                                                            'periodo' => $aula->getPeriodo()->getId(),
                                                            '_format'=>'html'
                                                            ));
        }

        return $this->render('MultiacademicoBundle:Aulas:edit.html.twig', array(
            'aula' => $aula,
            'edit_form' => $editForm->createView(),
          //  'delete_form' => $deleteForm->createView(),
        ));
    }
   
    /**
     * Creates a form to delete a Aula entity.
     *
     * param Cargos $cargo The Cargos entity
     *
     * return \Symfony\Component\Form\Form The form
     */
    /*private function createDeleteForm(Aula $aula)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aula_delete', array('id' => $aula->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }*/
}

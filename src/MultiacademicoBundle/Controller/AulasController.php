<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use MultiacademicoBundle\Entity\Aula;
use JMS\Serializer\SerializationContext;

/**
 * Reportes controller.
 * @Route("/aulas")
 *  @Rest\RouteResource("Aula")
 * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_ADMIN')")
 */
class AulasController extends FOSRestController
{


    /**
     * Lists all Distributivos entities.
     *
     * @Method("GET")
     * Rest\View(serializerGroups={"list"})
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
        
        $aulasDatatable = $this->get("multiacademico.aulas");
        $aulasDatatable->buildDatatable();
        
         $context=new SerializationContext();
         $context->setGroups("list");
         $templateData= array(
            'aulas' => $aulas,
            'datatable' => $aulasDatatable,
           
        );
         $view = $this->view($aulas, 200)
            ->setTemplate("MultiacademicoBundle:Aulas:cgetAll.html.twig")
            ->setTemplateVar('aulas')
            ->setTemplateData($templateData)
            ->setSerializationContext($context);
         
                 
        return $this->handleView($view);
        //return $templateData;
    }
    
    /**
     * Get results estudiante entities.
     *
     * @Route("/results", name="aula_results")
     *
     * @return Response
     */
    
    public function aulaResultsAction()
    {
        /**
         * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
         */
        $datatable = $this->get('multiacademico.aulas');
         $datatable->buildDatatable();
         $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }
    
    /**
     * Lists aula.
     * @Rest\Get("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}")
     * @ParamConverter("aula", class="MultiacademicoBundle:Aula", options={
     *    "repository_method" = "findByDatos",
     *    "mapping": {"curso": "curso","especializacion":"especializacion","paralelo":"paralelo", "seccion": "seccion","periodo": "periodo"},
     *    "map_method_signature" = true
     * })
     * Rest\View(serializerGroups={"detail"})
     */
    public function getAction(Request $request,Aula $aula)
    {
        
        if (!$aula) {
            throw $this->createNotFoundException('Unable to find Aula.');
        }
       $deleteForm = $this->createDeleteForm($aula);
       $context=new SerializationContext();
        $context->setGroups("detail");
         $templateData= array(
            'aula' => $aula,
            'delete_form' => $deleteForm->createView(),
           
        );
         $view = $this->view($aula, 200)
            ->setTemplate("MultiacademicoBundle:Aulas:get.html.twig")
            ->setTemplateVar('aula')
            ->setTemplateData($templateData)
            ->setSerializationContext($context);
         
                 
        return $this->handleView($view);
        
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
     * @ParamConverter("aula", class="MultiacademicoBundle:Aula", options={
     *    "repository_method" = "findByDatos",
     *    "mapping": {"curso": "curso","especializacion":"especializacion","paralelo":"paralelo", "seccion": "seccion","periodo": "periodo"},
     *    "map_method_signature" = true
     * })
     */
    public function editAction(Request $request, Aula $aula)
    {
        $deleteForm = $this->createDeleteForm($aula);
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
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Aula entity.
     *
     * @Rest\Delete("/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}")
     * @ParamConverter("aula", class="MultiacademicoBundle:Aula", options={
     *    "repository_method" = "findByDatos",
     *    "mapping": {"curso": "curso","especializacion":"especializacion","paralelo":"paralelo", "seccion": "seccion","periodo": "periodo"},
     *    "map_method_signature" = true
     * })
     */
    public function deleteAction(Request $request, Aula $aula)
    {
        $form = $this->createDeleteForm($aula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aula);
            $em->flush();
        }

        return $this->redirectToRoute('aulas');
    }
   
    /**
     * Creates a form to delete a Aula entity.
     *
     * param Cargos $cargo The Cargos entity
     *
     * return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aula $aula)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_aula', array(
                                                                   'curso' => $aula->getCurso()->getId(),
                                                            'especializacion' => $aula->getEspecializacion()->getId(),
                                                            'paralelo' => $aula->getParalelo(),
                                                            'seccion' => $aula->getSeccion(),
                                                            'periodo' => $aula->getPeriodo()->getId(),
                                                             '_format','html'
                                                                )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

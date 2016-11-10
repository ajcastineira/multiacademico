<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;

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
     * List all AreaAcademica
     * @param Request $request
     * @return type
     */
    public function cgetAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA')||$this->get('security.authorization_checker')->isGranted('ROLE_INSPECTOR'))
        {
          $areas=$em->getRepository('MultiacademicoBundle:AreaAcademica')->findAll();
        }else
        {
           $areas=$em->getRepository('MultiacademicoBundle:AreaAcademica')->findAll();
           //$areas=$em->getRepository('MultiacademicoBundle:AreaAcademica')->misAreasByUser($user);  
        }
        
        $areaAcademicas_datatable = $this->get("multiacademicobundle_datatable.areaAcademicas");
        $areaAcademicas_datatable->buildDatatable();
        
         $context=new SerializationContext();
         $context->setGroups("list");
         $templateData= array(
            'areas' => $areas,
            'datatable'=>$areaAcademicas_datatable
           
        );
         $view = $this->view($areas, 200)
            ->setTemplate("MultiacademicoBundle:AreaAcademica:index.html.twig")
            ->setTemplateVar('areas')
            ->setTemplateData($templateData)
            ->setSerializationContext($context);
         
                 
        return $this->handleView($view);
        //return $templateData;
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
    public function getAction(AreaAcademica $areaAcademica)
    {
       $deleteForm = $this->createDeleteForm($areaAcademica);
       $context=new SerializationContext();
        $context->setGroups("detail");
         $templateData= array(
            'areaAcademica' => $areaAcademica,
            'delete_form' => $deleteForm->createView(),
           
        );
         $view = $this->view($areaAcademica, 200)
            ->setTemplate('MultiacademicoBundle:AreaAcademica:show.html.twig')
            ->setTemplateVar('aula')
            ->setTemplateData($templateData)
            ->setSerializationContext($context);
         
                 
        return $this->handleView($view);
        


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
    
    /**
     * Finds and displays a AreaAcademica entity.
     * @Rest\Patch() 
     * @Rest\Get("/areaacademicas/{areaAcademica}/junta/{quimestre}/{parcial}", name="junta_areaacademica") 
     */
    public function juntaAction(AreaAcademica $areaAcademica,$quimestre,$parcial)
    {
               
        $em = $this->getDoctrine()->getManager();
        $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(22);
        $materia=$em->getRepository('MultiacademicoBundle:Materias')->find(25);
        $juntaDeArea=$em->getRepository('MultiacademicoBundle:Calificaciones')
                ->promediosParcialesDeJuntaDeArea($areaAcademica,$quimestre,$parcial);
        //var_dump($juntaDeArea);
       $context=new SerializationContext();
        $context->setGroups("informejunta");
         $templateData= array(
            'juntaDeArea' => $juntaDeArea
        );
         $view = $this->view($juntaDeArea, 200)
            ->setTemplate('::basesimple.html.twig')
            ->setTemplateVar('junta')
            ->setTemplateData($templateData)
            ->setSerializationContext($context);
         
                 
        return $this->handleView($view);
        


    }
}

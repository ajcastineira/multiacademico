<?php

namespace Multiservices\ArxisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\ArxisBundle\Entity\Pagos;
use Multiservices\ArxisBundle\Form\PagosType;
use Multiservices\ArxisBundle\Form\PagosChangeAvatarType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Pagos controller.
 *
 * @Route("/arxis/pagos")
 */
class PagosController extends Controller
{


 /**
     * Lists all Pagos entities.
     *
     * @Route("", name="secured_pagos")
     * @Method("GET")
     */
   public function PagosAction() {
    $js = '<script  type="text/javascript">'.
     'function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute("href", "data:text/plain;charset=utf-8," + encodeURIComponent(text));
  element.setAttribute("download", filename);

  element.style.display = "none";
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}'.
     '</script>';

    return $this->render(
        'PayPayBundle:Default:GuiLogin.html.twig',
        array(
            'js' => $js
        )
    );

    //para llamar desde consola "download('test.txt', 'Hello world!');"
    // poner en twig {% if (js is defined) %}{{ js|raw }}{% endif %}
}


    /**
     * Lists all Pagos entities.
     *
     * @Route("", name="secured_pagos")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Pagos entities.
     *
     * @Route("/api", name="secured_Pagos_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Pagos:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiservicesArxisBundle:Pagos')->findAll();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pagos entity.
     *
     * @Route("/", name="secured_pagos_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiservicesArxisBundle:Pagos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pagos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->setSecurePassword($entity);
            $this->setRoleDefault($entity);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('pagos_show', array('id' => $entity->getId())));
                $response_redir=new JsonResponse();
                $response_redir->setData(array('id'=>$entity->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pagos entity.
     *
     * @param Pagos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pagos $entity)
    {
        $form = $this->createForm(PagosType::class, $entity, array(
            'action' => $this->generateUrl('secured_pagos_create'),
            'method' => 'POST',
        ));
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
         {    
             $form->add('pagos_roles');
         } 
        
        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Pagos entity.
     *
     * @Route("/new", name="secured_pagos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Pagos entity.
     *
     * @Route("/api/new", name="secured_pagos_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Pagos:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Pagos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pagos entity.
     *
     * @Route("/{id}", name="secured_pagos_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }
    
    

    /**
     * Finds and displays a Pagos entity.
     *
     * @Route("/api/{id}", name="secured_pagos_api_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Pagos:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Pagos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pagos entity.');
        }
        $avatarform = $this->createForm(PagosChangeAvatarType::class,$entity, array(
            //'action' => $this->generateUrl('secured_pagos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'usuario'      => $entity,
            'changeavatarform' => $avatarform->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Finds and displays a Pagos entity.
     *
     * @Route("/api/me", name="secured_pagos_api_showme", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Pagos:me.html.twig")
     */
    public function showMeApiAction()
    {
        
        $me=$this->get('security.token_storage')->getToken()->getUser();
        
        $usuario = $me;
        $form = $this->createForm(PagosChangeAvatarType::class,$me, array(
            //'action' => $this->generateUrl('secured_pagos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
       

        return array(
            'usuario'      => $usuario,
            'changeavatarform' => $form->createView()
        );
    }
    
    /** Edits an existing Pagos avatat entity.
     *
     * @Route("api/me/updateavatar", name="secured_pagos_api_me_update_avatar", options={"expose":true})
     * @Method("PUT")
     * 
     */
    public function updateAvatarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $me=$this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(PagosChangeAvatarType::class,$me, array(
            //'action' => $this->generateUrl('secured_pagos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $em->persist($me);
            $em->flush();

            $response=new JsonResponse();
             $response->setData(array('path'=>$me->getWebPath()));
             $response->setStatusCode(202);
             //return $this->redirect($this->generateUrl('secured_pagos_api_showme'));
            return $response;
        }
        $errores=$form->getErrors(true);
        $response= new JsonResponse();
        $erroresarray=[];
        foreach ($errores as $error)
        {
            $erroresarray[]=$error->getMessage();
        }
        
        $response->setData(array('errores' => $erroresarray));
        $response->setStatusCode(400);
        
        return $response;
       
    }

    /**
     * Displays a form to edit an existing Pagos entity.
     *
     * @Route("/{id}/edit", name="secured_pagos_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Pagos entity.
    *
    * @param Pagos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pagos $entity)
    {
        $form = $this->createForm(PagosType::class, $entity, array(
            //'action' => $this->generateUrl('secured_pagos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
         {    
             $form->add('pagos_roles');
         } 
    
        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Pagos entity.
     *
     * @Route("/api/{id}/edit", name="secured_pagos_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Pagos:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Pagos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pagos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Pagos entity.
     *
     * @Route("/{id}", name="secured_pagos_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiservicesArxisBundle:Pagos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Pagos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pagos entity.');
        }
        $current_pass = $entity->getPassword();
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            
            if ($current_pass != $entity->getPassword()) {
                $this->setSecurePassword($entity);
            }
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('secured_pagos_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pagos entity.
     *
     * @Route("/{id}", name="secured_pagos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiservicesArxisBundle:Pagos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pagos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('secured_pagos'));
    }

    /**
     * Creates a form to delete a Pagos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secured_pagos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
    
    private function setSecurePassword(&$entity)
    {
    $entity->setSalt(md5(time()));
    $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
    $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
    $entity->setPassword($password);
    }
    
    private function setRoleDefault(&$entity)
    {
        if (!($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')))
         { 
            $roldefault=$this->getDoctrine()->getRepository('MultiservicesArxisBundle:Role')->find(2);
         $entity->addUserRole($roldefault);
        }
    }
}

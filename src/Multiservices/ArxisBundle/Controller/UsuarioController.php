<?php

namespace Multiservices\ArxisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\ArxisBundle\Entity\Usuario;
use Multiservices\ArxisBundle\Form\UsuarioType;
use Multiservices\ArxisBundle\Form\UsuarioChangeAvatarType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use JMS\Serializer\SerializationContext;

/**
 * Usuario controller.
 *
 * @Route("/arxis/user")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("", name="secured_user")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Usuario entities.
     *
     * @Route("/api", name="secured_user_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Usuario:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiservicesArxisBundle:Usuario')->findAll();
        return array(
            'entities' => $entities,
        );
    }
    
    
     /**
     * Lists all Usuario entities.
     *
     * @Route("/api/indexsearch.json", name="index_search_usuarios", options={"expose":true})
     * @Method("GET")
     * 
     */
    public function indexSearchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('MultiservicesArxisBundle:Usuario')->findAll();
        $serializer = $this->get('jms_serializer');
        $r=$serializer->serialize($entities, 'json', SerializationContext::create()->setGroups(array('search')));
        $response= new JsonResponse();
        //$response->sendHeaders(array('content-type' => 'application/json'));
        $response->setData(json_decode($r));
        
        
        return $response;
    }
    /**
     * Creates a new Usuario entity.
     *
     * @Route("/", name="secured_user_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiservicesArxisBundle:Usuario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->setSecurePassword($entity);
            $this->setRoleDefault($entity);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(UsuarioType::class, $entity, array(
            'action' => $this->generateUrl('secured_user_create'),
            'method' => 'POST',
        ));
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
         {    
             $form->add('user_roles');
         } 
        
        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/new", name="secured_user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/api/new", name="secured_user_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Usuario:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Usuario();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="secured_user_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }
    
    

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/api/{id}", name="secured_user_api_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Usuario:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }
        $avatarform = $this->createForm(UsuarioChangeAvatarType::class,$entity, array(
            //'action' => $this->generateUrl('secured_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $deleteForm = $this->createDeleteForm($id);
        $estudiante=$em->getRepository('MultiacademicoBundle:Estudiantes')->findOneByUsuario($entity);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($entity);
        //$administrativo=null;
        
        return array(
            'usuario'      => $entity,
            'estudiante' => $estudiante,
            'docente' => $docente,
           // 'administrativo'=>$administrativo,
            'changeavatarform' => $avatarform->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/api/me", name="secured_user_api_showme", options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Usuario:me.html.twig")
     */
    public function showMeApiAction()
    {
        
        $me=$this->get('security.token_storage')->getToken()->getUser();
        
        $usuario = $me;
        $form = $this->createForm(UsuarioChangeAvatarType::class,$me, array(
            //'action' => $this->generateUrl('secured_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $em = $this->getDoctrine()->getManager();
        $estudiante=$em->getRepository('MultiacademicoBundle:Estudiantes')->findOneByUsuario($me);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($me);
        //$administrativo=null;

        return array(
            'usuario'      => $usuario,
            'estudiante' => $estudiante,
            'docente' => $docente,
           // 'administrativo'=>$administrativo,
            'changeavatarform' => $form->createView()
        );
    }
    
    /** Edits an existing Usuario avatat entity.
     *
     * @Route("api/me/updateavatar", name="secured_user_api_me_update_avatar", options={"expose":true})
     * @Method("PUT")
     * 
     */
    public function updateAvatarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $me=$this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(UsuarioChangeAvatarType::class,$me, array(
            //'action' => $this->generateUrl('secured_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
            $em->persist($me);
            $em->flush();

            $response=new JsonResponse();
             $response->setData(array('path'=>$me->getWebPath()));
             $response->setStatusCode(202);
             //return $this->redirect($this->generateUrl('secured_user_api_showme'));
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
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="secured_user_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(UsuarioType::class, $entity, array(
            //'action' => $this->generateUrl('secured_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
         {    
             $form->add('user_roles');
         } 
    
        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/api/{id}/edit", name="secured_user_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiservicesArxisBundle:Usuario:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="secured_user_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiservicesArxisBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
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

            return $this->redirect($this->generateUrl('secured_user_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}", name="secured_user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiservicesArxisBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('secured_user'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secured_user_delete', array('id' => $id)))
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

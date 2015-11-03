<?php

namespace Multiservices\NotifyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\NotifyBundle\Entity\Notificaciones;
use Multiservices\NotifyBundle\Servicios\Notificador;
use Multiservices\NotifyBundle\NotifyBox\NotifyBox;
//use Multiservices\NotifyBundle\Form\NotificacionesType;
//use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Notificaciones controller.
 *
 * @Route("/notificaciones")
 */
class NotificacionesController extends Controller
{
   
    /**
     * Lists all Notificaciones entities.
     *
     * @Route("/", name="notificaciones")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('NotifyBundle:Notificaciones')->inbox($user);
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Notificaciones entities.
     *
     * @Route("/inbox", name="inbox_notificaciones")
     * @Method("GET")
     * @Template("NotifyBundle:Notificaciones:inbox.html.twig")
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('NotifyBundle:Notificaciones')->inbox($user);
        $tempo = $this->get('timeago');
        
        foreach($entities as $notificacion)
        {
            $notificacion->timeago=New $tempo($notificacion->getNotificaciontimestamp());
        }
        //var_dump($hola);
        
        return array(
            'entities' => $entities,
        );
    }
    
     /**
     * Lists all Notificacionesentities.
     *
     * @Route("/api/activities/activity-notify.{_format}", name="activity-notify", options={"expose":true})
     * @Method("GET")
     */
    public function inboxApiAction($_format='')
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('NotifyBundle:Notificaciones')->inbox($user);
        
        $notifyBox=new NotifyBox();
        $c=count($entities);
        $notifyBox->setLength($c);
        $notifyBox->setData($entities);
        $serializer = $this->get('jms_serializer');
        $dataNotifyBox=$serializer->serialize($notifyBox, 'json');

        $response=new JsonResponse();
        $response->setData(json_decode($dataNotifyBox));
        return $response;
    }
    
    /**
     * Edits an existing Notificaciones entity.
     *
     * @Route("/{id}/read", name="notificaciones_read", options={"expose":true})
     * @Method("POST")
     
     */
    public function readAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotifyBundle:Notificaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notificaciones entity.');
        }
        $entity->setNotificacionestado(1);
        //$editForm = $this->createEditForm($entity);
        //$editForm->handleRequest($request);
        $em->flush();
        /*if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('notificaciones_edit', array('id' => $id)));
        }*/

        /*return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        
        );*/
        return New Response("");
    }
    /**
     * Creates a new Notificaciones entity.
     *
     * @Route("/", name="notificaciones_create")
     * @Method("POST")
     * @Template("NotifyBundle:Notificaciones:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Notificaciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('notificaciones_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Notificaciones entity.
     *
     * @param Notificaciones $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Notificaciones $entity)
    {
        $form = $this->createForm(new NotificacionesType(), $entity, array(
            'action' => $this->generateUrl('notificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Notificaciones entity.
     *
     * @Route("/new", name="notificaciones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Notificaciones();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Notificaciones entity.
     *
     * @Route("/{id}", name="notificaciones_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotifyBundle:Notificaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notificaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Notificaciones entity.
     *
     * @Route("/{id}/edit", name="notificaciones_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotifyBundle:Notificaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notificaciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Notificaciones entity.
    *
    * @param Notificaciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Notificaciones $entity)
    {
        $form = $this->createForm(new NotificacionesType(), $entity, array(
            'action' => $this->generateUrl('notificaciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Notificaciones entity.
     *
     * @Route("/{id}", name="notificaciones_update")
     * @Method("PUT")
     * @Template("NotifyBundle:Notificaciones:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NotifyBundle:Notificaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notificaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('notificaciones_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Notificaciones entity.
     *
     * @Route("/{id}", name="notificaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NotifyBundle:Notificaciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Notificaciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notificaciones'));
    }

    /**
     * Creates a form to delete a Notificaciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notificaciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    

    
}

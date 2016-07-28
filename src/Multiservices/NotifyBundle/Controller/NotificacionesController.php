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
     * 
     *
     * @Route("/new", name="notificaciones_new")
     * @Method("GET")
     */
    public function baseAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    
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
        $user = $this->getUser();
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
    public function readAction(Request $request, Notificaciones $notificacion)
    {
        $em = $this->getDoctrine()->getManager();
        $notificacion->setNotificacionestado(true);
        $em->flush();
        return New Response("",Response::HTTP_NO_CONTENT);
    }
    /**
     * Creates a new Notificacion entity.
     *
     * @Route("/api/new", name="new_notificacion", options={"expose":true})
     * @Method({"POST","GET"})
     */
    public function newAction(Request $request)
    {
        $notificacion = new Notificaciones();
        $form = $this->createForm('Multiservices\NotifyBundle\Form\NotificacionesType', $notificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user=$this->getUser();
            $notificador=new Notificador($em);
            $actiondata=new \Multiservices\NotifyBundle\ActionData\UserNormalNotification();
            $actiondata->setUsuario($user->getName());
            $actiondata->setUid($user->getId());
            $actiondata->setNotificacion($notificacion->getNotificacion());
            $actiondata->setUrlUser($this->container->get('router')->generate('perfil_user', array(
                                                                                                 'id' => $user->getId())));
       
            //$notify=$notificador->crearNotificacion($actiondata->getActionid(), 'notificacion', $notificacion->getNotificacionuser(), $actiondata);
            $notificador->notificar($actiondata->getActionid(), 'notificacion', $notificacion->getNotificacionuser(), $actiondata);
            
            //$em->persist($notify);
            //$em->flush();

            //return $this->redirectToRoute('notificaciones', array('page' => $notificacion->getId()));
            return new Response("El Usuario Ha sido Notificado con EXITO");
        }

        return $this->render('NotifyBundle:Notificaciones:new.html.twig', array(
            'notificacion' => $notificacion,
            'form' => $form->createView(),
        ));
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

    
}
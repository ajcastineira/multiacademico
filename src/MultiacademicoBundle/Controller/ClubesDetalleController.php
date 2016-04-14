<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\ClubesDetalle;
use MultiacademicoBundle\Form\ClubesDetalleType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * ClubesDetalle controller.
 *
 * @Route("/proyectosescolares/notas")
 */
class ClubesDetalleController extends Controller
{

    /**
     * Lists all ClubesDetalle entities.
     *
     * @Route("", name="proyectosescolares_notas")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all ClubesDetalle entities.
     *
     * @Route("/api", name="proyectosescolares_notas_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:ClubesDetalle:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ClubesDetalle entity.
     *
     * @Route("/", name="proyectosescolares_notas_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:ClubesDetalle:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ClubesDetalle();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('proyectosescolares_notas_show', array('id' => $entity->getId())));
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
     * Creates a form to create a ClubesDetalle entity.
     *
     * @param ClubesDetalle $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ClubesDetalle $entity)
    {
        $form = $this->createForm( ClubesDetalleType::class, $entity, array(
            //'action' => $this->generateUrl('proyectosescolares_notas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new ClubesDetalle entity.
     *
     * @Route("/new", name="proyectosescolares_notas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new ClubesDetalle entity.
     *
     * @Route("/api/new", name="proyectosescolares_notas_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:ClubesDetalle:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new ClubesDetalle();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ClubesDetalle entity.
     *
     * @Route("/{id}", name="proyectosescolares_notas_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a ClubesDetalle entity.
     *
     * @Route("/api/{id}", name="proyectosescolares_notas_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:ClubesDetalle:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClubesDetalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ClubesDetalle entity.
     *
     * @Route("/{id}/edit", name="proyectosescolares_notas_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a ClubesDetalle entity.
    *
    * @param ClubesDetalle $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ClubesDetalle $entity)
    {
        $form = $this->createForm( ClubesDetalleType::class, $entity, array(
            //'action' => $this->generateUrl('proyectosescolares_notas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing ClubesDetalle entity.
     *
     * @Route("/api/{id}/edit", name="proyectosescolares_notas_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:ClubesDetalle:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClubesDetalle entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing ClubesDetalle entity.
     *
     * @Route("/{id}", name="proyectosescolares_notas_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:ClubesDetalle:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ClubesDetalle entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('proyectosescolares_notas_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ClubesDetalle entity.
     *
     * @Route("/{id}", name="proyectosescolares_notas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:ClubesDetalle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ClubesDetalle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proyectosescolares_notas'));
    }

    /**
     * Creates a form to delete a ClubesDetalle entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proyectosescolares_notas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

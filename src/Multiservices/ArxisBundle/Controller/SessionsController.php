<?php

namespace Multiservices\ArxisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\ArxisBundle\Entity\Sessions;
use Multiservices\ArxisBundle\Form\SessionsType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Sessions controller.
 *
 * @Route("/sessions")
 */
class SessionsController extends Controller
{

    /**
     * Lists all Sessions entities.
     *
     * @Route("/", name="sessions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiservicesArxisBundle:Sessions')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sessions entity.
     *
     * @Route("/", name="sessions_create")
     * @Method("POST")
     * @Template("MultiservicesArxisBundle:Sessions:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sessions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sessions_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Sessions entity.
    *
    * @param Sessions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sessions $entity)
    {
        $form = $this->createForm(new SessionsType(), $entity, array(
            'action' => $this->generateUrl('sessions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sessions entity.
     *
     * @Route("/new", name="sessions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sessions();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sessions entity.
     *
     * @Route("/{id}", name="sessions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Sessions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sessions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sessions entity.
     *
     * @Route("/{id}/edit", name="sessions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Sessions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sessions entity.');
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
    * Creates a form to edit a Sessions entity.
    *
    * @param Sessions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sessions $entity)
    {
        $form = $this->createForm(new SessionsType(), $entity, array(
            'action' => $this->generateUrl('sessions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sessions entity.
     *
     * @Route("/{id}", name="sessions_update")
     * @Method("PUT")
     * @Template("MultiservicesArxisBundle:Sessions:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiservicesArxisBundle:Sessions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sessions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sessions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sessions entity.
     *
     * @Route("/{id}", name="sessions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiservicesArxisBundle:Sessions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sessions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sessions'));
    }

    /**
     * Creates a form to delete a Sessions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sessions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

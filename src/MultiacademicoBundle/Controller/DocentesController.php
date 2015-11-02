<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Docentes;
use MultiacademicoBundle\Form\DocentesType;

/**
 * Docentes controller.
 *
 * @Route("/docentes")
 */
class DocentesController extends Controller
{

    /**
     * Lists all Docentes entities.
     *
     * @Route("", name="docentes")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Docentes entities.
     *
     * @Route("/api", name="docentes_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Docentes:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:Docentes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Docentes entity.
     *
     * @Route("/", name="docentes_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Docentes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Docentes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('docentes_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Docentes entity.
     *
     * @param Docentes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Docentes $entity)
    {
        $form = $this->createForm(new DocentesType(), $entity, array(
            //'action' => $this->generateUrl('docentes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Docentes entity.
     *
     * @Route("/new", name="docentes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Docentes entity.
     *
     * @Route("/api/new", name="docentes_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Docentes:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Docentes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Docentes entity.
     *
     * @Route("/{id}", name="docentes_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Docentes entity.
     *
     * @Route("/api/{id}", name="docentes_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Docentes:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Docentes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Docentes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Docentes entity.
     *
     * @Route("/{id}/edit", name="docentes_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Docentes entity.
    *
    * @param Docentes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Docentes $entity)
    {
        $form = $this->createForm(new DocentesType(), $entity, array(
            //'action' => $this->generateUrl('docentes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Docentes entity.
     *
     * @Route("/api/{id}/edit", name="docentes_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Docentes:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Docentes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Docentes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Docentes entity.
     *
     * @Route("/{id}", name="docentes_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Docentes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Docentes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Docentes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('docentes_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Docentes entity.
     *
     * @Route("/{id}", name="docentes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Docentes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Docentes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('docentes'));
    }

    /**
     * Creates a form to delete a Docentes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docentes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

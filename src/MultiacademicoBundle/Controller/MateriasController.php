<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Materias;
use MultiacademicoBundle\Form\MateriasType;

/**
 * Materias controller.
 *
 * @Route("/materias")
 * @Security("has_role('ROLE_ADMIN')")
 */
class MateriasController extends Controller
{

    /**
     * Lists all Materias entities.
     *
     * @Route("", name="materias")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Materias entities.
     *
     * @Route("/api", name="materias_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Materias:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:Materias')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Materias entity.
     *
     * @Route("/", name="materias_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Materias:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Materias();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('materias_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Materias entity.
     *
     * @param Materias $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Materias $entity)
    {
        $form = $this->createForm(new MateriasType(), $entity, array(
            //'action' => $this->generateUrl('materias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Materias entity.
     *
     * @Route("/new", name="materias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Materias entity.
     *
     * @Route("/api/new", name="materias_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Materias:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Materias();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Materias entity.
     *
     * @Route("/{id}", name="materias_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Materias entity.
     *
     * @Route("/api/{id}", name="materias_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Materias:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Materias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Materias entity.
     *
     * @Route("/{id}/edit", name="materias_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Materias entity.
    *
    * @param Materias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Materias $entity)
    {
        $form = $this->createForm(new MateriasType(), $entity, array(
            //'action' => $this->generateUrl('materias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Materias entity.
     *
     * @Route("/api/{id}/edit", name="materias_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Materias:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Materias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materias entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Materias entity.
     *
     * @Route("/{id}", name="materias_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Materias:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Materias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('materias_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Materias entity.
     *
     * @Route("/{id}", name="materias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Materias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Materias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('materias'));
    }

    /**
     * Creates a form to delete a Materias entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

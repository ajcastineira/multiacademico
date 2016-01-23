<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Periodos;
use MultiacademicoBundle\Form\PeriodosType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Periodos controller.
 *
 * @Route("/periodos")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PeriodosController extends Controller
{

    /**
     * Lists all Periodos entities.
     *
     * @Route("", name="periodos")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Periodos entities.
     *
     * @Route("/api", name="periodos_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Periodos:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:Periodos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Periodos entity.
     *
     * @Route("/", name="periodos_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Periodos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Periodos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('periodos_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Periodos entity.
     *
     * @param Periodos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Periodos $entity)
    {
        $form = $this->createForm( PeriodosType::class, $entity, array(
            //'action' => $this->generateUrl('periodos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Periodos entity.
     *
     * @Route("/new", name="periodos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Periodos entity.
     *
     * @Route("/api/new", name="periodos_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Periodos:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Periodos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Periodos entity.
     *
     * @Route("/{id}", name="periodos_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Periodos entity.
     *
     * @Route("/api/{id}", name="periodos_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Periodos:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Periodos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Periodos entity.
     *
     * @Route("/{id}/edit", name="periodos_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Periodos entity.
    *
    * @param Periodos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Periodos $entity)
    {
        $form = $this->createForm( PeriodosType::class, $entity, array(
            //'action' => $this->generateUrl('periodos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Periodos entity.
     *
     * @Route("/api/{id}/edit", name="periodos_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Periodos:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Periodos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Periodos entity.
     *
     * @Route("/{id}", name="periodos_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Periodos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Periodos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('periodos_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Periodos entity.
     *
     * @Route("/{id}", name="periodos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Periodos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Periodos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('periodos'));
    }

    /**
     * Creates a form to delete a Periodos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('periodos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

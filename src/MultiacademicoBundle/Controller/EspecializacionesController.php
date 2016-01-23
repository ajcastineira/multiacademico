<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Especializaciones;
use MultiacademicoBundle\Form\EspecializacionesType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Especializaciones controller.
 *
 * @Route("/especializaciones")
 * @Security("has_role('ROLE_ADMIN')")
 */
class EspecializacionesController extends Controller
{

    /**
     * Lists all Especializaciones entities.
     *
     * @Route("", name="especializaciones")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Especializaciones entities.
     *
     * @Route("/api", name="especializaciones_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Especializaciones:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:Especializaciones')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Especializaciones entity.
     *
     * @Route("/", name="especializaciones_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Especializaciones:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Especializaciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('especializaciones_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Especializaciones entity.
     *
     * @param Especializaciones $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especializaciones $entity)
    {
        $form = $this->createForm( EspecializacionesType::class, $entity, array(
            //'action' => $this->generateUrl('especializaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Especializaciones entity.
     *
     * @Route("/new", name="especializaciones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Especializaciones entity.
     *
     * @Route("/api/new", name="especializaciones_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Especializaciones:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Especializaciones();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Especializaciones entity.
     *
     * @Route("/{id}", name="especializaciones_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Especializaciones entity.
     *
     * @Route("/api/{id}", name="especializaciones_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Especializaciones:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Especializaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especializaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Especializaciones entity.
     *
     * @Route("/{id}/edit", name="especializaciones_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Especializaciones entity.
    *
    * @param Especializaciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Especializaciones $entity)
    {
        $form = $this->createForm( EspecializacionesType::class, $entity, array(
            //'action' => $this->generateUrl('especializaciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Especializaciones entity.
     *
     * @Route("/api/{id}/edit", name="especializaciones_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Especializaciones:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Especializaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especializaciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Especializaciones entity.
     *
     * @Route("/{id}", name="especializaciones_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Especializaciones:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Especializaciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especializaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('especializaciones_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Especializaciones entity.
     *
     * @Route("/{id}", name="especializaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Especializaciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especializaciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especializaciones'));
    }

    /**
     * Creates a form to delete a Especializaciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especializaciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

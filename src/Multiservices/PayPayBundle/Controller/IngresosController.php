<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\PayPayBundle\Entity\Ingresos;
use Multiservices\PayPayBundle\Form\IngresosType;

/**
 * Ingresos controller.
 *
 * @Route("/ingresos")
 */
class IngresosController extends Controller
{

    /**
     * Lists all Ingresos entities.
     *
     * @Route("", name="ingresos")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }
    /**
     * Lists all Ingresis entities.
     *
     * @Route("/inbox", name="inbox_ingresos")
     * @Method("GET")
     * @Template("PayPayBundle:Ingresos:inbox.html.twig")
     */
    public function inboxAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $entities = $em->getRepository('PayPayBundle:Ingresos')->inbox($user);
        
        return array(
            'entities' => $entities,
        );
    }  
    /**
     * Lists all Ingresos entities.
     *
     * @Route("/api", name="ingresos_api", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Ingresos:index.html.twig")
     */
    public function indexApiAction()
    {
        $ingresosDatatable = $this->get("paypay_datatables.ingresos");
        $ingresosDatatable->buildDatatable();
        return array(
           // 'entities' => $entities,
            'datatable'=>$ingresosDatatable,
        );
    }
    /**
     * Get results Ingresos entities.
     *
     * @Route("/results", name="ingresos_results")
     *
     * @return Response
     */
    public function ingresosResultsAction()
    {
    	/**
    	 * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
    	 */
    	$datatable = $this->get('paypay_datatables.ingresos');
    	$datatable->buildDatatable();
    	$query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

    	return $query->getResponse();
    }
    /**
     * Creates a new Ingresos entity.
     *
     * @Route("/", name="ingresos_create", options={"expose":true})
     * @Method("POST")
     * @Template("PayPayBundle:Ingresos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ingresos();
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $entity->setCollectedby($usr);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('ingresos_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Ingresos entity.
     *
     * @param Ingresos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ingresos $entity)
    {
        $form = $this->createForm(new IngresosType(), $entity, array(
            //'action' => $this->generateUrl('ingresos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Ingresos entity.
     *
     * @Route("/new", name="ingresos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Displays a form to create a new Ingresos entity.
     *
     * @Route("/api/new", name="ingresos_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Ingresos:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Ingresos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ingresos entity.
     *
     * @Route("/{id}", name="ingresos_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
     * Finds and displays a Ingresos entity.
     *
     * @Route("/api/{id}", name="ingresos_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Ingresos:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Ingresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ingresos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ingresos entity.
     *
     * @Route("/{id}/edit", name="ingresos_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::basesmartpanelangular.html.twig');
    }

    /**
    * Creates a form to edit a Ingresos entity.
    *
    * @param Ingresos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ingresos $entity)
    {
        $form = $this->createForm(new IngresosType(), $entity, array(
            //'action' => $this->generateUrl('ingresos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Ingresos entity.
     *
     * @Route("/api/{id}/edit", name="ingresos_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("PayPayBundle:Ingresos:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Ingresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ingresos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Ingresos entity.
     *
     * @Route("/{id}", name="ingresos_update", options={"expose":true})
     * @Method("PUT")
     * @Template("PayPayBundle:Ingresos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PayPayBundle:Ingresos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ingresos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ingresos_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Ingresos entity.
     *
     * @Route("/{id}", name="ingresos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PayPayBundle:Ingresos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ingresos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ingresos'));
    }

    /**
     * Creates a form to delete a Ingresos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ingresos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

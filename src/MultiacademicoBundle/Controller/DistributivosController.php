<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Distributivos;
use MultiacademicoBundle\Form\DistributivosType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Distributivos controller.
 *
 * @Route("/distributivos")
 * @Security("has_role('ROLE_ADMIN')")
 */
class DistributivosController extends Controller
{

    /**
     * Lists all Distributivos entities.
     *
     * @Route("", name="distributivos")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Distributivos entities.
     *
     * @Route("/api", name="distributivos_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Distributivos:index.html.twig")
     */
    public function indexApiAction()
    {
        $distributivosDatatable = $this->get("multiacademico.distributivos");
        $distributivosDatatable->buildDatatable();
        
        return array(
           'datatable'=>$distributivosDatatable
        );
    }
    
     /**
     * Get results distributivos entities.
     *
     * @Route("/results", name="distributivos_results")
     *
     * @return Response
     */
    
    public function distributivosResultsAction()
    {
        /**
         * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
         */
        $datatable = $this->get('multiacademico.distributivos');
         $datatable->buildDatatable();
         $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }
    /**
     * Creates a new Distributivos entity.
     *
     * @Route("/", name="distributivos_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Distributivos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Distributivos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$entity->getDistributivocodcurso()->getId(),
                                                                          'especializacion'=>$entity->getDistributivocodespecializacion()->getId(),
                                                                          'paralelo'=>$entity->getDistributivoparalelo(),
                                                                          'seccion'=>$entity->getDistributivoseccion(),
                                                                          'periodo'=>$entity->getDistributivocodperiodo()->getId()
                                                                           )
                                                                    );
            $entity->setAula($aula);
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('distributivos_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Distributivos entity.
     *
     * @param Distributivos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Distributivos $entity)
    {
        $form = $this->createForm( DistributivosType::class, $entity, array(
            //'action' => $this->generateUrl('distributivos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Distributivos entity.
     *
     * @Route("/new", name="distributivos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Distributivos entity.
     *
     * @Route("/api/new", name="distributivos_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Distributivos:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Distributivos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Distributivos entity.
     *
     * @Route("/{id}", name="distributivos_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Distributivos entity.
     *
     * @Route("/api/{id}", name="distributivos_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Distributivos:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Distributivos entity.
     *
     * @Route("/{id}/edit", name="distributivos_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Distributivos entity.
    *
    * @param Distributivos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Distributivos $entity)
    {
        $form = $this->createForm( DistributivosType::class, $entity, array(
            //'action' => $this->generateUrl('distributivos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Distributivos entity.
     *
     * @Route("/api/{id}/edit", name="distributivos_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Distributivos:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Distributivos entity.
     *
     * @Route("/{id}", name="distributivos_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Distributivos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('distributivos_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Distributivos entity.
     *
     * @Route("/{id}", name="distributivos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Distributivos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('distributivos'));
    }

    /**
     * Creates a form to delete a Distributivos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('distributivos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

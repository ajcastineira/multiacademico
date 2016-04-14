<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Estudiantes;
use MultiacademicoBundle\Form\EstudiantesType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use MultiacademicoBundle\Entity\Representantes;
/**
 * Estudiantes controller.
 *
 * @Route("/estudiantes")
 * @Security("has_role('ROLE_ADMIN')")
 */
class EstudiantesController extends Controller
{

    /**
     * Lists all Estudiantes entities.
     *
     * @Route("", name="estudiantes")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Estudiantes entities.
     *
     * @Route("/api", name="estudiantes_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Estudiantes:index.html.twig")
     */
    public function indexApiAction()
    {
         $estudiantesDatatable = $this->get("multiacademico.estudiantes");
        $estudiantesDatatable->buildDatatable();
        
        return array(
           'datatable'=>$estudiantesDatatable
        );
        
        //$em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('MultiacademicoBundle:Estudiantes')->findAll();

        /*return array(
            'entities' => $entities,
        );*/
    }
    
    
    /**
     * Get results estudiante entities.
     *
     * @Route("/results", name="estudiantes_results")
     *
     * @return Response
     */
    
    public function estudiantesResultsAction()
    {
        /**
         * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
         */
        $datatable = $this->get('multiacademico.estudiantes');
         $datatable->buildDatatable();
         $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }
    /**
     * Creates a new Estudiantes entity.
     *
     * @Route("/", name="estudiantes_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Estudiantes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $estudiante = new Estudiantes();
        $form = $this->createCreateForm($estudiante);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $userEstudiante=$this->crearUserEstudiante($estudiante);
            $estudiante->setUsuario($userEstudiante);
            //$representante=$this->crearRepresentante($estudiante);
            //$estudiante->setRepresentante($representante);
           
            
            $em->persist($estudiante);
            $em->flush();
            //return $this->redirect($this->generateUrl('estudiantes_show', array('id' => $estudiante->getId())));
                $response_redir=new JsonResponse();
                $response_redir->setData(array('id'=>$estudiante->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
        }

        return array(
            'entity' => $estudiante,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Estudiantes entity.
     *
     * @param Estudiantes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Estudiantes $entity)
    {
        $form = $this->createForm( EstudiantesType::class, $entity, array(
            //'action' => $this->generateUrl('estudiantes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Estudiantes entity.
     *
     * @Route("/new", name="estudiantes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Estudiantes entity.
     *
     * @Route("/api/new", name="estudiantes_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Estudiantes:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Estudiantes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Estudiantes entity.
     *
     * @Route("/{id}", name="estudiantes_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Estudiantes entity.
     *
     * @Route("/api/{id}", name="estudiantes_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Estudiantes:show.html.twig")
     */
    public function showApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Estudiantes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiantes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Estudiantes entity.
     *
     * @Route("/{id}/edit", name="estudiantes_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Estudiantes entity.
    *
    * @param Estudiantes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Estudiantes $entity)
    {
        $form = $this->createForm( EstudiantesType::class, $entity, array(
            //'action' => $this->generateUrl('estudiantes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Estudiantes entity.
     *
     * @Route("/api/{id}/edit", name="estudiantes_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Estudiantes:edit.html.twig")
     */
    public function editApiAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Estudiantes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiantes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Estudiantes entity.
     *
     * @Route("/{id}", name="estudiantes_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Estudiantes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Estudiantes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiantes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            //$entity->getUsuario()->setUsernameCanonical($entity->getUsername());
            $em->flush();

            return $this->redirect($this->generateUrl('estudiantes_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Estudiantes entity.
     *
     * @Route("/{id}", name="estudiantes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Estudiantes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estudiantes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estudiantes'));
    }

    /**
     * Creates a form to delete a Estudiantes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estudiantes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
    
    private function crearUserEstudiante(Estudiantes $estudiante)
    {
        $em=$this->getDoctrine()->getManager();
        $userManager = $this->container->get('fos_user.user_manager');
            $userEstudiante= $userManager->createUser();
            $userEstudiante->setUsername($estudiante->getUsername());
            $userEstudiante->setEmail($estudiante->getMail());
            $userEstudiante->setPlainPassword($estudiante->getPassword());
            //buscando rol
            $role=$em->getRepository("MultiservicesArxisBundle:Role")->findOneByName("ROLE_ESTUDIANTE");
            //asignando rol estudiante
            $userEstudiante->addRole($role);
            $userEstudiante->setName($estudiante->getEstudiante());
            $userEstudiante->setCargo("Estudiante");
            $userEstudiante->setEnabled(true);
            $userManager->updateUser($userEstudiante);
            return $userEstudiante;
    }
    
    private function crearRepresentante(Estudiantes $estudiante)
    {
        $em=$this->getDoctrine()->getManager();
        $representante=Representantes();
        
        return $representante;
    }
}

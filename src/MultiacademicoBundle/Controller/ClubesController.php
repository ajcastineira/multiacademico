<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Clubes;
use MultiacademicoBundle\Form\ClubesType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Clubes controller.
 *
 * @Route("/proyectosescolares")
 */
class ClubesController extends Controller
{

    /**
     * Lists all Clubes entities.
     *
     * @Route("", name="proyectosescolares")
     * @Method("GET")
     * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_SECRETARIA') or has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Clubes entities.
     *
     * @Route("/api", name="proyectosescolares_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Clubes:index.html.twig")
     * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_SECRETARIA') or has_role('ROLE_ADMIN')")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
        $entities = $em->getRepository('MultiacademicoBundle:Clubes')->findAll();
        }else
        {
        $entities = $em->getRepository('MultiacademicoBundle:Clubes')->MisClubesByUser($user);    
        }    
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Clubes entity.
     *
     * @Route("/", name="proyectosescolares_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Clubes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Clubes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('proyectosescolares_show', array('id' => $entity->getId())));
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
     * Creates a form to create a Clubes entity.
     *
     * @param Clubes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Clubes $entity)
    {
        $form = $this->createForm(new ClubesType(), $entity, array(
            //'action' => $this->generateUrl('proyectosescolares_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Clubes entity.
     *
     * @Route("/new", name="proyectosescolares_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Clubes entity.
     *
     * @Route("/api/new", name="proyectosescolares_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Clubes:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Clubes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Clubes entity.
     *
     * @Route("/{id}", name="proyectosescolares_show", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Security("(is_granted('PROYECTO_VIEW',id) and has_role('ROLE_DOCENTE'))or has_role('ROLE_ADMIN')")
     */
    public function showAction(Clubes $id)
    {
        return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Clubes entity.
     *
     * @Route("/api/{id}", name="proyectosescolares_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Clubes:show.html.twig")
     * @Security("(is_granted('PROYECTO_VIEW',id) and has_role('ROLE_DOCENTE'))or has_role('ROLE_ADMIN')")
     */
    public function showApiAction(Clubes $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Clubes')->mostrarClub($id);
        
        if (!$entity) {
            $entity = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);
            if (!$entity){
            throw $this->createNotFoundException('Unable to find Clubes entity.');
            }
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Clubes entity.
     *
     * @Route("/{id}/edit", name="proyectosescolares_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Security("(is_granted('PROYECTO_EDIT',id) and has_role('ROLE_DOCENTE'))or has_role('ROLE_ADMIN')")
     */
    public function editAction(Clubes $id)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Clubes entity.
    *
    * @param Clubes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Clubes $entity)
    {
        $form = $this->createForm(new ClubesType(), $entity, array(
            //'action' => $this->generateUrl('proyectosescolares_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Clubes entity.
     *
     * @Route("/api/{id}/edit", name="proyectosescolares_api_edit", requirements={"id":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Clubes:edit.html.twig")
     * @Security("(is_granted('PROYECTO_EDIT',id) and has_role('ROLE_DOCENTE'))or has_role('ROLE_ADMIN')")
     */
    public function editApiAction(Clubes $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clubes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Clubes entity.
     *
     * @Route("/{id}", name="proyectosescolares_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Clubes:edit.html.twig")
     * @Security("has_role('ROLE_DOCENTE')or has_role('ROLE_ADMIN')")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clubes entity.');
        }
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
        $this->denyAccessUnlessGranted('PROYECTO_EDIT', $entity, 'Usted solo puede editar los alumnos de su propio club!');
        }
        $originalRegistrados = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($entity->getRegistrados() as $registrado) {
        $originalRegistrados->add($registrado);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
             // remove the relationship between the tag and the Task
                foreach ($originalRegistrados as $registrado) {
                    if (false === $entity->getRegistrados()->contains($registrado)) {
                        // remove the Club from the Registro
                        // if it was a many-to-one relationship, remove the relationship like this
                       // $registrado->setCodClub(null);

                        //$em->persist($registrado);

                        
                         $em->remove($registrado);
                    }
                }
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proyectosescolares_api_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Clubes entity.
     *
     * @Route("/{id}", name="proyectosescolares_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Clubes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Clubes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proyectosescolares'));
    }

    /**
     * Creates a form to delete a Clubes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proyectosescolares_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Calificaciones;
use MultiacademicoBundle\Form\CalificacionesType;

/**
 * Calificaciones controller.
 *
 * @Route("/calificaciones")
 */
class CalificacionesController extends Controller
{

    /**
     * Lists all Calificaciones entities.
     *
     * @Route("", name="calificaciones1")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Calificaciones entities.
     *
     * @Route("/api", name="calificaciones_api1", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MultiacademicoBundle:Calificaciones')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Calificaciones entity.
     *
     * @Route("/", name="calificaciones_create", options={"expose":true})
     * @Method("POST")
     * @Template("MultiacademicoBundle:Calificaciones:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Calificaciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('calificaciones_show', array('id' => $entity->getId())));
                $response_redir=new JsonResponse();
                //$response_redir->setData(array('id'=>$entity->getId()));
                $response_redir->setStatusCode(201);
                return $response_redir;
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Calificaciones entity.
     *
     * @param Calificaciones $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Calificaciones $entity)
    {
        $form = $this->createForm(new CalificacionesType(), $entity, array(
            //'action' => $this->generateUrl('calificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Calificaciones entity.
     *
     * @Route("/new", name="calificaciones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Displays a form to create a new Calificaciones entity.
     *
     * @Route("/api/new", name="calificaciones_api_new", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:new.html.twig")
     */
    public function newApiAction()
    {
        $entity = new Calificaciones();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Calificaciones entity.
     *
     * @Route("/{matricula}/{materia}", name="calificaciones_show", requirements={"matricula":"\d+","materia":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function showAction($matricula,$materia)
    {

       return $this->render('::baseangular.html.twig');
    }

  /**
     * Finds and displays a Calificaciones entity.
     *
     * @Route("/imprimir/{matricula}/{materia}", name="calificaciones_imprimir", requirements={"matricula":"\d+","materia":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function imprimirAction($matricula,$materia)
    {
     $container->get('knp_snappy.image')->generate('http://www.google.fr', '/path/to/the/image.jpg');   
       // return $this->render('::baseangular.html.twig');
    }

    /**
     * Finds and displays a Calificaciones entity.
     *
     * @Route("/api/{matricula}/{materia}", name="calificaciones_api_show", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:show.html.twig")
     */
    public function showApiAction($matricula,$materia)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Calificaciones')->find(array(
                                                                                        'calificacioncodmateria'=>$materia,
                                                                                        'calificacionnummatricula'=>$matricula
                                                                                    ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($matricula,$materia);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Calificaciones entity.
     *
     * @Route("/{matricula}/{materia}/edit", name="calificaciones_edit", requirements={"matricula":"\d+","materia":"\d+"}, options={"expose":true})
     * @Method("GET")
     */
    public function editAction($matricula,$materia)
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
    * Creates a form to edit a Calificaciones entity.
    *
    * @param Calificaciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Calificaciones $entity)
    {
        $form = $this->createForm(new CalificacionesType(), $entity, array(
            //'action' => $this->generateUrl('calificaciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Displays a form to edit an existing Calificaciones entity.
     *
     * @Route("/api/{matricula}/{materia}/edit", name="calificaciones_api_edit", requirements={"matricula":"\d+","materia":"\d+"}, options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:edit.html.twig")
     */
    public function editApiAction($matricula,$materia)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Calificaciones')->find(array(
                                                                                        'calificacioncodmateria'=>$materia,
                                                                                        'calificacionnummatricula'=>$matricula
                                                                                    )
                                                                                  );

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificaciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($matricula,$materia);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }    /**
     * Edits an existing Calificaciones entity.
     *
     * @Route("/{matricula}/{materia}", name="calificaciones_update", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Calificaciones:edit.html.twig")
     */
    public function updateAction(Request $request, $matricula,$materia)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MultiacademicoBundle:Calificaciones')->find(array(
                                                                                        'calificacioncodmateria'=>$materia,
                                                                                        'calificacionnummatricula'=>$matricula
                                                                                    ));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificaciones entity.');
        }

        $deleteForm = $this->createDeleteForm($matricula,$materia);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_api_edit', array('matricula' => $matricula,'materia'=>$materia)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Calificaciones entity.
     *
     * @Route("/{matricula}/{materia}", name="calificaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $matricula,$materia)
    {
        $form = $this->createDeleteForm($matricula,$materia);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MultiacademicoBundle:Calificaciones')->find(array(
                                                                                        'calificacioncodmateria'=>$materia,
                                                                                        'calificacionnummatricula'=>$matricula
                                                                                    ));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Calificaciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calificaciones'));
    }

    /**
     * Creates a form to delete a Calificaciones entity by id.
     *
     * @param mixed $matricula The entity matriculas
     * @param mixed $materia  The entity materias
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($matricula,$materia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calificaciones_delete', array('matricula' => $matricula,'materia'=>$materia)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}

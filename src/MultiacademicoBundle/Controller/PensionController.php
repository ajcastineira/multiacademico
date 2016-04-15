<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use MultiacademicoBundle\Entity\Pension;
use MultiacademicoBundle\Form\PensionType;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
use Multiservices\PayPayBundle\Entity\Ingresos;

/**
 * Pension controller.
 * @Route("/pension")
* @Rest\RouteResource("Pension")
 */
class PensionController extends FOSRestController
{
    /**
     * Lists all Pension entities.
     *
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$pensions = $em->getRepository('MultiacademicoBundle:Pension')->findAll();

        $pensions_datatable = $this->get("multiacademico.pensiones");
        $pensions_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:Pension:index.html.twig', array(
            //'pensions' => $pensions,
            'datatable'=>$pensions_datatable
        ));
    }

    /**
     * Get results from Pension entity.
     *
     */
    public function resultsAction(Request $request)
    {

        $datatable = $this->get('multiacademico.pensiones');
        $datatable->buildDatatable();
        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Pension entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/pension/new", name="new_pension") 
     */
    public function newAction(Request $request)
    {
        $pension = new Pension();
        $form = $this->createForm('MultiacademicoBundle\Form\PensionType', $pension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pension);
            $em->flush();

            return $this->redirectToRoute('pension', array('page' => $pension->getId()));
        }

        return $this->render('MultiacademicoBundle:Pension:new.html.twig', array(
            'pension' => $pension,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pension entity.
     *
     * @Rest\Get() 
     */
    public function getAction(Pension $pension)
    {
        $deleteForm = $this->createDeleteForm($pension);

        return $this->render('MultiacademicoBundle:Pension:show.html.twig', array(
            'pension' => $pension,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
     /**
     * Print and displays a Matriculas entity.
     * @Rest\Get()  
     */
    public function printAction(Pension $pension)
    {
        return $this->render('MultiacademicoBundle:Pension:print.html.twig', array(
            'pension' => $pension,
        ));
    }

    /**
     * Displays a form to edit an existing Pension entity.
     *
     * @Rest\Post() 
     * @Rest\Get("/pensions/{pension}/edit", name="edit_pension") 
     */
    public function editAction(Request $request, Pension $pension)
    {
        $deleteForm = $this->createDeleteForm($pension);
        $editForm = $this->createForm('MultiacademicoBundle\Form\PensionType', $pension);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pension->getFactura()->calcularFactura();
            $em->persist($pension);
            $em->flush();

            return $this->redirectToRoute('edit_pension', array('pension' => $pension->getId()));
        }

        return $this->render('MultiacademicoBundle:Pension:edit.html.twig', array(
            'pension' => $pension,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Change Pension entity to Payed Estatus
     *
     * @Rest\Post() 
     * @Rest\View(statusCode=200) 
     */
    public function payAction(Request $request, Pension $pension)
    {
        $em = $this->getDoctrine()->getManager(); 
         if ($pension->getFactura()->getEstado()!=EstadoFacturaType::PAGADA)
         {
            $pension->getFactura()->setEstado(EstadoFacturaType::PAGADA);
            $pension->getFactura()->setPago(new \DateTime());
            $ingreso=new Ingresos();
            $ingreso->setMonto($pension->getFactura()->saldoAPagar());
            $ingreso->setRepresentante($pension->getFactura()->getIdcliente());
            $ingreso->setFecha(New \DateTime());
            $ingreso->addFactura($pension->getFactura());
            $efectivo=$em->getRepository('PayPayBundle:FormasPagos')->findOneByFormaPago('EFECTIVO');
            $ingreso->setFormaPago($efectivo);
            $ingreso->setCollectedby($this->getUser());
            $ingreso->registrarPagoEnFacturas();
            $em->persist($ingreso);
            
         }
         
         
         $em->persist($pension);
         $em->flush();

         return true;
    }

    /**
     * Deletes a Pension entity.
     *
     */
    public function deleteAction(Request $request, Pension $pension)
    {
        $form = $this->createDeleteForm($pension);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pension);
            $em->flush();
        }

        return $this->redirectToRoute('pension_index');
    }

    /**
     * Creates a form to delete a Pension entity.
     *
     * @param Pension $pension The Pension entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pension $pension)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_pension', array('pension' => $pension->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

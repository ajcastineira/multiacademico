<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use MultiacademicoBundle\Entity\Pension;
use MultiacademicoBundle\Form\PensionType;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
use Multiservices\PayPayBundle\Entity\Ingresos;

use Multiservices\PayPayBundle\Form\SubirListadoXLSType;
use Multiservices\PayPayBundle\Bancos\Pichincha\ListadoXLS;

use AppBundle\Lib\ResultsCorrector;


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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pensions = $em->getRepository('MultiacademicoBundle:Pension')->actualizarPensiones();
        
        $listado = new ListadoXLS();
        $form=$this->createForm(SubirListadoXLSType::class, $listado, 
                                        ['action'=>$this->generateUrl('subir_pension_listado')]);
        $form->handleRequest($request);
        
        $pensions_datatable = $this->get("multiacademico.pensiones");
        $pensions_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:Pension:index.html.twig', array(
            //'pensions' => $pensions,
            'datatable'=>$pensions_datatable,
            'form'=>$form->createView()
        ));
    }
    /**
     * @Rest\Post()
     */
    public function subirListadoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listado = new ListadoXLS();
        $form=$this->createForm(SubirListadoXLSType::class, $listado, 
                                    ['action'=>$this->generateUrl('subir_pension_listado')]);
        $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid()) {
            
            $file=$listado->getFile()->openFile();
            $lineas=0;
            while (!$file->eof())
            {
                $lineas++;
                $file->seek($lineas);
                if ($lineas>3)
                {
                    $data=$file->fgetcsv("\t");
                    if (count($data)>26)
                    {    
                    //$que_va_a_pagar=$data[0];   //referencia banco
                    $que_va_a_pagar=explode("|",$data[33]);   //contra referencia adicional
                    $canal_de_pago=$data[18];
                    $id_estudiante=$data[4];   //contra partidoa
                    $valorapagar=floatval($data[8]);
                    $referencia_doc=$data[20];
                    $fecha=explode(" ",$data[25]);
                    $hora=explode(" ",$data[26]);
                    $datetime_pago=new \DateTime("$fecha[2]/$fecha[1]/$fecha[0] $hora[3]:$hora[4]:$hora[5]");
                    
                    
                    $pensions = $em->getRepository('MultiacademicoBundle:Pension')->importarPago($id_estudiante,$valorapagar,$que_va_a_pagar[0],$referencia_doc,$datetime_pago);
                    
                    }
                    
                }   
            }
            var_dump("Ingresos Registrados Correctamente");
            return $this->redirectToRoute('pension');
        }
        
        $pensions_datatable = $this->get("multiacademico.pensiones");
        $pensions_datatable->buildDatatable();

        return $this->render('MultiacademicoBundle:Pension:index.html.twig', array(
            //'pensions' => $pensions,
            'datatable'=>$pensions_datatable,
            'form'=>$form->createView()
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
        $query->buildQuery();
        $qb = $query->getQuery();
        $qb->addSelect('partial idcliente.{id,representante}')->join('factura.idcliente','idcliente');
        $where=$qb->getDqlPart('where');
        $valorBuscado="factura.idcliente";
        $valorNuevo="idcliente.representante";
        $partesvalidas=[];
        if (isset($where)){
            $qb_where_parts = $where->getParts();
            foreach ($qb_where_parts as $qb_where_part)
             {
                $partesvalidas[]=ResultsCorrector::obtenerPartesValidas($qb_where_part, $valorBuscado, $valorNuevo);
             }
         }
        //var_dump($qb->getDQL()); 
        //var_dump($where); 
        $clasew=get_class($where);
            if (!empty($partesvalidas)){
            $qb->resetDQLPart('where');
            $qb->add('where',new $clasew($partesvalidas));
            }
        //var_dump($qb->getDQLPart('where'));     
        //var_dump($qb->getDQL());
        $query->setQuery($qb);
        return $query->getResponse(false);
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
     * Print and displays a Pension entity.
     * @Rest\Get()  
     */
    public function dataprintAction(Pension $pension)
    {
        $view = $this->view($pension, 200)
            ->setTemplate("MultiacademicoBundle:Pension:dataprint.html.twig")
            ->setTemplateVar('pension')
            ;
        return $this->handleView($view);

    }
    /**
     * Print PDF
     * @Rest\Get()
     */
    public function printpdfAction(Pension $pension)
    {
        $html = $this->renderView('MultiacademicoBundle:Pension:dataprint.html.twig', array(
                'pension'  => $pension
            ));
        //$html = $this->generateUrl('dataprint_pension', array('pension'=>$pension->getId(),'_format'=>'html'), UrlGeneratorInterface::ABSOLUTE_URL); // use absolute path!

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }
    
     /**
     * Print and displays a Matriculas entity.
     * @Rest\Get()  
     */
    public function printAction(Pension $pension)
    {
        $view = $this->view($pension, 200)
            ->setTemplate("MultiacademicoBundle:Pension:print.html.twig")
            ->setTemplateVar('pension')
            //->setTemplateData($templateData)
            //->setSerializationContext($context)
            ;
        return $this->handleView($view);

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
    
    /**
     * Update All
     *
     */
    public function updateAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $arraymat=[];
        $log="";
        $batchSize=20;
        $i=0;
        foreach ($arraymat as $nummatricula=>$descuento) {
            $i++;
            $matricula=$em->getRepository("MultiacademicoBundle:Matriculas")->find($nummatricula);
            if ($matricula==NULL)
            {
                $log.="Actualizando $nummatricula <br/>";
            }
            print_r("Actualizando $matricula <br/>");
           // $log.="----  Pensiones: </br>";
            set_time_limit(20);
            foreach ($matricula->getMatriculacodestudiante()->getPensiones() as &$pension)
            {
                $total=$pension->getFactura()->getTotal();
                $estado=$pension->getFactura()->getEstado();
                print_r("----------  Pension: $pension Estado: $estado Total: $total</br>");
                if ($estado!=  EstadoFacturaType::PAGADA && $pension->getInfo()!='Matricula Ordinaria')
                {    
                foreach ($pension->getFactura()->getItems() as &$item) {
                    $descuentoactual=$item->getDescuento();
                   print_r("----------------------  Descuento Actual $descuentoactual</br>");
                   print_r("----------------------  Descuento A Aplicar $descuento</br>");
                    $item->setDescuento($descuento);
                    
                }
                $pension->getFactura()->calcularFactura();
                if (($i % $batchSize) === 0) {
                    $em->flush();
                    $em->clear(); // Detaches all objects from Doctrine!
                }
                }
                $totalnuevo=$pension->getFactura()->getTotal();
                print_r("----------  Pension Aplicando Descuento: $pension Total: $totalnuevo</br>");
            }
           $em->flush(); //Persist objects that did not make up an entire batch
           $em->clear();
           print_r("----------  FINALIZADO CON EXITO  ------");
        };
        
        
        

        return new Response($log);
    }
}

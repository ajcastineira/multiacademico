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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pensions = $em->getRepository('MultiacademicoBundle:Pension')->actualizarPensiones();

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
        $arraymat=[371=>24.0714188174246
                ,346=>50
                ,400=>30
                ,195=>24.9
                ,352=>20
                ,160=>64.55
                ,129=>10
                ,116=>10
                ,460=>18
                ,286=>58
                ,173=>58
                ,471=>52
                ,472=>52
                ,144=>10
                ,81=>15
                ,32=>10
                ,357=>20
                ,300=>15
                ,11=>10
                ,49=>10
                ,298=>10
                ,154=>20
                ,181=>20
                ,51=>25
                ,218=>41.81
                ,178=>50
                ,179=>40
                ,236=>40
                ,452=>57.45
                ,234=>57.45
                ,368=>50
                ,184=>20
                ,186=>20
                ,442=>25
                ,577=>40
                ,525=>15
                ,103=>20
                ,188=>20
                ,165=>30
                ,323=>34
                ,324=>15
                ,59=>31.0014224751067
                ,574=>40
                ,23=>25
                ,303=>25
                ,406=>25
                ,477=>20
                ,378=>15
                ,490=>15
                ,63=>50
                ,256=>15
                ,257=>15
                ,258=>15
                ,146=>25
                ,19=>35
                ,115=>25
                ,425=>20
                ,233=>40
                ,78=>30
                ,125=>25
                ,57=>20
                ,162=>15
                ,508=>21
                ,509=>21
                ,507=>10
                ,200=>15
                ,94=>30
                ,174=>25
                ,252=>15
                ,251=>15
                ,255=>15
                ,130=>25
                ,603=>50
                ,299=>15
                ,344=>15
                ,343=>15
                ,491=>10
                ,20=>20
                ,301=>20
                ,239=>25
                ,104=>15
                ,597=>20
                ,235=>45
                ,479=>100
                ,269=>30
                ,268=>30
                ,320=>40
                ,522=>30
                ,521=>30
                ,480=>33
                ,334=>21.9344773790952
                ,83=>20
                ,287=>30
                ,530=>20
                ,430=>30
                ,133=>10
                ,304=>25
                ,305=>22.7951635846373
                ,124=>10
                ,547=>40
                ,487=>30
                ,488=>30
                ,482=>25
                ,483=>25
                ,285=>35
                ,127=>25
                ,399=>25.6661327897496
                ,36=>5
                ,377=>5
                ,401=>15
                ,402=>15
                ,517=>20
                ,540=>55
                ,237=>20
                ,468=>18.2361308677098
                ,292=>20
                ,410=>20
                ,259=>25
                ,572=>25
                ,337=>10
                ,580=>15
                ,581=>10
                ,358=>10
                ,135=>20
                ,354=>15
                ,263=>25
                ,512=>25
                ,511=>15
                ,322=>25
                ,308=>10
                ,309=>10
                ,341=>15
                ,66=>15
                ,202=>27
                ,143=>20
                ,310=>33
                ,339=>20
                ,366=>20
                ,112=>15
                ,111=>15
                ,105=>35
                ,311=>45
                ,312=>45
                ,90=>27
                ,246=>27
                ,595=>60
                ,594=>60
                ,35=>28
                ,241=>25
                ,92=>20
                ,25=>15
                ,21=>10
                ,102=>20
                ,42=>20
                ,238=>25
                ,294=>25
                ,150=>30
                ,245=>10
                ,141=>35
                ,619=>35
                ,62=>15
                ,60=>15.0387947756369
                ,271=>15
                ,61=>10
                ,384=>54
                ,383=>57
                ,74=>10
                ,15=>10
                ,177=>37
                ,348=>40
                ,367=>64.54
                ,128=>50
                ,99=>40
                ,45=>30
                ,46=>25
                ,462=>25
                ,463=>24
                ,566=>35
                ,542=>30
                ,189=>20
                ,455=>10
                ,561=>15
                ,132=>20
                ,204=>50
                ,589=>15
                ,588=>15
                ,353=>31
                ,448=>20
                ,450=>20
                ,449=>20
                ,606=>24
                ,604=>24
                ,605=>24
                ,418=>20
                ,24=>20
                ,91=>25
                ,317=>20
                ,110=>15
                ,151=>57.45
                ,144=>15
                ,278=>10
                ,279=>10
                ,147=>25
                ,264=>10
                ,117=>10
                ,242=>40
                ,107=>30
                ,80=>25
                ,131=>15
                ,208=>20
                ,253=>20
                ,518=>25
                ,106=>45
                ,529=>10
                ,176=>30
                ,598=>20
                ,576=>20
                ,291=>35
                ,349=>28
                ,227=>25
                ,228=>28
                ,633=>25
                ,137=>20
                ,428=>20
                ,138=>25
                ,345=>25
                ,134=>25
                ,590=>30
                ,520=>50
                ,260=>50.0070911927386
                ,261=>50
                ,101=>20
                ,231=>20
                ,230=>20
                ,96=>25
                ,492=>25
                ,203=>25
                ,79=>10
                ,473=>15
                ,551=>28
                ,192=>20
                ,191=>20
                ,329=>12
                ,330=>12
                ,565=>20
                ,120=>18
                ,528=>25
                ,100=>71
                ,364=>15
                ,223=>44
                ,224=>45
                ,82=>20
                ,172=>20
                ,409=>20
                ,193=>20
                ,434=>25
                ,52=>25
                ,544=>40
                ,543=>40
                ,114=>20
                ,557=>20
                ,551=>20
                ,552=>20
                ,553=>20
                ,554=>20
                ,262=>36
                ,295=>36
                ,495=>22
                ,546=>29.09
                ,556=>14
                ,571=>25
                ,568=>25
                ,56=>15
                ,456=>40
                ,356=>15
                ,627=>29.09
                ,14=>10
                ,88=>15
                ,470=>15
                ,607=>20
                ,288=>15
                ,624=>15
                ,248=>5
                ,415=>5
                ,97=>5
                ,139=>15
                ,73=>15
                ,404=>10
                ,612=>40
                ,586=>40
                ,498=>10
                ,634=>10
                ,635=>10
                ,636=>10
                ,216=>10
                ,331=>10
                ,215=>10
                ,609=>10
                ,610=>10
                ,625=>100
                ,539=>10
                ,538=>10
                ,537=>10
                ,209=>15
                ,414=>10
                ,229=>10
                ,306=>10
                ,564=>10
                ,548=>10
                ,549=>10
                ,478=>15
                ,445=>15
                ,584=>15
                ,417=>15
                ,347=>10
                ,493=>10
                ,569=>10
                ,222=>10
                ,9=>50
                ,395=>50
                ,395=>50
                ,169=>50
                ,502=>50
                ,359=>50
                ,226=>50
                ,496=>50
                ,497=>50
                ,281=>50
                ,86=>50
                ,225=>50
                ,119=>50
                ,503=>50
                ,458=>50
                ,277=>25
                ,171=>50
                ,283=>50
                ,220=>50
                ,504=>50
                ,505=>50
                ,50=>50
                ,394=>50
                ,342=>50
                ,370=>50
                ,393=>50
                ,397=>50];
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
        };
        
        
        

        return new Response($log);
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Matriculas;
use MultiacademicoBundle\Form\MatriculasType;

use MultiacademicoBundle\Entity\Pension;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Facturaitems;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

use AppBundle\Lib\ResultsCorrector;


/**
 * Matriculas controller.
 *
 * @Route("/matriculas")
 * @Rest\RouteResource("Matricula")
 * @Security("has_role('ROLE_SECRETARIA') or has_role('ROLE_COLECTORA')")
 */
class MatriculasController extends FOSRestController
{
    /**
     * Lists all Matriculas entities.
     *
     * 
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$matriculas = $em->getRepository('MultiacademicoBundle:Matriculas')->findAll();
        $matriculasDatatable = $this->get("multiacademicobundle_datatable.matriculas");
        $matriculasDatatable->buildDatatable();
        
        return $this->render('MultiacademicoBundle:Matriculas:index.html.twig', array(
            //'matriculas' => $matriculas,
            'datatable'=>$matriculasDatatable
        ));
    }
    
    /**
     * Get results matriculas entities.
     *
     */
    
    public function resultsAction()
    {
        /**
         * @var \Sg\DatatablesBundle\Datatable\Data\DatatableData $datatable
         */
        $datatable = $this->get('multiacademicobundle_datatable.matriculas');
         $datatable->buildDatatable();
         $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);
         
         $query->buildQuery();
        $qb = $query->getQuery();
        $qb->addSelect('partial representante.{id,representante}')->join('matriculacodestudiante.representante','representante');
        $where=$qb->getDqlPart('where');
        $valorBuscado="matriculacodestudiante.representante";
        $valorNuevo="representante.representante";
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
     * Creates a new Matriculas entity.
     *
 
     * @Rest\Post() 
     * @Rest\Get("/matriculas/new", name="new_matricula") 
     */
    public function newAction(Request $request)
    {
        $matricula = new Matriculas();
       $form = $this->createForm('MultiacademicoBundle\Form\MatriculasType', $matricula);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $aula=$em->getRepository('MultiacademicoBundle:Aula')->findOneBy(
                                                                    array(
                                                                          'curso'=>$matricula->getMatriculacodcurso()->getId(),
                                                                          'especializacion'=>$matricula->getMatriculacodespecializacion()->getId(),
                                                                          'paralelo'=>$matricula->getMatriculaparalelo(),
                                                                          'seccion'=>$matricula->getMatriculaseccion(),
                                                                          'periodo'=>$matricula->getMatriculacodperiodo()->getId()
                                                                           )
                                                                    );
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $matricula->setMatriculausuario($user);
            $matricula->setAula($aula);
            $em->persist($matricula);
            $entidad = $this->get('entidadData');
            if ($entidad->getEsParticular())
            {
                $this->generarFacturas($matricula);
            }
            $em->flush();

            return $this->redirectToRoute('get_matricula', array('matricula' => $matricula->getId()));
        }
        
        return $this->render('MultiacademicoBundle:Matriculas:new.html.twig', array(
            'matricula' => $matricula,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Matriculas entity.
     * @Rest\Get("/matriculas/{matricula}") 
     */
    public function getAction(Matriculas $matricula)
    {
        $deleteForm = $this->createDeleteForm($matricula);

        return $this->render('MultiacademicoBundle:Matriculas:show.html.twig', array(
            'matricula' => $matricula,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Print and displays a Matriculas entity.
     * @Rest\Get("/matriculas/{matricula}/print")  
     */
    public function printAction(Matriculas $matricula)
    {
        return $this->render('MultiacademicoBundle:Matriculas:print.html.twig', array(
            'matricula' => $matricula
        ));
    }
    
    /**
     * Print and displays a Matriculas entity.
     * @Rest\Get("/matriculas/{matricula}/contrato/print")  
     */
    public function printContratoAction(Matriculas $matricula)
    {
        return $this->render('MultiacademicoBundle:Matriculas:printcontrato.html.twig', array(
            'matricula' => $matricula
        ));
    }

    /**
     * Displays a form to edit an existing Matriculas entity.
     * @Rest\Post() 
     * @Rest\Get("/matriculas/{matricula}/edit", name="edit_matricula") 
     */
    public function editAction(Request $request, Matriculas $matricula)
    {
        $deleteForm = $this->createDeleteForm($matricula);
        $editForm = $this->createForm('MultiacademicoBundle\Form\MatriculasType', $matricula);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $aula=$em->getRepository('MultiacademicoBundle:Aula')->findOneBy(
                                                                    array(
                                                                          'curso'=>$matricula->getMatriculacodcurso()->getId(),
                                                                          'especializacion'=>$matricula->getMatriculacodespecializacion()->getId(),
                                                                          'paralelo'=>$matricula->getMatriculaparalelo(),
                                                                          'seccion'=>$matricula->getMatriculaseccion(),
                                                                          'periodo'=>$matricula->getMatriculacodperiodo()->getId()
                                                                           )
                                                                    );
            $matricula->setAula($aula);
            $em->persist($matricula);
            $em->flush();

            return $this->redirectToRoute('edit_matricula', array('matricula' => $matricula->getId()));
        }

        return $this->render('MultiacademicoBundle:Matriculas:edit.html.twig', array(
            'matricula' => $matricula,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Matriculas entity.
     * 
     */
    public function deleteAction(Request $request, Matriculas $matricula)
    {
        $form = $this->createDeleteForm($matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matricula);
            $em->flush();
        }

        return $this->redirectToRoute('matriculas');
    }

    /**
     * Creates a form to delete a Matriculas entity.
     *
     * @param Matriculas $matricula The Matriculas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Matriculas $matricula)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_matricula', array('matricula' => $matricula->getId() )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    protected function generarFacturas(Matriculas $matricula)
    {
        
        $em = $this->getDoctrine()->getManager();
        $usuarioResponsable=$matricula->getMatriculausuario()->getId();
        $representante = $matricula->getMatriculacodestudiante()->getRepresentante();
        if (!$representante)
        {
            $representante = $em->getRepository('MultiacademicoBundle:Representantes')->findOneByRepresentante('REPRESENTANTE POR DEFECTO');
        }
        
        $facturaDeMatricula = new Facturas();
        $facturaDeMatricula->setIdcliente($representante);
        

        //añadiendo items
            $itemMatriculaOrdinaria=new Facturaitems();
            //añadiendo item el producto Servicio Matricula Ordinaria
            $tipoMat='MATRORD';
            
            if ($matricula->getMatriculatipo() == "Extraordinaria")
            {
                $tipoMat='MATREXTRA';
            }
            $matriculaOrdinaria=$em->getRepository('PayPayBundle:Productos')->findOneByDescripcionCorta($tipoMat);
            $itemMatriculaOrdinaria->setIdproducto($matriculaOrdinaria);
            $itemMatriculaOrdinaria->setCantidad(1);
            $itemMatriculaOrdinaria->setPunitario($matricula->getValorMatricula());
            $itemMatriculaOrdinaria->setDescripcion($matriculaOrdinaria->getDescripcion()." Estudiante: ".$matricula->getMatriculacodestudiante());
            $itemMatriculaOrdinaria->setIdfactura($facturaDeMatricula);
            $itemMatriculaOrdinaria->setUserid($usuarioResponsable);
            
        $facturaDeMatricula->addItem($itemMatriculaOrdinaria);
        //fecha de vencimiento de factura por matricula 3 dias despues
        $facturaDeMatricula->setVencimiento(new \DateTime('+3 days'));
        $facturaDeMatricula->setPago(null);
        //calculando factura
        $facturaDeMatricula->calcularFactura();
        $em->persist($facturaDeMatricula);
        $em->flush();
        $pensionM=new Pension();
        $pensionM->setFactura($facturaDeMatricula);
            $pensionM->setEstudiante($matricula->getMatriculacodestudiante());
            
            $pensionM->setInfo("Matricula ".$matricula->getMatriculatipo());
            $em->persist($pensionM);
        
        //generando facturas pendientes de pension
        $diaDeVencimiento=5;// el 5 del siguiente mes
        $mesinicial=5;// primer mes es mayo
        $anio=date('Y');
        for($i=1 ;$i<=10;$i++)
        {
            $pension=new Pension();
            
            
            $facturaDePension=new Facturas();
            $facturaDePension->setIdcliente($representante);
                $itemPension=new Facturaitems();
                $itemPension->setCantidad(1);
                    $productopension=$em->getRepository('PayPayBundle:Productos')->findOneByDescripcionCorta("PENSION ".$i);
                    $itemPension->setIdproducto($productopension);
                    $itemPension->setPunitario($matricula->getValorPension());
                    $itemPension->setDescripcion($productopension->getDescripcion()." Estudiante: ".$matricula->getMatriculacodestudiante());
                $itemPension->setIdfactura($facturaDePension);
                $itemPension->setUserid($usuarioResponsable);
            //añadiendo item
            $facturaDePension->addItem($itemPension);    
            
            $fechaVencimiento=new \DateTime();
            $fechaVencimiento->setDate($anio, $mesinicial+$i, $diaDeVencimiento);
            $facturaDePension->setVencimiento($fechaVencimiento);
            $facturaDePension->setPago(null);
            
            $facturaDePension->calcularFactura();
            $em->persist($facturaDePension);
            $em->flush();
            $pension->setFactura($facturaDePension);
            $pension->setEstudiante($matricula->getMatriculacodestudiante());
            $pension->setInfo($productopension->getDescripcion());
            $em->persist($pension);
        }
        
    }
}

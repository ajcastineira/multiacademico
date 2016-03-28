<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//use FOS\RestBundle\Controller\FOSRestController;
//use FOS\RestBundle\Controller\Annotations as Rest;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Facturaitems;
use Multiservices\PayPayBundle\Entity\Productos;
use MultiacademicoBundle\Entity\Representates;

use Doctrine\Common\Collections\ArrayCollection;
use Multiservices\PayPayBundle\Bancos\Pichincha\FormatoEntrada;

/**
 * Pensiones controller.
 *
 * @Route("/pensiones")

 * @Security("has_role('ROLE_COLECTORA') or has_role('ROLE_ADMIN')")

 *  */
class PensionesController extends Controller
{

    protected function downloadFile(array $pensiones)
    {
        $string="";
        foreach ($pensiones as $pension)
        {    
        $formato=new FormatoEntrada();    
        $formato->llenarDesdeFactura($pension);
        $string.=$formato->devolverString();
        $string.="\n";
        }
       //// $string1 =" - Estado: ".$factura->getEstado();
        //$string2 =" - Fecha de Vencimiento : ".$factura->getVencimiento()->format('Y-d-m');

        $path = $this->get('kernel')->getRootDir();
        $file = "\Resources\Files\banco.txt";
        $filename = $path.$file;

        $f = fopen($filename, "x+");
        fwrite($f, $string);
      //  fwrite($f, $string1);
      //  fwrite($f, $string2);
        fclose($f);

        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type','text/plain');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.basename($filename).'"');
        $response->headers->set('Content-Transfer-Encoding', 'binary');
        $response->headers->set('Content-length', filesize($filename));
        $response->sendHeaders();
        $response->setContent(file_get_contents($filename));
        unlink($filename);
        return $response;
    }

    public function downloadAction(){
        return $this->downloadFile($this->facturas());
    }
    /**
     * 
     * @return array
     */
    protected function facturas()
    {
        $facturas = $this->getDoctrine()->getManager()->getRepository('MultiacademicoBundle:Pension')->findAll();
        return $facturas;
    }
}

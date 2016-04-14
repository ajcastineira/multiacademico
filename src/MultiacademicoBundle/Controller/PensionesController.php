<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//use FOS\RestBundle\Controller\FOSRestController;
//use FOS\RestBundle\Controller\Annotations as Rest;
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
        $string.="\r\n";
        }

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

    public function downloadAction($seccion='all'){
        return $this->downloadFile($this->facturas($seccion));
    }
    /**
     * 
     * @return array
     */
    protected function facturas($seccion)
    {
        $facturas = $this->getDoctrine()->getRepository('MultiacademicoBundle:Pension')->pensionesPendientes($seccion);
        return $facturas;
    }
}

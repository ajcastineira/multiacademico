<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

class FacturacionController extends Controller
{
    /**
     * @Route("/facturacion/pagos", name="facturacion_pagos")
     */
    public function pagosAction(Request $request)
    {

        $pagos[0]['valor1'] = 'PA1713621298!';
        $pagos[0]['valor2'] = 'USD0000000001000CTAAHO00000000000713507705';
        $pagos[0]['valor3'] = 'PAGO PRIMERA QUINCENA DE JULIO';
        $pagos[0]['valor4'] = 'C1713621298';
        $pagos[0]['valor5'] = 'ANALUCA ZAMBRANO CHRISTIAN PAUL ';
        $pagos[1]['valor1'] = 'PA1713621298!';
        $pagos[1]['valor2'] = 'USD0000000001000CTAAHO00000000000713507705';
        $pagos[1]['valor3'] = 'PAGO PRIMERA QUINCENA DE JULIO';
        $pagos[1]['valor4'] = 'C1713621298';
        $pagos[1]['valor5'] = 'ANALUCA ZAMBRANO CHRISTIAN PAUL ';
       
         // return $this->render('multiservices/pay/facturacion.html.twig', array( 'cobros' => $cobros, 'pagos' => $pagos));
        return $this->render('PayPayBundle:Factura:Pagos.html.twig', array( 'pagos' => $pagos));
// AppBundle:app:auth/directives/login-info.tpl.html.twig
        // return new Response($hello,array($));

    }
   

     /**
     * @Route("/facturacion/cobros", name="facturacion_cobro")
     */
 public function cobroAction(Request $request)
    {

       $cobros[0]['valor1'] = 'CO1713621298';
        $cobros[0]['valor2'] = 'USD0000000001000CTAAHO00000000000713507705';
        $cobros[0]['valor3'] = 'PAGO FACTURACION JULIO 2003';
        $cobros[0]['valor4'] = 'C1713621298';
        $cobros[0]['valor5'] = 'ANALUCA ZAMBRANO CHRISTIAN PAUL';
        $cobros[0]['valor6'] = '893 ';
        $cobros[1]['valor1'] = 'PA1713621298!';
        $cobros[1]['valor2'] = 'USD0000000001000CTAAHO00000000000713554631';
        $cobros[1]['valor3'] = 'PAGO SEGUNDA QUINCENA DE JULIO';
        $cobros[1]['valor4'] = 'C1713621298';
        $cobros[1]['valor5'] = 'JOSE ALEJANDRO CHRISTIAN PAUL ';
        $cobros[1]['valor6'] = '893 ';
$file = fopen("cobros".rand(0,100).".txt", "w");

$response = new Response();
foreach ($cobros as $key => $value) {
   
$pay[] = $value['valor1']."          ".$value['valor2'].$value['valor3']."          ".$value['valor4']." ".$value['valor5']."          ".$value['valor6']."\n";


}
foreach ($pay as $key) {
    # code...
   fwrite($file, $key);
}
   // fwrite($file, $pay[1]);
fclose($file);
$response->setContent($pay[0].$pay[1]);
$response->headers->remove('Cache-Control');
$response->headers->remove('Content-Type');
$response->headers->set('Content-Type', 'text/plain');
// $response->getContent();

// "<script type="text/javascript"> var a = document.documentElement.innerHTML; var file = new Blob([text], {type: type}); a.href = URL.createObjectURL(file); a.download = name; </script>";
 
return $response;

// return $this->render($response);
        // return $this->render('PayPayBundle:Factura:Cobros.html.twig', array( 'cobros' => $cobros));

    }

    

}


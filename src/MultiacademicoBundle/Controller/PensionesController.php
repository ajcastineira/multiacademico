<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Facturaitems;
use Multiservices\PayPayBundle\Entity\Productos;
use MultiacademicoBundle\Entity\Representates;

/**
 * Pensiones controller.
 *
 * @Route("/pensiones")
 */
class PensionesController extends Controller
{
    /**
     * Lists all Pensiones entities.
     *
     * @Route("", name="pensiones")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Pensiones entities.
     *
     * @Route("/api", name="pensiones_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Pensiones:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();
        // $entities = $em->getRepository('PayPayBundle:Productos')->findAll();
        // $entities = $em->getRepository('PayPayBundle:Productos')->findByServicio('Pension');
        // $entities = $em->getRepository('MultiacademicoBundle:Representantes')->findAll();
        // $entities = $em->getRepository('PayPayBundle:Facturas')->findAll();
        $entities = $em->getRepository('PayPayBundle:Facturaitems')->findByTipo('Pension');
        return array(
            'entities' => $entities,
            );
    }

    protected function downloadFile($contenido)
    {
        $string ="Id Factura : ".$contenido->getId();
        $string1 =" - Estado: ".$contenido->getEstado();
        $string2 =" - Fecha de Vencimiento : ".$contenido->getPago()->format('Y-d-m');

        $path = $this->get('kernel')->getRootDir();
        $file = "\Resources\Files\banco.txt";
        $filename = $path.$file;

        $f = fopen($filename, "x+");
        fwrite($f, $string);
        fwrite($f, $string1);
        fwrite($f, $string2);
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

    public function downloadAction($id){
        return $this->downloadFile($this->facturatxt($id));
    }

    protected function facturatxt($id)
    {
        $product = $this->getDoctrine()->getRepository('PayPayBundle:Facturas')->findOneById($id);
        return $product;
    }
}

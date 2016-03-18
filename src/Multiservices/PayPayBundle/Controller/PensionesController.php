<?php

namespace Multiservices\PayPayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Multiservices\PayPayBundle\Entity\Facturas;
use Multiservices\PayPayBundle\Entity\Productos;

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
     * @Template("PayPayBundle:Pensiones:index.html.twig")
     */
    public function indexApiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PayPayBundle:Productos')->findAll();

        return array(
            'entities' => $entities,
        );
    }}

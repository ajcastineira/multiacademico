<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
     /**
     * @Route("/", name="homepage")
     * @Route("/inicio", name="inicial")
     * @Route("/dashboard", name="dashboard")
     * @Method("GET")
     * Cache(expires="+1 minute") 
     **/
    public function inicioAction()
    {
        return $this->render('baseangular.html.twig');
    }
    
     /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/me", name="miperfil", options={"expose":true})
     * @Method("GET")
     */
    public function showMeAction()
    {
       return $this->render('::baseangular.html.twig');
    }
}

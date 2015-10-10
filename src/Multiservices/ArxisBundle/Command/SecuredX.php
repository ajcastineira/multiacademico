<?php

namespace Multiservices\ArxisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Multiservices\ArxisBundle\Entity\Sessions;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 *  Ro ute("/arxis")
 */
class SecuredController extends Controller
{
    /**
     * @Route("/login", name="_arxis_login")
     * R oute("/login", name="login")
     * @Route("/login_check", name="_security_check")
     * @Template()
     */
    public function loginAction(Request $request)
    {
       
        $request = $this->getRequest();
        $session = $request->getSession();
        // obtiene el error de inicio de sesión si lo hay

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
           
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
          
        }
       
        return array(
           // 'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
             'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }
    /**
     * @Route("/loginok", name="_login_ok")
     * 
     */
    public function createSession(Request $request)
    {
           // var_dump($this->get('security.context'));
           /* $iduser = $this->get('security.context')->getToken()->getUser()->getId();
            $entity = new Sessions($request,$iduser); 
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);               
            $em->flush();
            
            $em2 =$this->getDoctrine()->getManager();

            $usuario = $em2->getRepository('MultiservicesArxisBundle:Usuario')->find($iduser);
            
            $usuario->setLogin($request);

            $em2->persist($usuario);
            $em2->flush();
*/
           
            return new RedirectResponse($this->generateUrl('homepage'));
           
    }
    /**
     *  R o ute("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    
    /**
     * @Route("/logout", name="_arxis_logout")
     */
    public function logoutokAction()
    {
        // The security layer will intercept this request
        /*$iduser = $this->get('security.context')->getToken()->getUser()->getId();
        $em2 =$this->getDoctrine()->getManager();
         $usuario = $em2->getRepository('MultiservicesArxisBundle:Usuario')->find($iduser);
            
            $usuario->setStatus(0);

            $em2->persist($usuario);
            $em2->flush();*/
            return new RedirectResponse($this->generateUrl('_logout_ok'));
    }
    /**
     * @Route("/logoutok", name="_logout_ok")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
       
    }
}

<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MultiacademicoBundle\Entity\Distributivos;
use MultiacademicoBundle\Form\DistributivosType;
use MultiacademicoBundle\Form\CalificarCursoType;
use MultiacademicoBundle\Calificar\CursoACalificar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
/**
 * Distributivos controller.
 *
 * @Route("/midistributivo")
 */
class MiDistributivoController extends Controller
{

    /**
     * Lists all Distributivos entities.
     *
     * @Route("", name="midistributivo")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }

    /**
     * Lists all Distributivos entities.
     *
     * @Route("/api", name="midistributivo_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:index.html.twig")
     */
    public function miDistributivoAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        $entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);
        
        $misclubes= $em->getRepository('MultiacademicoBundle:Clubes')->misClubes($docente);

        return array(
            'entities' => $entities,
            'misclubes' => $misclubes,
        );
    }
    
    /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}", name="menu_calificar", options={"expose":true})
     * @Method("GET")
     */
    public function menuCalificarAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/api", name="menu_calificar_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menu.html.twig")
     */
    public function menuCalificarApiAction($id)
    {
        //$em = $this->getDoctrine()->getManager();
        
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        //$docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        //$entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);

        return array(
            null
        );
    }
    
    /**
     * printer pdf file.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/imprimir", name="imprimir_calificaciones", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:imprimir.html.twig")
     */
    public function imprimirAction($id,$q,$p)
    { 
                $url ='midistributivo/menu/'.$id.'/calificaciones/'.$q.'/'.$p.'/imprimir';
      // return new Response('<html><body>Hello test!</body></html>');
      $em = $this->getDoctrine()->getManager();
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);
        if (!$distributivo) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($id);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        return array(
            
            'curso'=>$curso, 'materia'=>$materia,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'form'   => $form->createView(),
            'url' => $url,
            // 'q' => $q,
            // 'p' => $p,
        );

    }





    /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}", name="calificaciones", options={"expose":true})
     * @Method("GET")
     */
    public function calificacionesAction($id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/api", name="calificaciones_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     */
    public function calificacionesApiAction($id,$q,$p)
    {

 /*         $url = $this->container->get('router')->generate(
            'imprimir_calificaciones',
            array('id' => '1')
        ); */ 
        $em = $this->getDoctrine()->getManager();
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);
        if (!$distributivo) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($id);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        $url ='midistributivo/menu/'.$id.'/calificaciones/'.$q.'/'.$p.'/imprimir';
             //midistributivo/menu/259/calificaciones/1/1/api
        return array(
            
            'curso'=>$curso, 'materia'=>$materia,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'url' => $url,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Creates a form to create a Calificaciones entity.
     *
     * @param CursoACalificar $cursoACalificar The curso a califcar
     * @param integer $q El quimestre
     * @param integer $p El parcial
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarForm(CursoACalificar $cursoACalificar,$q,$p)
    {
        $form = $this->createForm(new CalificarCursoType($q,$p), $cursoACalificar, array(
          //  'action' => $this->generateUrl('pasar_calificaciones_api',array('id'=>$cursoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', 'submit', array('label' => 'Guardar'));

        return $form;
    }
    /**
     * Edits an existing Calificaciones entity.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/api", name="pasar_calificaciones_api", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     */
    public function pasarCalificacionesAction(Request $request,$id,$q,$p)
    {
        $em = $this->getDoctrine()->getManager();
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);
        if (!$distributivo) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($id);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_api', array('id'=>$id,'q'=>$q,'p'=>$p)));
            
        }
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        return array(
            'curso'=>$curso, 'materia'=>$materia,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
            'form'   => $form->createView(),
        );
        
    }
        
    

    
}

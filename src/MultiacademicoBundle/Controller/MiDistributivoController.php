<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Distributivos;
use MultiacademicoBundle\Entity\Calificaciones;

use MultiacademicoBundle\Form\CalificarCursoType;
use MultiacademicoBundle\Calificar\CursoACalificar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
        $docente=$em->getRepository('MultiacademicoBundle:Docentes')->findOneByUsuario($user);
        $entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);
        
        $misclubes= $em->getRepository('MultiacademicoBundle:Clubes')->misClubes($docente);
        $misaulas= $em->getRepository('MultiacademicoBundle:Aula')->misAulas($docente);
        $misasistencias=$em->getRepository('MultiacademicoBundle:Aula')->misAulasAsistencia($docente);

        return array(
            'entities' => $entities,
            'misclubes' => $misclubes,
            'misaulas' => $misaulas,
            'misasistencias' => $misasistencias,
        );
    }
    
    /**
     * Lists all Distributivos entities.
     
     * @Route("/menu/{id}", name="menu_calificar", options={"expose":true})
     * @Method("GET")
     * @Security("(is_granted('DISTRIBUTIVO_VIEW',id) and has_role('ROLE_DOCENTE')) or has_role('ROLE_SECRETARIA')")
     */
    public function menuCalificarAction(Distributivos $id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/api", name="menu_calificar_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menu.html.twig")
     * @Security("(is_granted('DISTRIBUTIVO_VIEW',id) and has_role('ROLE_DOCENTE')) or has_role('ROLE_SECRETARIA')")
     */
    
    public function menuCalificarApiAction(Distributivos $id)
    {
        //$em = $this->getDoctrine()->getManager();
        
        //$user = $this->get('security.token_storage')->getToken()->getUser();
        //var_dump($user);
        //$docente=$em->getRepository('MultiacademicoBundle:Docentes')->findByUsuario($user);
        //$entities = $em->getRepository('MultiacademicoBundle:Distributivos')->miDistributivo($docente);

        return array(
            'aula_id' => $id->getAula()->getId()
        );
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/tutor/{aula}", name="menu_tutor", options={"expose":true})
     * Route("/tutor/{aula}/", name="menu_tutor", options={"expose":true})
     * @Method("GET")
     */
    public function menuTutorAction()
    {
        return $this->render('::baseangular.html.twig');
    }
    
    /**
     * Lists all Distributivos entities.
     *
     * @Route("/tutor/{aula}/api", name="menu_tutor_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:MiDistributivo:menututor.html.twig")
     */
    
    public function menuTutorApiAction()
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
     * @Template("MultiacademicoBundle:Calificaciones:imprimir.html.twig")
     * @Security("(is_granted('DISTRIBUTIVO_VIEW',id) and has_role('ROLE_DOCENTE')) or has_role('ROLE_SECRETARIA')")
     */
    public function imprimirAction(Distributivos $id,$q,$p)
    { 
                
        $em = $this->getDoctrine()->getManager();
        $periodo = $em->getRepository('MultiacademicoBundle:Periodos')->find(1);
        if (!$periodo) {
            throw $this->createNotFoundException('El periodo no esta configurado.');
        }
        $distributivo = $em->getRepository('MultiacademicoBundle:Distributivos')->find($id);
        if (!$distributivo) {
            throw $this->createNotFoundException('Unable to find Distributivos entity.');
        }
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        $docente=$distributivo->getDistributivocoddocente();
        return array(
            'periodo'=>$periodo,
            'curso'=>$curso, 'materia'=>$materia, 'docente'=>$docente,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado
        );

    }





    /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}", name="calificaciones", options={"expose":true})
     * @Method("GET")
     * @Security("(is_granted('DISTRIBUTIVO_VIEW',id) and has_role('ROLE_DOCENTE')) or has_role('ROLE_SECRETARIA')")
     * 
     */
    public function calificacionesAction(Distributivos $id)
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/api", name="calificaciones_api", options={"expose":true})
     * @Method("GET")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     * @Security("('ROLE_DOCENTE')")
     */
    public function calificacionesApiAction(Distributivos $distributivo,$q,$p)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA'))
        {    
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir calificaciones en los cursos asignados a su distributivo!');
        }
        $em = $this->getDoctrine()->getManager();
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($distributivo->getId(),$parcial);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        // comparando si el listado de calificaciones no ha sido creado
        $matriculados=$distributivo->getAula()->getMatriculados();
        $numMatriculados=count($matriculados);
        if ($numMatriculados>count($listado))
        {
            $this->crearCuadrosDeCalificaciones($listado, $distributivo);
            $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        }
        $cursoACalificar->setCalificaciones($listado);
        
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        $curso=$distributivo->getCursoName();
        $materia=$distributivo->getDistributivocodmateria();
        
        return array(
            
            'curso'=>$curso, 'materia'=>$materia,
            'parcial'=>$parcial,'qactivo'=>$qactivo,  'pactivo'=>$pactivo,
            'listado' => $listado,
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
        $form = $this->createForm( CalificarCursoType::class, $cursoACalificar, array(
          //  'action' => $this->generateUrl('pasar_calificaciones_api',array('id'=>$cursoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', SubmitType::class, array('label' => 'Guardar'));

        return $form;
    }
    /**
     * Edits an existing Calificaciones entity.
     *
     * @Route("/menu/{id}/calificaciones/{q}/{p}/api", name="pasar_calificaciones_api", options={"expose":true})
     * @Method("PUT")
     * @Template("MultiacademicoBundle:Calificaciones:calificar.html.twig")
     * @Security("has_role('ROLE_DOCENTE')")
     */
    public function pasarCalificacionesAction(Request $request,Distributivos $distributivo,$q,$p)
    {

        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir calificaciones en sus cursos asignados!');
        $em = $this->getDoctrine()->getManager();
     
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($distributivo->getId(),$parcial);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->flush();
            

            return $this->redirect($this->generateUrl('calificaciones_api', array('id'=>$distributivo->getId(),'q'=>$q,'p'=>$p)));
            
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
    
    
    private function crearCuadrosDeCalificaciones($listado, Distributivos $distributivo){
            
            $em=$this->getDoctrine()->getManager();
            //Definiedo ArrayColection 
            $matriculasEnListado=new \Doctrine\Common\Collections\ArrayCollection();
            //llenando array
            foreach ($listado as $listacalificacion)
            {
              $matriculasEnListado[]=$listacalificacion->getComportamientonummatricula();
            }
            //obteniendo lista de matriculados
            $matriculados=$distributivo->getAula()->getMatriculados();
            foreach ($matriculados as $matricula) {
                if (!$matriculasEnListado->contains($matricula))
                {   
                $calificacion=new Calificaciones();
                $calificacion->setCalificacioncodmateria($distributivo->getDistributivocodmateria());
                $calificacion->setCalificacionnummatricula($matricula);
                $em->persist($calificacion);
                }
            }
            $em->flush(); //Persistiendo objetos en base de datos
    }
   
}

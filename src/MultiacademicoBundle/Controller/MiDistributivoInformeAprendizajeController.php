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

use MultiacademicoBundle\Form\CalificarInformeAprendizajeType;
use MultiacademicoBundle\Calificar\CursoACalificar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Distributivos controller.
 *
 * @Route("/midistributivo/menu")
 */
class MiDistributivoInformeAprendizajeController extends Controller
{


    /**
     * Lists all Distributivos entities.
     *
     * @Route("/{distributivo}/informeaprendizaje/{q}/{p}", name="calificaciones_informeaprendizaje", options={"expose":true})
     * @Method("GET")
     */
    public function menuMainAction()
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/informeaprendizaje/{q}/{p}/api", name="calificaciones_informeaprendizaje_api", options={"expose":true})
     * @Method({"GET","PUT"})
     * @Template("MultiacademicoBundle:Calificaciones:calificarInformeAprendizaje.html.twig")
     * @Security("('ROLE_DOCENTE')")
     */
    public function informeaprendizajeApiAction(Request $request, Distributivos $distributivo, $q, $p)
    {
        /*if (!$this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA'))
        {    
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir informeaprendizaje en los cursos asignados a su distributivo!');
        }*/
        
        $em = $this->getDoctrine()->getManager();
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $cursoACalificar=new CursoACalificar($distributivo->getId(),$parcial);
        $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        // comparando si el listado de informeaprendizaje no ha sido creado
        $matriculados=$distributivo->getAula()->getMatriculados();
        $numMatriculados=count($matriculados);
        if ($numMatriculados>count($listado))
        {
            $this->crearCuadrosDeCalificaciones($listado, $distributivo);
            $listado = $em->getRepository('MultiacademicoBundle:Calificaciones')->calificacionesDistributivo($distributivo);
        }
        
        $cursoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($cursoACalificar,$qactivo,$pactivo);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()&&$form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_informeaprendizaje_api', array('id'=>$distributivo->getId(),'q'=>$q,'p'=>$p)));
            
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
    
    /**
     * Creates a form to create a Comportamiento entity.
     *
     * @param CursoACalificar $cursoACalificar The curso a califcar
     * @param integer $q El quimestre
     * @param integer $p El parcial
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCalificarForm(CursoACalificar $cursoACalificar,$q,$p)
    {
        $form = $this->createForm( CalificarInformeAprendizajeType::class, $cursoACalificar, array(
          //  'action' => $this->generateUrl('pasar_informeaprendizaje_api',array('id'=>$cursoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', SubmitType::class, array('label' => 'Guardar'));

        return $form;
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

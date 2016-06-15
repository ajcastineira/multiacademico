<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MultiacademicoBundle\Entity\Aula;
use MultiacademicoBundle\Entity\Asistencia;

use MultiacademicoBundle\Form\RegistrarAsistenciaType;
use MultiacademicoBundle\Calificar\AsistenciasARegistrar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Distributivos controller.
 *
 * @Route("/midistributivo/inspector")
 */
class MiDistributivoAsistenciaController extends Controller
{


    /**
     * Lists all Distributivos entities.
     *
     * @Route("/{aula}", name="menu_inspector", options={"expose":true})
     * @Route("/{aula}/asistencia/{q}/{p}", name="registrar_asistencias", options={"expose":true})
     * @Method("GET")
     */
    public function menuInspectorAction()
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/asistencia/{q}/{p}/api", name="registrar_asistencias_api", options={"expose":true})
     * @Method({"GET","PUT"})
     * @Template("MultiacademicoBundle:Calificaciones:registrarAsistencia.html.twig")
     * @Security("('ROLE_DOCENTE')")
     */
    public function asistenciaApiAction(Request $request, Aula $aula, $q, $p)
    {
       /* if (!$this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA'))
        {    
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir comportamiento en los cursos asignados a su distributivo!');
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir comportamiento en sus cursos asignados!');
        }*/
        
        $em = $this->getDoctrine()->getManager();
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $asistenciaARegistrar=new AsistenciasARegistrar($aula->getId(),$parcial);
        $listado = $em->getRepository('MultiacademicoBundle:Asistencia')->asistenciaAula($aula);
        // comparando si el listado de comportamiento no ha sido creado
        $matriculados=$aula->getMatriculados();
        $numMatriculados=count($matriculados);
        if ($numMatriculados>count($listado))
        {
            $this->crearCuadrosDeAsistencia($listado, $aula);
            $listado = $em->getRepository('MultiacademicoBundle:Asistencia')->asistenciaAula($aula);
        }
        
        $asistenciaARegistrar->setAsistencias($listado);
        $form = $this->createRegistrarAsitenciaForm($asistenciaARegistrar,$qactivo,$pactivo);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()&&$form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registrar_asistencias_api', array('id'=>$aula->getId(),'q'=>$q,'p'=>$p)));
            
        }
        
        return array(
            
            'aula'=>$aula,
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
    private function createRegistrarAsitenciaForm(AsistenciasARegistrar $asistenciasARegistrar,$q,$p)
    {
        $form = $this->createForm( RegistrarAsistenciaType::class, $asistenciasARegistrar, array(
          //  'action' => $this->generateUrl('pasar_comportamiento_api',array('id'=>$cursoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', SubmitType::class, array('label' => 'Guardar'));

        return $form;
    }
    
    private function crearCuadrosDeAsistencia($listado, Aula $aula){
            
            $em=$this->getDoctrine()->getManager();
            //Definiedo ArrayColection 
            $matriculasEnListado=new \Doctrine\Common\Collections\ArrayCollection();
            //llenando array
            foreach ($listado as $listacalificacion)
            {
              $matriculasEnListado[]=$listacalificacion->getAsistencianummatricula();
            }
            //obteniendo lista de matriculados
            $matriculados=$aula->getMatriculados();
            foreach ($matriculados as $matricula) {
                if (!$matriculasEnListado->contains($matricula))
                {   
                $asistencia=new Asistencia();
                $asistencia->setAsistencianummatricula($matricula);
                $em->persist($asistencia);
                }
            }
            $em->flush(); //Persistiendo objetos en base de datos
    }
   
}

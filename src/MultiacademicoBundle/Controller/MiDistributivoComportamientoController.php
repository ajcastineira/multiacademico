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
use MultiacademicoBundle\Entity\Comportamiento;

use MultiacademicoBundle\Form\CalificarComportamientoType;
use MultiacademicoBundle\Calificar\ComportamientoACalificar;
use MultiacademicoBundle\Libs\Parcial;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Distributivos controller.
 *
 * @Route("/midistributivo/tutor")
 */
class MiDistributivoComportamientoController extends Controller
{


    /**
     * Lists all Distributivos entities.
     *
     * @Route("/{aula}", name="menu_tutor", options={"expose":true})
     * @Route("/{aula}/comportamiento/{q}/{p}", name="calificaciones_comportamiento", options={"expose":true})
     * @Method("GET")
     */
    public function menuTutorAction()
    {
        return $this->render('::baseangular.html.twig');
    }
    
     /**
     * Lists all Distributivos entities.
     *
     * @Route("/{id}/comportamiento/{q}/{p}/api", name="calificaciones_comportamiento_api", options={"expose":true})
     * @Method({"GET","PUT"})
     * @Template("MultiacademicoBundle:Calificaciones:calificarcomportamiento.html.twig")
     * @Security("('ROLE_DOCENTE')")
     */
    public function comportamientoApiAction(Request $request, Aula $aula, $q, $p)
    {
       /* if (!$this->get('security.authorization_checker')->isGranted('ROLE_SECRETARIA'))
        {    
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir comportamiento en los cursos asignados a su distributivo!');
        $this->denyAccessUnlessGranted('DISTRIBUTIVO_VIEW', $distributivo, 'Usted solo puede escribir comportamiento en sus cursos asignados!');
        }*/
        
        $em = $this->getDoctrine()->getManager();
        $qactivo=$q;   $pactivo=$p;
        $parcial=new Parcial($qactivo,$pactivo);
        $comportamientoACalificar=new ComportamientoACalificar($aula->getId(),$parcial);
        $listado = $em->getRepository('MultiacademicoBundle:Comportamiento')->comportamientoAula($aula);
        // comparando si el listado de comportamiento no ha sido creado
        $matriculados=$aula->getMatriculados();
        $numMatriculados=count($matriculados);
        if ($numMatriculados>count($listado))
        {
            $this->crearCuadrosDeComportamiento($listado, $aula);
            $listado = $em->getRepository('MultiacademicoBundle:Comportamiento')->comportamientoAula($aula);
        }
        
        $comportamientoACalificar->setCalificaciones($listado);
        $form = $this->createCalificarForm($comportamientoACalificar,$qactivo,$pactivo);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()&&$form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_comportamiento_api', array('id'=>$aula->getId(),'q'=>$q,'p'=>$p)));
            
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
    private function createCalificarForm(ComportamientoACalificar $comportamientoACalificar,$q,$p)
    {
        $form = $this->createForm( CalificarComportamientoType::class, $comportamientoACalificar, array(
          //  'action' => $this->generateUrl('pasar_comportamiento_api',array('id'=>$cursoACalificar->getDistributivoId(),'q'=>$q,'p'=>$p)),
            'method' => 'PUT',
        ));

        $form->add('guardar', SubmitType::class, array('label' => 'Guardar'));

        return $form;
    }
    
    private function crearCuadrosDeComportamiento($listado, Aula $aula){
            
            $em=$this->getDoctrine()->getManager();
            //Definiedo ArrayColection 
            $matriculasEnListado=new \Doctrine\Common\Collections\ArrayCollection();
            //llenando array
            foreach ($listado as $listacalificacion)
            {
              $matriculasEnListado[]=$listacalificacion->getComportamientonummatricula();
            }
            //obteniendo lista de matriculados
            $matriculados=$aula->getMatriculados();
            foreach ($matriculados as $matricula) {
                if (!$matriculasEnListado->contains($matricula))
                {   
                $comportamiento=new Comportamiento();
                $comportamiento->setComportamientonummatricula($matricula);
                $em->persist($comportamiento);
                }
            }
            $em->flush(); //Persistiendo objetos en base de datos
    }
   
}

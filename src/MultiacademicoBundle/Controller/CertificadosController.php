<?php

namespace MultiacademicoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Certificados controller.
 *
 * @Route("")
 * 
 */
class CertificadosController extends Controller
{

    /**
     * Lists all Materias entities.
     *
     * @Route("/certificados", name="cetificados")
     * @Route("/certificados/matricula", name="cetificadosmatricula")
     * @Route("/certificados/promocion", name="cetificadospromocion")
     * @Route("/certificados/matricula/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}", name="certificados-matricula-front")
     * @Route("/certificados/promocion/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}", name="certificados-promocion-front")
     * @Method("GET")
     */
    public function indexAction()
    {
       return $this->render('::baseangular.html.twig');
    }
    
    /**
     * Certificados de Matriculas por curso.
     *
     * @Route("/api/certificados/matricula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}", name="certificados-matricula-curso-api", options={"expose":true})
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function certificadoMatriculaCursoAction(Request $request,$curso,$especializacion,$paralelo,$seccion,$periodo)
    {
       $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('MultiacademicoBundle:Entidad')->find(1);
        if (!$entidad) {
            throw $this->createNotFoundException('La entidad o institucion no esta configurada.');
        }
        
        $rector= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Rector');
        if (!$rector) {
            $rector= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Rectora');
            if (!$rector) {
            throw $this->createNotFoundException('El rector no esta configurado.');
            }
        }
        $secretaria= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Secretaria');
        if (!$secretaria) {
            throw $this->createNotFoundException('La secretaria no esta configurada.');
        }
        
        $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$curso,
                                                                          'especializacion'=>$especializacion,
                                                                          'paralelo'=>$paralelo,
                                                                          'seccion'=>$seccion,
                                                                          'periodo'=>$periodo
                                                                           )
                                                                    );
        
        return array(
            'entidad'=>$entidad,
            'aula'=>$aula,
            'rector'=>$rector,
            'secretaria'=>$secretaria);
    }
    /**
     * Certificados de Matriculas por curso.
     *
     * @Route("/api/certificados/promocion/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}", name="certificados-promocion-curso-api", options={"expose":true})
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function certificadoPromocionCursoAction(Request $request,$curso,$especializacion,$paralelo,$seccion,$periodo)
    {
       $em = $this->getDoctrine()->getManager();
        $entidad = $em->getRepository('MultiacademicoBundle:Entidad')->find(1);
        if (!$entidad) {
            throw $this->createNotFoundException('La entidad o institucion no esta configurada.');
        }
        
        $rector= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Rector');
        $pron_r='el';
        if (!$rector) {
            $rector= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Rectora');
            $pron_r='la';
            if (!$rector) {
            throw $this->createNotFoundException('El rector no esta configurado.');
            }
        }
        $secretaria= $em->getRepository('MultiservicesArxisBundle:Usuario')->findOneByCargo('Secretaria');
        $pron_s='la';
        if (!$secretaria) {
            throw $this->createNotFoundException('La secretaria no esta configurada.');
        }
        
        
      
       //    $this->rector=mb_strtoupper("$trato_r $rector");
       //    $this->cargorector=mb_strtoupper("$cargo_r");
       //    $this->elrector="$pron_r $cargo_r";
      //     $this->secretaria=mb_strtoupper("$trato_s $secretaria");
      //     $this->cargosecretaria=mb_strtoupper("$cargo_s");
    //       $this->lasecretaria="$pron_s $cargo_s";
        $aula=$em->getRepository('MultiacademicoBundle:Aula')->find(
                                                                    array(
                                                                          'curso'=>$curso,
                                                                          'especializacion'=>$especializacion,
                                                                          'paralelo'=>$paralelo,
                                                                          'seccion'=>$seccion,
                                                                          'periodo'=>$periodo
                                                                           )
                                                                    );
        
        $sigcurso=$em->getRepository('MultiacademicoBundle:Cursos')->findOneByNivel($aula->getCurso()->getNivel()+1);
        return array(
            'entidad'=>$entidad,
            'aula'=>$aula,
            'sigcurso'=>$sigcurso,
            'rector'=>$rector,
            'secretaria'=>$secretaria,
            'pron_r'=>$pron_r,
            'pron_s'=>$pron_s);
    }

}

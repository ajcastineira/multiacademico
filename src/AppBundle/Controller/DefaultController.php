<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;


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
    
     /**
     * Update Estudiantes.
     *
     * @Route("/updateusers", name="updateclaves", options={"expose":true})
     * @Method("GET")
     */
    public function updateUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matriculas = $em->getRepository('MultiacademicoBundle:Matriculas')->matriculadosSinClave();
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $content="";
        $c=0;
         $output = new BufferedOutput();
        foreach ($matriculas as $matricula) {
            $user=$matricula->getId();
            $pass=$user;
            $userest=$matricula->getMatriculacodestudiante()->getUsuario();
            
            echo $c;
            if (isset($userest)&&($userest->getPassword()==""))
            {
                $input = new ArrayInput(array(
                'command' => 'fos:user:change-password',
                'username' => $user,
                'password' => $pass
                ));
                $output = new BufferedOutput();
                // You can use NullOutput() if you don't need the output
               
                $application->run($input, $output);
                $content = $output->fetch();
                echo $content;
                // return the output, don't use if you used NullOutput()
               
            }
            if ($c>100){break;}
            $c++;
             
        }
        
        // return new Response(""), if you used NullOutput()
        return new Response($content);
        
    }
}

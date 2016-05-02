<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AulaRepository extends EntityRepository
{
    
    public function findByDatos($curso,$especializacion,$paralelo,$seccion,$periodo)
    {
        $aula=$this->getEntityManager()->getRepository('MultiacademicoBundle:Aula')->findOneBy(
                                                                    array(
                                                                          'curso'=>$curso,
                                                                          'especializacion'=>$especializacion,
                                                                          'paralelo'=>$paralelo,
                                                                          'seccion'=>$seccion,
                                                                          'periodo'=>$periodo
                                                                           )
                                                                    );
        return $aula;
    }
    public function misAulas($docente)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM MultiacademicoBundle:Aula a '
                    . ' where a.tutor= :docente'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":docente", $docente)
            ->getResult();
    }
    
    public function misAulasByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a'
                    . ' FROM MultiacademicoBundle:Aula a JOIN a.tutor u '
                    . ' where u.usuario= :usuario'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":usuario", $user)
            ->getResult();
    }
    
    public function matriculadosPorSexo()
    {
        $result=[];
        $aulas=$this->getEntityManager()
            ->createQuery('SELECT a as aula, count(m) as total'
                    . ' FROM MultiacademicoBundle:Aula a '
                    . ' JOIN a.matriculados m '
                    . ' JOIN m.matriculacodestudiante e'
                    //. ' JOIN m.matriculacodestudiante e'
               //     . ' WHERE e.estudianteGenero=:genero '
                    . ' GROUP BY a '
                    //. ' ORDER BY a.id'
                    )
           // ->setParameter(":genero", "Masculino")
            ->getResult();
       
        foreach ($aulas as &$aula)
        {
            $aula["masculino"]=$this->masculinosAula($aula['aula']);
            $aula["femenino"]=$this->femeninosAula($aula['aula']);
        }

        return $aulas;
    }
    
    public function masculinosAula($aula)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(m)'
                    . ' FROM MultiacademicoBundle:Aula a '
                    . ' JOIN a.matriculados m '
                    . ' JOIN m.matriculacodestudiante e'
                    //. ' JOIN m.matriculacodestudiante e'
                    . ' WHERE e.estudianteGenero=:genero AND a.id=:aula'
                  //  . ' GROUP BY e.estudianteGenero '
                    //. ' ORDER BY a.id'
                    )
            ->setParameters([":genero"=> "Masculino",
                             ":aula"=>$aula])
            ->getSingleScalarResult();
    }
    
    public function femeninosAula($aula)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT count(m) as total'
                    . ' FROM MultiacademicoBundle:Aula a '
                    . ' JOIN a.matriculados m '
                    . ' JOIN m.matriculacodestudiante e'
                    //. ' JOIN m.matriculacodestudiante e'
                    . ' WHERE e.estudianteGenero=:genero AND a=:aula'
                   // . ' GROUP BY e.estudianteGenero '
                    //. ' ORDER BY a.id'
                    )
            ->setParameters([":genero"=> "Femenino",
                             ":aula"=>$aula])
            ->getSingleScalarResult();
    }
   /*public function alumnosClub(Clubes $club)
    {
        $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();*/
        /*return $this->getEntityManager()
            ->createQuery('SELECT m'
                    . ' FROM MultiacademicoBundle:Matriculas m '
                    . ' where m.matriculacodcurso=:curso and'
                    .' m.matriculacodespecializacion=:especializacion and'
                    .' m.matriculaparalelo=:paralelo and'
                    .' m.matriculacodperiodo=:periodo and'
                    .' m.matriculaseccion=:seccion '
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":curso", $curso)
            ->setParameter(":especializacion", $especializacion)
            ->setParameter(":paralelo", $paralelo)
            ->setParameter(":periodo", $periodo)
            ->setParameter(":seccion", $seccion)
            ->getResult();
    }  */
}

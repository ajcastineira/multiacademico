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

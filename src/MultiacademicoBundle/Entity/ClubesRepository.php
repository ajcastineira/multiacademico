<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ClubesRepository extends EntityRepository
{
    
   public function misClubes($docente)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c'
                    . ' FROM MultiacademicoBundle:Clubes c '
                    . 'where c.clubcoddocente=:docente'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":docente", $docente)
            ->getResult();
    }
    
    public function misClubesByUser($user)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c'
                    . ' FROM MultiacademicoBundle:Clubes c join c.clubcoddocente d'
                    . ' where d.usuario=:usuario'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":usuario", $user)
            ->getResult();
    }
    
    public function mostrarClub($id)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c, l , e, m '
                    . ' FROM MultiacademicoBundle:Clubes c '
                    . ' join c.registrados l '
                    . ' join l.clubescodestudiante e '
                    . ' join e.matriculas m '
                    . ' where c=:club'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":club", $id)
            ->getOneOrNullResult();
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

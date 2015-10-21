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

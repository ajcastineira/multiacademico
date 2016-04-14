<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DistributivosRepository extends EntityRepository
{
    
   public function miDistributivo($docente)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT d'
                    . ' FROM MultiacademicoBundle:Distributivos d '
                    . ' join d.distributivocodmateria m '
                    . ' where d.distributivocoddocente=:docente and '
                    . ' m.materia != :materia'
                    //. ' ORDER BY n.notificaciontimestamp DESC'
                    )
            ->setParameter(":docente", $docente)
            ->setParameter(":materia", "Tutor/a")
            ->getResult();
    }
    
   public function alumnosDistributivo(Distributivos $distributivo)
    {
        $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        return $this->getEntityManager()
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
    }  
}

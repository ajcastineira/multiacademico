<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CalificacionesRepository extends EntityRepository
{
    
   public function calificacionesDistributivo(Distributivos $distributivo)
    {
        $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        $materia=$distributivo->getDistributivocodmateria();
        
        return $this->getEntityManager()
            ->createQuery('SELECT c '
                    . ' FROM MultiacademicoBundle:Calificaciones c'
                    . ' JOIN c.calificacionnummatricula m '
                    . ' JOIN m.matriculacodestudiante e'
                    . ' where c.calificacioncodmateria=:materia and'
                    . ' m.matriculacodcurso=:curso and'
                    .' m.matriculacodespecializacion=:especializacion and'
                    .' m.matriculaparalelo=:paralelo and'
                    .' m.matriculacodperiodo=:periodo and'
                    .' m.matriculaseccion=:seccion '
                    .' ORDER BY e.estudiante asc '
                    )
            ->setParameter(":materia", $materia)
            ->setParameter(":curso", $curso)
            ->setParameter(":especializacion", $especializacion)
            ->setParameter(":paralelo", $paralelo)
            ->setParameter(":periodo", $periodo)
            ->setParameter(":seccion", $seccion)
            ->getResult();
    } 
    
    public function calificacionesDistributivoReporte(Distributivos $distributivo)
    {
        $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        $materia=$distributivo->getDistributivocodmateria();
        
        return $this->getEntityManager()
            ->createQuery('SELECT e.id as codestudiante, e.estudiante, m.id as nummatricula, c '
                    . ' FROM MultiacademicoBundle:Calificaciones c'
                    . ' JOIN c.calificacionnummatricula m '
                    . ' JOIN m.matriculacodestudiante e'
                    . ' where c.calificacioncodmateria=:materia and'
                    . ' m.matriculacodcurso=:curso and'
                    .' m.matriculacodespecializacion=:especializacion and'
                    .' m.matriculaparalelo=:paralelo and'
                    .' m.matriculacodperiodo=:periodo and'
                    .' m.matriculaseccion=:seccion '
                    .' ORDER BY e.estudiante asc '
                    )
            ->setParameter(":materia", $materia)
            ->setParameter(":curso", $curso)
            ->setParameter(":especializacion", $especializacion)
            ->setParameter(":paralelo", $paralelo)
            ->setParameter(":periodo", $periodo)
            ->setParameter(":seccion", $seccion)
            ->getResult();
    } 
}

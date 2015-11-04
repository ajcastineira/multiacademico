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
            ->createQuery('SELECT c, m, e '
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
    
    public function MejoresEstudiantesGeneralParcial($q,$p)
    {
        $sump="";
        for ($n=1;$n<=5;$n++)
        {
          $sump.='c.q'.$q.'P'.$p.'N'.$n;
          $sump.='+';
        }
        $sump.='0';
        
        
        return $this->getEntityManager()
            ->createQuery('SELECT u.id as uid, c as calificaciones, e.estudiante as estudiante, avg(('.$sump.')/5) as promp, cur.curso, m.matriculaparalelo as paralelo , esp.especializacion , m.matriculaseccion as seccion '
                    . ' FROM MultiacademicoBundle:Calificaciones c '
                    . ' join c.calificacionnummatricula m  '
                    . ' join m.matriculacodestudiante e  '
                    . ' join e.usuario u '
                    . ' join m.matriculacodcurso cur  '
                    . ' join m.matriculacodespecializacion esp  '
                    //. ' where c.q1P1N1 '
                    . ' GROUP BY c.calificacionnummatricula '
                    . ' ORDER BY promp  DESC'
                    )
            //->setParameter(":pass", "")
           ->setMaxResults(5)
           ->getResult();
    }
    
    public function MejoresEstudiantesGeneralQuimestre($q)
    {
        $sump="";
        for ($p=1;$p<=3;$p++)
        {
        for ($n=1;$n<=5;$n++)
        {
          $sump.='c.q'.$q.'P'.$p.'N'.$n;
          $sump.='+';
        }
        }
        $sump.='0';
        $sumq='((('.$sump.')/15)*0.8)+(c.q'.$q.'Ex*0.2)';//+((c.q".$q."Ex)*0.2)";
         return $this->getEntityManager()
            ->createQuery('SELECT u.id as uid, c as calificaciones, e.estudiante, avg('.$sumq.') as promq, cur.curso, m.matriculaparalelo as paralelo , esp.especializacion , m.matriculaseccion as seccion '
                    . ' FROM MultiacademicoBundle:Calificaciones c '
                    . ' join c.calificacionnummatricula m  '
                    . ' join m.matriculacodestudiante e  '
                    . ' join m.matriculacodcurso cur  '
                    . ' join m.matriculacodespecializacion esp  '
                     . ' join e.usuario u '
                    //. ' where c.q1P1N1 '
                    . ' GROUP BY c.calificacionnummatricula '
                    . ' ORDER BY promq DESC'
                    )
            //->setParameter(":pass", "")
           ->setMaxResults(5)
           ->getResult();
    }
}

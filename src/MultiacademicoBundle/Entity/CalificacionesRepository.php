<?php
/**
 * Description of NotificacionesRepository
 *
 * @author Rene Arias <renearias@axis.la>
 */
namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Monolog\Handler\Curl\Util;

class CalificacionesRepository extends EntityRepository
{
    
    public function crearCursoACalificar(Distributivos $distributivo)
    {
        return null;
    }
    public function numeroMatriculadosDelDistributivo(Distributivos $distributivo)
    {
       $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        
        return $this->getEntityManager()
            ->createQuery('SELECT count(m) '
                    . ' FROM MultiacademicoBundle:Matriculas m'
                    . ' where  m.matriculacodcurso=:curso and'
                    .' m.matriculacodespecializacion=:especializacion and'
                    .' m.matriculaparalelo=:paralelo and'
                    .' m.matriculacodperiodo=:periodo and'
                    .' m.matriculaseccion=:seccion '
                    )
            ->setParameter(":curso", $curso)
            ->setParameter(":especializacion", $especializacion)
            ->setParameter(":paralelo", $paralelo)
            ->setParameter(":periodo", $periodo)
            ->setParameter(":seccion", $seccion)
            ->getSingleScalarResult(); 
    }
         
    public function matriculadosDelDistributivo(Distributivos $distributivo)
    {
       $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        
        return $this->getEntityManager()
            ->createQuery('SELECT m '
                    . ' FROM MultiacademicoBundle:Matriculas m'
                    . ' where m.matriculacodcurso=:curso and'
                    .' m.matriculacodespecializacion=:especializacion and'
                    .' m.matriculaparalelo=:paralelo and'
                    .' m.matriculacodperiodo=:periodo and'
                    .' m.matriculaseccion=:seccion '
                    )
            ->setParameter(":curso", $curso)
            ->setParameter(":especializacion", $especializacion)
            ->setParameter(":paralelo", $paralelo)
            ->setParameter(":periodo", $periodo)
            ->setParameter(":seccion", $seccion)
            ->getResult(); 
    }
           
    public function calificacionesDistributivo(Distributivos $distributivo)
    {
        $curso=$distributivo->getDistributivocodcurso();
        $especializacion=$distributivo->getDistributivocodespecializacion();
        $paralelo=$distributivo->getDistributivoparalelo();
        $periodo=$distributivo->getDistributivocodperiodo();
        $seccion=$distributivo->getDistributivoseccion();
        $materia=$distributivo->getDistributivocodmateria();
        
        //$cacheId = 'Activity_';
        
        $parameters=[
            
            ":materia" => $materia,
            ":curso" => $curso,
            ":especializacion" => $especializacion,
            ":paralelo" => $paralelo,
            ":periodo" => $periodo,
            ":seccion" => $seccion
            
        ];
        
        /** @var Parameter $parameter */
        /*foreach ($parameters as $parameter) {
         $cacheId .= serialize($parameter);
        }
        $cacheId = md5($cacheId);*/
        
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
            ->setParameters($parameters)
            //->useQueryCache(true)
            //->useResultCache(true, 3600, $cacheId)
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
    public function calificacionesDeMateriaEnAula(Aula $aula, Materias $materia) {
        return $this->getEntityManager()->createQueryBuilder()
                ->select('calificaciones')
                ->from('MultiacademicoBundle:Calificaciones','calificaciones')
                ->join('calificaciones.calificacionnummatricula','matricula')
                ->join('matricula.aula','aula')
                //->join('aula.curso','curso')
                ->where('calificaciones.calificacioncodmateria=:materia and aula=:aula')
                ->setParameters([
                    'materia'=>$materia,
                    'aula'=>$aula
                ])
                ->getQuery()
                ->getResult();
    }
    
    public function promedioParcialDeMateriaenAula(Aula $aula, Materias $materia,$quimestre,$parcial){
        $results= $this->calificacionesDeMateriaEnAula($aula, $materia);
        $sum=0;
        foreach ($results as $calificacion){
           $sum+=$calificacion->getPromedioParcial($quimestre,$parcial);
        }
        if (count($results)>0)
        {
        $promedio=($sum/count($results));
        return Calificaciones::redondear_dos_decimal($promedio);
        }else{
         return 0;
        }
    }
    
    public function promedioQuimestreDeMateriaenAula(Aula $aula, Materias $materia,$quimestre){

        $results= $this->calificacionesDeMateriaEnAula($aula, $materia);
        $sum=0;
        foreach ($results as $calificacion){
           $sum+=$calificacion->getPromedioQuimestre($quimestre);
        }
        if (count($results)>0)
        {
        $promedio=($sum/count($results));
        return Calificaciones::redondear_dos_decimal($promedio);
        }else{
         return 0;
        }
    }
    
    
    public function promedioParcialDeAreaenAula(Aula $aula, AreaAcademica $areaAcademica,$quimestre,$parcial){
        
        $em=$this->getEntityManager();
        $materiasDeAreaEnAula=$em->getRepository('MultiacademicoBundle:AreaAcademica')->materiasDeAreaAcademicaEnAula($aula,$areaAcademica);
        $sum=0;
        foreach ($materiasDeAreaEnAula as $materia){
            $sum+=$this->promedioParcialDeMateriaenAula($aula,$materia,$quimestre,$parcial);
        }
        $promedio=$sum/count($materiasDeAreaEnAula);
        return Calificaciones::redondear_dos_decimal($promedio);
    }
    
    
    public function promedioQuimestreDeAreaenAula(Aula $aula, AreaAcademica $areaAcademica,$quimestre){
        
        $em=$this->getEntityManager();
        $materiasDeAreaEnAula=$em->getRepository('MultiacademicoBundle:AreaAcademica')->materiasDeAreaAcademicaEnAula($aula,$areaAcademica);
        $sum=0;
        foreach ($materiasDeAreaEnAula as $materia){
            $sum+=$this->promedioQuimestreDeMateriaenAula($aula,$materia,$quimestre);
        }
        $promedio=$sum/count($materiasDeAreaEnAula);
        return Calificaciones::redondear_dos_decimal($promedio);
    }
    
    
    public function promediosParcialesDeJuntaDeArea(AreaAcademica $areaAcademica,$quimestre,$parcial){
        
        $em=$this->getEntityManager();
        $aulasDeAreaAcademica=$em->getRepository('MultiacademicoBundle:AreaAcademica')->aulasDeAreaAcademica($areaAcademica);
        $result=[];
        foreach ($aulasDeAreaAcademica as $aula){
            $result[]=['aula'=>$aula,
                       'promedio'=>$this->promedioParcialDeAreaenAula($aula,$areaAcademica,$quimestre,$parcial)
                      ];
        }
        
        return $result;
    }
    
}

 'use strict';
 angular.module('multiacademico.estadisticas').service('estadisticasCommon', function(Calificaciones, CALIFICACION_MINIMA, CALIFICACION_META){
     
     function resultCountAlturaNotas(bajos, medios, altos){
            return {
                notasBajas: bajos,
                notasMedias: medios,
                notasAltas: altos
            };
         }
     
     var resumenDeNotasPorAltura= function(array){
         
        var nB=0, nM=0, nA=0;
        array.forEach(function(e){
                       var nota = e;
                       if (nota<CALIFICACION_MINIMA){
                           nB++;
                       }else if(nota>=CALIFICACION_MINIMA&&nota<CALIFICACION_META){
                           nM++;
                       }else if(nota>CALIFICACION_META){
                           nA++;
                       }
        });
        
        var result = new resultCountAlturaNotas(nB, nM, nA);
        return result;
         
         
         
         
         /*aula.distributivos.forEach(function(distributivo){
                   //var nomEstudiante=element.matriculacodestudiante.estudiante;
                   //var promedioParcial=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                   distributivo.promediosBajos=0;
                   distributivo.promediosMedios=0;
                   distributivo.promediosAltos=0;
                   aula.matriculados.forEach(function(e){
                       var calificacion=Calificaciones.findCalificacionOnAlumno(e,distributivo.distributivocodmateria.id);
                       var promedio=Calificaciones.getPromedioParcial(scope.q,scope.p,calificacion);
                       if (promedio<CALIFICACION_MINIMA){
                           distributivo.promediosBajos++;
                       }else if(promedio>=CALIFICACION_MINIMA&&promedio<CALIFICACION_META){
                           distributivo.promediosMedios++;
                       }else if(promedio>CALIFICACION_META){
                           distributivo.promediosAltos++;
                       }
                   });
                   var materia=distributivo.distributivocodmateria.materia
                   filas.push(generarFila(materia,  distributivo.promediosBajos, distributivo.promediosMedios, distributivo.promediosAltos));
                });*/
         
     }
     
     return {
         resumenDeNotasPorAltura:resumenDeNotasPorAltura
     }
 });

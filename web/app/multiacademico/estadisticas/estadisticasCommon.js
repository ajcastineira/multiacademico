 'use strict';
 angular.module('multiacademico.estadisticas').service('estadisticasCommon', function(Calificaciones, CALIFICACION_MINIMA, CALIFICACION_META){
     
     function resultCountAlturaNotas(bajos, medios, altos){
            return {
                notasBajas: bajos,
                notasMedias: medios,
                notasAltas: altos
            };
         }
     function resultCountCualidadNotas(nNAR, nPAAR, nAAR, nDAR){
            return {
                nNAR: nNAR,
                nPAAR: nPAAR,
                nAAR: nAAR,
                nDAR: nDAR
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
     }
     
     var resumenDeNotasPorCualidad= function(array){
         
        var nNAR=0, nPAAR=0, nAAR=0, nDAR=0;
        array.forEach(function(e){
                       if (e==='NAR'){
                           nNAR++;
                       }else if (e==='PAAR'){
                           nPAAR++;
                       }else if (e==='AAR'){
                           nAAR++;
                       }else if (e==='DAR'){
                           nDAR++;
                       }
        });
        
        var result = new resultCountCualidadNotas(nNAR, nPAAR, nAAR, nDAR);
        return result;
     }
     
     return {
         resumenDeNotasPorAltura:resumenDeNotasPorAltura,
         resumenDeNotasPorCualidad:resumenDeNotasPorCualidad
     }
 });

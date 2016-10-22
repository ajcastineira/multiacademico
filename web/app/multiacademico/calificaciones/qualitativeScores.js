/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

    "use strict";
    
    angular.module('multiacademico').service('qualitativeScores', function(RANGOS_CALIFICACIONES_CUALITATIVAS)
    {
         function retornaSiglasCualidad(cantidad){
             var letra="";
             RANGOS_CALIFICACIONES_CUALITATIVAS.forEach(function(e){
                if (e.min===undefined&&cantidad<e.max){
                    letra = e.name;
                    return;
                }
                if (cantidad>=e.min&&cantidad<e.max){
                    letra = e.name;
                    return;
                }
                if (cantidad>=e.min&&e.max===undefined){
                    letra = e.name;
                    return;
                }
             });
             return letra;
         }
         
         
        function retornaCualidad(cantidad){
             var letra="";
             RANGOS_CALIFICACIONES_CUALITATIVAS.forEach(function(e){
                if (e.min===undefined&&cantidad<e.max){
                    letra = e.description;
                    return;
                }
                if (cantidad>=e.min&&cantidad<e.max){
                    letra = e.description;
                    return;
                }
                if (cantidad>=e.min&&e.max===undefined){
                    letra = e.description;
                    return;
                }
             });
             return letra;
        }
       
        return {
                    getNotaCualitativa:retornaSiglasCualidad,
                    getCualitativa:retornaCualidad
               };
            }
        );
   




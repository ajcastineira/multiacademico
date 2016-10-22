/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

"use strict";
    
angular.module('multiacademico')
       .constant('CALIFICACION_META',8.5)
       .constant('CALIFICACION_MAXIMA',10)
       .constant('CALIFICACION_MINIMA',7.5)
       .constant('LETRAS', { 'A':10,'B':9,'C':8,'D':6,'E':4,'F':3,'':0})
       .constant('QUIMESTRES',[
                                    {id:1,label:"PRIMER QUIMESTRE"},
                                    {id:2,label:"SEGUNDO QUIMESTRE"},
                                    {id:3,label:"ANUAL"}
                            ])
        .constant('PARCIALES',[
                               {id:1,label:"Primer Parcial",labelabrv:"1er Parcial"},
                               {id:2,label:"Segundo Parcial",labelabrv:"2do Parcial"},
                                {id:3,label:"Tercer Parcial",labelabrv:"3er Parcial"},
                                {id:4,label:"Resumen Parciales",labelabrv:"Total Parciales"}
                                //   {id:5,label:"Total Quimestre"}
                            ])
        .constant('RANGOS_CALIFICACIONES_CUALITATIVAS',[
                               {name:'NAR', min:undefined, max: 4, description:'No alcanza los aprendizajes requeridos'},
                               {name:'PAAR', min:4, max: 7, description:'Esta proximo a alcanzar los aprendizajes requeridos'},
                               {name:'AAR', min:7, max: 9, description:'Alcanza los aprendizajes requeridos'},
                               {name:'DAR', min:9, max: 10, description:'Domina los aprendizajes requeridos'},
                               {name:'DAR', min:10, max: undefined, description:'Domina los aprendizajes requeridos'}
                            ]);
                            
               
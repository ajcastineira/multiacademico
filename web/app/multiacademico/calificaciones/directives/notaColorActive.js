/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

"use strict";
    
angular.module('multiacademico')
           .directive('notaColorActive',function notaColorActive(Calificaciones){
              
             return {
                restrict: 'A',
                template : '{{notaValue}}',
                scope: {
                    notaValue:'=',
                },
                link: function (scope, element, attributes) {

                    var escucharNota = scope.$watch('notaValue', function(newValue, oldValue){
                       var nota=parseFloat(newValue);
                       var altNot=Calificaciones.getAlturaNota(nota);
                       if (altNot==='baja')
                       {
                         element.css('background-color', 'rgba(255,0,0,0.50)');
                       }else if(altNot==='media'){
                           element.css('background-color', 'white');
                       }else if(altNot==='alta'){
                           element.css('background-color', 'rgba(124,252,0,0.50)');
                       }else{
                           element.css('background-color', 'white');
                       }
                    }, true);
                   scope.$on('$destroy', function() {
                        escucharNota();
                      });
                    }
                }
        });
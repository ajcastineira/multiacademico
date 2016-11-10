/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
   'use strict';
    
    angular.module('multiacademico.juntadearea')
        .controller('JuntaDeAreaCtrl', function ($scope, $timeout, $state,$stateParams, areaAcademica, resumenJuntaDeArea, Calificaciones, QUIMESTRES, PARCIALES, CALIFICACION_MINIMA, CALIFICACION_META) {
                            
                            var resumenJuntaDeAreaAgrupado=_.groupBy(resumenJuntaDeArea,'aula.curso.tipo');
                            
                            _.forIn(resumenJuntaDeAreaAgrupado, function(value, key) {
                              resumenJuntaDeAreaAgrupado[key]=_.groupBy(value,'aula.curso.nivel');
                            });
                            
                            window.resumenJuntaDeAreaAgrupado=resumenJuntaDeAreaAgrupado;
                            $scope.resumenJuntaDeArea = resumenJuntaDeArea;
                            $scope.areaAcademica=areaAcademica;
                            $scope.CALIFICACION_META=CALIFICACION_META;
                            $scope.CALIFICACION_MINIMA=CALIFICACION_MINIMA;
                            $scope.meta= function(nota){
                                return Calificaciones.redondear(nota-CALIFICACION_META,2);
                            }
                            
                            $scope.promedioAnio= function(tiponivel,nivel){
                                return Calificaciones.redondear(_.meanBy(resumenJuntaDeAreaAgrupado[tiponivel][nivel],'promedio'),2);
                            };
                            
                            $scope.promedioNivel= function(tipoNivel){
                                var sum=0,count=0;
                                _.forIn(resumenJuntaDeAreaAgrupado[tipoNivel], function(value, key) {
                                    sum+=$scope.promedioAnio(tipoNivel,key)
                                    count++;
                                 });
                                return Calificaciones.redondear(sum/count,2);
                            };
                            
                            /*var crearDataTable=function(){
                                    var dTable= jQuery('#juntadearea-normal').DataTable( {
                                        dom: 'B',
                                        paging: false,
                                        order: [1,'asc'],
                                        buttons: [
                                            {
                                                extend: 'collection',
                                                text: 'Seleccionar Materias',
                                                className: 'btn-primary',
                                                buttons: getButtonsMaterias()
                                            },
                                            { extend: 'copy', className: 'btn-primary' },
                                            { extend: 'excel', className: 'btn-success' }
                                        ]
                                        });
                                      jQuery('#malla-normal_wrapper').addClass("noprint");  
                                      return dTable;
                                    };*/
                            /*angular.element('#malla-normal').ready(function () {
                                     $timeout(function () {
                                     $scope.dataTable=crearDataTable();
                                    });
                                });*/
                             
                           });




/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
   'use strict';
    
    angular.module('multiacademico.juntadearea')
        .controller('JuntaDeAreaCtrl', function ($scope, $timeout, $state,$stateParams, areaAcademica, resumenJuntaDeArea, Calificaciones, QUIMESTRES, PARCIALES) {
                            
                            $scope.resumenJuntaDeArea = resumenJuntaDeArea;
                            $scope.areaAcademica=areaAcademica;
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




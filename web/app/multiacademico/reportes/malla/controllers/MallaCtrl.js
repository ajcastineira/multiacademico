/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['multiacademico/reportes/malla/module',
    'multiacademico/calificaciones/Calificaciones'], function (module) {

    'use strict';
    

    module.registerController('MallaCtrl', function ($scope,$state,$stateParams, aula, Calificaciones) {
                            $scope.aula = aula;
                            $scope.qop=Calificaciones.quimestres;
                            $scope.pop=Calificaciones.parciales;
                            $scope.q = $stateParams.q;
                            $scope.p = $stateParams.p;
                            $scope.Calificaciones=Calificaciones;
                            $scope.Materias={};
                            $scope.prparcial=function(i,m)
                            {
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m]
                                return Calificaciones.getPromedioParcial($scope.q,$scope.p,calificacion);
                                //Calificaciones.getPromedioParcial($scope.q,$scope.p)
                            }
                            $scope.cualitativa=function(nota)
                            {
                                return Calificaciones.getNotaCualitativa(nota);
                            }
                            $scope.changeq = function(){
                                   
                                
                                };
                            
                           });
});




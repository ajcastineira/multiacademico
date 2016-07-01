/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['multiacademico/informes/module',
    'multiacademico/calificaciones/Calificaciones','multiacademico/calificaciones/EnLetras'], function (module) {

    'use strict';
    

    module.registerController('MisCalificacionesCtrl', function ($scope,$state,$stateParams, estudiante, Calificaciones,EnLetras) {
                            $scope.estudiante = estudiante;
                            
                            $scope.qop=Calificaciones.quimestres;
                            $scope.pop=Calificaciones.parciales;
                            $scope.parnot=Calificaciones.parcialesnotas;
                            $scope.q = $stateParams.q;
                            $scope.p = $stateParams.p;
                            $scope.encabezado={
                                titulo:function()
                                {
                                    if ($scope.p<=3)
                                    {    
                                        return "Informe Parcial de Aprendizaje";
                                    }
                                    if ($scope.p==4)
                                    {    
                                        return "Informe Quimestral de Aprendizaje";
                                    }
                                },
                                colspan:function()
                                {
                                    if ($scope.p<=3)
                                    {    
                                        return 2;
                                    }
                                    if ($scope.p==4)
                                    {    
                                        return 4;
                                    }
                                    return 7
                                }
                            };
                            $scope.Calificaciones=Calificaciones;
                            $scope.Materias={};
                            $scope.prparcial=function(q,p,calificacion)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                               // var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioParcial(q,p,calificacion);
                            };
                            
                            $scope.prtp=function(q,p,calificaciones)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                               // var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioTotalParcial(q,p,calificaciones);
                            };
                            
                            $scope.prparciales=function(q,calificacion)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                               
                                return Calificaciones.getPromedioParciales(q,calificacion);
                            };
                            
                            $scope.prparciales80=function(q,calificacion)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                
                                return Calificaciones.getPromedioParciales80(q,calificacion);
                            };
                            $scope.ex20=function(q,calificacion)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                
                                return Calificaciones.getExamen20(q,calificacion);
                            };
                            
                            $scope.prq=function(q,calificacion)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return Calificaciones.getPromedioQuimestre(q,calificacion);
                            };
                            
                            
                            $scope.prtq=function(q,calificaciones)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return Calificaciones.getPromedioTotalQuimestre(q,calificaciones);
                            };
                            
                            $scope.cualitativa=function(nota)
                            {
                                return Calificaciones.getCualitativa(nota);
                            };
                            $scope.cualitativasiglas=function(nota)
                            {
                                return Calificaciones.getNotaCualitativa(nota);
                            };
                            $scope.notaEnLetras=function(nota)
                            {
                                return EnLetras.EnLetras.ValorEnLetras(nota);
                            };
                            $scope.changeq = function(){
                                   
                                    
                                
                                };
                            
                           });
});




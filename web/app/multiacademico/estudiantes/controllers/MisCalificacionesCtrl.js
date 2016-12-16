/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
    'use strict';
    

     angular.module('multiacademico.estudiantes').controller('MisCalificacionesCtrl', function ($scope,$state,$stateParams, estudiante, Calificaciones,EnLetras) {
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
                            
                            
                            $scope.proyectoparcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.proyectoescolar==='undefined') return 'Sin Proyecto';
                                var calificacionparcialproyecto=$scope.estudiante.proyectoescolar['nota_q'+q+'_p'+p];
                                if (typeof calificacionparcialproyecto==='undefined') calificacionparcialproyecto='Sin Nota';
                                return calificacionparcialproyecto;
                            };
                            
                            $scope.proyectoQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.estudiante.proyectoescolar==='undefined') return 'Sin Proyecto';
                                return Calificaciones.getPromedioProyectoEscolarQuimestre($scope.estudiante.proyectoescolar,q);
                            };
                            
                            $scope.comportamientoParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.comportamiento==='undefined') return 'S.C.';
                                var calificacionparcialcomportamiento=$scope.estudiante.comportamiento['agdc_q'+q+'_p'+p];
                                if (typeof calificacionparcialcomportamiento==='undefined') calificacionparcialcomportamiento='Sin Nota';
                                return calificacionparcialcomportamiento;
                            };
                            
                            $scope.comportamientoQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.estudiante.comportamiento==='undefined') return 'S.C.';
                                return Calificaciones.getPromedioComportamientoQuimestre($scope.estudiante.comportamiento,q);
                            };
                            
                           $scope.comportamientoRecomendacionParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.comportamiento==='undefined') return 'S.C.';
                                var recomendacion=$scope.estudiante.comportamiento['crecomendacion_q'+q+'_p'+p];
                                if (typeof recomendacion==='undefined') recomendacion='';
                                return recomendacion;
                            };
                            $scope.comportamientoEstaBienParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.comportamiento==='undefined') return 'S.C.';
                                var loQueEstaBien=$scope.estudiante.comportamiento['estabien_q'+q+'_p'+p];
                                if (typeof loQueEstaBien==='undefined') loQueEstaBien='';
                                return loQueEstaBien;
                            };
                            $scope.comportamientoMejorarParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.comportamiento==='undefined') return 'S.C.';
                                var mejorar=$scope.estudiante.comportamiento['mejorar_q'+q+'_p'+p];
                                if (typeof mejorar==='undefined') mejorar='';
                                return mejorar;
                            };
                            
                            $scope.atrasosParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var atrasos=$scope.estudiante.asistencia['at_p'+p+'_q'+q];
                                if (typeof atrasos==='undefined') atrasos=0;
                                return atrasos;
                            };
                            
                            $scope.faltasInjustificadasParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var faltas=$scope.estudiante.asistencia['fi_p'+p+'_q'+q];
                                if (typeof faltas==='undefined') faltas=0;
                                return faltas;
                            };
                            
                            $scope.faltasJustificadasParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var faltas=$scope.estudiante.asistencia['fj_p'+p+'_q'+q];
                                if (typeof faltas==='undefined') faltas=0;
                                return faltas;
                            };
                            
                            $scope.totalFaltasParcial=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var faltas=$scope.faltasJustificadasParcial(q,p)*1+$scope.faltasInjustificadasParcial(q,p)*1;
                                return faltas;
                            };
                            
                           });




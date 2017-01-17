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
                            /*Promedio anual Q1+Q2/2*/
                            $scope.pranual=function(calificacion)
                            {
                                return Calificaciones.getPromedioAnual(calificacion);
                            };

                            /* Promedio anual final por materia luego de remediales y gracia*/
                            $scope.pranualTotal = function(calificacion){

                                return Calificaciones.getPromedioFinal(calificacion);
                            }
                            
                            $scope.aprobarMateria = function(calificacion){

                                if (Calificaciones.apruebaMateria(calificacion))

                                      return "Aprueba";
                                  else
                                       return "No aprueba";
                            }


                            /*Promedio de todos los promedios de todas las materias al finalizar el año*/
                            $scope.prFinal=function(calificaciones)
                            {
                                return Calificaciones.getPromedioTotalAnual(calificaciones);
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
                            
                            
                            $scope.atrasosQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var atrasos=$scope.atrasosParcial(q,1)*1+$scope.atrasosParcial(q,2)*1+$scope.atrasosParcial(q,3)*1;
                                if (isNaN(atrasos)) atrasos=0;
                                return atrasos;
                            };
                            $scope.atrasosAnual=function(q1, q2)
                            {   
                                if (typeof q1==='undefined')q1=$scope.q1;
                                if (typeof q2==='undefined')q2=$scope.q2;
                                }
                                return $scope.atrasosQuimestre(q1) + $scope.atrasosQuimestre(q2);
                            };
                            $scope.faltasInjustificadasQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var faltas=$scope.faltasInjustificadasParcial(q,1)*1+$scope.faltasInjustificadasParcial(q,2)*1+$scope.faltasInjustificadasParcial(q,3)*1;
                                if (isNaN(faltas)) faltas=0;
                                return faltas;
                            };
                            $scope.faltasInjustificadasAnual=function(q1, q2){
                                if (typeof q1==='undefined')q1=$scope.q1;
                                if (typeof q2==='undefined')q2=$scope.q2;
                                
                                return $scope.faltasInjustificadasQuimestre(q1) + $scope.faltasInjustificadasQuimestre(q2);
                            };
                            $scope.faltasJustificadasQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.estudiante.asistencia==='undefined') return 'Sin Asistencias';
                                var faltas=$scope.faltasJustificadasParcial(q,1)*1+$scope.faltasJustificadasParcial(q,2)*1+$scope.faltasJustificadasParcial(q,3)*1;                                if (isNaN(faltas)) faltas=0;
                                return faltas;
                            };

                            $scope.faltasJustificadasAnual=function(q1, q2){
                                if (typeof q1==='undefined')q1=$scope.q1;
                                if (typeof q2==='undefined')q2=$scope.q2;

                                return $scope.faltasJustificadasQuimestre(q1) + $scope.faltasJustificadasQuimestre(q2);
                            }
                            
                            $scope.totalFaltasQuimestre=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var faltas=$scope.totalFaltasParcial(q,1)*1+$scope.totalFaltasParcial(q,2)*1+$scope.totalFaltasParcial(q,3)*1;
                                return faltas;
                            };

                            $scope.totalFaltasAnual=function(q1, q2){
                                if (typeof q1==='undefined')q1=$scope.q1;
                                if (typeof q2==='undefined')q2=$scope.q2;

                                return $scope.totalFaltasQuimestre(q1) + $scope.totalFaltasQuimestre(q2);
                            }
                            
                           });




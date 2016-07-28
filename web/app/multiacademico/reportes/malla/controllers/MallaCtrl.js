/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['multiacademico/reportes/malla/module',
    'multiacademico/calificaciones/Calificaciones'], function (module) {

    'use strict';
    

    module.registerController('MallaCtrl', function ($scope,$state,$stateParams, aula, Calificaciones) {
                            $scope.aula = aula;
                            $scope.aula.recibeProyectoEscolar=function(){
                                if (this.curso.tipo!=='BACH'&&this.curso.tipo!=='INICIAL'&&!(this.curso.tipo=='EBI'&&this.curso.nivel==1))
                                {return true;}
                                else
                                {return false;}
                            };
                            $scope.tam= '1';
                            $scope.tamOptions= [
                              {id: '1', name: 'normal'},
                              {id: '0', name: 'reducido'}
                            ];
                            $scope.estaReducido=function()
                            {
                                return !parseInt($scope.tam); 
                            };
                            $scope.qop=Calificaciones.quimestres;
                            $scope.pop=Calificaciones.parciales;
                            $scope.q = $stateParams.q;
                            $scope.p = $stateParams.p;
                            $scope.encabezado={
                                titulo:"CUADRO DE CALIFICACIONES DEL PARCIAL"+$scope.p,
                                materiacolspan:function()
                                {
                                    if ($scope.p<=3&& $scope.q<3)
                                    {    
                                        return 7;
                                    }
                                    if ($scope.p===4&& $scope.q<3)
                                    {    
                                        return 8;
                                    }
                                    if ($scope.q===3)
                                    {    
                                        return 5;
                                    }
                                    return 7;
                                }
                            };
                            $scope.Calificaciones=Calificaciones;
                            $scope.Materias={};
                            $scope.prparcial=function(i,m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioParcial(q,p,calificacion);
                            };
                            
                            $scope.prparciales=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioParciales(q,calificacion);
                            };
                            
                            $scope.prparciales80=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioParciales80(q,calificacion);
                            };
                            $scope.ex20=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getExamen20(q,calificacion);
                            };
                            
                            $scope.prq=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioQuimestre(q,calificacion);
                            };
                            
                            $scope.pra=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioAnual(calificacion);
                            };
                            
                            $scope.prf=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioFinal(calificacion);
                            };
                            
                            $scope.prf=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.aula.matriculados[i].calificaciones[m];
                                return Calificaciones.getPromedioFinal(calificacion);
                            };
                            $scope.sumf=function(i)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.getSumaFinal(calificaciones);
                            };
                            
                            $scope.prgp=function(i,q,p)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.getPromedioTotalParcial(q,p,calificaciones);
                            };
                            
                            $scope.prg=function(i)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.getPromedioGeneral(calificaciones);
                            };
                            
                            $scope.apruebaAnioLectivo=function(i)
                            {
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.apruebaAnio(calificaciones);
                            };
                            
                            $scope.cualitativa=function(nota)
                            {
                                return Calificaciones.getNotaCualitativa(nota);
                            };
                            $scope.changeq = function(){
                                   
                                    if ($scope.p<=3)
                                    {    
                                    
                                    $scope.encabezado.titulo="CUADRO DE CALIFICACIONES DEL PARCIAL "+$scope.p;
                                    }
                                    if ($scope.p==4)
                                    {    
                                    
                                    $scope.encabezado.titulo="CUADRO DE CALIFICACIONES DEL QUIMESTRE "+$scope.q;
                                    }
                                
                                };
                            
                            $scope.proyectoparcial=function(i,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.aula.matriculados[i].proyectoescolar==='undefined') return 'S.P.';
                                var calificacionparcialproyecto=$scope.aula.matriculados[i].proyectoescolar['nota_q'+q+'_p'+p];
                                if (typeof calificacionparcialproyecto==='undefined') calificacionparcialproyecto='N/A';
                                return calificacionparcialproyecto;
                            };
                           $scope.comportamientoparcial=function(i,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                if (typeof $scope.aula.matriculados[i].comportamiento==='undefined') return 'S.C.';
                                var calificacionparcialcomportamiento=$scope.aula.matriculados[i].comportamiento['agdc_q'+q+'_p'+p];
                                if (typeof calificacionparcialcomportamiento==='undefined') calificacionparcialcomportamiento='N/A';
                                return calificacionparcialcomportamiento;
                            };
                           });
});




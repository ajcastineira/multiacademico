/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
   'use strict';
    
    angular.module('multiacademico.malla')
        .controller('MallaCtrl', function ($scope, $timeout, $state,$stateParams, aula, Calificaciones,estadisticasCommon,QUIMESTRES, PARCIALES,CALIFICACION_MINIMA,CALIFICACION_META) {
                            
                            
                            $scope.aula = aula;
                            $scope.calificacionminima=CALIFICACION_MINIMA;
                            $scope.calificacionmeta=CALIFICACION_META;
                            $scope.aula.recibeProyectoEscolar=function(){
                                if (this.curso.tipo!=='BACH'&&this.curso.tipo!=='INICIAL'&&!(this.curso.tipo==='EBI'&&this.curso.tipo==='EBM'&&this.curso.nivel===1))
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
                            $scope.qop=QUIMESTRES;
                            $scope.pop=PARCIALES;
                            $scope.q = $stateParams.q;
                            $scope.p = $stateParams.p;
                            $scope.tipo = $stateParams.tipo;
                            $scope.encabezado={
                                titulo:"CUADRO DE CALIFICACIONES DEL PARCIAL"+$scope.p,
                                materiacolspan:function()
                                {
                                    var colspan=5;
                                    if ($scope.tipo=="estadistica"){
                                        var colspan=0;
                                    }
                                    if ($scope.p<=3&& $scope.q<3)
                                    {    
                                        return colspan+2;
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
                            
                            var getPromediosComportamientoParcial = $scope.getPromediosComportamientoParcial = function(q,p)
                            {
                                 if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                
                                return getPromediosFromFunction(function(matriculado){
                                    if (typeof matriculado.comportamiento==='undefined') return 'S.C.';
                                    var calificacionComportamiento=matriculado.comportamiento['agdc_q'+q+'_p'+p];
                                    if (typeof calificacionComportamiento==='undefined') calificacionComportamiento='N/A';
                                    return calificacionComportamiento;
                                        });
                            };
                            
                            
                            var getPromediosComportamientoQuimestre = $scope.getPromediosComportamientoQuimestre = function(q)
                            {
                                 if (typeof q==='undefined') q=$scope.q;
                                
                                return getPromediosFromFunction(function(matriculado){
                                    if (typeof matriculado.comportamiento==='undefined') return 'S.C.';
                                    return Calificaciones.getPromedioComportamientoQuimestre(matriculado.comportamiento,q);
                                        });
                            };
                            
                            var getPromediosFromFunction = $scope.getPromediosFromFunction = function(callBackFn)
                            {
                                return _.map($scope.aula.matriculados, callBackFn);
                            };
                            var getPromediosFromFunctionParcialesMateria=$scope.getPromediosFromFunctionParcialesMateria = function(q,p,m,callBackFn){
                                return getPromediosFromFunction(function(matriculado){
                                    return callBackFn(q,p,$scope.findCalificacion(matriculado,m));
                                });
                            };
                            
                            var getPromediosFromFunctionQuimestralesMateria = $scope.getPromediosFromFunctionQuimestralesMateria = function(q,m,callBackFn){
                                return getPromediosFromFunction(function(matriculado){
                                    return callBackFn(q,$scope.findCalificacion(matriculado,m));
                                });
                            };
                            
                            
                            $scope.findCalificacion = function(alumno, idmateria){
                                return _.find(alumno.calificaciones, {'calificacioncodmateria':{'id':idmateria}});
                            };
                            
                            $scope.clasificarPromediosPorAltura=function(array){
                                return estadisticasCommon.resumenDeNotasPorAltura(array);
                            }
                            
                            
                            $scope.Materias={};
                            
                            $scope.prparcial=function(i,m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioParcial(q,p,calificacion);
                            };
                            
                            $scope.promediosParcialMateria=function(m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                return getPromediosFromFunctionParcialesMateria(q,p,m,Calificaciones.getPromedioParcial);
                            };
                            
                            $scope.prparcialMateria=function(m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;

                                return Calificaciones.redondear(_.mean($scope.promediosParcialMateria(m,q,p)),2);
                                
                            };
                            
                            $scope.prparciales=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioParciales(q,calificacion);
                            };
                            
                            
                            $scope.prparcialesMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                
                                var promediosArray=getPromediosFromFunctionQuimestralesMateria(q,m,Calificaciones.getPromedioParciales);
                                return Calificaciones.redondear(_.mean(promediosArray),2);
                            };
                            
                            $scope.prparciales80=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioParciales80(q,calificacion);
                            };
                            
                            $scope.prparciales80Materia=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var promediosArray=getPromediosFromFunctionQuimestralesMateria(q,m,Calificaciones.getPromedioParciales80);
                                return Calificaciones.redondear(_.mean(promediosArray),2);
                            };
                            
                            $scope.prExamenMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                
                                var promediosArray=getPromediosFromFunctionQuimestralesMateria(q,m,Calificaciones.getExamen);
                                return Calificaciones.redondear(_.mean(promediosArray),2);
                            };
                            
                            $scope.ex20=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getExamen20(q,calificacion);
                            };
                            
                            $scope.ex20Materia=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var promediosArray=getPromediosFromFunctionQuimestralesMateria(q,m,Calificaciones.getExamen20);
                                return Calificaciones.redondear(_.mean(promediosArray),2);
                                
                            };
                            
                            $scope.prq=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioQuimestre(q,calificacion);
                            };
                            
                            $scope.promediosQuimestreMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return getPromediosFromFunctionQuimestralesMateria(q,m,Calificaciones.getPromedioQuimestre);
                            };
                            
                            $scope.prqMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return Calificaciones.redondear(_.mean($scope.promediosQuimestreMateria(m,q)),2);
                                
                            };
                            
                            $scope.pra=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioAnual(calificacion);
                            };
                            
                            $scope.prf=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioFinal(calificacion);
                            };
                            
                            $scope.prf=function(i,m)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
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
                            $scope.promediosGeneralesParcialMateria=function(q,p){
                               if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                
                                return getPromediosFromFunction(function(matriculado){
                                                return Calificaciones.getPromedioTotalParcial(q,p,matriculado.calificaciones);
                                            });
                            };
                            $scope.prgpMateria=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                
                                return Calificaciones.redondear(_.mean($scope.promediosGeneralesParcialMateria(q,p)),2);
                            };
                            
                            $scope.prgq=function(i,q)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.getPromedioTotalQuimestre(q,calificaciones);
                            };
                            $scope.prgqMateriasBasicas=function(i,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                return Calificaciones.getPromedioTotalQuimestreMateriasBasicas(q,calificaciones);
                            };
                            $scope.promediosGeneralesQuimestreMateria=function(q){
                                return getPromediosFromFunction(function(matriculado){
                                                return Calificaciones.getPromedioTotalQuimestre(q,matriculado.calificaciones);
                                            });
                            };
                            $scope.promediosGeneralesQuimestreMateriasBasicas=function(q){
                                return getPromediosFromFunction(function(matriculado){
                                                return Calificaciones.getPromedioTotalQuimestreMateriasBasicas(q,matriculado.calificaciones);
                                            });
                            };
                            $scope.prgqAulaMateriasBasicas=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return Calificaciones.redondear(_.mean($scope.promediosGeneralesQuimestreMateriasBasicas(q)),2);
                                
                            };
                            $scope.prgqAula=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                return Calificaciones.redondear(_.mean($scope.promediosGeneralesQuimestreMateria(q)),2);
                                
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
                                    $scope.dataTable.destroy();
                                    $timeout(function () {
                                        $scope.dataTable=crearDataTable();
                                    });
                                    
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
                            
                            $scope.comportamientoQuimestre=function(i,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof $scope.aula.matriculados[i].comportamiento==='undefined') return 'S.C.';
                                return Calificaciones.getPromedioComportamientoQuimestre($scope.aula.matriculados[i].comportamiento,q);
                                
                            };
                            
                            var buttonToggleMateria= function(text,columns){
                                  return {
                                    extend: 'columnToggle',
                                    text: text,
                                    columns: columns
                                   };
                            };
                            var getButtonsMaterias = function(){
                                
                                var fieldInicial=2;
                                var fields=$scope.encabezado.materiacolspan();
                                var i,c=0;
                                var resultButtons=[];
                                resultButtons.push(new buttonToggleMateria('Todas las Materias','.malla-field'));
                                for (i=0;i<$scope.aula.distributivos.length;i++){
                                    c++;
                                    var materia=$scope.aula.distributivos[i].distributivocodmateria.materia;
                                    var columns=(function(i,fieldInicial,fields){
                                        var a=[];
                                        var j;
                                        var colIni=(i*fields)+fieldInicial;
                                        var colFin=colIni+fields;
                                        for (j=colIni;j<colFin;j++)
                                        {   
                                            a.push(j);
                                        }
                                        return a;
                                    }(i,fieldInicial,fields));
                                    resultButtons.push(new buttonToggleMateria(materia,columns));
                                }
                                return resultButtons;
                            };
                            
                            var encabezadoTable=['Comportamiento','Valor'];
                            
                            if ($scope.p<=3&&$scope.q<3){
                                $scope.resumenComportamientoTable=_.union([encabezadoTable],_.toPairs(estadisticasCommon.resumenDeNotasPorLetra(getPromediosComportamientoParcial($scope.q,$scope.p))));
                            }else if ($scope.p==4&&$scope.q<3){
                                $scope.resumenComportamientoTable=_.union([encabezadoTable],_.toPairs(estadisticasCommon.resumenDeNotasPorLetra(getPromediosComportamientoQuimestre($scope.q))));
                            }
                            var crearDataTable=function(){
                                    var dTable= jQuery('#malla-normal').DataTable( {
                                        dom: 'B',
                                        paging: false,
                                        order: [1,'asc'],
                                       // responsive: true,
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
                                    };
                            angular.element('#malla-normal').ready(function () {
                                     $timeout(function () {
                                     $scope.dataTable=crearDataTable();
                                    });
                                });
                             
                           });




/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
   'use strict';
    
    angular.module('multiacademico.malla')
        .controller('MallaCtrl', function ($scope, $timeout, $state,$stateParams, aula, Calificaciones, QUIMESTRES, PARCIALES) {
                            
                            $scope.aula = aula;
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
                            $scope.Calificaciones=Calificaciones;
                            
                             var findByMateriaId = function(id){
                                return function(calificacion){
                                  return calificacion.calificacioncodmateria.id === id;
                                };
                            };
                            $scope.findCalificacion = function(alumno, idmateria){
                                return alumno.calificaciones.filter(findByMateriaId(idmateria))[0];
                            };
                            
                            $scope.Materias={};
                            
                            $scope.prparcial=function(i,m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioParcial(q,p,calificacion);
                            };
                            
                            $scope.prparcialMateria=function(m,q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                    sum += Calificaciones.getPromedioParcial(q,p,calificacion);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
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
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                    sum += Calificaciones.getPromedioParciales(q,calificacion);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
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
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                    sum += Calificaciones.getPromedioParciales80(q,calificacion);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
                            };
                            
                            $scope.prExamenMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    sum += $scope.findCalificacion($scope.aula.matriculados[i],m)['q'+q+'_ex'];
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
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
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                    sum += Calificaciones.getExamen20(q,calificacion);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
                            };
                            
                            $scope.prq=function(i,m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                return Calificaciones.getPromedioQuimestre(q,calificacion);
                            };
                            
                            $scope.prqMateria=function(m,q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificacion=$scope.findCalificacion($scope.aula.matriculados[i],m);
                                    sum += Calificaciones.getPromedioQuimestre(q,calificacion);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
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
                            
                            $scope.prgpMateria=function(q,p)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                if (typeof p==='undefined') p=$scope.p;
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                    sum += Calificaciones.getPromedioTotalParcial(q,p,calificaciones);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
                            };
                            
                            $scope.prgq=function(i,q)
                            {
                                //if (typeof q==='undefined') q=$scope.q;
                                var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                
                                return Calificaciones.getPromedioTotalQuimestre(q,calificaciones);
                            };
                            
                            $scope.prgqMateria=function(q)
                            {
                                if (typeof q==='undefined') q=$scope.q;
                                var sum=0,i;
                                var totalAlumnos=$scope.aula.matriculados.length;
                                for (i=0;i<totalAlumnos;i++)
                                {
                                    var calificaciones=$scope.aula.matriculados[i].calificaciones;
                                    sum += Calificaciones.getPromedioTotalQuimestre(q,calificaciones);
                                }
                                return Calificaciones.redondear(sum/totalAlumnos,2);
                                
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
                            var crearDataTable=function(){
                                    var dTable= jQuery('#malla-normal').DataTable( {
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
                                    };
                            angular.element('#malla-normal').ready(function () {
                                     $timeout(function () {
                                     $scope.dataTable=crearDataTable();
                                    });
                                });
                             
                           });




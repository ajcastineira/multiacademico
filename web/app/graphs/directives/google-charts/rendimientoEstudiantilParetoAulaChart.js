'use strict';

angular.module('app.graphs').directive('rendimientoEstudiantilParetoAulaChart', function (Calificaciones, CALIFICACION_MINIMA, CALIFICACION_META) {
    return {
        restrict: 'A',
        scope: {
            titulo: '@',
            aula: '=',
            q: '=',
            p: '='
        },
        link: function (scope, element, attributes) {
            
            google.charts.load('current', {'packages':['corechart']});
            
            var aula=scope.aula;
            var calificacionMeta=CALIFICACION_META;
            
            scope.promedioCurso=function(){
                return 
            }
           
            scope.$watch(attributes.q, function(value) {
                google.charts.setOnLoadCallback(drawChart);
            });
            scope.$watch(attributes.p, function(value) {
                google.charts.setOnLoadCallback(drawChart);
            });
            
            var generarFila=function(materia,  bajo, medio, alto){
                    return [materia,  bajo, medio, alto];
                };
            var generarTabla=function(){
                var encabezado=['Materia', 'Menor a 7', '7 a 8.5', 'mas de 8.5'];
                var filas=[encabezado];
                var sumPromedioCurso=0,promedioCurso=0;
                
                aula.promediosBajos=0;
                aula.promediosMedios=0;
                aula.promediosAltos=0;
                
                /*aula.matriculados.forEach(function(element){
                    //var promedioParcial=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                    //scope.q,scope.p,element.calificaciones
                    var promedioParcialMateria=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                    //sumPromedioCurso+=promedioParcial;
                });
                promedioCurso=sumPromedioCurso/aula.matriculados.length;*/
                
                aula.distributivos.forEach(function(distributivo){
                   //var nomEstudiante=element.matriculacodestudiante.estudiante;
                   //var promedioParcial=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                   distributivo.promediosBajos=0;
                   distributivo.promediosMedios=0;
                   distributivo.promediosAltos=0;
                   aula.matriculados.forEach(function(e){
                       var calificacion=Calificaciones.findCalificacionOnAlumno(e,distributivo.distributivocodmateria.id);
                       var promedio=Calificaciones.getPromedioParcial(scope.q,scope.p,calificacion);
                       if (promedio<CALIFICACION_MINIMA){
                           distributivo.promediosBajos++;
                       }else if(promedio>=CALIFICACION_MINIMA&&promedio<CALIFICACION_META){
                           distributivo.promediosMedios++;
                       }else if(promedio>CALIFICACION_META){
                           distributivo.promediosAltos++;
                       }
                   });
                   var materia=distributivo.distributivocodmateria.materia
                   filas.push(generarFila(materia,  distributivo.promediosBajos, distributivo.promediosMedios, distributivo.promediosAltos));
                });
                
                
                return filas;
            }
            //{"#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"}
            function drawChart() {
                var data = google.visualization.arrayToDataTable(generarTabla());
                var options = {
                  title: scope.titulo,
                  colors: ["#dc3912","#ff9900","#109618"],
                  vAxis: {title: 'Numero de Alumnos' },
                  hAxis: {title: 'Materias',
                          
                          showTextEvery: 1,
                          maxTextLines: 5,
                          textStyle: {
                             fontSize: 8
                         }
                        },
                  isStacked: 'percent',      
                  seriesType: 'bars',
                  
                 // series: {5: {type: 'line'}}
                  //curveType: 'function',
                  //legend: { position: 'bottom' },
                  //pointSize: 5
                };
                var chart = new google.visualization.ComboChart(element[0]);

                chart.draw(data, options);
              }
            

        }
    };
});


     

      
        

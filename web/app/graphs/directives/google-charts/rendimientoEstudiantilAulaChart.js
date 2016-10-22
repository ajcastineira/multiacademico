'use strict';

angular.module('app.graphs').directive('rendimientoEstudiantilAulaChart', function (Calificaciones, CALIFICACION_META, CALIFICACION_MINIMA) {
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
            
            scope.promedioCurso=function(){
                return 
            }
           
            var listenQ = scope.$watch(attributes.q, function(value) {
                google.charts.setOnLoadCallback(drawChart);
            });
            var listenP =scope.$watch(attributes.p, function(value) {
                google.charts.setOnLoadCallback(drawChart);
            });
            
            var generarFila=function(nombreEstudiante,  calificacion,minima, promedio, meta){
                    return [nombreEstudiante,  calificacion, minima, promedio, meta];
                };
            var generarTabla=function(){
                var encabezado=['Estudiante', 'Calificacion', 'Minima','Media', 'Meta'];
                var filas=[encabezado];
                var sumPromedioCurso=0,promedioCurso=0;
                aula.matriculados.forEach(function(element){
                    var promedioParcial=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                    sumPromedioCurso+=promedioParcial;
                });
                promedioCurso=sumPromedioCurso/aula.matriculados.length;
                aula.matriculados.forEach(function(element){
                   var nomEstudiante=element.matriculacodestudiante.estudiante;
                   var promedioParcial=Calificaciones.getPromedioTotalParcial(scope.q,scope.p,element.calificaciones);
                   filas.push(generarFila(nomEstudiante,promedioParcial,CALIFICACION_MINIMA,promedioCurso,CALIFICACION_META));
                });
                return filas;
            }
            
            function drawChart() {
                var data = google.visualization.arrayToDataTable(generarTabla());

                var options = {
                  title: scope.titulo,
                  curveType: 'function',
                  legend: { position: 'bottom' },
                  pointSize: 5
                };
                var chart = new google.visualization.LineChart(element[0]);

                chart.draw(data, options);
              }
            
            scope.$on('destroy', function(){
                        listenQ();
                        listenP();
                    });
        }
    };
});


     

      
        

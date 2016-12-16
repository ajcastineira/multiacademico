'use strict';

angular.module('app.graphs').directive('materiaAulaCualitativoChart',
    function (Calificaciones, estadisticasCommon, CALIFICACION_MINIMA, CALIFICACION_META) {
            return {
                restrict: 'A',

             compile: function compile(tElement, tAttrs, transclude) {
                  return {
                     pre: function preLink(scope, iElement, iAttrs, controller) {
                        
                         /**
                          * promediosDeEsteCurso se lo obtiene del window por ahora para que no afecte al modal
                          */
                         scope.promediosAula=promediosDeEsteCurso;
                    google.charts.load('current', {'packages':['corechart']});
                    var promediosAulaCualitativos=[];
                    scope.promediosAula.forEach(function(e){
                        promediosAulaCualitativos.push(Calificaciones.getNotaCualitativa(e));
                    });
                    var estadisticaPromedios= estadisticasCommon.resumenDeNotasPorCualidad(promediosAulaCualitativos);
                    var generarFila=function(cualidad,cantidad, color){
                            return [cualidad, cantidad, color];
                        };
                    var generarTabla=function(){
                        var encabezado=['Cualidad', 'Cantidad',{ role: 'style' }];
                        var filas=[encabezado];
                        filas.push(generarFila('NAR',estadisticaPromedios.nNAR,'#dc3912"'));
                        filas.push(generarFila('PAAR',estadisticaPromedios.nPAAR,'#ff9900'));
                        filas.push(generarFila('AAR',estadisticaPromedios.nAAR,'#109618'));
                        filas.push(generarFila('DAR',estadisticaPromedios.nDAR,'#990099'));
                        return filas;
                        };
                        
                    
                    //{"#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"}
                    function drawChart() {
                        /**
                         * 
                         * parche temporal
                         */
                        
                        var totalE= estadisticaPromedios.nDAR+estadisticaPromedios.nAAR+estadisticaPromedios.nPAAR+estadisticaPromedios.nNAR;
                        jQuery(angular.element.find('#dar-value')).html(estadisticaPromedios.nDAR);
                        jQuery(angular.element.find('#dar-percent')).html(Math.round(((estadisticaPromedios.nDAR)/totalE) * 100)+'%');
                        jQuery(angular.element.find('#aar-value')).html(estadisticaPromedios.nAAR);
                        jQuery(angular.element.find('#aar-percent')).html(Math.round(((estadisticaPromedios.nAAR)/totalE) * 100)+'%');
                        jQuery(angular.element.find('#paar-value')).html(estadisticaPromedios.nPAAR);
                        jQuery(angular.element.find('#paar-percent')).html(Math.round(((estadisticaPromedios.nPAAR)/totalE) * 100)+'%');
                        jQuery(angular.element.find('#nar-value')).html(estadisticaPromedios.nNAR||'0');
                        jQuery(angular.element.find('#nar-percent')).html(Math.round(((estadisticaPromedios.nNAR)/totalE) * 100)+'%');
                        
                        /**
                         * 
                         * fin parche temporal
                         */
                        
                        var data = google.visualization.arrayToDataTable(generarTabla());
                        var options = {
                          title: 'Resumen materia Aula',
                          colors: ["#dc3912","#ff9900","#109618","#990099"],
                          /*vAxis: {title: 'Porcentaje Alumnos' },
                          hAxis: {title: 'Materias',

                                  showTextEvery: 1,
                                  maxTextLines: 5,
                                  textStyle: {
                                     fontSize: 8
                                 }
                                },
                          isStacked: 'percent',      
                          seriesType: 'bars',*/

                         // series: {5: {type: 'line'}}
                          //curveType: 'function',
                          legend: { position: 'none' },
                          //pointSize: 5
                        };
                        var chart = new google.visualization.ColumnChart(iElement[0]);
                        
                        google.visualization.events.addListener(chart, 'ready', function () {
                            //parche tambien
                          angular.element(".printable").html(angular.element("#remoteModalCalificaciones").html());
                        });
                        
                        chart.draw(data, options);
                      }
                      google.charts.setOnLoadCallback(drawChart);
                         
                     },
                     //post: function postLink(scope, iElement, iAttrs, controller) { ... }
                  }
                  // or
                  // return function postLink( ... ) { ... }
                },
                link: function (scope, element, attributes) {
                    
                      
                      
                    scope.$on('$destroy', function(){
                        
                    });
                }
            };
});


     

      
        

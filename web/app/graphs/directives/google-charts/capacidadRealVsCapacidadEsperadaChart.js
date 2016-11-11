'use strict';

angular.module('app.graphs').directive('capacidadRealVsCapacidadEsperadaChart',
    function (Calificaciones, CALIFICACION_MINIMA, CALIFICACION_META) {
            return {
                restrict: 'A',
                scope: {
                    titulo: '@',
                    graphdata: '=',
                    q: '=',
                    p: '='
                },
                link: function (scope, element, attributes) {

                    google.charts.load('current', {'packages':['corechart']});

                    var aula=scope.aula;
                    var calificacionMeta=CALIFICACION_META;

                    var listenQ = scope.$watch(attributes.q, function(value) {
                        google.charts.setOnLoadCallback(drawChart);
                    });
                    var listenP =scope.$watch(attributes.p, function(value) {
                        google.charts.setOnLoadCallback(drawChart);
                    });

                    //{"#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"}
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(scope.graphdata);
                        var options = {
                          title: scope.titulo,
                          colors: ["#3366cc","#109618","#990099","#ff9900","#dc3912","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"],
                          vAxis: { title: 'Valor',
                            viewWindow: {
                                max: 10
                            },
                           maxValue:10},
                          hAxis: {title: 'Aulas',
                                  showTextEvery: 1,
                                  maxTextLines: 5,
                                  textStyle: {
                                     fontSize: 8
                                 }
                                },
                          //isStacked: 'percent',      
                          seriesType: 'bars',

                          series: {
                                   1: {type: 'line'},
                                   2: {type: 'line'}
                                    },
                          //curveType: 'function',
                          //legend: { position: 'bottom' },
                          //pointSize: 5
                        };
                        var chart = new google.visualization.ComboChart(element[0]);

                        chart.draw(data, options);
                      }

                    scope.$on('destroy', function(){
                        listenQ();
                        listenP();
                    });
                }
            };
});


     

      
        

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
                /*compile: function (element, attributes) {
                   
                    
                },*/
                link: function (scope, element, attributes) {
                    
                    google.charts.load('current', {'packages':['corechart', 'controls']});
                    
                    var $filterDiv = $('<div id="filter_div">filter</div>')
                        .appendTo(element);
                    var $chartDiv = $('<div id="chart_div">chart</div>')
                        .appendTo(element);
                    
                    var aula=scope.aula;
                    var calificacionMeta=CALIFICACION_META;

                    var listenQ = scope.$watch(attributes.q, function(value) {
                        google.charts.setOnLoadCallback(drawDashboard);
                    });
                    var listenP =scope.$watch(attributes.p, function(value) {
                        google.charts.setOnLoadCallback(drawDashboard);
                    });

                    //{"#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6","#dd4477","#66aa00","#b82e2e","#316395","#994499","#22aa99","#aaaa11","#6633cc","#e67300","#8b0707","#651067","#329262","#5574a6","#3b3eac","#b77322","#16d620","#b91383","#f4359e","#9c5935","#a9c413","#2a778d","#668d1c","#bea413","#0c5922","#743411"}
                    function drawDashboard() {
                        
                        var data = google.visualization.arrayToDataTable(scope.graphdata);
                        
                         // Create a dashboard.
                        var dashboard = new google.visualization.Dashboard(element[0]);
                        // Create a range slider, passing some options
                        var rangeSlider = new google.visualization.ControlWrapper({
                          'controlType': 'CategoryFilter',
                          'containerId': 'filter_div',
                          'options': {
                            'filterColumnLabel': 'Aulas',
                            'ui':{
                                caption:'Seleccione Aulas',
                            }
                          }
                        });
                        
                        var options = {
                          title: scope.titulo,
                          height: 300,
                          //'width': 300,
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
                        
                        // Create a combo chart, passing some options
                        var chart = new google.visualization.ChartWrapper({
                          'chartType': 'ComboChart',
                          'containerId': 'chart_div',
                          'options': options
                        });
                                                
                        dashboard.bind(rangeSlider, chart);

                        // Draw the dashboard.
                        dashboard.draw(data);
                        
                      }

                    scope.$on('$destroy', function(){
                        listenQ();
                        listenP();
                    });
                }
            };
});


     

      
        

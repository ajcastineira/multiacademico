'use strict';

angular.module('app.graphs').directive('histogramaPromediosChart',
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
                    
                    google.charts.load('current', {'packages':['corechart', 'controls'],'callback': drawDashboard});
                    
                    var $filterDiv = $('<div id="filter_div_h">filter</div>')
                        .appendTo(element);
                    var $chartDiv = $('<div id="chart_div_h">chart</div>')
                        .appendTo(element);
                    
                    var aula=scope.aula;
                    var calificacionMeta=CALIFICACION_META;

                    var listenQ = scope.$watch(attributes.q, function(value) {
                        google.charts.setOnLoadCallback(drawDashboard);
                    });
                    var listenP =scope.$watch(attributes.p, function(value) {
                        google.charts.setOnLoadCallback(drawDashboard);
                    });

                    function drawDashboard() {
                        
                        var data = google.visualization.arrayToDataTable(scope.graphdata);
                        
                         // Create a dashboard.
                        var dashboard = new google.visualization.Dashboard(element[0]);
                        // Create a range slider, passing some options
                        var rangeSlider = new google.visualization.ControlWrapper({
                          'controlType': 'NumberRangeFilter',
                          'containerId': 'filter_div_h',
                          'options': {
                            'filterColumnLabel': 'Nota',
                            'ui':{
                                caption:'Rango',
                            }
                          }
                        });
                        
                        var options = {
                          title: scope.titulo,
                          height: 300,
                          hAxis: {title: 'Promedio'
                                },
                          legend: { position: 'none' }
                        };
                        
                        var chart = new google.visualization.ChartWrapper({
                          'chartType': 'Histogram',
                          'containerId': 'chart_div_h',
                          'options': options
                        });
                                                
                        dashboard.bind(rangeSlider, chart);
                        
                        dashboard.draw(data);
                        
                      }

                    scope.$on('$destroy', function(){
                        listenQ();
                        listenP();
                    });
                }
            };
});


     

      
        

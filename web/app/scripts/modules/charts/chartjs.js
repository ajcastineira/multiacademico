/* ==========================================================================
 * Plugins used: chartjs chart
 * ---------------------------------------------------------------------------
 * - BAR
 * - DOUGHNUT
 * - LINE
 * - PIE
 * - POLAR AREA
 * - RADAR
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.charts.chartjs', [])

        // =========================================================================
        // BAR
        // =========================================================================
        .controller('ChartjsBarCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = {
                labels : ["January","February","March","April","May","June","July"],
                datasets : [
                    {
                        fillColor : "#E9573F",
                        strokeColor : "#f55b43",
                        data : [65,59,90,81,56,55,40]
                    },
                    {
                        fillColor : "#00B1E1",
                        strokeColor : "#00c3f4",
                        data : [28,48,40,19,96,27,100]
                    }
                ]
            };

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero : true,

                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - If there is a stroke on each bar
                barShowStroke : true,

                //Number - Pixel width of the bar stroke
                barStrokeWidth : 2,

                //Number - Spacing between each of the X value sets
                barValueSpacing : 5,

                //Number - Spacing between data sets within X values
                barDatasetSpacing : 1

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
            };

        })

        // =========================================================================
        // DOUGHNUT
        // =========================================================================
        .controller('ChartjsDoughnutCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = [
                {
                    value: 20,
                    color:"#37BC9B"
                },
                {
                    value : 70,
                    color : "#8CC152"
                },
                {
                    value : 50,
                    color : "#00B1E1"
                },
                {
                    value : 40,
                    color : "#E9573F"
                },
                {
                    value : 90,
                    color : "#F6BB42"
                }
            ];

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke : true,

                //String - The colour of each segment stroke
                segmentStrokeColor : '#fff',

                //Number - The width of each segment stroke
                segmentStrokeWidth : 2,

                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout : 50, // This is 0 for Pie charts

                //Number - Amount of animation steps
                animationSteps : 100,

                //String - Animation easing effect
                animationEasing : 'easeOutBounce',

                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate : true,

                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale : false

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            };

        })

        // =========================================================================
        // LINE
        // =========================================================================
        .controller('ChartjsLineCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = {
                labels : ["January","February","March","April","May","June","July"],
                datasets : [
                    {
                        fillColor : "#F6BB42",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        data : [30,60,90,120,150,180,210]
                    },
                    {
                        fillColor : "#8D8D6E",
                        pointColor : "rgba(151,187,205,1)",
                        pointStrokeColor : "#fff",
                        data : [20,40,60,80,90,110,130]
                    }
                ]
            };

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                ///Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - Whether the line is curved between points
                bezierCurve : true,

                //Number - Tension of the bezier curve between points
                bezierCurveTension : 0.4,

                //Boolean - Whether to show a dot for each point
                pointDot : true,

                //Number - Radius of each point dot in pixels
                pointDotRadius : 4,

                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,

                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,

                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,

                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,

                //Boolean - Whether to fill the dataset with a colour
                datasetFill : true,

                // Function - on animation progress
                onAnimationProgress: function(){},

                // Function - on animation complete
                onAnimationComplete: function(){}

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].strokeColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
            };

        })

        // =========================================================================
        // PIE
        // =========================================================================
        .controller('ChartjsPieCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = [
                {
                    value: 30,
                    color:"#8CC152"
                },
                {
                    value : 40,
                    color : "#E9573F"
                },
                {
                    value : 50,
                    color : "#F6BB42"
                }
            ];

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke : true,

                //String - The colour of each segment stroke
                segmentStrokeColor : '#fff',

                //Number - The width of each segment stroke
                segmentStrokeWidth : 2,

                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout : 0, // This is 0 for Pie charts

                //Number - Amount of animation steps
                animationSteps : 100,

                //String - Animation easing effect
                animationEasing : 'easeOutBounce',

                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate : true,

                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale : false

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'

            };

        })

        // =========================================================================
        // POLAR AREA
        // =========================================================================
        .controller('ChartjsPolarAreaCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = [
                {
                    value : Math.random(),
                    color: "#D97041"
                },
                {
                    value : Math.random(),
                    color: "#C7604C"
                },
                {
                    value : Math.random(),
                    color: "#21323D"
                },
                {
                    value : Math.random(),
                    color: "#9D9B7F"
                },
                {
                    value : Math.random(),
                    color: "#7D4F6D"
                },
                {
                    value : Math.random(),
                    color: "#584A5E"
                }
            ];

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                //Boolean - Show a backdrop to the scale label
                scaleShowLabelBackdrop : true,

                //String - The colour of the label backdrop
                scaleBackdropColor : 'rgba(255,255,255,0.75)',

                // Boolean - Whether the scale should begin at zero
                scaleBeginAtZero : true,

                //Number - The backdrop padding above & below the label in pixels
                scaleBackdropPaddingY : 2,

                //Number - The backdrop padding to the side of the label in pixels
                scaleBackdropPaddingX : 2,

                //Boolean - Show line for each value in the scale
                scaleShowLine : true,

                //Boolean - Stroke a line around each segment in the chart
                segmentShowStroke : true,

                //String - The colour of the stroke on each segement.
                segmentStrokeColor : '#fff',

                //Number - The width of the stroke value in pixels
                segmentStrokeWidth : 2,

                //Number - Amount of animation steps
                animationSteps : 100,

                //String - Animation easing effect.
                animationEasing : 'easeOutBounce',

                //Boolean - Whether to animate the rotation of the chart
                animateRotate : true,

                //Boolean - Whether to animate scaling the chart from the centre
                animateScale : false

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            };

        })

        // =========================================================================
        // RADAR
        // =========================================================================
        .controller('ChartjsRadarCtrl', function ($scope) {

            // Chart.js Data
            $scope.data = {
                labels : ["Eating","Drinking","Sleeping","Designing","Coding","Partying","Running"],
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,1)",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        data : [65,59,90,81,56,55,40]
                    },
                    {
                        fillColor : "rgba(151,187,205,0.5)",
                        strokeColor : "rgba(151,187,205,1)",
                        pointColor : "rgba(151,187,205,1)",
                        pointStrokeColor : "#fff",
                        data : [28,48,40,19,96,27,100]
                    }
                ]
            };

            // Chart.js Options
            $scope.options =  {

                // Sets the chart to be responsive
                responsive: true,

                //Boolean - Whether to show lines for each scale point
                scaleShowLine : true,

                //Boolean - Whether we show the angle lines out of the radar
                angleShowLineOut : true,

                //Boolean - Whether to show labels on the scale
                scaleShowLabels : false,

                // Boolean - Whether the scale should begin at zero
                scaleBeginAtZero : true,

                //String - Colour of the angle line
                angleLineColor : 'rgba(0,0,0,.1)',

                //Number - Pixel width of the angle line
                angleLineWidth : 1,

                //String - Point label font declaration
                pointLabelFontFamily : '"Arial"',

                //String - Point label font weight
                pointLabelFontStyle : 'normal',

                //Number - Point label font size in pixels
                pointLabelFontSize : 10,

                //String - Point label font colour
                pointLabelFontColor : '#666',

                //Boolean - Whether to show a dot for each point
                pointDot : true,

                //Number - Radius of each point dot in pixels
                pointDotRadius : 3,

                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,

                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,

                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,

                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,

                //Boolean - Whether to fill the dataset with a colour
                datasetFill : true

                //String - A legend template
                // If you use legend just type on attribut element "auto-legend"
                //legendTemplate : '<ul class="tc-chart-js-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].strokeColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
            };

        })

})();
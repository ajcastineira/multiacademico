/* ==========================================================================
 * Plugins used: morris chart
 * --------------------------------------------------------------------------
 * TABLE OF CONTENT
 * --------------------------------------------------------------------------
 * - LINE
 * - AREA
 * - BAR
 * - DONUT
 ============================================================================ */
'use strict';
(function(){
    angular.module('blankonApp.charts.c3js', [])

        // =========================================================================
        // LINE
        // =========================================================================
        .controller('C3jsLineChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'data1':30,'data2':50,'data3':130},
                {'data1':200,'data2':20,'data3':150},
                {'data1':100,'data2':10,'data3':200},
                {'data1':400,'data2':40,'data3':300},
                {'data1':150,'data2':15,'data3':200},
                {'data1':250,'data2':25,'data3':100}
            ];
            $scope.datacolumns=[
                {'id':'data1','name':'Data 1','type':'line','color':'#E9573F'},
                {'id':'data2','name':'Data 2','type':'line','color':'#00B1E1'},
                {'id':'data3','name':'Data 3','type':'line','color':'#37BC9B'}
            ];
        })

        // =========================================================================
        // BAR
        // =========================================================================
        .controller('C3jsBarChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'data1':30,'data2':50,'data3':130},
                {'data1':200,'data2':20,'data3':-150},
                {'data1':100,'data2':10,'data3':200},
                {'data1':400,'data2':40,'data3':300},
                {'data1':150,'data2':15,'data3':-200},
                {'data1':250,'data2':25,'data3':100}
            ];
            $scope.datacolumns=[
                {'id':'data1','name':'Data 1','type':'bar','color':'#E9573F'},
                {'id':'data2','name':'Data 2','type':'bar','color':'#00B1E1'},
                {'id':'data3','name':'Data 3','type':'bar','color':'#37BC9B'}
            ];
        })

        // =========================================================================
        // AREA
        // =========================================================================
        .controller('C3jsAreaChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'data1':300,'data2':130},
                {'data1':350,'data2':100},
                {'data1':300,'data2':140},
                {'data1':0,'data2':200},
                {'data1':0,'data2':150},
                {'data1':0,'data2':50}
            ];
            $scope.datacolumns=[
                {'id':'data1','name':'Data 1','type':'area','color':'#E9573F'},
                {'id':'data2','name':'Data 2','type':'area-spline','color':'#00B1E1'}
            ];
        })

        // =========================================================================
        // STACKED
        // =========================================================================
        .controller('C3jsStackedChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'data1':-30,'data2':130,'data3':-230,'data4':100},
                {'data1':200,'data2':100,'data3':200,'data4':-50},
                {'data1':200,'data2':-100,'data3':200,'data4':150},
                {'data1':400,'data2':200,'data3':-300,'data4':200},
                {'data1':-150,'data2':-150,'data3':250,'data4':-300},
                {'data1':250,'data2':50,'data3':250,'data4':-100}
            ];
            $scope.datacolumns=[
                {'id':'data1','name':'Data 1','type':'bar','color':'#E9573F'},
                {'id':'data2','name':'Data 2','type':'bar','color':'#00B1E1'},
                {'id':'data3','name':'Data 3','type':'bar','color':'#37BC9B'},
                {'id':'data4','name':'Data 4','type':'bar','color':'#906094'}
            ];
        })

        // =========================================================================
        // PIE
        // =========================================================================
        .controller('C3jsPieChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'internetExplorer':0.2,'mozillaFirefox':1.4,'googleChrome':2.5},
                {'internetExplorer':0.2,'mozillaFirefox':1.5,'googleChrome':1.9},
                {'internetExplorer':0.2,'mozillaFirefox':1.5,'googleChrome':2.1},
                {'internetExplorer':0.2,'mozillaFirefox':1.3,'googleChrome':1.8},
                {'internetExplorer':0.2,'mozillaFirefox':1.5,'googleChrome':2.2},
                {'internetExplorer':0.4,'mozillaFirefox':1.3,'googleChrome':2.1}
            ];
            $scope.datacolumns=[
                {'id':'internetExplorer','name':'Internet Explorer','type':'pie','color':'#E9573F'},
                {'id':'mozillaFirefox','name':'Mozilla Firefox','type':'pie','color':'#00B1E1'},
                {'id':'googleChrome','name':'Google Chrome','type':'pie','color':'#37BC9B'}
            ];
        })

        // =========================================================================
        // DONUT
        // =========================================================================
        .controller('C3jsDonutChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'blackberry':0.2,'android':1.4,'iphone':2.5},
                {'blackberry':0.2,'android':1.5,'iphone':1.9},
                {'blackberry':0.2,'android':1.5,'iphone':2.1},
                {'blackberry':0.2,'android':1.3,'iphone':1.8},
                {'blackberry':0.2,'android':1.5,'iphone':2.2},
                {'blackberry':0.4,'android':1.3,'iphone':2.1}
            ];
            $scope.datacolumns=[
                {'id':'blackberry','name':'Blackberry','type':'donut','color':'#E9573F'},
                {'id':'android','name':'Android','type':'donut','color':'#00B1E1'},
                {'id':'iphone','name':'Iphone','type':'donut','color':'#37BC9B'}
            ];
        })

        // =========================================================================
        // COMBINATION
        // =========================================================================
        .controller('C3jsCombinationChartCtrl', function ($scope) {
            $scope.datapoints=[
                {'data1':30,'data2':200,'data3':300,'data4':200,'data5':130},
                {'data1':20,'data2':130,'data3':200,'data4':130,'data5':120},
                {'data1':50,'data2':90,'data3':160,'data4':90,'data5':150},
                {'data1':40,'data2':240,'data3':400,'data4':240,'data5':140},
                {'data1':60,'data2':130,'data3':250,'data4':130,'data5':160},
                {'data1':50,'data2':220,'data3':250,'data4':220,'data5':150}
            ];
            $scope.datacolumns=[
                {'id':'data1','name':'Data 1','type':'bar','color':'#E9573F'},
                {'id':'data2','name':'Data 2','type':'bar','color':'#00B1E1'},
                {'id':'data3','name':'Data 3','type':'spline','color':'#37BC9B'},
                {'id':'data4','name':'Data 4','type':'line','color':'#906094'},
                {'id':'data5','name':'Data 5','type':'bar','color':'#1F77B4'}
            ];
        })

})();
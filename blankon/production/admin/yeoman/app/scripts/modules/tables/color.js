"use strict";
(function(){
    angular.module('blankonApp.tables.color', [])

        .controller('TableColorCtrl', function($scope, $http, settings) {

            // =========================================================================
            // TABLE DEFAULT
            // =========================================================================
            $scope.tables = [];
            $http.get(settings.dataPath+'/views/tables/color.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.tables = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
        })

})();
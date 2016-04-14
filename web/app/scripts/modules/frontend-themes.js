"use strict";
(function(){
    angular.module('blankonApp.frontendThemes', [])

        .controller('FrontendThemesCtrl', function($scope, $http, settings) {

            // List of frontend themes to show
            $scope.themes = [];
            $http.get(settings.dataPath+'/views/frontend-themes.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.themes = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });

        });

})();
"use strict";
(function(){
    angular.module('blankonApp.pages.messages', [])

        .controller('MessagesCtrl', function($scope, $http, settings) {

            // List of invoices to show
            $scope.messages = [];
            $http.get(settings.dataPath+'/views/pages/messages.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.messages = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });

        });

})();
"use strict";
(function(){
    angular.module('blankonApp.pages.invoice', [])

        .controller('InvoiceCtrl', function($scope, $http, settings) {

            // List of invoices to show
            $scope.invoice = [];
            $http.get(settings.dataPath+'/views/pages/invoice.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.invoice = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });

        });

})();
/* ==========================================================================
 * Plugins used: bootstrap wysihtml5
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.blog.single', [])

        .controller('BlogSingleCtrl', function($scope, $http, settings) {

            // List of blog to show
            $scope.blogs = [];
            $http.get(settings.dataPath+'/views/blog/single.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.blogs = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });

        })

    // =========================================================================
    // BOOTSTRAP WYSIHTML5
    // =========================================================================
    .directive('wysihtml5Textarea', function () {
        return {
            restrict: 'A',
            link: function (scope, element) {
                element.wysihtml5();
            }
        }
    })

})();
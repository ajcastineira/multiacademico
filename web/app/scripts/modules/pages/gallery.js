"use strict";
(function(){
    var app = angular.module('blankonApp.pages.gallery', []);

    app.controller('GalleryCtrl',['$scope', function($scope) {

        // =========================================================================
        // MIXITUP
        // =========================================================================
        $scope.mixitup = function () {
            $('#gallery').mixItUp({
                animation: {
                    animateResizeContainer: false,
                    duration: 400,
                    effects: 'fade translateZ(-360px) stagger(34ms)',
                    easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)'
                }
            });
            setTimeout(function () {
                $('#gallery').mixItUp('setOptions', {
                    animation: {
                        easing: 'ease'
                    }
                });
            }, 1000)
        };

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        $scope.mixitup(); // Call mixitup

    }]);

})();
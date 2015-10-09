/* ==========================================================================
 * Plugins used: Gmap3
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.pages.timeline', [])

        .controller('TimelineCtrl', ['$scope', '$window', '$q', function($scope, $window, $q){

            $scope.loadScript = function () {
                var s = document.createElement('script'); // use global document since Angular's $document is weak
                s.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize';
                document.body.appendChild(s);
            };

            $scope.lazyLoadApi = function () {
                var deferred = $q.defer();
                $window.initialize = function () {
                    deferred.resolve();
                };
                // thanks to Emil Stenström: http://friendlybit.com/js/lazy-loading-asyncronous-javascript/
                if ($window.attachEvent) {
                    $window.attachEvent('onload', $scope.loadScript());
                } else {
                    $window.addEventListener('load', $scope.loadScript(), false);
                }
                return deferred.promise;
            };

            // =========================================================================
            // WITH MARKER
            // =========================================================================
            $scope.mapMarker = function () {
                var mapId = $('#map-marker');
                mapId.gmap3({
                    marker:{
                        latLng:[29.132318972825445,81.32052349999992]
                    }
                });
            };

            // in this example, it shows how and when the promises are resolved
            if ($window.google && $window.google.maps) {
                console.log('gmaps already loaded');
                $scope.mapMarker(); // call map marker
            } else {
                $scope.lazyLoadApi().then(function () {
                    console.log('promise resolved');
                    if ($window.google && $window.google.maps) {
                        console.log('gmaps loaded');
                        $scope.mapMarker(); // call map marker
                    } else {
                        console.log('gmaps not loaded');
                    }
                }, function () {
                    console.log('promise rejected');
                });
            }

        }]);

})();
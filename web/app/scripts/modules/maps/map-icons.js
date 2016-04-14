/* ==========================================================================
 * Plugins used: Gmap3
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.maps.icon', [])
        .controller('IconMapCtrl', ['$scope', '$window', '$q', function($scope, $window, $q){

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

            $scope.mapIcon = function () {
                var mapOptions = {
                    zoom: 12,
                    center: new google.maps.LatLng(-33.9, 151.2),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: [
                        {stylers: [{ visibility: 'simplified' }]},
                        {elementType: 'labels', stylers: [{ visibility: 'off' }]}
                    ]
                };
                var map = new google.maps.Map(document.getElementById('map-icons'), mapOptions);

                var marker1 = new Marker({
                    map: map,
                    zIndex: 10,
                    title: 'Map Icons',
                    position:  new google.maps.LatLng(-33.890542, 151.274856),
                    icon: {
                        path: MAP_PIN,
                        fillColor: '#0E77E9',
                        fillOpacity: 1,
                        strokeColor: '',
                        strokeWeight: 0,
                        scale: 1/2
                    },
                    label: '<i class="map-icon-walking"></i>'
                });

                var marker2 = new Marker({
                    map: map,
                    zIndex: 20,
                    title: 'Map Icons',
                    position:  new google.maps.LatLng(-33.923036, 151.259052),
                    icon: {
                        path: SQUARE_PIN,
                        fillColor: '#0E77E9',
                        fillOpacity: 1,
                        strokeColor: '',
                        strokeWeight: 0,
                        scale: 1/2
                    },
                    label: '<i class="map-icon-cafe"></i>'
                });

                var marker3 = new Marker({
                    map: map,
                    zIndex: 30,
                    title: 'Map Icons',
                    position:  new google.maps.LatLng(-34.028249, 151.157507),
                    icon: {
                        path: SHEILD,
                        fillColor: '#0E77E9',
                        fillOpacity: 1,
                        strokeColor: '',
                        strokeWeight: 0,
                        scale: 1/2
                    },
                    label: '<i class="map-icon-car-wash"></i>'
                });

                var marker4 = new Marker({
                    map: map,
                    zIndex: 40,
                    title: 'Map Icons',
                    position:  new google.maps.LatLng(-33.80010128657071, 151.28747820854187),
                    icon: {
                        path: ROUTE,
                        fillColor: '#0E77E9',
                        fillOpacity: 1,
                        strokeColor: '',
                        strokeWeight: 0,
                        scale: 1/2
                    },
                    label: '<i class="map-icon-male"></i>'
                });
            };

            // in this example, it shows how and when the promises are resolved
            if ($window.google && $window.google.maps) {
                console.log('gmaps already loaded');
                google.maps.event.addDomListener(window, 'load', $scope.mapIcon()); // call map icons
            } else {
                $scope.lazyLoadApi().then(function () {
                    console.log('promise resolved');
                    if ($window.google && $window.google.maps) {
                        console.log('gmaps loaded');
                        google.maps.event.addDomListener(window, 'load', $scope.mapIcon()); // call map icons
                    } else {
                        console.log('gmaps not loaded');
                    }
                }, function () {
                    console.log('promise rejected');
                });
            }

        }])

})();


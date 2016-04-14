/* ==========================================================================
 * Plugins used: Gmap3
 * --------------------------------------------------------------------------
 * TABLE OF CONTENT
 * --------------------------------------------------------------------------
 * - STREET VIEW MARKER
 * - WITH MARKER
 * - MULTIPLE MARKER
 * - ADDRESS MAP
 * - TAG MAP
 * - CIRCLE MAP
 * - ELEVATION MAP
 * - INFO WINDOW
 * - TRAFFIC MAP
 * - PANEL MAP
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.maps.google', [])
        .controller('GoogleMapCtrl', ['$scope', '$window', '$q', function($scope, $window, $q){

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
            // STREET VIEW MARKER
            // =========================================================================
            $scope.mapStreetViewMarker = function () {
                var mapId = $('#map-street-view-marker');
                mapId.gmap3({
                    map:{
                        options:{
                            zoom: 18,
                            center: new google.maps.LatLng(40.729884, -73.990988)
                        }
                    }
                });
                var map = mapId.gmap3('get'),
                    panorama = map.getStreetView();
                panorama.setPosition(map.getCenter());
                panorama.setPov({
                    heading: 265,
                    zoom:1,
                    pitch:0
                });
                panorama.setVisible(true);
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

            // =========================================================================
            // MULTIPLE MARKER
            // =========================================================================
            $scope.mapMultipleMarker = function () {
                var mapId = $('#multiple-marker');
                mapId.gmap3({
                    map:{
                        options:{
                            center:[46.578498,2.457275],
                            zoom: 5
                        }
                    },
                    marker:{
                        values:[
                            {latLng:[48.8620722, 2.352047], data:"Paris !"},
                            {address:"86000 Poitiers, France", data:"Poitiers : great city !"},
                            {address:"66000 Perpignan, France", data:"Perpignan ! <br> GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}
                        ],
                        options:{
                            draggable: false
                        },
                        events:{
                            mouseover: function(marker, event, context){
                                var map = $(this).gmap3("get"),
                                    infowindow = $(this).gmap3({get:{name:"infowindow"}});
                                if (infowindow){
                                    infowindow.open(map, marker);
                                    infowindow.setContent(context.data);
                                } else {
                                    $(this).gmap3({
                                        infowindow:{
                                            anchor:marker,
                                            options:{content: context.data}
                                        }
                                    });
                                }
                            },
                            mouseout: function(){
                                var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                                if (infowindow){
                                    infowindow.close();
                                }
                            }
                        }
                    }
                });
            };

            // =========================================================================
            // ADDRESS MAP
            // =========================================================================
            $scope.mapAddress = function () {
                var mapId = $('#map-address');
                mapId.gmap3({
                    marker:{
                        address: "Haltern am See, Weseler Str. 151"
                    },
                    map:{
                        options:{
                            zoom: 14
                        }
                    }
                });
            };

            // =========================================================================
            // TAG MAP
            // =========================================================================
            $scope.mapTag = function () {
                var mapId = $('#map-tag'),
                    colors = "black brown green purple yellow grey orange white".split(" "),
                    letters = "A B C D E F".split(" ");

                mapId.gmap3({
                    map:{
                        options:{
                            zoom: 2,
                            mapTypeId: google.maps.MapTypeId.TERRAIN
                        },
                        onces: {
                            bounds_changed: function(){
                                var $this = $(this),
                                    bounds = $this.gmap3("get").getBounds(),
                                    southWest = bounds.getSouthWest(),
                                    northEast = bounds.getNorthEast(),
                                    lngSpan = northEast.lng() - southWest.lng(),
                                    latSpan = northEast.lat() - southWest.lat(),
                                    i, color, letter;
                                for (i = 0; i < 50; i++) {
                                    letter = letters[Math.floor(Math.random() * letters.length)];
                                    color = colors[Math.floor(Math.random() * colors.length)];

                                    $this.gmap3({
                                        marker:{
                                            latLng:[southWest.lat() + latSpan * Math.random(), southWest.lng() + lngSpan * Math.random()],
                                            options:{
                                                icon: "http://maps.google.com/mapfiles/marker_"+color+letter+".png"
                                            },
                                            tag:[color, letter]
                                        }
                                    });
                                }
                            }
                        }
                    }
                });

                setTimeout(function(){
                    $("#test").gmap3({
                        clear:{
                            name:"marker",
                            tag: ["black", "brown", "green", "purple", "A", "B", "C"],
                            all: true
                        }
                    });
                }, 3000);
            };

            // =========================================================================
            // CIRCLE MAP
            // =========================================================================
            $scope.mapCircle = function () {
                var mapId = $('#map-circle');
                mapId.gmap3({
                    circle:{
                        options:{
                            center: [37.772323, -122.214897],
                            radius : 250,
                            fillColor : "#008BB2",
                            strokeColor : "#005BB7"
                        },
                        events:{
                            click: function(circle){
                                circle.setOptions({
                                    fillColor : "#FFAF9F",
                                    strokeColor : "#FF512F"
                                });
                            }
                        },
                        callback: function(){
                            $(this).gmap3('get').setZoom(15);
                        }
                    }
                });
            };

            // =========================================================================
            // ELEVATION MAP
            // =========================================================================
            $scope.mapElevation = function () {
                var mapId = $('#map-elevation');
                mapId.gmap3({
                    marker:{
                        latLng: [63.3333333, -150.5],
                        options:{
                            draggable:true
                        },
                        events:{
                            dragend: function(marker){
                                $(this).gmap3({
                                    getelevation:{
                                        latLng:marker.getPosition(),
                                        callback:function(results){
                                            var map = $(this).gmap3("get"),
                                                infowindow = $(this).gmap3({get:"infowindow"}),
                                                content = results && results[0] ? Math.round(results[0].elevation) + " meters" : "no result";
                                            if (infowindow){
                                                infowindow.open(map, marker);
                                                infowindow.setContent(content);
                                            } else {
                                                $(this).gmap3({
                                                    infowindow:{
                                                        anchor:marker,
                                                        options:{content: content}
                                                    }
                                                });
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    },
                    map:{
                        options:{
                            zoom: 8,
                            mapTypeId:  google.maps.MapTypeId.TERRAIN
                        }
                    }
                });
            };

            // =========================================================================
            // INFO WINDOW
            // =========================================================================
            $scope.mapInfoWindow = function () {
                var mapId = $('#map-info-window');
                mapId.gmap3({
                    infowindow:{
                        address:"Pourrieres, France",
                        options:{
                            content: "Blankon Fullpack Admin Theme Just $18"
                        },
                        events:{
                            closeclick: function(infowindow){
                                alert("closing : " + infowindow.getContent());
                            }
                        }
                    }
                });
            };

            // =========================================================================
            // TRAFFIC MAP
            // =========================================================================
            $scope.mapTraffic = function () {
                var mapId = $('#map-traffic');
                mapId.gmap3({ map:{
                        options:{
                            center:[34.04924594193164, -118.24104309082031],
                            zoom: 13
                        }
                    }
                    },
                    "trafficlayer");
            };

            // =========================================================================
            // PANEL MAP
            // =========================================================================
            $scope.mapPanel = function () {
                var mapId = $('#map-panel');
                mapId.gmap3(
                    { panel:{
                        options:{
                            content: '<div id="panel-box">' +
                            '<div id="lat-north" class="line-panel"><div class="name">North</div><div class="value"></div></div>' +
                            '<div id="lng-east" class="line-panel"><div class="name">East</div><div class="value"></div></div>' +
                            '<div id="lat-south" class="line-panel"><div class="name">South</div><div class="value"></div></div>' +
                            '<div id="lng-west" class="line-panel"><div class="name">West</div><div class="value"></div></div>' +
                            '</div>',
                            middle: true,
                            right: true
                        }
                    },
                        map:{
                            options:{
                                zoom: 5
                            },
                            events:{
                                bounds_changed: function(map){
                                    var bounds = map.getBounds();
                                    var ne = bounds.getNorthEast();
                                    var sw = bounds.getSouthWest();
                                    $("#lat-north").find(".value").html(ne.lat());
                                    $("#lng-east").find(".value").html(ne.lng());
                                    $("#lat-south").find(".value").html(sw.lat());
                                    $("#lng-west").find(".value").html(sw.lng());
                                }
                            }
                        }
                    }
                );
            };

            // in this example, it shows how and when the promises are resolved
            if ($window.google && $window.google.maps) {
                console.log('gmaps already loaded');
                $scope.mapStreetViewMarker(); // call map street view marker
                $scope.mapMarker(); // call map marker
                $scope.mapMultipleMarker(); // call map multiple marker
                $scope.mapAddress(); // call map address
                $scope.mapTag(); // call map tag
                $scope.mapCircle(); // call map circle
                $scope.mapElevation(); // call map elevation
                $scope.mapInfoWindow(); // call map info window
                $scope.mapTraffic(); // call map traffic
                $scope.mapPanel(); // call map panel
            } else {
                $scope.lazyLoadApi().then(function () {
                    console.log('promise resolved');
                    if ($window.google && $window.google.maps) {
                        console.log('gmaps loaded');
                        $scope.mapStreetViewMarker(); // call map street view marker
                        $scope.mapMarker(); // call map marker
                        $scope.mapMultipleMarker(); // call map multiple marker
                        $scope.mapAddress(); // call map address
                        $scope.mapTag(); // call map tag
                        $scope.mapCircle(); // call map circle
                        $scope.mapElevation(); // call map elevation
                        $scope.mapInfoWindow(); // call map info window
                        $scope.mapTraffic(); // call map traffic
                        $scope.mapPanel(); // call map panel
                    } else {
                        console.log('gmaps not loaded');
                    }
                }, function () {
                    console.log('promise rejected');
                });
            }

        }])

})();


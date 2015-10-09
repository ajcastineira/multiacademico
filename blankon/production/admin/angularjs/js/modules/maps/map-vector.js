/* ==========================================================================
 * Plugins used: Jqvmap
 * --------------------------------------------------------------------------
 * TABLE OF CONTENT
 * --------------------------------------------------------------------------
 * - WORLD MAP
 * - USA MAP
 * - RUSIA MAP
 * - ALGERIA MAP
 * - GERMANY MAP
 * - CONTINENTS MAP
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.maps.vector', [])

        .controller('VectorMapCtrl', function () {
            // Optimalisation: Store the references outside the event handler:
            var $window = $(window);
            function checkWidth() {
                var windowsize = $window.width();
                // Check if view screen on greater then 720px and smaller then 1024px
                if (windowsize > 1024) {
                    $('.map-continent').width(752);
                }
                if (windowsize < 800) {
                    $('.map-continent').width(500);
                }
                if (windowsize < 500) {
                    $('.map-continent').width(280);
                }
            }
            // Execute on load
            checkWidth();
            // Bind event listener
            $(window).resize(checkWidth);
        })

        // =========================================================================
        // WORLD MAP
        // =========================================================================
        .directive('worldMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'world_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#E9573F',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#81b71a', '#8CC152'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // =========================================================================
        // USA MAP
        // =========================================================================
        .directive('usaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'usa_en',
                        enableZoom: true,
                        showTooltip: true,
                        selectedRegion: 'MO',
                        backgroundColor: null,
                        selectedColor: '#81b71a'
                    });
                }
            }
        })

        // =========================================================================
        // RUSIA MAP
        // =========================================================================
        .directive('rusiaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'russia_en',
                        backgroundColor: null,
                        selectedColor: '#81b71a',
                        enableZoom: true,
                        showTooltip: true
                    });
                }
            }
        })

        // =========================================================================
        // ALGERIA MAP
        // =========================================================================
        .directive('algeriaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'dz_fr',
                        enableZoom: true,
                        showTooltip: true,
                        backgroundColor: null,
                        selectedColor: '#81b71a'
                    });
                }
            }
        })

        // =========================================================================
        // GERMANY MAP
        // =========================================================================
        .directive('germanyMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'germany_en',
                        backgroundColor: null,
                        selectedColor: '#81b71a',
                        onRegionClick: function(element, code, region)
                        {
                            var message = 'You clicked "'
                                + region
                                + '" which has the code: '
                                + code.toUpperCase();

                            alert(message);
                        }
                    });
                }
            }
        })

        // =========================================================================
        // CONTINENTS MAP
        // =========================================================================

        // ASIA MAP
        .directive('asiaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'asia_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#81b71a', '#8CC152'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // EUROPE MAP
        .directive('europeMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'europe_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#E9573F', '#ba4a34'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // AUSTRALIA MAP
        .directive('australiaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'australia_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#C8EEFF', '#006491'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // AFRICA MAP
        .directive('africaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'africa_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#37BC9B', '#28846e'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // NORTH AMERICA MAP
        .directive('northAmericaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'north-america_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#906094', '#6e4972'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

        // SOUTH AMERICA MAP
        .directive('southAmericaMap', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.vectorMap({
                        map: 'south-america_en',
                        backgroundColor: null,
                        color: '#ffffff',
                        hoverOpacity: 0.7,
                        selectedColor: '#666666',
                        enableZoom: true,
                        showTooltip: true,
                        values: sample_data,
                        scaleColors: ['#5577B4', '#455b8c'],
                        normalizeFunction: 'polynomial'
                    });
                }
            }
        })

})();


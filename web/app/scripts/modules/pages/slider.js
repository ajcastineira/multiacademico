/* ==========================================================================
 * Plugins used: ion.rangeSlider
 * ---------------------------------------------------------------------------
 * TABLE OF CONTENT
 * - BASIC SLIDER
 * - CONTEXTUAL CLASSES SLIDER
 * - SKIN SLIDER
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.components.slider', [])

        // =========================================================================
        // BASIC SLIDER
        // =========================================================================
        .directive('slider1', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 1
                    });
                }
            }
        })
        .directive('slider2', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 1,
                        type: 'single',
                        prefix: "$",
                        maxPostfix: "+",
                        prettify: false
                    });
                }
            }
        })
        .directive('slider3', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        values: [
                            "January", "February",
                            "March", "April",
                            "May", "June",
                            "July", "August",
                            "September", "October",
                            "November", "December"
                        ],
                        type: 'single',
                        from: 1
                    });
                }
            }
        })
        .directive('slider4', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 1,
                        type: 'single',
                        step: 0.1,
                        postfix: " carats",
                        prettify: false
                    });
                }
            }
        })

        // =========================================================================
        // CONTEXTUAL CLASSES SLIDER
        // =========================================================================
        .directive('defaultSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 1
                    });
                }
            }
        })
        .directive('primarySlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 2
                    });
                }
            }
        })
        .directive('successSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 3,
                        type: 'single'
                    });
                }
            }
        })
        .directive('infoSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 4
                    });
                }
            }
        })
        .directive('warningSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 5
                    });
                }
            }
        })
        .directive('dangerSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 6
                    });
                }
            }
        })
        .directive('lilacSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 7
                    });
                }
            }
        })
        .directive('tealSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 6
                    });
                }
            }
        })
        .directive('inverseSlider', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 5
                    });
                }
            }
        })

        // =========================================================================
        // SKIN SLIDER
        // =========================================================================
        .directive('typeSlider1', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 3
                    });
                }
            }
        })
        .directive('typeSlider2', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 6
                    });
                }
            }
        })
        .directive('typeSlider3', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.ionRangeSlider({
                        min: 0,
                        max: 10,
                        from: 3
                    });
                }
            }
        });

})();
"use strict";
(function(){
    angular.module('blankonApp.forms.layout', [])

        // =========================================================================
        // CHOSEN SELECT
        // =========================================================================
        .directive('chosenSelect', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.chosen();
                }
            }
        })

})();
"use strict";
(function(){
    angular.module('blankonApp.components.typography', [])

        // =========================================================================
        // CODE PRETTIFY
        // =========================================================================
        .directive('codePrettify', function () {
            return {
                restrict: 'A',
                link: function () {
                    prettyPrint();
                }
            }
        })

})();
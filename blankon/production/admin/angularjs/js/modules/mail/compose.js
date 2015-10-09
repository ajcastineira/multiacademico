"use strict";
(function(){
    angular.module('blankonApp.mail.compose', [])

        // =========================================================================
        // BOOTSTRAP WYSIHTML5
        // =========================================================================
        .directive('composeEditor', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.wysihtml5({});
                }
            }
        })

})();
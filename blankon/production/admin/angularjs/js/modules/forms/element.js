"use strict";
(function(){
    angular.module('blankonApp.forms.element', [])

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

        // =========================================================================
        // CHARACTER LIMIT
        // =========================================================================
        .directive('characterLimit', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.maxlength({
                        alwaysShow: true,
                        threshold: 20,
                        warningClass: "label label-success",
                        limitReachedClass: "label label-danger",
                        separator: ' of ',
                        preText: 'You have ',
                        postText: ' chars remaining.',
                        placement: 'centered-right'
                    });
                }
            }
        })

        // =========================================================================
        // TEXTAREA AUTOSIZE
        // =========================================================================
        .directive('autosize', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.autosize();
                }
            }
        })

})();
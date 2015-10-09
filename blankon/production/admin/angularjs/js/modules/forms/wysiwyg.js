"use strict";
(function(){
    angular.module('blankonApp.forms.wysiwyg', [])

        // =========================================================================
        // BOOTSTRAP WYSIHTML5
        // =========================================================================
        .directive('wysihtml5Textarea', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.wysihtml5();
                }
            }
        })

        // =========================================================================
        // SUMMERNOTE
        // =========================================================================
        .directive('summernoteTextarea', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.summernote();
                }
            }
        })

        // =========================================================================
        // SUMMERNOTE INLINE EDITOR
        // =========================================================================
        .directive('editable', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.summernote({
                        height: 300,
                        airMode: true
                    });
                }
            }
        })

})();
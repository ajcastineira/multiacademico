"use strict";
(function(){
    angular.module('blankonApp.forms.advanced', [])

        // =========================================================================
        // BOOTSTRAP SWITCH
        // =========================================================================
        .directive('switch', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.bootstrapSwitch();
                }
            }
        })

        // =========================================================================
        // JQUERY INPUTMASK
        // =========================================================================
        .directive('inputMask', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.inputmask();
                }
            }
        })

        // =========================================================================
        // BOOTSTRAP DATEPICKER
        // =========================================================================
        .directive('dp1', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.datepicker({
                        format: 'mm-dd-yyyy',
                        todayBtn: 'linked'
                    });
                }
            }
        })
        .directive('dp2', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.datepicker();
                    $('#btn2').click(function(e){
                        e.stopPropagation();
                        element.datepicker('update', '03/17/12');
                    });
                }
            }
        })
        .directive('dp3', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.datepicker({
                        todayBtn: 'linked'
                    });
                    $('#btn3').click(function(){
                        element.datepicker('update', '15-05-1984');
                    });
                }
            }
        })

})();
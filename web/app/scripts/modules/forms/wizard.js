"use strict";
(function(){
    angular.module('blankonApp.forms.wizard', [])

        // =========================================================================
        // BASIC WIZARD HORIZONTAL
        // =========================================================================
        .directive('basicWizardHorizontal', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.bootstrapWizard();
                }
            }
        })

        // =========================================================================
        // BASIC WIZARD VERTICAL
        // =========================================================================
        .directive('basicWizardVertical', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.bootstrapWizard();
                }
            }
        })

        // =========================================================================
        // PROGRESS WIZARD
        // =========================================================================
        .directive('progressWizard', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.bootstrapWizard({
                        'nextSelector': '.next',
                        'previousSelector': '.previous',
                        onNext: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index+1;
                            var $percent = ($current/$total) * 100;
                            element.find('.progress-bar').css('width', $percent+'%');
                        },
                        onPrevious: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index+1;
                            var $percent = ($current/$total) * 100;
                            element.find('.progress-bar').css('width', $percent+'%');
                        },
                        onTabShow: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index+1;
                            var $percent = ($current/$total) * 100;
                            element.find('.progress-bar').css('width', $percent+'%');
                        }
                    });
                }
            }
        })

        // =========================================================================
        // DISABLED TAB WIZARD
        // =========================================================================
        .directive('disabledTabWizard', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.bootstrapWizard({onTabClick: function(tab, navigation, index) {
                        alert('on tab click disabled');
                        return false;
                    }});
                }
            }
        })

        // =========================================================================
        // VALIDATION WIZARD
        // =========================================================================
        .directive('validationWizard', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    var $validator = $("#form-wizard").validate({
                        rules: {
                            firstname: {
                                required: true,
                                minlength: 3
                            },
                            gender: {
                                required: true
                            },
                            productid: {
                                required: true
                            },
                            productname: {
                                required: true
                            },
                            category: {
                                required: true
                            },
                            creditcard: {
                                required: true
                            },
                            creditcardnumber: {
                                required: true,
                                number: true
                            }
                        },
                        highlight:function(element) {
                            $(element).parents('.form-group').addClass('has-error has-feedback');
                        },
                        unhighlight: function(element) {
                            $(element).parents('.form-group').removeClass('has-error');
                        },
                        submitHandler: function() {
                            alert("submitted!");
                        }
                    });
                    element.bootstrapWizard({
                        'onNext': function(tab, navigation, index) {
                            var $valid = $("#form-wizard").valid();
                            if(!$valid) {
                                $validator.focusInvalid();
                                return false;
                            }
                        },
                        onTabClick: function(tab, navigation, index) {
                            var $valid = $("#form-wizard").valid();
                            if(!$valid) {
                                $validator.focusInvalid();
                                return false;
                            }
                        }
                    });
                }
            }
        })

})();
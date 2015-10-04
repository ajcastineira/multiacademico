"use strict";
(function(){
    angular.module('blankonApp.forms.validation', [])

        // =========================================================================
        // BASIC VALIDATION
        // =========================================================================
        .directive('basicValidate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    $.mockjax({
                        url: 'users.action',
                        response: function(settings) {
                            var user = settings.data.bv_username,
                                users = ["john", "peter", "bill", "jokowi"];
                            this.responseText = "true";
                            if ( $.inArray( user, users ) !== -1 ) {
                                this.responseText = 'false';
                            }
                        },
                        responseTime: 500
                    });
                    element.validate({
                        rules:{
                            bv_required:{
                                required:true
                            },
                            bv_email:{
                                required:true,
                                email: true
                            },
                            bv_date:{
                                required:true,
                                date: true
                            },
                            bv_url:{
                                required:true,
                                url: true
                            },
                            bv_username: {
                                required: true,
                                minlength: 2,
                                remote: "users.action"
                            }
                        },
                        messages: {
                            bv_email: {
                                remote: jQuery.validator.format("{0} is already in use")
                            },
                            bv_username: {
                                remote: jQuery.validator.format("{0} is already in use")
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
                }
            }
        })

        // =========================================================================
        // NUMBER VALIDATION
        // =========================================================================
        .directive('numberValidate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.validate({
                        rules:{
                            nv_number:{
                                required:true,
                                number:true
                            },
                            nv_min:{
                                required: true,
                                min:5
                            },
                            nv_max:{
                                required:true,
                                max:5
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
                }
            }
        })

        // =========================================================================
        // PASSWORD VALIDATION
        // =========================================================================
        .directive('passwordValidate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.validate({
                        rules:{
                            pv_password:{
                                required: true,
                                minlength:5,
                                maxlength:20
                            },
                            pv_password2:{
                                required:true,
                                minlength:5,
                                maxlength:20,
                                equalTo:"#pv_password"
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
                }
            }
        })

        // =========================================================================
        // CHECKBOX RADIO VALIDATION
        // =========================================================================
        .directive('checkboxRadioValidate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.validate({
                        rules:{
                            cr_gender:{
                                required: true
                            },
                            cr_skill:{
                                required:true,
                                minlength: 2
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
                }
            }
        })

        // =========================================================================
        // SELECT VALIDATION
        // =========================================================================
        .directive('selectValidate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.validate({
                        rules:{
                            sv_skill_programming:{
                                required: true
                            },
                            sv_position:{
                                required: true
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
                }
            }
        })

        // =========================================================================
        // SAMPLE VALIDATION 1
        // =========================================================================
        .directive('sampleValidation1', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {

                    $.mockjax({
                        url: 'emails.action2',
                        response: function(settings) {
                            var email = settings.data.sv1_email,
                                emails = ["jokowi@jk.co.id", "george@bush.gov", "bill@gates.com"];
                            this.responseText = "true";
                            if ( $.inArray( email, emails ) !== -1 ) {
                                this.responseText = 'false';
                            }
                        },
                        responseTime: 500
                    });

                    $.mockjax({
                        url: 'users.action2',
                        response: function(settings) {
                            var user = settings.data.sv1_username,
                                users = ["john", "peter", "bill", "jokowi"];
                            this.responseText = "true";
                            if ( $.inArray( user, users ) !== -1 ) {
                                this.responseText = 'false';
                            }
                        },
                        responseTime: 500
                    });

                    element.validate({
                        rules: {
                            sv1_firstname: "required",
                            sv1_lastname: "required",
                            sv1_username: {
                                required: true,
                                minlength: 2,
                                remote: "users.action2"
                            },
                            sv1_password: {
                                required: true,
                                minlength: 5
                            },
                            sv1_password_confirm: {
                                required: true,
                                minlength: 5,
                                equalTo: "#password"
                            },
                            sv1_email: {
                                required: true,
                                email: true,
                                remote: "emails.action2"
                            },
                            sv1_gender: "required",
                            sv1_terms: "required"
                        },
                        messages: {
                            sv1_firstname: "Enter your firstname",
                            sv1_lastname: "Enter your lastname",
                            sv1_username: {
                                required: "Enter a username",
                                minlength: jQuery.validator.format("Enter at least {0} characters"),
                                remote: jQuery.validator.format("{0} is already in use")
                            },
                            sv1_password: {
                                required: "Provide a password",
                                rangelength: jQuery.validator.format("Enter at least {0} characters")
                            },
                            sv1_password_confirm: {
                                required: "Repeat your password",
                                minlength: jQuery.validator.format("Enter at least {0} characters"),
                                equalTo: "Enter the same password as above"
                            },
                            sv1_email: {
                                required: "Please enter a valid email address",
                                minlength: "Please enter a valid email address",
                                remote: jQuery.validator.format("{0} is already in use")
                            },
                            sv1_gender: "Choose your gender",
                            sv1_terms: "Please check our terms of use again"
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

                }
            }
        })

        // =========================================================================
        // SAMPLE VALIDATION 2
        // =========================================================================
        .directive('sampleValidation2', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.validate({
                        rules: {
                            sv2_company_name: "required",
                            sv2_firstname: "required",
                            sv2_lastname: "required",
                            sv2_city: "required",
                            sv2_state: "required",
                            sv2_phone: {
                                required: true,
                                number: true
                            },
                            sv2_email: {
                                required: true,
                                email: true,
                                remote: "emails.action"
                            },
                            sv2_password: {
                                required: true,
                                minlength: 5
                            },
                            sv2_password_confirm: {
                                required: true,
                                minlength: 5,
                                equalTo: "#sv2_password"
                            },
                            sv2_credit_card: {
                                required: true,
                                minlength: 1
                            },
                            sv2_credit_card_number: {
                                required: true,
                                number: true
                            }
                        },
                        messages: {
                            sv2_company_name: "Enter your company name",
                            sv2_firstname: "Enter your firstname",
                            sv2_lastname: "Enter your lastname",
                            sv2_city: "Enter your city",
                            sv2_state: "Enter your state",
                            sv2_phone: "Enter your phone number",
                            sv2_username: {
                                required: "Enter a username",
                                minlength: jQuery.validator.format("Enter at least {0} characters")
                            },
                            sv2_email: {
                                required: "Please enter a valid email address",
                                minlength: "Please enter a valid email address"
                            },
                            sv2_password: {
                                required: "Provide a password",
                                rangelength: jQuery.validator.format("Enter at least {0} characters")
                            },
                            sv2_password_confirm: {
                                required: "Repeat your password",
                                minlength: jQuery.validator.format("Enter at least {0} characters"),
                                equalTo: "Enter the same password as above"
                            },
                            sv2_credit_card: {
                                required: "Choose your credit card",
                                minlength: jQuery.validator.format("Enter at least {0} credit card")
                            },
                            sv2_credit_card_number: {
                                required: "Please enter credit card number",
                                minlength: jQuery.validator.format("Enter at least {0} credit card")
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
                }
            }
        })

})();
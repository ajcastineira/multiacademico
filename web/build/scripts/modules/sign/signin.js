"use strict";!function(){angular.module("blankonApp.account.signin",[]).controller("SigninCtrl",["settings",function(a){$(".sign-in").length&&$(window).width()>=1024&&$(".sign-in").validate({invalidHandler:function(){$("#sign-wrapper").addClass("animated shake"),setTimeout(function(){$("#sign-wrapper").removeClass("animated shake")},1500),$(".page-sound").length&&ion.sound.play("light_bulb_breaking")},rules:{username:{required:!0},password:{required:!0}},messages:{username:{required:"Just fill anything mr awesome"},password:{required:"Please provide a password"}},highlight:function(a){$(a).parents(".form-group").addClass("has-error has-feedback")},unhighlight:function(a){$(a).parents(".form-group").removeClass("has-error")},submitHandler:function(b){var c=$("#login-btn");c.html("Checking ..."),$(".page-sound").length&&ion.sound.play("cd_tray"),c.attr("disabled","disabled"),setTimeout(function(){c.text("Great MR AWESOME !")},2e3),c.removeAttr("disabled"),setTimeout(function(){b.submit(),window.location=a.baseURL+"/production/admin/angularjs/#/dashboard"},2500)}}),$("#sign-wrapper").css("min-height",$(window).outerHeight()),$(".page-sound").length&&($("input").on("input",function(){ion.sound.play("tap")}),$("input[type=checkbox]").on("click",function(){ion.sound.play("button_tiny")}))}])}();
"use strict";!function(){angular.module("blankonApp.mail.inbox",[]).controller("MailInboxCtrl",["$scope","$http","settings",function(a,b,c){a.mails=[],b.get(c.dataPath+"/views/mail/inbox.json").success(function(b){a.mails=b}).error(function(a,b,c,d){})}]).directive("checkAction",function(){return{restrict:"A",link:function(a,b){b.click(function(){var a=$(this);a.is(":checked")?a.closest("tr").addClass("selected"):a.closest("tr").removeClass("selected")})}}}).directive("starAction",function(){return{restrict:"A",link:function(a,b){b.click(function(){return $(this).hasClass("star-checked")?$(this).removeClass("star-checked"):$(this).addClass("star-checked"),!1})}}}).directive("readMail",function(){return{restrict:"A",link:function(a,b){b.click(function(){location.href="#/mail-view"})}}})}();
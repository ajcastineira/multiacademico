"use strict";!function(){angular.module("blankonApp.pages.messages",[]).controller("MessagesCtrl",["$scope","$http","settings",function(a,b,c){a.messages=[],b.get(c.dataPath+"/views/pages/messages.json").success(function(b){a.messages=b}).error(function(a,b,c,d){})}])}();
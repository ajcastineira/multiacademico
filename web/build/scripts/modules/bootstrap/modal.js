"use strict";!function(){angular.module("ui.bootstrap.modal",[]).controller("ModalCtrl",["$scope","$modalInstance","items",function(a,b,c){a.open=function(b){var c=$modal.open({templateUrl:"myModalContent.html",controller:"ModalInstanceCtrl",size:b,resolve:{items:function(){return a.items}}});c.result.then(function(b){a.selected=b},function(){$log.info("Modal dismissed at: "+new Date)})},a.items=c,a.selected={item:a.items[0]},a.ok=function(){b.close(a.selected.item)},a.cancel=function(){b.dismiss("cancel")}}])}();
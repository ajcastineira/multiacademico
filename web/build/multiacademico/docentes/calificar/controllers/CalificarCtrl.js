define(["multiacademico/docentes/calificar/module"],function(a){"use strict";function b(a){var b="";return 4>=a&&(b="E"),a>4&&7>a&&(b="D"),a>=7&&9>a&&(b="C"),a>=9&&10>a&&(b="B"),10==a&&(b="A"),b}a.registerController("CalificarCtrl",["$scope","$modal","$log","$http","$state","$stateParams",function(a,c,d,e,f,g){a.state=g,a.qop=[{id:1,label:"PRIMER QUIMESTRE"},{id:2,label:"SEGUNDO QUIMESTRE"}],a.pop=[{id:1,label:"Primer Parcial"},{id:2,label:"Segundo Parcial"},{id:3,label:"Tercer Parcial"}],a.letras={A:10,B:9,C:8,D:6,E:4,F:3,"":0},a.promedioletras=function(c,d,e){var f=(a.letras[c]+a.letras[d]+a.letras[e])/3,g=b(f);return g},a.changeq=function(){f.go(f.$current,{submited:!1,q:a.q,p:a.p})},a.urlCalificacionesPrint=function(){return Routing.generate("imprimir_calificaciones",{id:g.id,q:g.q,p:g.p})},a.imprimirCalificaciones=function(){angular.element(".printable").html(angular.element("#remoteModalCalificaciones .modal-content").html())},a.openModal=function(){var a=c.open({templateUrl:Routing.generate("imprimir_calificaciones",{id:g.id,q:g.q,p:g.p}),size:"lg",controller:["$scope","$modalInstance",function(a,b){a.closeModal=function(){b.close()}}]});a.rendered.then(function(){angular.element(".modal-dialog").addClass("noprint"),angular.element(".printable").html(angular.element(".modal-content #remoteModalCalificaciones").html()),d.info("Modal rendered at: "+new Date)}),a.result.then(function(){d.info("Modal closed at: "+new Date)},function(){d.info("Modal dismissed at: "+new Date)})},a.formData={},a.processForm=function(a,b){a.preventDefault();var c;c=new FormData(document.getElementsByName(b)[0]),f.go(f.$current,{submited:!0,formData:c},{reload:!0})}}])});
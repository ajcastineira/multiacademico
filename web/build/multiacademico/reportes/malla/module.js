define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.malla",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("multiacademico.malla-normal",{url:"/malla-normal",data:{pageTitle:"malla-normal",pageHeader:{icon:"fa fa-pencil",title:"Cuadro de calificaiones",subtitle:"Lista"},breadcrumbs:[{title:"Malla"},{title:"Malla Normal"}]},views:{"content@multiacademico":{templateUrl:"views/multiacademico/malla/seleccionar-aula-malla-normal.html",controller:["$scope","aulas",function(a,b){a.aulas=b}],resolve:{aulas:["$http",function(a){return a.get(Routing.generate("get_aulas_all",{_format:"json"})).then(function(a){return a.data})}]}}}}).state("multiacademico.malla-normal.aula",{url:"/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/{q}/{p}",reloadOnSearch:!1,data:{pageTitle:"Cuadro de Calificaciones",pageHeader:{icon:"fa flaticon-tactil1",title:"Malla",subtitle:"Cuadro de Calificaciones"},breadcrumbs:[{title:"Malla"},{title:"Cuadro de Calificaciones"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("malla-normal-api"),controller:"MallaCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/reportes/malla/controllers/MallaCtrl"]),aula:["$http","$stateParams",function(a,b){return a.get(Routing.generate("get_aula",{curso:b.curso,especializacion:b.especializacion,paralelo:b.paralelo,seccion:b.seccion,periodo:b.periodo,_format:"json"})).then(function(a){return a.data})}]}}}}).state("cuadro-de-calificaciones",{url:"/cuadro-de-calificaciones",templateUrl:"views/multiacademico/malla/cuadro-de-calificaciones.html",data:{pageTitle:"cuadro-de-calificaciones",pageHeader:{icon:"fa fa-pencil",title:"Cuadro de Calificaciones",subtitle:"cuadro-de-calificaciones"},breadcrumbs:[{title:"Malla"},{title:"Cuadro de Calificaciones"}]}}).state("comportamiento",{url:"/comportamiento",templateUrl:"views/multiacademico/malla/comportamiento.html",data:{pageTitle:"comportamiento",pageHeader:{icon:"fa fa-pencil",title:"Comportamiento",subtitle:"comportamiento"},breadcrumbs:[{title:"Malla"},{title:"Comportamiento"}]}}).state("quimestre",{url:"/quimestre",templateUrl:"views/multiacademico/malla/quimestre.html",data:{pageTitle:"quimestre",pageHeader:{icon:"fa fa-pencil",title:"Quimestre",subtitle:"quimestre"},breadcrumbs:[{title:"Malla"},{title:"Quimestre"}]}}).state("quimestre2",{url:"/quimestre2",templateUrl:"views/multiacademico/malla/quimestre2.html",data:{pageTitle:"quimestre2",pageHeader:{icon:"fa fa-pencil",title:"Quimestre 2",subtitle:"quimestre 2"},breadcrumbs:[{title:"Malla"},{title:"Quimestre 2"}]}}).state("dos-quimestre",{url:"/dos-quimestre",templateUrl:"views/multiacademico/malla/dos-quimestre.html",data:{pageTitle:"dos-quimestre",pageHeader:{icon:"fa fa-pencil",title:"Dos quimestre",subtitle:"dos quimestre"},breadcrumbs:[{title:"Malla"},{title:"Dos quimestre"}]}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
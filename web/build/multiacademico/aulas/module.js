define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.aulas",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/aulas/","/aulas");var d={create:"new_aula","new":"new_aula",edit:"edit_aula",update:"edit_aula",show:"get_aula",list:"get_aulas_all",state_created:"multiacademico.aulas.show",state_updated:"multiacademico.aulas.show"};a.state("multiacademico.aulas",{"abstract":!0,data:{pageTitle:"Aulas",pageHeader:{icon:"flaticon-teach",title:"Aulas",subtitle:"Lista"},breadcrumbs:[{title:"Aulas"},{title:"lista"}]}}).state("multiacademico.aulas.list",{url:"/aulas",data:{pageTitle:"Aulas"},views:{"content@multiacademico":{templateUrl:Routing.generate(d.list,{_format:"html"}),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.aulas.show",{url:"/aulas/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}",data:{pageHeader:{icon:"flaticon-teach",title:"Aulas",subtitle:"Mostrar"},breadcrumbs:[{title:"Aulas"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate(d.show,{curso:a.curso,especializacion:a.especializacion,paralelo:a.paralelo,seccion:a.seccion,periodo:a.periodo,_format:"html"})}}}}).state("multiacademico.aulas.new",{url:"/aulas/new",params:{submited:!1,formData:null},data:{pageTitle:"aulas",pageHeader:{icon:"flaticon-teach",title:"Aulas",subtitle:"Nuevo"},breadcrumbs:[{title:"Aulas"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d,{_format:"html"})}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.aulas.edit",{url:"/aulas/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/edit",params:{id:void 0,curso:void 0,especializacion:void 0,paralelo:void 0,seccion:void 0,periodo:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"flaticon-teach",title:"Aulas",subtitle:"Editar"},breadcrumbs:[{title:"Aulas"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.editWithVars(a,d,{curso:a.curso,especializacion:a.especializacion,paralelo:a.paralelo,seccion:a.seccion,periodo:a.periodo,_format:"html"})}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
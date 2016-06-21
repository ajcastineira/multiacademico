define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.entidad",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/entidad/","/entidad");var d={create:"new_entidad","new":"new_entidad",edit:"edit_entidad",update:"edit_entidad",list:"index_entidad",show:"show_entidad",state_created:"multiacademico.entidad.show",state_updated:"multiacademico.entidad.show"};a.state("multiacademico.entidad",{"abstract":!0,data:{pageTitle:"entidad",pageHeader:{icon:"flaticon-filing",title:"Entidad",subtitle:"Lista"},breadcrumbs:[{title:"entidad"},{title:"lista"}]}}).state("multiacademico.entidad.list",{url:"/entidad",data:{pageTitle:"Entidad"},views:{"content@multiacademico":{templateUrl:Routing.generate(d.list,{_format:"html"}),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.entidad.show",{url:"/entidad/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"flaticon-filing",title:"Entidad",subtitle:"Mostrar"},breadcrumbs:[{title:"entidad"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate(d.show,{entidad:a.id})}}}}).state("multiacademico.entidad.new",{url:"/entidad/new",params:{submited:!1,formData:null},data:{pageTitle:"entidad",pageHeader:{icon:"flaticon-filing",title:"Entidad",subtitle:"Nuevo"},breadcrumbs:[{title:"entidad"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.entidad.edit",{url:"/entidad/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"flaticon-filing",title:"Entidad",subtitle:"Editar"},breadcrumbs:[{title:"entidad"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.editWithVars(a,d,{entidad:a.id,_format:"html"})}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
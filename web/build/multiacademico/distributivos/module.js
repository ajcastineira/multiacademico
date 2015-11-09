define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.distributivos",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/distributivos/","/distributivos");var d={create:"distributivos_create","new":"distributivos_api_new",edit:"distributivos_api_edit",update:"distributivos_update",list:"distributivos_api",state_created:"multiacademico.distributivos.show",state_updated:"multiacademico.distributivos.show"};a.state("multiacademico.distributivos",{"abstract":!0,data:{pageTitle:"Distributivos",pageHeader:{icon:"flaticon-teach",title:"Distributivos",subtitle:"Lista"},breadcrumbs:[{title:"Distributivos"},{title:"lista"}]}}).state("multiacademico.distributivos.list",{url:"/distributivos",data:{pageTitle:"Distributivos"},views:{"content@multiacademico":{templateUrl:Routing.generate("distributivos_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.distributivos.show",{url:"/distributivos/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"flaticon-teach",title:"Distributivos",subtitle:"Mostrar"},breadcrumbs:[{title:"Distributivos"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("distributivos_api_show",{id:a.id})}}}}).state("multiacademico.distributivos.new",{url:"/distributivos/new",params:{submited:!1,formData:null},data:{pageTitle:"distributivos",pageHeader:{icon:"flaticon-teach",title:"Distributivos",subtitle:"Nuevo"},breadcrumbs:[{title:"Distributivos"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.distributivos.edit",{url:"/distributivos/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"flaticon-teach",title:"Distributivos",subtitle:"Editar"},breadcrumbs:[{title:"Distributivos"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
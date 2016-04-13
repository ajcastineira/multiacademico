define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.estudiantes",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/estudiantes/","/estudiantes");var d={create:"estudiantes_create","new":"estudiantes_api_new",edit:"estudiantes_api_edit",update:"estudiantes_update",list:"estudiantes_api",state_created:"multiacademico.estudiantes.show",state_updated:"multiacademico.estudiantes.show"};a.state("multiacademico.estudiantes",{"abstract":!0,data:{pageTitle:"Estudiantes",pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Lista"},breadcrumbs:[{title:"Estudiantes"},{title:"lista"}]},resolve:{chosencss:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/chosen/chosen.min.css"]}])}]}}).state("multiacademico.estudiantes.list",{url:"/estudiantes",data:{pageTitle:"Estudiantes"},views:{"content@multiacademico":{templateUrl:Routing.generate("estudiantes_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.estudiantes.show",{url:"/estudiantes/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Mostrar"},breadcrumbs:[{title:"Estudiantes"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("estudiantes_api_show",{id:a.id})}}}}).state("multiacademico.estudiantes.new",{url:"/estudiantes/new",params:{submited:!1,formData:null},data:{pageTitle:"Estudiantes",pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Nuevo"},breadcrumbs:[{title:"Estudiantes"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.estudiantes.edit",{url:"/estudiantes/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Editar"},breadcrumbs:[{title:"Estudiantes"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.estudiantes.miscalificaciones",{url:"/miscalificaciones",data:{pageTitle:"Mis Calificaciones",pageHeader:{icon:"flaticon-big57",title:"Mis Calificaciones",subtitle:"Menu"},breadcrumbs:[{title:"Mis Calificaciones"},{title:"menu"}]},views:{"content@multiacademico":{templateUrl:"views/multiacademico/estudiantes/menu-calificaciones.html"}}}).state("multiacademico.estudiantes.miscalificaciones.informe",{url:"/{q}/{p}",data:{pageTitle:"Mis Calificaciones",pageHeader:{icon:"flaticon-schedule",title:"Mis Calificaciones",subtitle:"Informe"},breadcrumbs:[{title:"Mis Calificaciones"},{title:"informe"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("miscalificaciones_informe_api"),controller:"MisCalificacionesCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/estudiantes/controllers/MisCalificacionesCtrl"]),estudiante:["$http","$stateParams",function(a,b){return a.get(Routing.generate("get_miscalificaciones",{_format:"json"})).then(function(a){return a.data.estudiante})}]}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
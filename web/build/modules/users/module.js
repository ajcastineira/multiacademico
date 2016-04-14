define(["angular","angular-couch-potato","angular-ui-router","angular-x-editable","angular-mocks","jasny-bootstrap-fileinput","jquery-autosize"],function(a,b){"use strict";var c=a.module("app.users",["ui.router","xeditable"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){var d={create:"secured_user_create","new":"secured_user_api_new",edit:"secured_user_api_edit",update:"secured_user_update",show:"secured_user_api_show",list:"secured_user_api",state_created:"app.users.profile",state_updated:"app.users.profile"};a.state("app.me",{url:"/me",data:{pageTitle:"Mi perfil",pageHeader:{icon:"fa fa-user",title:"Mi perfil",subtitle:"Mi Perfil"},breadcrumbs:[{title:"Mi Perfil"}]},resolve:{deps:b.resolveDependencies(["modules/users/controllers/MeCtrl","modules/users/directives/loadingspiner"])},views:{"content@app":{templateUrl:function(a){return Routing.generate("secured_user_api_showme")},controller:"MeCtrl",resolve:{deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.pluginProdPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/angular-xeditable/dist/css/xeditable.css",d+"/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css"]}])}]}}}}).state("app.users",{"abstract":!0,data:{pageTitle:"Usuarios",pageHeader:{icon:"fa fa-user",title:"Usuarios",subtitle:"Usuarios"},breadcrumbs:[{title:"Usuarios"}]}}).state("app.users.list",{url:"/arxis/user",data:{title:"Resumen"},views:{"content@app":{templateUrl:Routing.generate(d.list),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("app.users.profile",{url:"/perfil/{id:[0-9]{1,11}}",data:{pageTitle:"Perfil",pageHeader:{icon:"fa fa-user",title:"Perfil",subtitle:"perfil"},breadcrumbs:[{title:"Perfil"}]},resolve:{deps:b.resolveDependencies(["modules/users/controllers/MeCtrl","modules/users/directives/loadingspiner"])},views:{"content@app":{templateUrl:function(a){return Routing.generate(d.show,{id:a.id})},controller:"MeCtrl",resolve:{deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.pluginProdPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/angular-xeditable/dist/css/xeditable.css",d+"/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css"]}])}]}}}}).state("app.users.new",{url:"/arxis/user/new",params:{submited:!1,formData:null},data:{title:"Nuevo"},views:{"content@app":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("app.users.edit",{url:"/arxis/user/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{title:"Editar"},views:{"content@app":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato","editableOptions",function(a,b){c.lazy=a,b.theme="bs3"}]),c});
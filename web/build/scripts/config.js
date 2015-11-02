define(["angular","angular-couch-potato","angular-ui-router","angular-loading-bar","oc-lazyload"],function(a,b){"use strict";var c=a.module("blankonConfig",["angular-loading-bar","oc.lazyLoad"]).factory("settings",["$rootScope",function(a){var b="",c={baseURL:b,pluginPath:"vendor",pluginProdPath:"plugin",pluginCommercialPath:b+"/assets/commercial/plugins",globalImagePath:"img",adminImagePath:b+"/assets/admin/img",cssPath:"app/styles",jsPath:"app/scripts",dataPath:"data",additionalPath:b+"/assets/global/plugins/bower_components"};return a.settings=c,c}]).config(["cfpLoadingBarProvider",function(a){a.includeSpinner=!0}]).config(["$ocLazyLoadProvider",function(a){a.config({events:!0,debug:!1,cache:!1,cssFilesInsertBefore:"ng_load_plugins_before",modules:[{name:"blankonApp.core.demo",files:["app/scripts/modules/core/demo.js"]}]})}]).config(["$stateProvider","$couchPotatoProvider",function(a,b,c){a.state("signin",{url:"/login",data:{pageTitle:"Iniciar Sesion"}}).state("dashboard",{url:"/",data:{pageTitle:"Inicio",pageHeader:{icon:"fa fa-home",title:"Inicio",subtitle:"inicio & resumen"}},views:{"":{templateUrl:"views/dashboard.html",controller:"DashboardCtrl",resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.pluginProdPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/jquery.gritter/css/jquery.gritter.css"]}])}],ResumenInicio:["$http",function(a){return a.get(Routing.generate("get_estadisticas_all",{_format:"json"})).then(function(a){return a.data})}]}}}}).state("pageError404",{url:"/page-error-404",templateUrl:"views/pages/page-error-404.html",data:{pageTitle:"ERROR 404",pageHeader:{icon:"fa fa-ban",title:"Error 404",subtitle:"page not found"},breadcrumbs:[{title:"Pages"},{title:"Error 404"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/error-page.css"]}])}]}})}]).run(["$rootScope","settings","$state",function(a,b,c,d){a.$state=c,a.$location=d,a.settings=b}]);return b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
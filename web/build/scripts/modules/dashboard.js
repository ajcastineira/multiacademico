define(["angular","angular-couch-potato","angular-ui-router","angular-resource"],function(a,b){"use strict";var c=a.module("app.dashboard",["ui.router","ngResource"]);return c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("app.dashboard",{url:"/dashboard",template:"<div>hola</div>",data:{pageTitle:"DASHBOARD",pageHeader:{icon:"fa fa-home",title:"Dashboard",subtitle:"dashboard & statistics"}}})}]),b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
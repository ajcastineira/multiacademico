define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("blankonApp",["ui.router","oc.lazyLoad","angular-loading-bar","ngSanitize","ngAnimate","blankonConfig","blankonDirective","blankonController"]);return b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
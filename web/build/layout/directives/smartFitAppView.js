define(["layout/module","lodash"],function(a,b){"use strict";a.registerDirective("smartFitAppView",["$rootScope","SmartCss",function(a,b){return{restrict:"A",compile:function(c,d){c.removeAttr("smart-fit-app-view data-smart-fit-app-view leading-y data-leading-y");var e=d.leadingY?parseInt(d.leadingY):0,f=d.smartFitAppView;if(b.appViewSize&&b.appViewSize.height){var g=b.appViewSize.height-e<252?252:b.appViewSize.height-e;b.add(f,"height",g+"px")}var h=a.$on("$smartContentResize",function(a,c){var d=c.height-e<252?252:c.height-e;b.add(f,"height",d+"px")});c.on("$destroy",function(){h(),b.remove(f,"height")})}}}])});
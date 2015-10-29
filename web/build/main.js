define('app',["angular","angular-couch-potato","angular-ui-router","angular-animate","angular-sanitize","angular-bootstrap","angular-loading-bar","oc-lazyload"],function(a,b){var c=a.module("app",["ngSanitize","ngAnimate","oc.lazyLoad","scs.couch-potato","ui.router","ui.bootstrap","angular-loading-bar","blankonConfig","blankonController","blankonDirective","app.auth","app.dashboard","app.users","app.layout","app.forms","multiacademico","multiacademico.estudiantes","multiacademico.docentes.midistributivo","multiacademico.proyectosescolares","multiacademico.cursos","multiacademico.distributivos","multiacademico.malla","multiacademico.especializaciones","multiacademico.informes","multiacademico.materias","smart-templates"]);return b.configureApp(c),c.config(["$provide","$httpProvider","$locationProvider",function(a,b,c){c.html5Mode(!0),b.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",a.factory("ErrorHttpInterceptor",["$q",function(a){function b(a){console.log(a)}return{requestError:function(c){return b(c),a.reject(c)},responseError:function(c){return b(c),a.reject(c)}}}]),b.interceptors.push("ErrorHttpInterceptor")}]),c.run(["$couchPotato","$rootScope","$state","$stateParams",function(a,b,d,e){c.lazy=a,b.$state=d,b.$stateParams=e}]),c});
define('auth/module',["angular","angular-couch-potato","angular-ui-router","angular-google-plus","angular-easyfb"],function(a,b){"use strict";var c=a.module("app.auth",["ui.router","ezfb","googleplus"]);b.configureApp(c);return c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("realLogin",{url:"/real-login",views:{root:{templateUrl:"build/auth/login/login.html",controller:"LoginCtrl",resolve:{deps:b.resolveDependencies(["auth/models/User","auth/directives/loginInfo","auth/login/LoginCtrl","auth/login/directives/facebookSignin","auth/login/directives/googleSignin"])}}},data:{title:"Login",rootId:"extra-page"}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('auth/models/User',["auth/module"],function(a){"use strict";return a.registerFactory("User",["$http","$q",function(a,b){var c=b.defer(),d={initialized:c.promise,username:void 0,picture:void 0};return a.get(Routing.generate("api_user",{_format:"json"})).then(function(a){d.username=a.data.username,d.picture=a.data.picture,d.cargo=a.data.cargo,c.resolve(d)}),d}])});
define('auth/directives/loginInfo',["auth/module"],function(a){"use strict";return a.registerDirective("loginInfo",["User",function(a){return{restrict:"A",templateUrl:Routing.generate("logininfo"),link:function(b,c){a.initialized.then(function(){b.user=a})}}}])});
define('auth/directives/loginInfoLine',["auth/module"],function(a){"use strict";return a.registerDirective("loginInfoLine",["User",function(a){return{restrict:"A",templateUrl:Routing.generate("logininfoline"),link:function(b,c){a.initialized.then(function(){b.user=a})}}}])});
define('layout/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("app.layout",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){a.state("app",{"abstract":!0,template:'<div data-smart-router-animation-wrap="content content@app" data-wrap-for="#content"><div data-ui-view="content" data-autoscroll="false"></div></div>',resolve:{deps:b.resolveDependencies(["auth/directives/loginInfo"])}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('layout/directives/smartRouterAnimationWrap',["layout/module","lodash"],function(a,b){"use strict";a.registerDirective("smartRouterAnimationWrap",["$rootScope","$timeout",function(a,c){return{restrict:"A",compile:function(d,e){function f(){j=!0,d.css({height:d.height()+"px",overflow:"hidden"}).addClass("active"),$(h).addClass("animated faster fadeOutDown")}function g(){j&&(d.css({height:"auto",overflow:"visible"}).removeClass("active"),$(h).addClass("animated faster fadeInUp"),j=!1,c(function(){$(h).removeClass("animated")},10))}d.removeAttr("smart-router-animation-wrap data-smart-router-animation-wrap wrap-for data-wrap-for"),d.addClass("router-animation-container"),$('<div class="router-animation-loader noprint"><i class="fa fa-gear fa-4x fa-spin"></i></div>').appendTo(d);var h=e.wrapFor,i=e.smartRouterAnimationWrap.split(/\s/),j=!1,k=a.$on("$stateChangeStart",function(a,c,d,e,g){var h=b.any(i,function(a){return b.has(c.views,a)||b.has(e.views,a)});h&&f()}),l=a.$on("$viewContentLoaded",function(a){g()});d.on("$destroy",function(){k(),l()})}}}])});
define('scripts/config',["angular","angular-couch-potato","angular-ui-router","angular-loading-bar","oc-lazyload"],function(a,b){"use strict";var c=a.module("blankonConfig",["angular-loading-bar","oc.lazyLoad"]).factory("settings",["$rootScope",function(a){var b="",c={baseURL:b,pluginPath:"vendor",pluginProdPath:"plugin",pluginCommercialPath:b+"/assets/commercial/plugins",globalImagePath:"img",adminImagePath:b+"/assets/admin/img",cssPath:"app/styles",jsPath:"app/scripts",dataPath:"data",additionalPath:b+"/assets/global/plugins/bower_components"};return a.settings=c,c}]).config(["cfpLoadingBarProvider",function(a){a.includeSpinner=!0}]).config(["$ocLazyLoadProvider",function(a){a.config({events:!0,debug:!1,cache:!1,cssFilesInsertBefore:"ng_load_plugins_before",modules:[{name:"blankonApp.core.demo",files:["app/scripts/modules/core/demo.js"]}]})}]).config(["$stateProvider","$couchPotatoProvider",function(a,b,c){a.state("signin",{url:"/login",data:{pageTitle:"Iniciar Sesion"}}).state("dashboard",{url:"/",data:{pageTitle:"Inicio",pageHeader:{icon:"fa fa-home",title:"Inicio",subtitle:"inicio & resumen"}},views:{"":{templateUrl:"views/dashboard.html"}}}).state("pageError404",{url:"/page-error-404",templateUrl:"views/pages/page-error-404.html",data:{pageTitle:"ERROR 404",pageHeader:{icon:"fa fa-ban",title:"Error 404",subtitle:"page not found"},breadcrumbs:[{title:"Pages"},{title:"Error 404"}]},resolve:{deps:["$ocLazyLoad","settings",function(a,b){var c=b.cssPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/pages/error-page.css"]}])}]}})}]).run(["$rootScope","settings","$state",function(a,b,c,d){a.$state=c,a.$location=d,a.settings=b}]);return b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('scripts/controllers',["angular","angular-couch-potato","ionsound","angular-ui-router"],function(a,b){"use strict";var c=a.module("blankonController",[]).controller("BlankonCtrl",["$scope","$http","settings",function(a,b,c){a.supportIE=function(){var a=!1,b=!1,c=!1;a=!!navigator.userAgent.match(/MSIE 8.0/),b=!!navigator.userAgent.match(/MSIE 9.0/),c=!!navigator.userAgent.match(/MSIE 10.0/),c&&$("html").addClass("ie10"),(c||b||a)&&$("html").addClass("ie"),(a||b)&&$("input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)").each(function(){var a=$(this);""==a.val()&&""!=a.attr("placeholder")&&a.addClass("placeholder").val(a.attr("placeholder")),a.focus(function(){a.val()==a.attr("placeholder")&&a.val("")}),a.blur(function(){(""==a.val()||a.val()==a.attr("placeholder"))&&a.val(a.attr("placeholder"))})})},a.cookieSidebarMinimize=function(){"active"==$.cookie("page_sidebar_minimize")&&$("body").addClass("page-sidebar-minimize")},a.soundPage=function(){$(".page-sound").length&&(ion.sound({sounds:[{name:"beer_can_opening"},{name:"bell_ring",volume:.6},{name:"branch_break",volume:.3},{name:"button_click"},{name:"button_click_on"},{name:"button_push"},{name:"button_tiny",volume:.6},{name:"camera_flashing"},{name:"camera_flashing_2",volume:.6},{name:"cd_tray",volume:.6},{name:"computer_error"},{name:"door_bell"},{name:"door_bump",volume:.3},{name:"glass"},{name:"keyboard_desk"},{name:"light_bulb_breaking",volume:.6},{name:"metal_plate"},{name:"metal_plate_2"},{name:"pop_cork"},{name:"snap"},{name:"staple_gun"},{name:"tap",volume:.6},{name:"water_droplet"},{name:"water_droplet_2"},{name:"water_droplet_3",volume:.6}],path:"assets/global/plugins/bower_components/ionsound/sounds/",preload:!0}),$(".dropdown-toggle").on("click",function(){ion.sound.play("water_droplet_3")}))},a.tooltip=function(){$("[data-toggle=tooltip]").length&&$("[data-toggle=tooltip]").tooltip({animation:"fade"})},a.popover=function(){$("[data-toggle=popover]").length&&$("[data-toggle=popover]").popover()},a.navbarMessages=[],b.get(c.dataPath+"/partials/header/navbar-messages.json").success(function(b){a.navbarMessages=b}).error(function(a,b,c,d){}),a.navbarNotifications=[],b.get(c.dataPath+"/partials/header/navbar-notifications.json").success(function(b){a.navbarNotifications=b}).error(function(a,b,c,d){}),a.profile=[],b.get(c.dataPath+"/partials/sidebar-right/profile.json").success(function(b){a.profile=b}).error(function(a,b,c,d){}),a.chats=[],b.get(c.dataPath+"/partials/sidebar-right/chat.json").success(function(b){a.chats=b}).error(function(a,b,c,d){}),a.$on("ocLazyLoad.moduleLoaded",function(a,b){console.log("event module loaded",b)}),a.$on("ocLazyLoad.componentLoaded",function(a,b){console.log("event component loaded",b)}),a.$on("ocLazyLoad.fileLoaded",function(a,b){console.log("event file loaded",b)}),a.cookieSidebarMinimize(),a.soundPage(),a.tooltip(),a.popover()}]);return b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('scripts/directives',["angular","angular-couch-potato","bootbox","angular-ui-router","jquery-cookie","jquery-nicescroll","ionsound","chosen","sparkline"],function(a,b,c){"use strict";var d=a.module("blankonDirective",[]).directive("refreshPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){var a=$(this).parents(".panel").find(".panel-body");a.append('<div class="indicator"><span class="spinner"></span></div>'),setInterval(function(){$.getJSON("../../../assets/admin/data/reload-sample.json",function(b){$.each(b,function(){console.log("Retrieving data from json...")}),a.find(".indicator").hide()})},5e3)})}}}).directive("collapsePanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){var a=$(this).parents(".panel").find(".panel-body"),b=$(this).parents(".panel").find(".panel-sub-heading"),c=$(this).parents(".panel").find(".panel-footer");a.is(":visible")?($(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down"),a.slideUp(),b.slideUp(),c.slideUp()):($(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up"),a.slideDown(),b.slideDown(),c.slideDown())})}}}).directive("removePanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){$(this).parents(".panel").fadeOut()})}}}).directive("expandPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){b.parents(".panel").hasClass("panel-fullsize")?($("body").find(".panel-fullsize-backdrop").remove(),b.data("bs.tooltip").options.title="Expand",b.parents(".panel").removeClass("panel-fullsize")):($("body").append('<div class="panel-fullsize-backdrop"></div>'),b.data("bs.tooltip").options.title="Minimize",b.parents(".panel").addClass("panel-fullsize"))})}}}).directive("searchPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){return b.parents(".panel").find(".panel-search").toggle(100),!1})}}}).directive("tooltip",function(){return{restrict:"A",link:function(a,b,c){$(b).hover(function(){$(b).tooltip("show")},function(){$(b).tooltip("hide")})}}}).directive("backTop",function(){return{restrict:"A",link:function(a,b){b.hide(),$(window).scroll(function(){$(this).scrollTop()>100?b.addClass("show animated pulse"):b.removeClass("show animated pulse")}),b.click(function(){return ion.sound.play("cd_tray"),$("body,html").animate({scrollTop:0},800),!1})}}}).directive("nicescroll",function(){return{restrict:"A",link:function(a,b){b.niceScroll({cursorwidth:"3px",cursorborder:"0px"})}}}).directive("chosenSelect",function(){return{restrict:"A",link:function(a,b){b.chosen()}}}).directive("fullscreen",function(){return{restrict:"A",link:function(a,b){var c;b.on("click",function(){if(c=!c){$(".page-sound").length&&ion.sound.play("bell_ring"),$(this).toggleClass("fg-theme"),$(this).attr("data-original-title","Exit Fullscreen");var a,b;a=document.documentElement,b=a.requestFullScreen||a.webkitRequestFullScreen||a.mozRequestFullScreen||a.msRequestFullScreen,"undefined"!=typeof b&&b&&b.call(a)}else{$(".page-sound").length&&ion.sound.play("bell_ring"),$(this).removeClass("fg-theme"),$(this).attr("data-original-title","Fullscreen");var a,b;a=document,b=a.cancelFullScreen||a.webkitCancelFullScreen||a.mozCancelFullScreen||a.msCancelFullScreen||a.exitFullscreen,"undefined"!=typeof b&&b&&b.call(a)}})}}}).directive("resetSetting",function(){return{restrict:"A",link:function(a,b){b.on("click",function(){var a=$.cookie();for(var b in a)$.removeCookie(b);location.reload(!0)})}}}).directive("setting",function(){return{restrict:"A",link:function(a,b){b.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"I am a custom dialog setting",title:"Custom setting",className:"modal-success modal-center",buttons:{success:{label:"Success!",className:"btn-success",callback:function(){alert("You are so calm!")}},danger:{label:"Danger!",className:"btn-danger",callback:function(){alert("You are so hot!")}},main:{label:"Click ME!",className:"btn-primary",callback:function(){alert("Hello World")}}}})})}}}).directive("lockScreen",["settings",function(a){return{restrict:"A",link:function(b,d){d.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"Locker with notification display, Receive your notifications directly on your lock screen",title:"Lock Screen",className:"modal-lilac modal-center",buttons:{danger:{label:"No",className:"btn-danger"},success:{label:"Yes",className:"btn-success",callback:function(){window.location=a.baseURL+"/production/admin/angularjs/account.html#/lock-screen"}}}})})}}}]).directive("logout",["settings",function(a){return{restrict:"A",link:function(b,d){d.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"Do you want to exit from Blankon?",title:"Logout",className:"modal-danger modal-center",buttons:{danger:{label:"No",className:"btn-danger"},success:{label:"Yes",className:"btn-success",callback:function(){window.location=a.baseURL+"/production/admin/angularjs/account.html#/sign-in"}}}})})}}}]).directive("sparklineAverage",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#37BC9B",height:"30px"})}}}).directive("sparklineTraffic",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#8CC152",height:"30px"})}}}).directive("sparklineDisk",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#E9573F",height:"30px"})}}}).directive("sparklineCpu",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#F6BB42",height:"30px"})}}}).directive("a",function(){return{restrict:"E",link:function(a,b,c){(c.ngClick||""===c.href||"#"===c.href||b.data("toggle")||b.data("slide"))&&b.on("click",function(a){a.preventDefault()})}}}).directive("navbarMessage",function(){return{restrict:"A",controller:function(a){a.messages=[{image:"",name:"john kribo",message:"I was impressed how fast the content is loaded. Congratulations. nice design.",meta:{reply:"",attach:""},time:""}]}}}).directive("activeMenu",["$location","$state",function(a,b){return{link:function(c,d,e){c.$on("$stateChangeSuccess",function(c,f,g){if(void 0!=e.href){var h=(e.activeTab||1,a.absUrl()),i=b.href(e.uiSref,null,{absolute:!0});h===i?(d.closest(".submenu").length&&(d.closest(".submenu").addClass("active"),d.closest(".submenu").parents(".submenu").addClass("active"),d.append('<span class="selected"></span>')),d.parent().addClass("active"),d.append('<span class="selected"></span>')):(d.parent().removeClass("active"),d.find(".selected").remove())}})}}}]).directive("collapseMenu",["settings",function(a){return{restrict:"A",link:function(a,b,c){b.find("a").on("click",function(){var a=$(this).parent("li"),b=$(this).parent(".submenu"),c=$(this).nextAll(),d=$(this).find(".arrow"),e=$(this).find(".plus");$(".page-sound").length&&ion.sound.play("button_click_on"),a.siblings().removeClass("active"),b.parent("ul").find("ul:visible")&&(b.parent("ul").find("ul:visible").slideUp("fast"),b.parent("ul").find(".open").removeClass("open"),b.siblings().children("a").find(".selected").remove(),a.siblings().children("a").find(".selected").remove()),c.is("ul:visible")&&(d.removeClass("open"),e.removeClass("open"),c.slideUp("fast")),c.is("ul:visible")||(c.slideDown("fast"),a.children("a").append('<span class="selected"></span>'),b.addClass("active"),b.children("a").append('<span class="selected"></span>'),d.addClass("open"),e.addClass("open"))})}}}]).directive("sidebarLeftNicescroll",function(){return{restrict:"A",link:function(){function a(){if($(".page-sidebar-fixed").length){var a=$(window).outerHeight()-$("#header").outerHeight()-$(".sidebar-footer").outerHeight()-$(".sidebar-content").outerHeight(),b=$(window).outerHeight()-$("#sidebar-right .panel-heading").outerHeight(),c=$(window).outerHeight()-$("#sidebar-right .panel-heading").outerHeight()-$("#sidebar-chat .form-horizontal").outerHeight();$("#sidebar-left .sidebar-menu").height(a).niceScroll({cursorwidth:"3px",cursorborder:"0px",railalign:"left"}),$("#sidebar-profile .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-layout .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-setting .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-chat .sidebar-menu").height(c).niceScroll({cursorwidth:"3px",cursorborder:"0px"})}}a(),$(window).resize(a)}}}).directive("sidebarMinimize",function(){return{restrict:"A",link:function(a,b){function c(){var a=d.width();a>768&&1024>=a?$("body").addClass("page-sidebar-minimize-auto"):768>=a?($("body").removeClass("page-sidebar-minimize"),$("body").removeClass("page-sidebar-minimize-auto")):$("body").removeClass("page-sidebar-minimize-auto")}var d=$(window),e=$(".navbar-minimize a"),f=$(".navbar-setting a"),g=$(".navbar-minimize-mobile.left"),h=$(".navbar-minimize-mobile.right");c(),$(window).resize(c),e.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$(".page-sidebar-right-show").length&&$("body").removeClass("page-sidebar-right-show"),$(".page-sidebar-minimize-auto").length?$("body").removeClass("page-sidebar-minimize-auto"):$("body").toggleClass("page-sidebar-minimize"),"undefined"==$.cookie("page_sidebar_minimize")||"not_active"==$.cookie("page_sidebar_minimize")?$.cookie("page_sidebar_minimize","active",{expires:1}):($.removeCookie("page_sidebar_minimize"),$.cookie("page_sidebar_minimize","not_active",{expires:1}))}),f.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$(".page-sidebar-minimize.page-sidebar-right-show").length?$("body").toggleClass("page-sidebar-minimize page-sidebar-right-show"):$(".page-sidebar-minimize").length?$("body").toggleClass("page-sidebar-right-show"):$("body").toggleClass("page-sidebar-minimize page-sidebar-right-show")}),g.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$("body.page-sidebar-right-show").length&&($("body").removeClass("page-sidebar-right-show"),$("body").removeClass("page-sidebar-minimize")),$("body").toggleClass("page-sidebar-left-show")}),h.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$("body.page-sidebar-left-show").length&&($("body").removeClass("page-sidebar-left-show"),$("body").removeClass("page-sidebar-minimize")),$("body").toggleClass("page-sidebar-right-show")})}}}).directive("chooseThemes",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme");$.cookie("color_schemes")&&$("link#theme").attr("href","assets/admin/css/themes/"+$.cookie("color_schemes")+".theme.css"),$.cookie("navbar_color")&&$(".navbar-toolbar").attr("class","navbar navbar-toolbar navbar-"+$.cookie("navbar_color")),$.cookie("sidebar_color")&&($("#sidebar-left").hasClass("sidebar-box")?$("#sidebar-left").attr("class","sidebar-box sidebar-"+$.cookie("sidebar_color")):$("#sidebar-left").hasClass("sidebar-rounded")?$("#sidebar-left").attr("class","sidebar-rounded sidebar-"+$.cookie("sidebar_color")):$("#sidebar-left").hasClass("sidebar-circle")?$("#sidebar-left").attr("class","sidebar-circle sidebar-"+$.cookie("sidebar_color")):""==$("#sidebar-left").attr("class")&&$("#sidebar-left").attr("class","sidebar-"+$.cookie("sidebar_color"))),c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$("link#theme").attr("href","assets/admin/css/themes/"+a+".theme.css"),$.cookie("color_schemes",a,{expires:1})})}}}).directive("navbarColor",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme-navbar");c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$(".navbar-toolbar").attr("class","navbar navbar-toolbar navbar-"+a),$.cookie("navbar_color",a,{expires:1})})}}}).directive("sidebarColor",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme-sidebar");c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$("#sidebar-left").hasClass("sidebar-box")?$("#sidebar-left").attr("class","sidebar-box sidebar-"+a):$("#sidebar-left").hasClass("sidebar-rounded")?$("#sidebar-left").attr("class","sidebar-rounded sidebar-"+a):$("#sidebar-left").hasClass("sidebar-circle")?$("#sidebar-left").attr("class","sidebar-circle sidebar-"+a):""==$("#sidebar-left").attr("class")&&$("#sidebar-left").attr("class","sidebar-"+a),$.cookie("sidebar_color",a,{expires:1})})}}}).directive("layoutSetting",function(){return{restrict:"A",link:function(a,b){var c=$(".layout-setting").find("input"),d=$(".header-layout-setting").find("input"),e=$(".sidebar-layout-setting").find("input"),f=$(".sidebar-type-setting").find("input"),g=$(".footer-layout-setting").find("input");$.cookie("layout_setting")&&$("body").addClass($.cookie("layout_setting")),$.cookie("header_layout_setting")&&$("body").addClass($.cookie("header_layout_setting")),$.cookie("sidebar_layout_setting")&&$("#sidebar-left").addClass($.cookie("sidebar_layout_setting")),$.cookie("sidebar_type_setting")&&$("#sidebar-left").addClass($.cookie("sidebar_type_setting")),$.cookie("footer_layout_setting")&&$("body").addClass($.cookie("footer_layout_setting")),$("body").not(".page-boxed")&&$(".layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-boxed")&&($(".layout-setting li:eq(1) input").attr("checked","checked"),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".sidebar-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".footer-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip()),$("body").not(".page-header-fixed")&&$(".header-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-header-fixed")&&$(".header-layout-setting li:eq(1) input").attr("checked","checked"),$("body").not(".page-sidebar-fixed")&&$(".sidebar-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-sidebar-fixed")&&$(".sidebar-layout-setting li:eq(1) input").attr("checked","checked"),$("#sidebar-left").not(".sidebar-box, .sidebar-rounded, .sidebar-circle")&&$(".sidebar-type-setting li:eq(0) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-box")&&$(".sidebar-type-setting li:eq(1) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-rounded")&&$(".sidebar-type-setting li:eq(2) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-circle")&&$(".sidebar-type-setting li:eq(3) input").attr("checked","checked"),$("body").not(".page-footer-fixed")&&$(".footer-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-footer-fixed")&&$(".footer-layout-setting li:eq(1) input").attr("checked","checked"),c.change(function(){var a=$(this).val();$("body").hasClass("page-boxed")?($("body").removeClass("page-boxed"),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy"),$(".sidebar-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy"),$(".footer-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy")):($("body").addClass($(this).val()),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".sidebar-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".footer-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip()),$.cookie("layout_setting",a,{expires:1})}),d.change(function(){var a=$(this).val();$("body").hasClass("page-header-fixed")&&($("body").removeClass("page-header-fixed"),$("body").addClass($(this).val())),$("body").addClass($(this).val()),$.cookie("header_setting",a,{expires:1})}),e.change(function(){var a=$(this).val();$("body").hasClass("page-sidebar-fixed")?($("body").removeClass("page-sidebar-fixed"),$(".header-layout-setting li:eq(0) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy")):($("body").addClass($(this).val()),$("body").addClass("page-header-fixed"),$(".header-layout-setting li:eq(0) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on sidebar fixed"}).tooltip(),$(".header-layout-setting li:eq(1) input").attr("checked","checked")),$.cookie("sidebar_layout_setting",a,{expires:1})}),f.change(function(){var a=$(this).val();$("#sidebar-left").hasClass("sidebar-circle")&&($("#sidebar-left").removeClass("sidebar-circle"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").hasClass("sidebar-box")&&($("#sidebar-left").removeClass("sidebar-box"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").hasClass("sidebar-rounded")&&($("#sidebar-left").removeClass("sidebar-rounded"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").addClass($(this).val()),$.cookie("sidebar_type_setting",a,{expires:1})}),g.change(function(){var a=$(this).val();$("body").hasClass("page-footer-fixed")?$("body").removeClass("page-footer-fixed"):$("body").addClass($(this).val()),$.cookie("footer_layout_setting",a,{expires:1})})}}});return b.configureApp(d),d.run(["$couchPotato",function(a){d.lazy=a}]),d});
define('scripts/modules/dashboard',["angular","angular-couch-potato","angular-ui-router","bootstrap-session-timeout","jquery-gritter","flot-pack","dropzone","skycons"],function(a,b){"use strict";var c=a.module("app.dashboard",[]).controller("DashboardCtrl",function(a,b,c){$("#wrapper").css("opacity")&&($.cookie("intro")||(setTimeout(function(){var a=$.gritter.add({title:"Welcome to Blankon",text:"Blankon is a theme fullpack admin template powered by Twitter bootstrap 3 front-end framework.",image:c.globalImagePath+"/icon/64/contact.png",sticky:!1,time:""});setTimeout(function(){$.gritter.remove(a,{fade:!0,speed:"slow"})},12e3)},5e3),setTimeout(function(){$.gritter.add({title:"Playing sounds",text:"Blankon made for playing small sounds, will help you with this task. Please make your sound system is active",image:c.globalImagePath+"/icon/64/sound.png",sticky:!0,time:""})},8e3),$.cookie("intro",1,{expires:1})));var d,e=new Skycons({color:"white"},{resizeClear:!0}),f=["clear-day","clear-night","partly-cloudy-day","partly-cloudy-night","cloudy","rain","sleet","snow","wind","fog"];for(d=f.length;d--;)e.set(f[d],f[d]);e.play(),a.tables=[],b.get(c.dataPath+"/views/tables/color.json").success(function(b){a.tables=b}).error(function(){}),$.sessionTimeout({title:"Su sesion esta a punto de expirar!",logoutButton:"Logout",keepAliveButton:"Seguir Conectado",message:"Su sesion sera bloqueada en 2 minutos",keepAliveUrl:"#",logoutUrl:"account.html#/sign-in",redirUrl:"account.html#/lock-screen",ignoreUserActivity:!0,warnAfter:12e4,redirAfter:24e4})}).directive("visitorChart",function(){return{restrict:"A",link:function(a,b){$.plot(b,[{label:"New Visitor",color:"rgba(0, 177, 225, 0.35)",data:[["Jan",450],["Feb",532],["Mar",367],["Apr",245],["May",674],["Jun",897],["Jul",745]]},{label:"Old Visitor",color:"rgba(233, 87, 63, 0.36)",data:[["Jan",362],["Feb",452],["Mar",653],["Apr",756],["May",670],["Jun",352],["Jul",243]]}],{series:{lines:{show:!1},splines:{show:!0,tension:.4,lineWidth:2,fill:.5},points:{show:!0,radius:4}},grid:{borderColor:"transparent",borderWidth:0,hoverable:!0,backgroundColor:"transparent"},tooltip:!0,tooltipOpts:{content:"%x : %y People"},xaxis:{tickColor:"transparent",mode:"categories"},yaxis:{tickColor:"transparent"},shadowSize:0})}}}).directive("realtimeStatus",function(){return{restrict:"A",link:function(a,b){function c(){for(e.length>0&&(e=e.slice(1));e.length<f;){var a=e.length>0?e[e.length-1]:50,b=a+10*Math.random()-5;0>b?b=0:b>100&&(b=100),e.push(b)}for(var c=[],d=0;d<e.length;++d)c.push([d,e[d]]);return c}function d(){h.setData([c()]),h.draw(),setTimeout(d,g)}var e=[],f=50,g=1e3,h=$.plot(b,[c()],{colors:["#F6BB42"],series:{lines:{fill:!0,lineWidth:0},shadowSize:0},grid:{borderColor:"#ddd",borderWidth:1,labelMargin:10},xaxis:{color:"#eee"},yaxis:{min:0,max:100,color:"#eee"}});d()}}}).directive("countNumber",function(){return{restrict:"A",link:function(){function a(a){$({countNum:$(".counter-"+a).text()}).animate({countNum:$(".counter-"+a).data("counter")},{duration:8e3,easing:"linear",step:function(){$(".counter-"+a).text(Math.floor(this.countNum)).digits()},complete:function(){$(".counter-"+a).text(this.countNum).digits()}})}$.fn.digits=function(){return this.each(function(){$(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,"))})},$("#wrapper").css("opacity")&&(a("visit"),a("unique"),a("page"))}}});return b.configureApp(c),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/multiacademico',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("multiacademico",{"abstract":!0,template:'<div data-smart-router-animation-wrap="content content@multiacademico" data-wrap-for="#content"><div data-ui-view="content" data-autoscroll="false"></div></div>'}).state("matriculas",{url:"/matriculas",templateUrl:"views/matriculas.html",data:{pageTitle:"matriculas",pageHeader:{icon:"fa fa-pencil",title:"matriculas",subtitle:"matriculas and more"},breadcrumbs:[{title:"matriculas"},{title:"matriculas"}]}}).state("calificaciones",{url:"/calificaciones",templateUrl:"views/calificaciones.html",data:{pageTitle:"calificaciones",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget calificaciones"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("perfil",{url:"/perfil",templateUrl:"/views/multiacademico/perfil.html",data:{pageTitle:"Perfil",pageHeader:{icon:"fa fa-pencil",title:"Dos quimestre",subtitle:"Perfil"},breadcrumbs:[{title:"Malla"},{title:"Dos quimestre"}]}}).state("especialidades",{url:"/especialidades",templateUrl:"views/especialidades.html",data:{pageTitle:"especialidades",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget especialidades"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("ínformesortalf",{url:"/ínformesortalf",templateUrl:"views/ínformesortalf.html",data:{pageTitle:"ínformesortalf",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget ínformesortalf"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("informesortnum",{url:"/informesortnum",templateUrl:"views/informesortnum.html",data:{pageTitle:"informesortnum",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget informesortnum"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("reportesortcourse",{url:"/reportesortcourse",templateUrl:"views/reportesortcourse.html",data:{pageTitle:"reportesortcourse",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget reportesortcourse"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("reportesorterror",{url:"/reportesorterror",templateUrl:"views/reportesorterror.html",data:{pageTitle:"reportesorterror",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget reportesorterror"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("reportelibro",{url:"/reportelibro",templateUrl:"views/reportelibro.html",data:{pageTitle:"reportelibro",pageHeader:{icon:"fa fa-pencil",title:"reportelibro",subtitle:"reportelibro and more"},breadcrumbs:[{title:"Widget"},{title:"reportelibro"}]}}).state("reportedocente",{url:"/reportedocente",templateUrl:"views/reportedocente.html",data:{pageTitle:"reportedocente",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget reportedocente"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("reportedocenteclave",{url:"/reportedocenteclave",templateUrl:"views/reportedocenteclave.html",data:{pageTitle:"reportedocenteclave",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget reportedocenteclave"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("certificadomatricula",{url:"/certificadomatricula",templateUrl:"views/certificadomatricula.html",data:{pageTitle:"certificadomatricula",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget certificadomatricula"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("certificadomatriculacurso",{url:"/certificadomatriculacurso",templateUrl:"views/certificadomatriculacurso.html",data:{pageTitle:"certificadomatriculacurso",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget certificadomatriculacurso"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("certificadopromocion",{url:"/certificadopromocion",templateUrl:"views/certificadopromocion.html",data:{pageTitle:"certificadopromocion",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget certificadopromocion"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("certificadopromocioncurso",{url:"/certificadopromocioncurso",templateUrl:"views/certificadopromocioncurso.html",data:{pageTitle:"certificadopromocioncurso",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget certificadopromocioncurso"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("periodo1",{url:"/periodo1",templateUrl:"views/periodo1.html",data:{pageTitle:"periodo1",pageHeader:{icon:"fa fa-pencil",title:"periodo1",subtitle:"periodo1 and more"},breadcrumbs:[{title:"Widget"},{title:"periodo1"}]}}).state("periodo2",{url:"/periodo2",templateUrl:"views/periodo2.html",data:{pageTitle:"periodo2",pageHeader:{icon:"fa fa-pencil",title:"periodo2",subtitle:"periodo2 and more"},breadcrumbs:[{title:"Widget"},{title:"periodo2"}]}}).state("unidadeducativa",{url:"/unidadeducativa",templateUrl:"views/unidadeducativa.html",data:{pageTitle:"unidadeducativa",pageHeader:{icon:"fa fa-pencil",title:"Blog Widget",subtitle:"blog widget unidadeducativa"},breadcrumbs:[{title:"Widget"},{title:"Blog"}]}}).state("menus",{url:"/menus",templateUrl:"views/menus.html",data:{pageTitle:"menus",pageHeader:{icon:"fa fa-pencil",title:"menus",subtitle:"menus and more"},breadcrumbs:[{title:"Widget"},{title:"menus"}]}}).state("modulos",{url:"/modulos",templateUrl:"views/modulos.html",data:{pageTitle:"modulos",pageHeader:{icon:"fa fa-pencil",title:"modulos",subtitle:"modulos and more"},breadcrumbs:[{title:"Widget"},{title:"modulos"}]}}).state("permisos",{url:"/permisos",templateUrl:"views/permisos.html",data:{pageTitle:"permisos",pageHeader:{icon:"fa fa-pencil",title:"permisos",subtitle:"permisos and more"},breadcrumbs:[{title:"Widget"},{title:"permisos"}]}}).state("usuarios",{url:"/usuarios",templateUrl:"views/usuarios.html",data:{pageTitle:"usuarios",pageHeader:{icon:"fa fa-pencil",title:"usuarios",subtitle:"usuarios and more"},breadcrumbs:[{title:"Widget"},{title:"usuarios"}]}}).state("ayuda",{url:"/ayuda",templateUrl:"views/ayuda.html",data:{pageTitle:"ayuda",pageHeader:{icon:"fa fa-pencil",title:"ayuda",subtitle:"ayuda and more"},breadcrumbs:[{title:"Widget"},{title:"ayuda"}]}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/estudiantes/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.estudiantes",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/estudiantes/","/estudiantes");var d={create:"estudiantes_create","new":"estudiantes_api_new",edit:"estudiantes_api_edit",update:"estudiantes_update",list:"estudiantes_api",state_created:"multiacademico.estudiantes.show",state_updated:"multiacademico.estudiantes.show"};a.state("multiacademico.estudiantes",{"abstract":!0,data:{pageTitle:"Estudiantes",pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Lista"},breadcrumbs:[{title:"Estudiantes"},{title:"lista"}]}}).state("multiacademico.estudiantes.list",{url:"/estudiantes",data:{pageTitle:"Estudiantes"},views:{"content@multiacademico":{templateUrl:Routing.generate("estudiantes_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.estudiantes.show",{url:"/estudiantes/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Mostrar"},breadcrumbs:[{title:"Estudiantes"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("estudiantes_api_show",{id:a.id})}}}}).state("multiacademico.estudiantes.new",{url:"/estudiantes/new",params:{submited:!1,formData:null},data:{pageTitle:"Estudiantes",pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Nuevo"},breadcrumbs:[{title:"Estudiantes"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.estudiantes.edit",{url:"/estudiantes/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"Estudiantes",subtitle:"Editar"},breadcrumbs:[{title:"Estudiantes"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/materias/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.materias",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/materias/","/materias");var d={create:"materias_create","new":"materias_api_new",edit:"materias_api_edit",update:"materias_update",list:"materias_api",state_created:"multiacademico.materias.show",state_updated:"multiacademico.materias.show"};a.state("multiacademico.materias",{"abstract":!0,data:{pageTitle:"materias",pageHeader:{icon:"fa fa-users",title:"materias",subtitle:"Lista"},breadcrumbs:[{title:"materias"},{title:"lista"}]}}).state("multiacademico.materias.list",{url:"/materias",data:{pageTitle:"materias"},views:{"content@multiacademico":{templateUrl:Routing.generate("materias_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.materias.show",{url:"/materias/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"materias",subtitle:"Mostrar"},breadcrumbs:[{title:"materias"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("materias_api_show",{id:a.id})}}}}).state("multiacademico.materias.new",{url:"/materias/new",params:{submited:!1,formData:null},data:{pageTitle:"materias",pageHeader:{icon:"fa fa-users",title:"materias",subtitle:"Nuevo"},breadcrumbs:[{title:"materias"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.materias.edit",{url:"/materias/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"materias",subtitle:"Editar"},breadcrumbs:[{title:"materias"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/periodo/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.periodo",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/periodo/","/periodo");var d={create:"periodo_create","new":"periodo_api_new",edit:"periodo_api_edit",update:"periodo_update",list:"periodo_api",state_created:"multiacademico.periodo.show",state_updated:"multiacademico.periodo.show"};a.state("multiacademico.periodo",{"abstract":!0,data:{pageTitle:"periodo",pageHeader:{icon:"fa fa-users",title:"periodo",subtitle:"Lista"},breadcrumbs:[{title:"periodo"},{title:"lista"}]}}).state("multiacademico.periodo.list",{url:"/periodo",data:{pageTitle:"periodo"},views:{"content@multiacademico":{templateUrl:Routing.generate("periodo_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.periodo.show",{url:"/periodo/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"periodo",subtitle:"Mostrar"},breadcrumbs:[{title:"periodo"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("periodo_api_show",{id:a.id})}}}}).state("multiacademico.periodo.new",{url:"/periodo/new",params:{submited:!1,formData:null},data:{pageTitle:"periodo",pageHeader:{icon:"fa fa-users",title:"periodo",subtitle:"Nuevo"},breadcrumbs:[{title:"periodo"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.periodo.edit",{url:"/periodo/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"periodo",subtitle:"Editar"},breadcrumbs:[{title:"periodo"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/cursos/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.cursos",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/cursos/","/cursos");var d={create:"cursos_create","new":"cursos_api_new",edit:"cursos_api_edit",update:"cursos_update",list:"cursos_api",state_created:"multiacademico.cursos.show",state_updated:"multiacademico.cursos.show"};a.state("multiacademico.cursos",{"abstract":!0,data:{pageTitle:"cursos",pageHeader:{icon:"fa fa-users",title:"cursos",subtitle:"Lista"},breadcrumbs:[{title:"cursos"},{title:"lista"}]}}).state("multiacademico.cursos.list",{url:"/cursos",data:{pageTitle:"cursos"},views:{"content@multiacademico":{templateUrl:Routing.generate("cursos_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.cursos.show",{url:"/cursos/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"cursos",subtitle:"Mostrar"},breadcrumbs:[{title:"cursos"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("cursos_api_show",{id:a.id})}}}}).state("multiacademico.cursos.new",{url:"/cursos/new",params:{submited:!1,formData:null},data:{pageTitle:"cursos",pageHeader:{icon:"fa fa-users",title:"cursos",subtitle:"Nuevo"},breadcrumbs:[{title:"cursos"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.cursos.edit",{url:"/cursos/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"cursos",subtitle:"Editar"},breadcrumbs:[{title:"cursos"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/distributivos/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.distributivos",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/distributivos/","/distributivos");var d={create:"distributivos_create","new":"distributivos_api_new",edit:"distributivos_api_edit",update:"distributivos_update",list:"distributivos_api",state_created:"multiacademico.distributivos.show",state_updated:"multiacademico.distributivos.show"};a.state("multiacademico.distributivos",{"abstract":!0,data:{pageTitle:"Distributivos",pageHeader:{icon:"fa fa-users",title:"Distributivos",subtitle:"Lista"},breadcrumbs:[{title:"Distributivos"},{title:"lista"}]}}).state("multiacademico.distributivos.list",{url:"/distributivos",data:{pageTitle:"Distributivos"},views:{"content@multiacademico":{templateUrl:Routing.generate("distributivos_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.distributivos.show",{url:"/distributivos/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"Distributivos",subtitle:"Mostrar"},breadcrumbs:[{title:"Distributivos"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("distributivos_api_show",{id:a.id})}}}}).state("multiacademico.distributivos.new",{url:"/distributivos/new",params:{submited:!1,formData:null},data:{pageTitle:"distributivos",pageHeader:{icon:"fa fa-users",title:"Distributivos",subtitle:"Nuevo"},breadcrumbs:[{title:"Distributivos"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.distributivos.edit",{url:"/distributivos/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"Distributivos",subtitle:"Editar"},breadcrumbs:[{title:"Distributivos"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/especializaciones/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.especializaciones",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/especializaciones/","/especializaciones");var d={create:"especializaciones_create","new":"especializaciones_api_new",edit:"especializaciones_api_edit",update:"especializaciones_update",list:"especializaciones_api",state_created:"multiacademico.especializaciones.show",state_updated:"multiacademico.especializaciones.show"};a.state("multiacademico.especializaciones",{"abstract":!0,data:{pageTitle:"especializaciones",pageHeader:{icon:"fa fa-users",title:"especializaciones",subtitle:"Lista"},breadcrumbs:[{title:"especializaciones"},{title:"lista"}]}}).state("multiacademico.especializaciones.list",{url:"/especializaciones",data:{pageTitle:"especializaciones"},views:{"content@multiacademico":{templateUrl:Routing.generate("especializaciones_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.especializaciones.show",{url:"/especializaciones/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"especializaciones",subtitle:"Mostrar"},breadcrumbs:[{title:"especializaciones"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("especializaciones_api_show",{id:a.id})}}}}).state("multiacademico.especializaciones.new",{url:"/especializaciones/new",params:{submited:!1,formData:null},data:{pageTitle:"especializaciones",pageHeader:{icon:"fa fa-users",title:"especializaciones",subtitle:"Nuevo"},breadcrumbs:[{title:"especializaciones"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}}).state("multiacademico.especializaciones.edit",{url:"/especializaciones/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"especializaciones",subtitle:"Editar"},breadcrumbs:[{title:"especializaciones"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSelect2","modules/forms/controllers/FormsCrudCtrl"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/proyectosescolares/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.proyectosescolares",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){c.when("/proyectosescolares/","/proyectosescolares");var d={create:"proyectosescolares_create","new":"proyectosescolares_api_new",edit:"proyectosescolares_api_edit",update:"proyectosescolares_update",list:"proyectosescolares_api",state_created:"multiacademico.proyectosescolares.show",state_updated:"multiacademico.proyectosescolares.show"};a.state("multiacademico.proyectosescolares",{"abstract":!0,data:{pageTitle:"Proyectos Escolares",pageHeader:{icon:"fa fa-users",title:"Proyectos Escolares",subtitle:"Lista"},breadcrumbs:[{title:"Proyectos Escolares"},{title:"lista"}]}}).state("multiacademico.proyectosescolares.list",{url:"/proyectosescolares",data:{pageTitle:"Proyectos Escolares"},views:{"content@multiacademico":{templateUrl:Routing.generate("proyectosescolares_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.proyectosescolares.show",{url:"/proyectosescolares/{id:[0-9]{1,11}}",data:{pageHeader:{icon:"fa fa-users",title:"Proyectos Escolares",subtitle:"Mostrar"},breadcrumbs:[{title:"Proyectos Escolares"},{title:"mostrar"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("proyectosescolares_api_show",{id:a.id})}}}}).state("multiacademico.proyectosescolares.new",{url:"/proyectosescolares/new",params:{submited:!1,formData:null},data:{pageTitle:"Proyectos Escolares",pageHeader:{icon:"fa fa-users",title:"Proyectos Escolares",subtitle:"Nuevo"},breadcrumbs:[{title:"Proyectos Escolares"},{title:"nuevo"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.nuevo(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/controllers/FormsCrudCtrl"]),deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/chosen/chosen.min.css"]}])}]}}}}).state("multiacademico.proyectosescolares.edit",{url:"/proyectosescolares/{id:[0-9]{1,11}}/edit",params:{id:void 0,submited:!1,formData:null},data:{pageHeader:{icon:"fa fa-users",title:"Proyectos Escolares",subtitle:"Editar"},breadcrumbs:[{title:"Proyectos Escolares"},{title:"editar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","FormsCrud",function(a,b){return b.edit(a,d)}],controller:"FormsCrudCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/proyectosescolares/directives/collectionForm","modules/forms/controllers/FormsCrudCtrl"]),deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/chosen/chosen.min.css"]}])}]}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/docentes/calificar/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.docentes.midistributivo",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){var d={edit:"calificaciones_api",update:"calificaciones_api",state_created:"multiacademico.docentes.midistributivo.menu.calificaciones",state_updated:"multiacademico.docentes.midistributivo.menu.calificaciones"};a.state("multiacademico.docentes",{"abstract":!0,data:{pageTitle:"Docentes",pageHeader:{icon:"flaticon-teacher",title:"Docente",subtitle:"Docente"},breadcrumbs:[{title:"Docentes"},{title:"lista"}]}}).state("multiacademico.docentes.midistributivo",{url:"/midistributivo",data:{pageTitle:"Calificar",pageHeader:{icon:"flaticon-a1",title:"Calificar",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("midistributivo_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.menu",{url:"/menu/{id:[0-9]{1,11}}",data:{pageTitle:"Calificar",pageHeader:{icon:"flaticon-a1",title:"Calificar",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_calificar_api",{id:a.id})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.menu.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones",pageHeader:{icon:"flaticon-a1",title:"Calificaciones",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){return b.calificar(a,d)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.proyectos",{url:"/proyectos/{id:[0-9]{1,11}}",data:{pageTitle:"Calificar Proyecto Escolar",pageHeader:{icon:"flaticon-a1",title:"Proyectos Escolares",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar Proyecto"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_proyectos_escolares_api",{id:a.id})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.proyectos.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones Proyecto Escolar",pageHeader:{icon:"flaticon-a1",title:"Calificaciones Proyecto Escolar",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones Proyecto Escolar"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){var c={edit:"calificaciones_proyecto_api",update:"calificaciones_proyecto_api",state_created:"multiacademico.docentes.midistributivo.proyectos.calificaciones",state_updated:"multiacademico.docentes.midistributivo.proyectos.calificaciones"};return b.calificar(a,c)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.tutor",{url:"/tutor/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}",data:{pageTitle:"Menu Tutor",pageHeader:{icon:"flaticon-a1",title:"Tutor",subtitle:"Menu"},breadcrumbs:[{title:"Tutor"},{title:"menu"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_tutor_api",{curso:a.curso,especializacion:a.especializacion,paralelo:a.paralelo,seccion:a.seccion,periodo:a.periodo})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.tutor.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones Proyecto Escolar",pageHeader:{icon:"flaticon-a1",title:"Calificaciones Proyecto Escolar",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones Proyecto Escolar"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){var c={edit:"calificaciones_proyecto_api",update:"calificaciones_proyecto_api",state_created:"multiacademico.docentes.midistributivo.proyectos.calificaciones",state_updated:"multiacademico.docentes.midistributivo.proyectos.calificaciones"};return b.calificar(a,c)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/docentes/calificar/factory/CalificarForm',["multiacademico/docentes/calificar/module"],function(a){"use strict";return a.registerFactory("CalificarForm",["$http","$state",function(a,b){return{calificar:function(c,d){return c.submited===!0?a({method:"POST",async:!0,url:Routing.generate(d.update,{id:c.id,q:c.q,p:c.p}),data:c.formData,transformRequest:angular.identity,headers:{"Content-Type":void 0}}).then(function(a){return 200===a.status?a.data:201===a.status?(b.go(d.state_updated,{id:a.data.id}),"<div>se ha actualizado correctamente</div>"):void 0}):a.get(Routing.generate(d.edit,{id:c.id,q:c.q,p:c.p})).then(function(a){return a.data})}}}])});
define('multiacademico/reportes/malla/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.malla",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("multiacademico.malla-normal",{url:"/malla-normal",data:{pageTitle:"malla-normal",pageHeader:{icon:"fa fa-pencil",title:"Malla Normal",subtitle:"malla normal"},breadcrumbs:[{title:"Malla"},{title:"Malla Normal"}]},views:{"content@multiacademico":{templateUrl:"views/multiacademico/malla/seleccionar-aula-malla-normal.html",controller:["$scope","aulas",function(a,b){a.aulas=b}],resolve:{aulas:["$http",function(a){return a.get(Routing.generate("get_aulas_all",{_format:"json"})).then(function(a){return a.data.aulas})}]}}}}).state("multiacademico.malla-normal.aula",{url:"/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/{q}/{p}",reloadOnSearch:!1,data:{pageTitle:"Cuadro de Calificaciones",pageHeader:{icon:"fa flaticon-tactil1",title:"Malla",subtitle:"Cuadro de Calificaciones"},breadcrumbs:[{title:"Malla"},{title:"Cuadro de Calificaciones"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("malla-normal-api"),controller:"MallaCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/reportes/malla/controllers/MallaCtrl"]),aula:["$http","$stateParams",function(a,b){return a.get(Routing.generate("get_aula",{curso:b.curso,especializacion:b.especializacion,paralelo:b.paralelo,seccion:b.seccion,periodo:b.periodo,_format:"json"})).then(function(a){return a.data.aula})}]}}}}).state("cuadro-de-calificaciones",{url:"/cuadro-de-calificaciones",templateUrl:"views/multiacademico/malla/cuadro-de-calificaciones.html",data:{pageTitle:"cuadro-de-calificaciones",pageHeader:{icon:"fa fa-pencil",title:"Cuadro de Calificaciones",subtitle:"cuadro-de-calificaciones"},breadcrumbs:[{title:"Malla"},{title:"Cuadro de Calificaciones"}]}}).state("comportamiento",{url:"/comportamiento",templateUrl:"views/multiacademico/malla/comportamiento.html",data:{pageTitle:"comportamiento",pageHeader:{icon:"fa fa-pencil",title:"Comportamiento",subtitle:"comportamiento"},breadcrumbs:[{title:"Malla"},{title:"Comportamiento"}]}}).state("quimestre",{url:"/quimestre",templateUrl:"views/multiacademico/malla/quimestre.html",data:{pageTitle:"quimestre",pageHeader:{icon:"fa fa-pencil",title:"Quimestre",subtitle:"quimestre"},breadcrumbs:[{title:"Malla"},{title:"Quimestre"}]}}).state("quimestre2",{url:"/quimestre2",templateUrl:"views/multiacademico/malla/quimestre2.html",data:{pageTitle:"quimestre2",pageHeader:{icon:"fa fa-pencil",title:"Quimestre 2",subtitle:"quimestre 2"},breadcrumbs:[{title:"Malla"},{title:"Quimestre 2"}]}}).state("dos-quimestre",{url:"/dos-quimestre",templateUrl:"views/multiacademico/malla/dos-quimestre.html",data:{pageTitle:"dos-quimestre",pageHeader:{icon:"fa fa-pencil",title:"Dos quimestre",subtitle:"dos quimestre"},breadcrumbs:[{title:"Malla"},{title:"Dos quimestre"}]}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('multiacademico/informes/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.informes",["ui.router"]);return b.configureApp(c),c.registerFilter("ordenarCalificaciones",function(){return function(b,c){var d=[];return a.forEach(b,function(a){d.push(a)}),d.sort(function(a,b){var c="calificacioncodmateria",d="prioridad";return a[c][d]>b[c][d]?1:-1}),c&&d.reverse(),d}}),c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("multiacademico.informes",{url:"/informes",data:{pageTitle:"Informes",pageHeader:{icon:"fa flaticon-a3",title:"Informes",subtitle:"Seleccionar curso"},breadcrumbs:[{title:"Informes"},{title:"Seleccionar curso"}]},views:{"content@multiacademico":{templateUrl:"views/multiacademico/informes/seleccionar-aula-informes.html",controller:["$scope","aulas",function(a,b){a.aulas=b}],resolve:{aulas:["$http",function(a){return a.get(Routing.generate("get_aulas_all",{_format:"json"})).then(function(a){return a.data.aulas})}]}}}}).state("multiacademico.informes.aula",{url:"/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/{q}/{p}",reloadOnSearch:!1,data:{pageTitle:"Informe de Aprendizaje",pageHeader:{icon:"fa flaticon-tactil1",title:"Informes",subtitle:"Informe de Aprendizaje"},breadcrumbs:[{title:"Informes"},{title:"Informe de Aprendizaje"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("informe-aprendizaje-api"),controller:"InformesCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/informes/controllers/InformesCtrl"]),aula:["$http","$stateParams",function(a,b){return a.get(Routing.generate("get_aula",{curso:b.curso,especializacion:b.especializacion,paralelo:b.paralelo,seccion:b.seccion,periodo:b.periodo,_format:"json"})).then(function(a){return a.data.aula})}]}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('modules/forms/module',["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("app.forms",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("app.form",{"abstract":!0,data:{title:"Forms"}}).state("app.form.elements",{url:"/form/elements",data:{title:"Form Elements"},views:{"content@app":{templateUrl:"build/modules/forms/views/form-elements.html"}}}).state("app.form.layouts",{url:"/form/layouts",data:{title:"Form Layouts"},views:{"content@app":{controller:"FormLayoutsCtrl",templateUrl:"build/modules/forms/views/form-layouts.html",resolve:{deps:b.resolveDependencies(["modules/forms/controllers/FormLayoutsCtrl","modules/forms/directives/form-layouts/smartCheckoutForm","modules/forms/directives/form-layouts/smartOrderForm","modules/forms/directives/form-layouts/smartReviewForm","modules/forms/directives/form-layouts/smartRegistrationForm","modules/forms/directives/form-layouts/smartCommentForm","modules/forms/directives/form-layouts/smartContactsForm","modules/forms/directives/input/smartMaskedInput","modules/forms/directives/input/smartDatepicker"])}}}}).state("app.form.validation",{url:"/form/validation",data:{title:"Form Validation"},views:{"content@app":{templateUrl:"build/modules/forms/views/form-validation.html"}}}).state("app.form.bootstrapForms",{url:"/form/bootstrap-forms",data:{title:"Bootstrap Forms"},views:{"content@app":{templateUrl:"build/modules/forms/views/bootstrap-forms.html"}}}).state("app.form.bootstrapValidation",{url:"/form/bootstrap-validation",data:{title:"Bootstrap Validation"},views:{"content@app":{templateUrl:"build/modules/forms/views/bootstrap-validation.html",resolve:{deps:b.resolveDependencies(["modules/forms/directives/bootstrap-validation/bootstrapMovieForm","modules/forms/directives/bootstrap-validation/bootstrapTogglingForm","modules/forms/directives/bootstrap-validation/bootstrapAttributeForm","modules/forms/directives/bootstrap-validation/bootstrapButtonGroupForm","modules/forms/directives/bootstrap-validation/bootstrapProductForm","modules/forms/directives/bootstrap-validation/bootstrapProfileForm","modules/forms/directives/bootstrap-validation/bootstrapContactForm"])}}}}).state("app.form.plugins",{url:"/form/plugins",data:{title:"Form Plugins"},views:{"content@app":{templateUrl:"build/modules/forms/views/form-plugins.html",controller:"FormPluginsCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/input/smartSpinner","modules/forms/directives/input/smartDatepicker","modules/forms/directives/input/smartTimepicker","modules/forms/directives/input/smartClockpicker","modules/forms/directives/input/smartNouislider","modules/forms/directives/input/smartIonslider","modules/forms/directives/input/smartDuallistbox","modules/forms/directives/input/smartColorpicker","modules/forms/directives/input/smartKnob","modules/forms/directives/input/smartUislider","modules/forms/directives/input/smartSelect2","modules/forms/directives/input/smartMaskedInput","modules/forms/directives/input/smartTagsinput","modules/forms/directives/input/smartXEditable","modules/forms/controllers/FormXeditableCtrl","modules/forms/controllers/FormPluginsCtrl"])}}}}).state("app.form.wizards",{url:"/form/wizards",data:{title:"Wizards"},views:{"content@app":{templateUrl:"build/modules/forms/views/form-wizards.html",controller:"FormWizardCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/directives/validate/smartValidateForm","modules/forms/directives/wizard/smartWizard","modules/forms/directives/wizard/smartFueluxWizard","modules/forms/directives/input/smartMaskedInput","modules/forms/controllers/FormWizardCtrl"])}}}}).state("app.form.editors",{url:"/form/editors",data:{title:"Editors"},views:{"content@app":{templateUrl:"build/modules/forms/views/form-editors.html",resolve:{deps:b.resolveDependencies(["modules/forms/directives/editors/smartMarkdownEditor","modules/forms/directives/editors/smartSummernoteEditor","modules/forms/directives/editors/smartEditSummernote","modules/forms/directives/editors/smartDestroySummernote"])}}}}).state("app.form.dropzone",{url:"/form/dropzone",data:{title:"Dropzone"},views:{"content@app":{templateUrl:"build/modules/forms/views/dropzone.html",resolve:{deps:b.resolveDependencies(["modules/forms/directives/upload/smartDropzone"])}}}}).state("app.form.imageEditor",{url:"/form/image-editor",data:{title:"Image Editor"},views:{"content@app":{templateUrl:"build/modules/forms/views/image-editor.html",controller:"ImageEditorCtrl",resolve:{deps:b.resolveDependencies(["modules/forms/controllers/ImageEditorCtrl","modules/forms/directives/image-editor/smartJcrop"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('modules/forms/models/FormsCrud',["modules/forms/module"],function(a){"use strict";return a.registerFactory("FormsCrud",["$http","$state",function(a,b){return{nuevo:function(c,d){return c.submited===!0?a({method:"POST",async:!0,url:Routing.generate(d.create),data:c.formData,transformRequest:angular.identity,headers:{"Content-Type":void 0}}).then(function(a){return 200===a.status?a.data:201===a.status?(b.go(d.state_created,{id:a.data.id}),"<div>se ha guardado correctamente</div>"):void 0}):a.get(Routing.generate(d["new"])).then(function(a){return a.data})},edit:function(c,d){return c.submited===!0?a({method:"POST",async:!0,url:Routing.generate(d.update,{id:c.id}),data:c.formData,transformRequest:angular.identity,headers:{"Content-Type":void 0}}).then(function(a){return 200===a.status?a.data:201===a.status?(b.go(d.state_updated,{id:a.data.id}),"<div>se ha actualizado correctamente</div>"):void 0}):a.get(Routing.generate(d.edit,{id:c.id})).then(function(a){return a.data})}}}])});
/**
 * @license AngularJS v1.4.7
 * (c) 2010-2015 Google, Inc. http://angularjs.org
 * License: MIT
 */
(function(window, angular, undefined) {



/**
 * @ngdoc object
 * @name angular.mock
 * @description
 *
 * Namespace from 'angular-mocks.js' which contains testing related code.
 */
angular.mock = {};

/**
 * ! This is a private undocumented service !
 *
 * @name $browser
 *
 * @description
 * This service is a mock implementation of {@link ng.$browser}. It provides fake
 * implementation for commonly used browser apis that are hard to test, e.g. setTimeout, xhr,
 * cookies, etc...
 *
 * The api of this service is the same as that of the real {@link ng.$browser $browser}, except
 * that there are several helper methods available which can be used in tests.
 */
angular.mock.$BrowserProvider = function() {
  this.$get = function() {
    return new angular.mock.$Browser();
  };
};

angular.mock.$Browser = function() {
  var self = this;

  this.isMock = true;
  self.$$url = "http://server/";
  self.$$lastUrl = self.$$url; // used by url polling fn
  self.pollFns = [];

  // TODO(vojta): remove this temporary api
  self.$$completeOutstandingRequest = angular.noop;
  self.$$incOutstandingRequestCount = angular.noop;


  // register url polling fn

  self.onUrlChange = function(listener) {
    self.pollFns.push(
      function() {
        if (self.$$lastUrl !== self.$$url || self.$$state !== self.$$lastState) {
          self.$$lastUrl = self.$$url;
          self.$$lastState = self.$$state;
          listener(self.$$url, self.$$state);
        }
      }
    );

    return listener;
  };

  self.$$applicationDestroyed = angular.noop;
  self.$$checkUrlChange = angular.noop;

  self.deferredFns = [];
  self.deferredNextId = 0;

  self.defer = function(fn, delay) {
    delay = delay || 0;
    self.deferredFns.push({time:(self.defer.now + delay), fn:fn, id: self.deferredNextId});
    self.deferredFns.sort(function(a, b) { return a.time - b.time;});
    return self.deferredNextId++;
  };


  /**
   * @name $browser#defer.now
   *
   * @description
   * Current milliseconds mock time.
   */
  self.defer.now = 0;


  self.defer.cancel = function(deferId) {
    var fnIndex;

    angular.forEach(self.deferredFns, function(fn, index) {
      if (fn.id === deferId) fnIndex = index;
    });

    if (angular.isDefined(fnIndex)) {
      self.deferredFns.splice(fnIndex, 1);
      return true;
    }

    return false;
  };


  /**
   * @name $browser#defer.flush
   *
   * @description
   * Flushes all pending requests and executes the defer callbacks.
   *
   * @param {number=} number of milliseconds to flush. See {@link #defer.now}
   */
  self.defer.flush = function(delay) {
    if (angular.isDefined(delay)) {
      self.defer.now += delay;
    } else {
      if (self.deferredFns.length) {
        self.defer.now = self.deferredFns[self.deferredFns.length - 1].time;
      } else {
        throw new Error('No deferred tasks to be flushed');
      }
    }

    while (self.deferredFns.length && self.deferredFns[0].time <= self.defer.now) {
      self.deferredFns.shift().fn();
    }
  };

  self.$$baseHref = '/';
  self.baseHref = function() {
    return this.$$baseHref;
  };
};
angular.mock.$Browser.prototype = {

/**
  * @name $browser#poll
  *
  * @description
  * run all fns in pollFns
  */
  poll: function poll() {
    angular.forEach(this.pollFns, function(pollFn) {
      pollFn();
    });
  },

  url: function(url, replace, state) {
    if (angular.isUndefined(state)) {
      state = null;
    }
    if (url) {
      this.$$url = url;
      // Native pushState serializes & copies the object; simulate it.
      this.$$state = angular.copy(state);
      return this;
    }

    return this.$$url;
  },

  state: function() {
    return this.$$state;
  },

  notifyWhenNoOutstandingRequests: function(fn) {
    fn();
  }
};


/**
 * @ngdoc provider
 * @name $exceptionHandlerProvider
 *
 * @description
 * Configures the mock implementation of {@link ng.$exceptionHandler} to rethrow or to log errors
 * passed to the `$exceptionHandler`.
 */

/**
 * @ngdoc service
 * @name $exceptionHandler
 *
 * @description
 * Mock implementation of {@link ng.$exceptionHandler} that rethrows or logs errors passed
 * to it. See {@link ngMock.$exceptionHandlerProvider $exceptionHandlerProvider} for configuration
 * information.
 *
 *
 * ```js
 *   describe('$exceptionHandlerProvider', function() {
 *
 *     it('should capture log messages and exceptions', function() {
 *
 *       module(function($exceptionHandlerProvider) {
 *         $exceptionHandlerProvider.mode('log');
 *       });
 *
 *       inject(function($log, $exceptionHandler, $timeout) {
 *         $timeout(function() { $log.log(1); });
 *         $timeout(function() { $log.log(2); throw 'banana peel'; });
 *         $timeout(function() { $log.log(3); });
 *         expect($exceptionHandler.errors).toEqual([]);
 *         expect($log.assertEmpty());
 *         $timeout.flush();
 *         expect($exceptionHandler.errors).toEqual(['banana peel']);
 *         expect($log.log.logs).toEqual([[1], [2], [3]]);
 *       });
 *     });
 *   });
 * ```
 */

angular.mock.$ExceptionHandlerProvider = function() {
  var handler;

  /**
   * @ngdoc method
   * @name $exceptionHandlerProvider#mode
   *
   * @description
   * Sets the logging mode.
   *
   * @param {string} mode Mode of operation, defaults to `rethrow`.
   *
   *   - `log`: Sometimes it is desirable to test that an error is thrown, for this case the `log`
   *            mode stores an array of errors in `$exceptionHandler.errors`, to allow later
   *            assertion of them. See {@link ngMock.$log#assertEmpty assertEmpty()} and
   *            {@link ngMock.$log#reset reset()}
   *   - `rethrow`: If any errors are passed to the handler in tests, it typically means that there
   *                is a bug in the application or test, so this mock will make these tests fail.
   *                For any implementations that expect exceptions to be thrown, the `rethrow` mode
   *                will also maintain a log of thrown errors.
   */
  this.mode = function(mode) {

    switch (mode) {
      case 'log':
      case 'rethrow':
        var errors = [];
        handler = function(e) {
          if (arguments.length == 1) {
            errors.push(e);
          } else {
            errors.push([].slice.call(arguments, 0));
          }
          if (mode === "rethrow") {
            throw e;
          }
        };
        handler.errors = errors;
        break;
      default:
        throw new Error("Unknown mode '" + mode + "', only 'log'/'rethrow' modes are allowed!");
    }
  };

  this.$get = function() {
    return handler;
  };

  this.mode('rethrow');
};


/**
 * @ngdoc service
 * @name $log
 *
 * @description
 * Mock implementation of {@link ng.$log} that gathers all logged messages in arrays
 * (one array per logging level). These arrays are exposed as `logs` property of each of the
 * level-specific log function, e.g. for level `error` the array is exposed as `$log.error.logs`.
 *
 */
angular.mock.$LogProvider = function() {
  var debug = true;

  function concat(array1, array2, index) {
    return array1.concat(Array.prototype.slice.call(array2, index));
  }

  this.debugEnabled = function(flag) {
    if (angular.isDefined(flag)) {
      debug = flag;
      return this;
    } else {
      return debug;
    }
  };

  this.$get = function() {
    var $log = {
      log: function() { $log.log.logs.push(concat([], arguments, 0)); },
      warn: function() { $log.warn.logs.push(concat([], arguments, 0)); },
      info: function() { $log.info.logs.push(concat([], arguments, 0)); },
      error: function() { $log.error.logs.push(concat([], arguments, 0)); },
      debug: function() {
        if (debug) {
          $log.debug.logs.push(concat([], arguments, 0));
        }
      }
    };

    /**
     * @ngdoc method
     * @name $log#reset
     *
     * @description
     * Reset all of the logging arrays to empty.
     */
    $log.reset = function() {
      /**
       * @ngdoc property
       * @name $log#log.logs
       *
       * @description
       * Array of messages logged using {@link ng.$log#log `log()`}.
       *
       * @example
       * ```js
       * $log.log('Some Log');
       * var first = $log.log.logs.unshift();
       * ```
       */
      $log.log.logs = [];
      /**
       * @ngdoc property
       * @name $log#info.logs
       *
       * @description
       * Array of messages logged using {@link ng.$log#info `info()`}.
       *
       * @example
       * ```js
       * $log.info('Some Info');
       * var first = $log.info.logs.unshift();
       * ```
       */
      $log.info.logs = [];
      /**
       * @ngdoc property
       * @name $log#warn.logs
       *
       * @description
       * Array of messages logged using {@link ng.$log#warn `warn()`}.
       *
       * @example
       * ```js
       * $log.warn('Some Warning');
       * var first = $log.warn.logs.unshift();
       * ```
       */
      $log.warn.logs = [];
      /**
       * @ngdoc property
       * @name $log#error.logs
       *
       * @description
       * Array of messages logged using {@link ng.$log#error `error()`}.
       *
       * @example
       * ```js
       * $log.error('Some Error');
       * var first = $log.error.logs.unshift();
       * ```
       */
      $log.error.logs = [];
        /**
       * @ngdoc property
       * @name $log#debug.logs
       *
       * @description
       * Array of messages logged using {@link ng.$log#debug `debug()`}.
       *
       * @example
       * ```js
       * $log.debug('Some Error');
       * var first = $log.debug.logs.unshift();
       * ```
       */
      $log.debug.logs = [];
    };

    /**
     * @ngdoc method
     * @name $log#assertEmpty
     *
     * @description
     * Assert that all of the logging methods have no logged messages. If any messages are present,
     * an exception is thrown.
     */
    $log.assertEmpty = function() {
      var errors = [];
      angular.forEach(['error', 'warn', 'info', 'log', 'debug'], function(logLevel) {
        angular.forEach($log[logLevel].logs, function(log) {
          angular.forEach(log, function(logItem) {
            errors.push('MOCK $log (' + logLevel + '): ' + String(logItem) + '\n' +
                        (logItem.stack || ''));
          });
        });
      });
      if (errors.length) {
        errors.unshift("Expected $log to be empty! Either a message was logged unexpectedly, or " +
          "an expected log message was not checked and removed:");
        errors.push('');
        throw new Error(errors.join('\n---------\n'));
      }
    };

    $log.reset();
    return $log;
  };
};


/**
 * @ngdoc service
 * @name $interval
 *
 * @description
 * Mock implementation of the $interval service.
 *
 * Use {@link ngMock.$interval#flush `$interval.flush(millis)`} to
 * move forward by `millis` milliseconds and trigger any functions scheduled to run in that
 * time.
 *
 * @param {function()} fn A function that should be called repeatedly.
 * @param {number} delay Number of milliseconds between each function call.
 * @param {number=} [count=0] Number of times to repeat. If not set, or 0, will repeat
 *   indefinitely.
 * @param {boolean=} [invokeApply=true] If set to `false` skips model dirty checking, otherwise
 *   will invoke `fn` within the {@link ng.$rootScope.Scope#$apply $apply} block.
 * @param {...*=} Pass additional parameters to the executed function.
 * @returns {promise} A promise which will be notified on each iteration.
 */
angular.mock.$IntervalProvider = function() {
  this.$get = ['$browser', '$rootScope', '$q', '$$q',
       function($browser,   $rootScope,   $q,   $$q) {
    var repeatFns = [],
        nextRepeatId = 0,
        now = 0;

    var $interval = function(fn, delay, count, invokeApply) {
      var hasParams = arguments.length > 4,
          args = hasParams ? Array.prototype.slice.call(arguments, 4) : [],
          iteration = 0,
          skipApply = (angular.isDefined(invokeApply) && !invokeApply),
          deferred = (skipApply ? $$q : $q).defer(),
          promise = deferred.promise;

      count = (angular.isDefined(count)) ? count : 0;
      promise.then(null, null, (!hasParams) ? fn : function() {
        fn.apply(null, args);
      });

      promise.$$intervalId = nextRepeatId;

      function tick() {
        deferred.notify(iteration++);

        if (count > 0 && iteration >= count) {
          var fnIndex;
          deferred.resolve(iteration);

          angular.forEach(repeatFns, function(fn, index) {
            if (fn.id === promise.$$intervalId) fnIndex = index;
          });

          if (angular.isDefined(fnIndex)) {
            repeatFns.splice(fnIndex, 1);
          }
        }

        if (skipApply) {
          $browser.defer.flush();
        } else {
          $rootScope.$apply();
        }
      }

      repeatFns.push({
        nextTime:(now + delay),
        delay: delay,
        fn: tick,
        id: nextRepeatId,
        deferred: deferred
      });
      repeatFns.sort(function(a, b) { return a.nextTime - b.nextTime;});

      nextRepeatId++;
      return promise;
    };
    /**
     * @ngdoc method
     * @name $interval#cancel
     *
     * @description
     * Cancels a task associated with the `promise`.
     *
     * @param {promise} promise A promise from calling the `$interval` function.
     * @returns {boolean} Returns `true` if the task was successfully cancelled.
     */
    $interval.cancel = function(promise) {
      if (!promise) return false;
      var fnIndex;

      angular.forEach(repeatFns, function(fn, index) {
        if (fn.id === promise.$$intervalId) fnIndex = index;
      });

      if (angular.isDefined(fnIndex)) {
        repeatFns[fnIndex].deferred.reject('canceled');
        repeatFns.splice(fnIndex, 1);
        return true;
      }

      return false;
    };

    /**
     * @ngdoc method
     * @name $interval#flush
     * @description
     *
     * Runs interval tasks scheduled to be run in the next `millis` milliseconds.
     *
     * @param {number=} millis maximum timeout amount to flush up until.
     *
     * @return {number} The amount of time moved forward.
     */
    $interval.flush = function(millis) {
      now += millis;
      while (repeatFns.length && repeatFns[0].nextTime <= now) {
        var task = repeatFns[0];
        task.fn();
        task.nextTime += task.delay;
        repeatFns.sort(function(a, b) { return a.nextTime - b.nextTime;});
      }
      return millis;
    };

    return $interval;
  }];
};


/* jshint -W101 */
/* The R_ISO8061_STR regex is never going to fit into the 100 char limit!
 * This directive should go inside the anonymous function but a bug in JSHint means that it would
 * not be enacted early enough to prevent the warning.
 */
var R_ISO8061_STR = /^(\d{4})-?(\d\d)-?(\d\d)(?:T(\d\d)(?:\:?(\d\d)(?:\:?(\d\d)(?:\.(\d{3}))?)?)?(Z|([+-])(\d\d):?(\d\d)))?$/;

function jsonStringToDate(string) {
  var match;
  if (match = string.match(R_ISO8061_STR)) {
    var date = new Date(0),
        tzHour = 0,
        tzMin  = 0;
    if (match[9]) {
      tzHour = toInt(match[9] + match[10]);
      tzMin = toInt(match[9] + match[11]);
    }
    date.setUTCFullYear(toInt(match[1]), toInt(match[2]) - 1, toInt(match[3]));
    date.setUTCHours(toInt(match[4] || 0) - tzHour,
                     toInt(match[5] || 0) - tzMin,
                     toInt(match[6] || 0),
                     toInt(match[7] || 0));
    return date;
  }
  return string;
}

function toInt(str) {
  return parseInt(str, 10);
}

function padNumber(num, digits, trim) {
  var neg = '';
  if (num < 0) {
    neg =  '-';
    num = -num;
  }
  num = '' + num;
  while (num.length < digits) num = '0' + num;
  if (trim) {
    num = num.substr(num.length - digits);
  }
  return neg + num;
}


/**
 * @ngdoc type
 * @name angular.mock.TzDate
 * @description
 *
 * *NOTE*: this is not an injectable instance, just a globally available mock class of `Date`.
 *
 * Mock of the Date type which has its timezone specified via constructor arg.
 *
 * The main purpose is to create Date-like instances with timezone fixed to the specified timezone
 * offset, so that we can test code that depends on local timezone settings without dependency on
 * the time zone settings of the machine where the code is running.
 *
 * @param {number} offset Offset of the *desired* timezone in hours (fractions will be honored)
 * @param {(number|string)} timestamp Timestamp representing the desired time in *UTC*
 *
 * @example
 * !!!! WARNING !!!!!
 * This is not a complete Date object so only methods that were implemented can be called safely.
 * To make matters worse, TzDate instances inherit stuff from Date via a prototype.
 *
 * We do our best to intercept calls to "unimplemented" methods, but since the list of methods is
 * incomplete we might be missing some non-standard methods. This can result in errors like:
 * "Date.prototype.foo called on incompatible Object".
 *
 * ```js
 * var newYearInBratislava = new TzDate(-1, '2009-12-31T23:00:00Z');
 * newYearInBratislava.getTimezoneOffset() => -60;
 * newYearInBratislava.getFullYear() => 2010;
 * newYearInBratislava.getMonth() => 0;
 * newYearInBratislava.getDate() => 1;
 * newYearInBratislava.getHours() => 0;
 * newYearInBratislava.getMinutes() => 0;
 * newYearInBratislava.getSeconds() => 0;
 * ```
 *
 */
angular.mock.TzDate = function(offset, timestamp) {
  var self = new Date(0);
  if (angular.isString(timestamp)) {
    var tsStr = timestamp;

    self.origDate = jsonStringToDate(timestamp);

    timestamp = self.origDate.getTime();
    if (isNaN(timestamp)) {
      throw {
        name: "Illegal Argument",
        message: "Arg '" + tsStr + "' passed into TzDate constructor is not a valid date string"
      };
    }
  } else {
    self.origDate = new Date(timestamp);
  }

  var localOffset = new Date(timestamp).getTimezoneOffset();
  self.offsetDiff = localOffset * 60 * 1000 - offset * 1000 * 60 * 60;
  self.date = new Date(timestamp + self.offsetDiff);

  self.getTime = function() {
    return self.date.getTime() - self.offsetDiff;
  };

  self.toLocaleDateString = function() {
    return self.date.toLocaleDateString();
  };

  self.getFullYear = function() {
    return self.date.getFullYear();
  };

  self.getMonth = function() {
    return self.date.getMonth();
  };

  self.getDate = function() {
    return self.date.getDate();
  };

  self.getHours = function() {
    return self.date.getHours();
  };

  self.getMinutes = function() {
    return self.date.getMinutes();
  };

  self.getSeconds = function() {
    return self.date.getSeconds();
  };

  self.getMilliseconds = function() {
    return self.date.getMilliseconds();
  };

  self.getTimezoneOffset = function() {
    return offset * 60;
  };

  self.getUTCFullYear = function() {
    return self.origDate.getUTCFullYear();
  };

  self.getUTCMonth = function() {
    return self.origDate.getUTCMonth();
  };

  self.getUTCDate = function() {
    return self.origDate.getUTCDate();
  };

  self.getUTCHours = function() {
    return self.origDate.getUTCHours();
  };

  self.getUTCMinutes = function() {
    return self.origDate.getUTCMinutes();
  };

  self.getUTCSeconds = function() {
    return self.origDate.getUTCSeconds();
  };

  self.getUTCMilliseconds = function() {
    return self.origDate.getUTCMilliseconds();
  };

  self.getDay = function() {
    return self.date.getDay();
  };

  // provide this method only on browsers that already have it
  if (self.toISOString) {
    self.toISOString = function() {
      return padNumber(self.origDate.getUTCFullYear(), 4) + '-' +
            padNumber(self.origDate.getUTCMonth() + 1, 2) + '-' +
            padNumber(self.origDate.getUTCDate(), 2) + 'T' +
            padNumber(self.origDate.getUTCHours(), 2) + ':' +
            padNumber(self.origDate.getUTCMinutes(), 2) + ':' +
            padNumber(self.origDate.getUTCSeconds(), 2) + '.' +
            padNumber(self.origDate.getUTCMilliseconds(), 3) + 'Z';
    };
  }

  //hide all methods not implemented in this mock that the Date prototype exposes
  var unimplementedMethods = ['getUTCDay',
      'getYear', 'setDate', 'setFullYear', 'setHours', 'setMilliseconds',
      'setMinutes', 'setMonth', 'setSeconds', 'setTime', 'setUTCDate', 'setUTCFullYear',
      'setUTCHours', 'setUTCMilliseconds', 'setUTCMinutes', 'setUTCMonth', 'setUTCSeconds',
      'setYear', 'toDateString', 'toGMTString', 'toJSON', 'toLocaleFormat', 'toLocaleString',
      'toLocaleTimeString', 'toSource', 'toString', 'toTimeString', 'toUTCString', 'valueOf'];

  angular.forEach(unimplementedMethods, function(methodName) {
    self[methodName] = function() {
      throw new Error("Method '" + methodName + "' is not implemented in the TzDate mock");
    };
  });

  return self;
};

//make "tzDateInstance instanceof Date" return true
angular.mock.TzDate.prototype = Date.prototype;
/* jshint +W101 */

angular.mock.animate = angular.module('ngAnimateMock', ['ng'])

  .config(['$provide', function($provide) {

    $provide.factory('$$forceReflow', function() {
      function reflowFn() {
        reflowFn.totalReflows++;
      }
      reflowFn.totalReflows = 0;
      return reflowFn;
    });

    $provide.factory('$$animateAsyncRun', function() {
      var queue = [];
      var queueFn = function() {
        return function(fn) {
          queue.push(fn);
        };
      };
      queueFn.flush = function() {
        if (queue.length === 0) return false;

        for (var i = 0; i < queue.length; i++) {
          queue[i]();
        }
        queue = [];

        return true;
      };
      return queueFn;
    });

    $provide.decorator('$animate', ['$delegate', '$timeout', '$browser', '$$rAF',
                                    '$$forceReflow', '$$animateAsyncRun', '$rootScope',
                            function($delegate,   $timeout,   $browser,   $$rAF,
                                     $$forceReflow,   $$animateAsyncRun,  $rootScope) {
      var animate = {
        queue: [],
        cancel: $delegate.cancel,
        on: $delegate.on,
        off: $delegate.off,
        pin: $delegate.pin,
        get reflows() {
          return $$forceReflow.totalReflows;
        },
        enabled: $delegate.enabled,
        flush: function() {
          $rootScope.$digest();

          var doNextRun, somethingFlushed = false;
          do {
            doNextRun = false;

            if ($$rAF.queue.length) {
              $$rAF.flush();
              doNextRun = somethingFlushed = true;
            }

            if ($$animateAsyncRun.flush()) {
              doNextRun = somethingFlushed = true;
            }
          } while (doNextRun);

          if (!somethingFlushed) {
            throw new Error('No pending animations ready to be closed or flushed');
          }

          $rootScope.$digest();
        }
      };

      angular.forEach(
        ['animate','enter','leave','move','addClass','removeClass','setClass'], function(method) {
        animate[method] = function() {
          animate.queue.push({
            event: method,
            element: arguments[0],
            options: arguments[arguments.length - 1],
            args: arguments
          });
          return $delegate[method].apply($delegate, arguments);
        };
      });

      return animate;
    }]);

  }]);


/**
 * @ngdoc function
 * @name angular.mock.dump
 * @description
 *
 * *NOTE*: this is not an injectable instance, just a globally available function.
 *
 * Method for serializing common angular objects (scope, elements, etc..) into strings, useful for
 * debugging.
 *
 * This method is also available on window, where it can be used to display objects on debug
 * console.
 *
 * @param {*} object - any object to turn into string.
 * @return {string} a serialized string of the argument
 */
angular.mock.dump = function(object) {
  return serialize(object);

  function serialize(object) {
    var out;

    if (angular.isElement(object)) {
      object = angular.element(object);
      out = angular.element('<div></div>');
      angular.forEach(object, function(element) {
        out.append(angular.element(element).clone());
      });
      out = out.html();
    } else if (angular.isArray(object)) {
      out = [];
      angular.forEach(object, function(o) {
        out.push(serialize(o));
      });
      out = '[ ' + out.join(', ') + ' ]';
    } else if (angular.isObject(object)) {
      if (angular.isFunction(object.$eval) && angular.isFunction(object.$apply)) {
        out = serializeScope(object);
      } else if (object instanceof Error) {
        out = object.stack || ('' + object.name + ': ' + object.message);
      } else {
        // TODO(i): this prevents methods being logged,
        // we should have a better way to serialize objects
        out = angular.toJson(object, true);
      }
    } else {
      out = String(object);
    }

    return out;
  }

  function serializeScope(scope, offset) {
    offset = offset ||  '  ';
    var log = [offset + 'Scope(' + scope.$id + '): {'];
    for (var key in scope) {
      if (Object.prototype.hasOwnProperty.call(scope, key) && !key.match(/^(\$|this)/)) {
        log.push('  ' + key + ': ' + angular.toJson(scope[key]));
      }
    }
    var child = scope.$$childHead;
    while (child) {
      log.push(serializeScope(child, offset + '  '));
      child = child.$$nextSibling;
    }
    log.push('}');
    return log.join('\n' + offset);
  }
};

/**
 * @ngdoc service
 * @name $httpBackend
 * @description
 * Fake HTTP backend implementation suitable for unit testing applications that use the
 * {@link ng.$http $http service}.
 *
 * *Note*: For fake HTTP backend implementation suitable for end-to-end testing or backend-less
 * development please see {@link ngMockE2E.$httpBackend e2e $httpBackend mock}.
 *
 * During unit testing, we want our unit tests to run quickly and have no external dependencies so
 * we don’t want to send [XHR](https://developer.mozilla.org/en/xmlhttprequest) or
 * [JSONP](http://en.wikipedia.org/wiki/JSONP) requests to a real server. All we really need is
 * to verify whether a certain request has been sent or not, or alternatively just let the
 * application make requests, respond with pre-trained responses and assert that the end result is
 * what we expect it to be.
 *
 * This mock implementation can be used to respond with static or dynamic responses via the
 * `expect` and `when` apis and their shortcuts (`expectGET`, `whenPOST`, etc).
 *
 * When an Angular application needs some data from a server, it calls the $http service, which
 * sends the request to a real server using $httpBackend service. With dependency injection, it is
 * easy to inject $httpBackend mock (which has the same API as $httpBackend) and use it to verify
 * the requests and respond with some testing data without sending a request to a real server.
 *
 * There are two ways to specify what test data should be returned as http responses by the mock
 * backend when the code under test makes http requests:
 *
 * - `$httpBackend.expect` - specifies a request expectation
 * - `$httpBackend.when` - specifies a backend definition
 *
 *
 * # Request Expectations vs Backend Definitions
 *
 * Request expectations provide a way to make assertions about requests made by the application and
 * to define responses for those requests. The test will fail if the expected requests are not made
 * or they are made in the wrong order.
 *
 * Backend definitions allow you to define a fake backend for your application which doesn't assert
 * if a particular request was made or not, it just returns a trained response if a request is made.
 * The test will pass whether or not the request gets made during testing.
 *
 *
 * <table class="table">
 *   <tr><th width="220px"></th><th>Request expectations</th><th>Backend definitions</th></tr>
 *   <tr>
 *     <th>Syntax</th>
 *     <td>.expect(...).respond(...)</td>
 *     <td>.when(...).respond(...)</td>
 *   </tr>
 *   <tr>
 *     <th>Typical usage</th>
 *     <td>strict unit tests</td>
 *     <td>loose (black-box) unit testing</td>
 *   </tr>
 *   <tr>
 *     <th>Fulfills multiple requests</th>
 *     <td>NO</td>
 *     <td>YES</td>
 *   </tr>
 *   <tr>
 *     <th>Order of requests matters</th>
 *     <td>YES</td>
 *     <td>NO</td>
 *   </tr>
 *   <tr>
 *     <th>Request required</th>
 *     <td>YES</td>
 *     <td>NO</td>
 *   </tr>
 *   <tr>
 *     <th>Response required</th>
 *     <td>optional (see below)</td>
 *     <td>YES</td>
 *   </tr>
 * </table>
 *
 * In cases where both backend definitions and request expectations are specified during unit
 * testing, the request expectations are evaluated first.
 *
 * If a request expectation has no response specified, the algorithm will search your backend
 * definitions for an appropriate response.
 *
 * If a request didn't match any expectation or if the expectation doesn't have the response
 * defined, the backend definitions are evaluated in sequential order to see if any of them match
 * the request. The response from the first matched definition is returned.
 *
 *
 * # Flushing HTTP requests
 *
 * The $httpBackend used in production always responds to requests asynchronously. If we preserved
 * this behavior in unit testing, we'd have to create async unit tests, which are hard to write,
 * to follow and to maintain. But neither can the testing mock respond synchronously; that would
 * change the execution of the code under test. For this reason, the mock $httpBackend has a
 * `flush()` method, which allows the test to explicitly flush pending requests. This preserves
 * the async api of the backend, while allowing the test to execute synchronously.
 *
 *
 * # Unit testing with mock $httpBackend
 * The following code shows how to setup and use the mock backend when unit testing a controller.
 * First we create the controller under test:
 *
  ```js
  // The module code
  angular
    .module('MyApp', [])
    .controller('MyController', MyController);

  // The controller code
  function MyController($scope, $http) {
    var authToken;

    $http.get('/auth.py').success(function(data, status, headers) {
      authToken = headers('A-Token');
      $scope.user = data;
    });

    $scope.saveMessage = function(message) {
      var headers = { 'Authorization': authToken };
      $scope.status = 'Saving...';

      $http.post('/add-msg.py', message, { headers: headers } ).success(function(response) {
        $scope.status = '';
      }).error(function() {
        $scope.status = 'Failed...';
      });
    };
  }
  ```
 *
 * Now we setup the mock backend and create the test specs:
 *
  ```js
    // testing controller
    describe('MyController', function() {
       var $httpBackend, $rootScope, createController, authRequestHandler;

       // Set up the module
       beforeEach(module('MyApp'));

       beforeEach(inject(function($injector) {
         // Set up the mock http service responses
         $httpBackend = $injector.get('$httpBackend');
         // backend definition common for all tests
         authRequestHandler = $httpBackend.when('GET', '/auth.py')
                                .respond({userId: 'userX'}, {'A-Token': 'xxx'});

         // Get hold of a scope (i.e. the root scope)
         $rootScope = $injector.get('$rootScope');
         // The $controller service is used to create instances of controllers
         var $controller = $injector.get('$controller');

         createController = function() {
           return $controller('MyController', {'$scope' : $rootScope });
         };
       }));


       afterEach(function() {
         $httpBackend.verifyNoOutstandingExpectation();
         $httpBackend.verifyNoOutstandingRequest();
       });


       it('should fetch authentication token', function() {
         $httpBackend.expectGET('/auth.py');
         var controller = createController();
         $httpBackend.flush();
       });


       it('should fail authentication', function() {

         // Notice how you can change the response even after it was set
         authRequestHandler.respond(401, '');

         $httpBackend.expectGET('/auth.py');
         var controller = createController();
         $httpBackend.flush();
         expect($rootScope.status).toBe('Failed...');
       });


       it('should send msg to server', function() {
         var controller = createController();
         $httpBackend.flush();

         // now you don’t care about the authentication, but
         // the controller will still send the request and
         // $httpBackend will respond without you having to
         // specify the expectation and response for this request

         $httpBackend.expectPOST('/add-msg.py', 'message content').respond(201, '');
         $rootScope.saveMessage('message content');
         expect($rootScope.status).toBe('Saving...');
         $httpBackend.flush();
         expect($rootScope.status).toBe('');
       });


       it('should send auth header', function() {
         var controller = createController();
         $httpBackend.flush();

         $httpBackend.expectPOST('/add-msg.py', undefined, function(headers) {
           // check if the header was sent, if it wasn't the expectation won't
           // match the request and the test will fail
           return headers['Authorization'] == 'xxx';
         }).respond(201, '');

         $rootScope.saveMessage('whatever');
         $httpBackend.flush();
       });
    });
   ```
 */
angular.mock.$HttpBackendProvider = function() {
  this.$get = ['$rootScope', '$timeout', createHttpBackendMock];
};

/**
 * General factory function for $httpBackend mock.
 * Returns instance for unit testing (when no arguments specified):
 *   - passing through is disabled
 *   - auto flushing is disabled
 *
 * Returns instance for e2e testing (when `$delegate` and `$browser` specified):
 *   - passing through (delegating request to real backend) is enabled
 *   - auto flushing is enabled
 *
 * @param {Object=} $delegate Real $httpBackend instance (allow passing through if specified)
 * @param {Object=} $browser Auto-flushing enabled if specified
 * @return {Object} Instance of $httpBackend mock
 */
function createHttpBackendMock($rootScope, $timeout, $delegate, $browser) {
  var definitions = [],
      expectations = [],
      responses = [],
      responsesPush = angular.bind(responses, responses.push),
      copy = angular.copy;

  function createResponse(status, data, headers, statusText) {
    if (angular.isFunction(status)) return status;

    return function() {
      return angular.isNumber(status)
          ? [status, data, headers, statusText]
          : [200, status, data, headers];
    };
  }

  // TODO(vojta): change params to: method, url, data, headers, callback
  function $httpBackend(method, url, data, callback, headers, timeout, withCredentials) {
    var xhr = new MockXhr(),
        expectation = expectations[0],
        wasExpected = false;

    function prettyPrint(data) {
      return (angular.isString(data) || angular.isFunction(data) || data instanceof RegExp)
          ? data
          : angular.toJson(data);
    }

    function wrapResponse(wrapped) {
      if (!$browser && timeout) {
        timeout.then ? timeout.then(handleTimeout) : $timeout(handleTimeout, timeout);
      }

      return handleResponse;

      function handleResponse() {
        var response = wrapped.response(method, url, data, headers);
        xhr.$$respHeaders = response[2];
        callback(copy(response[0]), copy(response[1]), xhr.getAllResponseHeaders(),
                 copy(response[3] || ''));
      }

      function handleTimeout() {
        for (var i = 0, ii = responses.length; i < ii; i++) {
          if (responses[i] === handleResponse) {
            responses.splice(i, 1);
            callback(-1, undefined, '');
            break;
          }
        }
      }
    }

    if (expectation && expectation.match(method, url)) {
      if (!expectation.matchData(data)) {
        throw new Error('Expected ' + expectation + ' with different data\n' +
            'EXPECTED: ' + prettyPrint(expectation.data) + '\nGOT:      ' + data);
      }

      if (!expectation.matchHeaders(headers)) {
        throw new Error('Expected ' + expectation + ' with different headers\n' +
                        'EXPECTED: ' + prettyPrint(expectation.headers) + '\nGOT:      ' +
                        prettyPrint(headers));
      }

      expectations.shift();

      if (expectation.response) {
        responses.push(wrapResponse(expectation));
        return;
      }
      wasExpected = true;
    }

    var i = -1, definition;
    while ((definition = definitions[++i])) {
      if (definition.match(method, url, data, headers || {})) {
        if (definition.response) {
          // if $browser specified, we do auto flush all requests
          ($browser ? $browser.defer : responsesPush)(wrapResponse(definition));
        } else if (definition.passThrough) {
          $delegate(method, url, data, callback, headers, timeout, withCredentials);
        } else throw new Error('No response defined !');
        return;
      }
    }
    throw wasExpected ?
        new Error('No response defined !') :
        new Error('Unexpected request: ' + method + ' ' + url + '\n' +
                  (expectation ? 'Expected ' + expectation : 'No more request expected'));
  }

  /**
   * @ngdoc method
   * @name $httpBackend#when
   * @description
   * Creates a new backend definition.
   *
   * @param {string} method HTTP method.
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string))=} data HTTP request body or function that receives
   *   data string and returns true if the data is as expected.
   * @param {(Object|function(Object))=} headers HTTP headers or function that receives http header
   *   object and returns true if the headers match the current definition.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   *
   *  - respond –
   *      `{function([status,] data[, headers, statusText])
   *      | function(function(method, url, data, headers)}`
   *    – The respond method takes a set of static data to be returned or a function that can
   *    return an array containing response status (number), response data (string), response
   *    headers (Object), and the text for the status (string). The respond method returns the
   *    `requestHandler` object for possible overrides.
   */
  $httpBackend.when = function(method, url, data, headers) {
    var definition = new MockHttpExpectation(method, url, data, headers),
        chain = {
          respond: function(status, data, headers, statusText) {
            definition.passThrough = undefined;
            definition.response = createResponse(status, data, headers, statusText);
            return chain;
          }
        };

    if ($browser) {
      chain.passThrough = function() {
        definition.response = undefined;
        definition.passThrough = true;
        return chain;
      };
    }

    definitions.push(definition);
    return chain;
  };

  /**
   * @ngdoc method
   * @name $httpBackend#whenGET
   * @description
   * Creates a new backend definition for GET requests. For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(Object|function(Object))=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#whenHEAD
   * @description
   * Creates a new backend definition for HEAD requests. For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(Object|function(Object))=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#whenDELETE
   * @description
   * Creates a new backend definition for DELETE requests. For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(Object|function(Object))=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#whenPOST
   * @description
   * Creates a new backend definition for POST requests. For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string))=} data HTTP request body or function that receives
   *   data string and returns true if the data is as expected.
   * @param {(Object|function(Object))=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#whenPUT
   * @description
   * Creates a new backend definition for PUT requests.  For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string))=} data HTTP request body or function that receives
   *   data string and returns true if the data is as expected.
   * @param {(Object|function(Object))=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#whenJSONP
   * @description
   * Creates a new backend definition for JSONP requests. For more info see `when()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled.
   */
  createShortMethods('when');


  /**
   * @ngdoc method
   * @name $httpBackend#expect
   * @description
   * Creates a new request expectation.
   *
   * @param {string} method HTTP method.
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string)|Object)=} data HTTP request body or function that
   *  receives data string and returns true if the data is as expected, or Object if request body
   *  is in JSON format.
   * @param {(Object|function(Object))=} headers HTTP headers or function that receives http header
   *   object and returns true if the headers match the current expectation.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *  request is handled. You can save this object for later use and invoke `respond` again in
   *  order to change how a matched request is handled.
   *
   *  - respond –
   *    `{function([status,] data[, headers, statusText])
   *    | function(function(method, url, data, headers)}`
   *    – The respond method takes a set of static data to be returned or a function that can
   *    return an array containing response status (number), response data (string), response
   *    headers (Object), and the text for the status (string). The respond method returns the
   *    `requestHandler` object for possible overrides.
   */
  $httpBackend.expect = function(method, url, data, headers) {
    var expectation = new MockHttpExpectation(method, url, data, headers),
        chain = {
          respond: function(status, data, headers, statusText) {
            expectation.response = createResponse(status, data, headers, statusText);
            return chain;
          }
        };

    expectations.push(expectation);
    return chain;
  };


  /**
   * @ngdoc method
   * @name $httpBackend#expectGET
   * @description
   * Creates a new request expectation for GET requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   * request is handled. You can save this object for later use and invoke `respond` again in
   * order to change how a matched request is handled. See #expect for more info.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectHEAD
   * @description
   * Creates a new request expectation for HEAD requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectDELETE
   * @description
   * Creates a new request expectation for DELETE requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectPOST
   * @description
   * Creates a new request expectation for POST requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string)|Object)=} data HTTP request body or function that
   *  receives data string and returns true if the data is as expected, or Object if request body
   *  is in JSON format.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectPUT
   * @description
   * Creates a new request expectation for PUT requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string)|Object)=} data HTTP request body or function that
   *  receives data string and returns true if the data is as expected, or Object if request body
   *  is in JSON format.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectPATCH
   * @description
   * Creates a new request expectation for PATCH requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
   *   and returns true if the url matches the current definition.
   * @param {(string|RegExp|function(string)|Object)=} data HTTP request body or function that
   *  receives data string and returns true if the data is as expected, or Object if request body
   *  is in JSON format.
   * @param {Object=} headers HTTP headers.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */

  /**
   * @ngdoc method
   * @name $httpBackend#expectJSONP
   * @description
   * Creates a new request expectation for JSONP requests. For more info see `expect()`.
   *
   * @param {string|RegExp|function(string)} url HTTP url or function that receives an url
   *   and returns true if the url matches the current definition.
   * @returns {requestHandler} Returns an object with `respond` method that controls how a matched
   *   request is handled. You can save this object for later use and invoke `respond` again in
   *   order to change how a matched request is handled.
   */
  createShortMethods('expect');


  /**
   * @ngdoc method
   * @name $httpBackend#flush
   * @description
   * Flushes all pending requests using the trained responses.
   *
   * @param {number=} count Number of responses to flush (in the order they arrived). If undefined,
   *   all pending requests will be flushed. If there are no pending requests when the flush method
   *   is called an exception is thrown (as this typically a sign of programming error).
   */
  $httpBackend.flush = function(count, digest) {
    if (digest !== false) $rootScope.$digest();
    if (!responses.length) throw new Error('No pending request to flush !');

    if (angular.isDefined(count) && count !== null) {
      while (count--) {
        if (!responses.length) throw new Error('No more pending request to flush !');
        responses.shift()();
      }
    } else {
      while (responses.length) {
        responses.shift()();
      }
    }
    $httpBackend.verifyNoOutstandingExpectation(digest);
  };


  /**
   * @ngdoc method
   * @name $httpBackend#verifyNoOutstandingExpectation
   * @description
   * Verifies that all of the requests defined via the `expect` api were made. If any of the
   * requests were not made, verifyNoOutstandingExpectation throws an exception.
   *
   * Typically, you would call this method following each test case that asserts requests using an
   * "afterEach" clause.
   *
   * ```js
   *   afterEach($httpBackend.verifyNoOutstandingExpectation);
   * ```
   */
  $httpBackend.verifyNoOutstandingExpectation = function(digest) {
    if (digest !== false) $rootScope.$digest();
    if (expectations.length) {
      throw new Error('Unsatisfied requests: ' + expectations.join(', '));
    }
  };


  /**
   * @ngdoc method
   * @name $httpBackend#verifyNoOutstandingRequest
   * @description
   * Verifies that there are no outstanding requests that need to be flushed.
   *
   * Typically, you would call this method following each test case that asserts requests using an
   * "afterEach" clause.
   *
   * ```js
   *   afterEach($httpBackend.verifyNoOutstandingRequest);
   * ```
   */
  $httpBackend.verifyNoOutstandingRequest = function() {
    if (responses.length) {
      throw new Error('Unflushed requests: ' + responses.length);
    }
  };


  /**
   * @ngdoc method
   * @name $httpBackend#resetExpectations
   * @description
   * Resets all request expectations, but preserves all backend definitions. Typically, you would
   * call resetExpectations during a multiple-phase test when you want to reuse the same instance of
   * $httpBackend mock.
   */
  $httpBackend.resetExpectations = function() {
    expectations.length = 0;
    responses.length = 0;
  };

  return $httpBackend;


  function createShortMethods(prefix) {
    angular.forEach(['GET', 'DELETE', 'JSONP', 'HEAD'], function(method) {
     $httpBackend[prefix + method] = function(url, headers) {
       return $httpBackend[prefix](method, url, undefined, headers);
     };
    });

    angular.forEach(['PUT', 'POST', 'PATCH'], function(method) {
      $httpBackend[prefix + method] = function(url, data, headers) {
        return $httpBackend[prefix](method, url, data, headers);
      };
    });
  }
}

function MockHttpExpectation(method, url, data, headers) {

  this.data = data;
  this.headers = headers;

  this.match = function(m, u, d, h) {
    if (method != m) return false;
    if (!this.matchUrl(u)) return false;
    if (angular.isDefined(d) && !this.matchData(d)) return false;
    if (angular.isDefined(h) && !this.matchHeaders(h)) return false;
    return true;
  };

  this.matchUrl = function(u) {
    if (!url) return true;
    if (angular.isFunction(url.test)) return url.test(u);
    if (angular.isFunction(url)) return url(u);
    return url == u;
  };

  this.matchHeaders = function(h) {
    if (angular.isUndefined(headers)) return true;
    if (angular.isFunction(headers)) return headers(h);
    return angular.equals(headers, h);
  };

  this.matchData = function(d) {
    if (angular.isUndefined(data)) return true;
    if (data && angular.isFunction(data.test)) return data.test(d);
    if (data && angular.isFunction(data)) return data(d);
    if (data && !angular.isString(data)) {
      return angular.equals(angular.fromJson(angular.toJson(data)), angular.fromJson(d));
    }
    return data == d;
  };

  this.toString = function() {
    return method + ' ' + url;
  };
}

function createMockXhr() {
  return new MockXhr();
}

function MockXhr() {

  // hack for testing $http, $httpBackend
  MockXhr.$$lastInstance = this;

  this.open = function(method, url, async) {
    this.$$method = method;
    this.$$url = url;
    this.$$async = async;
    this.$$reqHeaders = {};
    this.$$respHeaders = {};
  };

  this.send = function(data) {
    this.$$data = data;
  };

  this.setRequestHeader = function(key, value) {
    this.$$reqHeaders[key] = value;
  };

  this.getResponseHeader = function(name) {
    // the lookup must be case insensitive,
    // that's why we try two quick lookups first and full scan last
    var header = this.$$respHeaders[name];
    if (header) return header;

    name = angular.lowercase(name);
    header = this.$$respHeaders[name];
    if (header) return header;

    header = undefined;
    angular.forEach(this.$$respHeaders, function(headerVal, headerName) {
      if (!header && angular.lowercase(headerName) == name) header = headerVal;
    });
    return header;
  };

  this.getAllResponseHeaders = function() {
    var lines = [];

    angular.forEach(this.$$respHeaders, function(value, key) {
      lines.push(key + ': ' + value);
    });
    return lines.join('\n');
  };

  this.abort = angular.noop;
}


/**
 * @ngdoc service
 * @name $timeout
 * @description
 *
 * This service is just a simple decorator for {@link ng.$timeout $timeout} service
 * that adds a "flush" and "verifyNoPendingTasks" methods.
 */

angular.mock.$TimeoutDecorator = ['$delegate', '$browser', function($delegate, $browser) {

  /**
   * @ngdoc method
   * @name $timeout#flush
   * @description
   *
   * Flushes the queue of pending tasks.
   *
   * @param {number=} delay maximum timeout amount to flush up until
   */
  $delegate.flush = function(delay) {
    $browser.defer.flush(delay);
  };

  /**
   * @ngdoc method
   * @name $timeout#verifyNoPendingTasks
   * @description
   *
   * Verifies that there are no pending tasks that need to be flushed.
   */
  $delegate.verifyNoPendingTasks = function() {
    if ($browser.deferredFns.length) {
      throw new Error('Deferred tasks to flush (' + $browser.deferredFns.length + '): ' +
          formatPendingTasksAsString($browser.deferredFns));
    }
  };

  function formatPendingTasksAsString(tasks) {
    var result = [];
    angular.forEach(tasks, function(task) {
      result.push('{id: ' + task.id + ', ' + 'time: ' + task.time + '}');
    });

    return result.join(', ');
  }

  return $delegate;
}];

angular.mock.$RAFDecorator = ['$delegate', function($delegate) {
  var rafFn = function(fn) {
    var index = rafFn.queue.length;
    rafFn.queue.push(fn);
    return function() {
      rafFn.queue.splice(index, 1);
    };
  };

  rafFn.queue = [];
  rafFn.supported = $delegate.supported;

  rafFn.flush = function() {
    if (rafFn.queue.length === 0) {
      throw new Error('No rAF callbacks present');
    }

    var length = rafFn.queue.length;
    for (var i = 0; i < length; i++) {
      rafFn.queue[i]();
    }

    rafFn.queue = rafFn.queue.slice(i);
  };

  return rafFn;
}];

/**
 *
 */
angular.mock.$RootElementProvider = function() {
  this.$get = function() {
    return angular.element('<div ng-app></div>');
  };
};

/**
 * @ngdoc service
 * @name $controller
 * @description
 * A decorator for {@link ng.$controller} with additional `bindings` parameter, useful when testing
 * controllers of directives that use {@link $compile#-bindtocontroller- `bindToController`}.
 *
 *
 * ## Example
 *
 * ```js
 *
 * // Directive definition ...
 *
 * myMod.directive('myDirective', {
 *   controller: 'MyDirectiveController',
 *   bindToController: {
 *     name: '@'
 *   }
 * });
 *
 *
 * // Controller definition ...
 *
 * myMod.controller('MyDirectiveController', ['log', function($log) {
 *   $log.info(this.name);
 * })];
 *
 *
 * // In a test ...
 *
 * describe('myDirectiveController', function() {
 *   it('should write the bound name to the log', inject(function($controller, $log) {
 *     var ctrl = $controller('MyDirectiveController', { /* no locals &#42;/ }, { name: 'Clark Kent' });
 *     expect(ctrl.name).toEqual('Clark Kent');
 *     expect($log.info.logs).toEqual(['Clark Kent']);
 *   });
 * });
 *
 * ```
 *
 * @param {Function|string} constructor If called with a function then it's considered to be the
 *    controller constructor function. Otherwise it's considered to be a string which is used
 *    to retrieve the controller constructor using the following steps:
 *
 *    * check if a controller with given name is registered via `$controllerProvider`
 *    * check if evaluating the string on the current scope returns a constructor
 *    * if $controllerProvider#allowGlobals, check `window[constructor]` on the global
 *      `window` object (not recommended)
 *
 *    The string can use the `controller as property` syntax, where the controller instance is published
 *    as the specified property on the `scope`; the `scope` must be injected into `locals` param for this
 *    to work correctly.
 *
 * @param {Object} locals Injection locals for Controller.
 * @param {Object=} bindings Properties to add to the controller before invoking the constructor. This is used
 *                           to simulate the `bindToController` feature and simplify certain kinds of tests.
 * @return {Object} Instance of given controller.
 */
angular.mock.$ControllerDecorator = ['$delegate', function($delegate) {
  return function(expression, locals, later, ident) {
    if (later && typeof later === 'object') {
      var create = $delegate(expression, locals, true, ident);
      angular.extend(create.instance, later);
      return create();
    }
    return $delegate(expression, locals, later, ident);
  };
}];


/**
 * @ngdoc module
 * @name ngMock
 * @packageName angular-mocks
 * @description
 *
 * # ngMock
 *
 * The `ngMock` module provides support to inject and mock Angular services into unit tests.
 * In addition, ngMock also extends various core ng services such that they can be
 * inspected and controlled in a synchronous manner within test code.
 *
 *
 * <div doc-module-components="ngMock"></div>
 *
 */
angular.module('ngMock', ['ng']).provider({
  $browser: angular.mock.$BrowserProvider,
  $exceptionHandler: angular.mock.$ExceptionHandlerProvider,
  $log: angular.mock.$LogProvider,
  $interval: angular.mock.$IntervalProvider,
  $httpBackend: angular.mock.$HttpBackendProvider,
  $rootElement: angular.mock.$RootElementProvider
}).config(['$provide', function($provide) {
  $provide.decorator('$timeout', angular.mock.$TimeoutDecorator);
  $provide.decorator('$$rAF', angular.mock.$RAFDecorator);
  $provide.decorator('$rootScope', angular.mock.$RootScopeDecorator);
  $provide.decorator('$controller', angular.mock.$ControllerDecorator);
}]);

/**
 * @ngdoc module
 * @name ngMockE2E
 * @module ngMockE2E
 * @packageName angular-mocks
 * @description
 *
 * The `ngMockE2E` is an angular module which contains mocks suitable for end-to-end testing.
 * Currently there is only one mock present in this module -
 * the {@link ngMockE2E.$httpBackend e2e $httpBackend} mock.
 */
angular.module('ngMockE2E', ['ng']).config(['$provide', function($provide) {
  $provide.decorator('$httpBackend', angular.mock.e2e.$httpBackendDecorator);
}]);

/**
 * @ngdoc service
 * @name $httpBackend
 * @module ngMockE2E
 * @description
 * Fake HTTP backend implementation suitable for end-to-end testing or backend-less development of
 * applications that use the {@link ng.$http $http service}.
 *
 * *Note*: For fake http backend implementation suitable for unit testing please see
 * {@link ngMock.$httpBackend unit-testing $httpBackend mock}.
 *
 * This implementation can be used to respond with static or dynamic responses via the `when` api
 * and its shortcuts (`whenGET`, `whenPOST`, etc) and optionally pass through requests to the
 * real $httpBackend for specific requests (e.g. to interact with certain remote apis or to fetch
 * templates from a webserver).
 *
 * As opposed to unit-testing, in an end-to-end testing scenario or in scenario when an application
 * is being developed with the real backend api replaced with a mock, it is often desirable for
 * certain category of requests to bypass the mock and issue a real http request (e.g. to fetch
 * templates or static files from the webserver). To configure the backend with this behavior
 * use the `passThrough` request handler of `when` instead of `respond`.
 *
 * Additionally, we don't want to manually have to flush mocked out requests like we do during unit
 * testing. For this reason the e2e $httpBackend flushes mocked out requests
 * automatically, closely simulating the behavior of the XMLHttpRequest object.
 *
 * To setup the application to run with this http backend, you have to create a module that depends
 * on the `ngMockE2E` and your application modules and defines the fake backend:
 *
 * ```js
 *   myAppDev = angular.module('myAppDev', ['myApp', 'ngMockE2E']);
 *   myAppDev.run(function($httpBackend) {
 *     phones = [{name: 'phone1'}, {name: 'phone2'}];
 *
 *     // returns the current list of phones
 *     $httpBackend.whenGET('/phones').respond(phones);
 *
 *     // adds a new phone to the phones array
 *     $httpBackend.whenPOST('/phones').respond(function(method, url, data) {
 *       var phone = angular.fromJson(data);
 *       phones.push(phone);
 *       return [200, phone, {}];
 *     });
 *     $httpBackend.whenGET(/^\/templates\//).passThrough();
 *     //...
 *   });
 * ```
 *
 * Afterwards, bootstrap your app with this new module.
 */

/**
 * @ngdoc method
 * @name $httpBackend#when
 * @module ngMockE2E
 * @description
 * Creates a new backend definition.
 *
 * @param {string} method HTTP method.
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(string|RegExp)=} data HTTP request body.
 * @param {(Object|function(Object))=} headers HTTP headers or function that receives http header
 *   object and returns true if the headers match the current definition.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 *
 *  - respond –
 *    `{function([status,] data[, headers, statusText])
 *    | function(function(method, url, data, headers)}`
 *    – The respond method takes a set of static data to be returned or a function that can return
 *    an array containing response status (number), response data (string), response headers
 *    (Object), and the text for the status (string).
 *  - passThrough – `{function()}` – Any request matching a backend definition with
 *    `passThrough` handler will be passed through to the real backend (an XHR request will be made
 *    to the server.)
 *  - Both methods return the `requestHandler` object for possible overrides.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenGET
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for GET requests. For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenHEAD
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for HEAD requests. For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenDELETE
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for DELETE requests. For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenPOST
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for POST requests. For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(string|RegExp)=} data HTTP request body.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenPUT
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for PUT requests.  For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(string|RegExp)=} data HTTP request body.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenPATCH
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for PATCH requests.  For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @param {(string|RegExp)=} data HTTP request body.
 * @param {(Object|function(Object))=} headers HTTP headers.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */

/**
 * @ngdoc method
 * @name $httpBackend#whenJSONP
 * @module ngMockE2E
 * @description
 * Creates a new backend definition for JSONP requests. For more info see `when()`.
 *
 * @param {string|RegExp|function(string)} url HTTP url or function that receives a url
 *   and returns true if the url matches the current definition.
 * @returns {requestHandler} Returns an object with `respond` and `passThrough` methods that
 *   control how a matched request is handled. You can save this object for later use and invoke
 *   `respond` or `passThrough` again in order to change how a matched request is handled.
 */
angular.mock.e2e = {};
angular.mock.e2e.$httpBackendDecorator =
  ['$rootScope', '$timeout', '$delegate', '$browser', createHttpBackendMock];


/**
 * @ngdoc type
 * @name $rootScope.Scope
 * @module ngMock
 * @description
 * {@link ng.$rootScope.Scope Scope} type decorated with helper methods useful for testing. These
 * methods are automatically available on any {@link ng.$rootScope.Scope Scope} instance when
 * `ngMock` module is loaded.
 *
 * In addition to all the regular `Scope` methods, the following helper methods are available:
 */
angular.mock.$RootScopeDecorator = ['$delegate', function($delegate) {

  var $rootScopePrototype = Object.getPrototypeOf($delegate);

  $rootScopePrototype.$countChildScopes = countChildScopes;
  $rootScopePrototype.$countWatchers = countWatchers;

  return $delegate;

  // ------------------------------------------------------------------------------------------ //

  /**
   * @ngdoc method
   * @name $rootScope.Scope#$countChildScopes
   * @module ngMock
   * @description
   * Counts all the direct and indirect child scopes of the current scope.
   *
   * The current scope is excluded from the count. The count includes all isolate child scopes.
   *
   * @returns {number} Total number of child scopes.
   */
  function countChildScopes() {
    // jshint validthis: true
    var count = 0; // exclude the current scope
    var pendingChildHeads = [this.$$childHead];
    var currentScope;

    while (pendingChildHeads.length) {
      currentScope = pendingChildHeads.shift();

      while (currentScope) {
        count += 1;
        pendingChildHeads.push(currentScope.$$childHead);
        currentScope = currentScope.$$nextSibling;
      }
    }

    return count;
  }


  /**
   * @ngdoc method
   * @name $rootScope.Scope#$countWatchers
   * @module ngMock
   * @description
   * Counts all the watchers of direct and indirect child scopes of the current scope.
   *
   * The watchers of the current scope are included in the count and so are all the watchers of
   * isolate child scopes.
   *
   * @returns {number} Total number of watchers.
   */
  function countWatchers() {
    // jshint validthis: true
    var count = this.$$watchers ? this.$$watchers.length : 0; // include the current scope
    var pendingChildHeads = [this.$$childHead];
    var currentScope;

    while (pendingChildHeads.length) {
      currentScope = pendingChildHeads.shift();

      while (currentScope) {
        count += currentScope.$$watchers ? currentScope.$$watchers.length : 0;
        pendingChildHeads.push(currentScope.$$childHead);
        currentScope = currentScope.$$nextSibling;
      }
    }

    return count;
  }
}];


if (window.jasmine || window.mocha) {

  var currentSpec = null,
      annotatedFunctions = [],
      isSpecRunning = function() {
        return !!currentSpec;
      };

  angular.mock.$$annotate = angular.injector.$$annotate;
  angular.injector.$$annotate = function(fn) {
    if (typeof fn === 'function' && !fn.$inject) {
      annotatedFunctions.push(fn);
    }
    return angular.mock.$$annotate.apply(this, arguments);
  };


  (window.beforeEach || window.setup)(function() {
    annotatedFunctions = [];
    currentSpec = this;
  });

  (window.afterEach || window.teardown)(function() {
    var injector = currentSpec.$injector;

    annotatedFunctions.forEach(function(fn) {
      delete fn.$inject;
    });

    angular.forEach(currentSpec.$modules, function(module) {
      if (module && module.$$hashKey) {
        module.$$hashKey = undefined;
      }
    });

    currentSpec.$injector = null;
    currentSpec.$modules = null;
    currentSpec = null;

    if (injector) {
      injector.get('$rootElement').off();
    }

    // clean up jquery's fragment cache
    angular.forEach(angular.element.fragments, function(val, key) {
      delete angular.element.fragments[key];
    });

    MockXhr.$$lastInstance = null;

    angular.forEach(angular.callbacks, function(val, key) {
      delete angular.callbacks[key];
    });
    angular.callbacks.counter = 0;
  });

  /**
   * @ngdoc function
   * @name angular.mock.module
   * @description
   *
   * *NOTE*: This function is also published on window for easy access.<br>
   * *NOTE*: This function is declared ONLY WHEN running tests with jasmine or mocha
   *
   * This function registers a module configuration code. It collects the configuration information
   * which will be used when the injector is created by {@link angular.mock.inject inject}.
   *
   * See {@link angular.mock.inject inject} for usage example
   *
   * @param {...(string|Function|Object)} fns any number of modules which are represented as string
   *        aliases or as anonymous module initialization functions. The modules are used to
   *        configure the injector. The 'ng' and 'ngMock' modules are automatically loaded. If an
   *        object literal is passed they will be registered as values in the module, the key being
   *        the module name and the value being what is returned.
   */
  window.module = angular.mock.module = function() {
    var moduleFns = Array.prototype.slice.call(arguments, 0);
    return isSpecRunning() ? workFn() : workFn;
    /////////////////////
    function workFn() {
      if (currentSpec.$injector) {
        throw new Error('Injector already created, can not register a module!');
      } else {
        var modules = currentSpec.$modules || (currentSpec.$modules = []);
        angular.forEach(moduleFns, function(module) {
          if (angular.isObject(module) && !angular.isArray(module)) {
            modules.push(function($provide) {
              angular.forEach(module, function(value, key) {
                $provide.value(key, value);
              });
            });
          } else {
            modules.push(module);
          }
        });
      }
    }
  };

  /**
   * @ngdoc function
   * @name angular.mock.inject
   * @description
   *
   * *NOTE*: This function is also published on window for easy access.<br>
   * *NOTE*: This function is declared ONLY WHEN running tests with jasmine or mocha
   *
   * The inject function wraps a function into an injectable function. The inject() creates new
   * instance of {@link auto.$injector $injector} per test, which is then used for
   * resolving references.
   *
   *
   * ## Resolving References (Underscore Wrapping)
   * Often, we would like to inject a reference once, in a `beforeEach()` block and reuse this
   * in multiple `it()` clauses. To be able to do this we must assign the reference to a variable
   * that is declared in the scope of the `describe()` block. Since we would, most likely, want
   * the variable to have the same name of the reference we have a problem, since the parameter
   * to the `inject()` function would hide the outer variable.
   *
   * To help with this, the injected parameters can, optionally, be enclosed with underscores.
   * These are ignored by the injector when the reference name is resolved.
   *
   * For example, the parameter `_myService_` would be resolved as the reference `myService`.
   * Since it is available in the function body as _myService_, we can then assign it to a variable
   * defined in an outer scope.
   *
   * ```
   * // Defined out reference variable outside
   * var myService;
   *
   * // Wrap the parameter in underscores
   * beforeEach( inject( function(_myService_){
   *   myService = _myService_;
   * }));
   *
   * // Use myService in a series of tests.
   * it('makes use of myService', function() {
   *   myService.doStuff();
   * });
   *
   * ```
   *
   * See also {@link angular.mock.module angular.mock.module}
   *
   * ## Example
   * Example of what a typical jasmine tests looks like with the inject method.
   * ```js
   *
   *   angular.module('myApplicationModule', [])
   *       .value('mode', 'app')
   *       .value('version', 'v1.0.1');
   *
   *
   *   describe('MyApp', function() {
   *
   *     // You need to load modules that you want to test,
   *     // it loads only the "ng" module by default.
   *     beforeEach(module('myApplicationModule'));
   *
   *
   *     // inject() is used to inject arguments of all given functions
   *     it('should provide a version', inject(function(mode, version) {
   *       expect(version).toEqual('v1.0.1');
   *       expect(mode).toEqual('app');
   *     }));
   *
   *
   *     // The inject and module method can also be used inside of the it or beforeEach
   *     it('should override a version and test the new version is injected', function() {
   *       // module() takes functions or strings (module aliases)
   *       module(function($provide) {
   *         $provide.value('version', 'overridden'); // override version here
   *       });
   *
   *       inject(function(version) {
   *         expect(version).toEqual('overridden');
   *       });
   *     });
   *   });
   *
   * ```
   *
   * @param {...Function} fns any number of functions which will be injected using the injector.
   */



  var ErrorAddingDeclarationLocationStack = function(e, errorForStack) {
    this.message = e.message;
    this.name = e.name;
    if (e.line) this.line = e.line;
    if (e.sourceId) this.sourceId = e.sourceId;
    if (e.stack && errorForStack)
      this.stack = e.stack + '\n' + errorForStack.stack;
    if (e.stackArray) this.stackArray = e.stackArray;
  };
  ErrorAddingDeclarationLocationStack.prototype.toString = Error.prototype.toString;

  window.inject = angular.mock.inject = function() {
    var blockFns = Array.prototype.slice.call(arguments, 0);
    var errorForStack = new Error('Declaration Location');
    return isSpecRunning() ? workFn.call(currentSpec) : workFn;
    /////////////////////
    function workFn() {
      var modules = currentSpec.$modules || [];
      var strictDi = !!currentSpec.$injectorStrict;
      modules.unshift('ngMock');
      modules.unshift('ng');
      var injector = currentSpec.$injector;
      if (!injector) {
        if (strictDi) {
          // If strictDi is enabled, annotate the providerInjector blocks
          angular.forEach(modules, function(moduleFn) {
            if (typeof moduleFn === "function") {
              angular.injector.$$annotate(moduleFn);
            }
          });
        }
        injector = currentSpec.$injector = angular.injector(modules, strictDi);
        currentSpec.$injectorStrict = strictDi;
      }
      for (var i = 0, ii = blockFns.length; i < ii; i++) {
        if (currentSpec.$injectorStrict) {
          // If the injector is strict / strictDi, and the spec wants to inject using automatic
          // annotation, then annotate the function here.
          injector.annotate(blockFns[i]);
        }
        try {
          /* jshint -W040 *//* Jasmine explicitly provides a `this` object when calling functions */
          injector.invoke(blockFns[i] || angular.noop, this);
          /* jshint +W040 */
        } catch (e) {
          if (e.stack && errorForStack) {
            throw new ErrorAddingDeclarationLocationStack(e, errorForStack);
          }
          throw e;
        } finally {
          errorForStack = null;
        }
      }
    }
  };


  angular.mock.inject.strictDi = function(value) {
    value = arguments.length ? !!value : true;
    return isSpecRunning() ? workFn() : workFn;

    function workFn() {
      if (value !== currentSpec.$injectorStrict) {
        if (currentSpec.$injector) {
          throw new Error('Injector already created, can not modify strict annotations');
        } else {
          currentSpec.$injectorStrict = value;
        }
      }
    }
  };
}


})(window, window.angular);

define("angular-mocks", ["angular"], function(){});

/*
 * bootstrap-tagsinput v0.5.0 by Tim Schlechter
 * 
 */

angular.module("bootstrap-tagsinput",[]).directive("bootstrapTagsinput",[function(){function a(a,b){return b?angular.isFunction(a.$parent[b])?a.$parent[b]:function(a){return a[b]}:void 0}return{restrict:"EA",scope:{model:"=ngModel"},template:"<select multiple></select>",replace:!1,link:function(b,c,d){$(function(){angular.isArray(b.model)||(b.model=[]);var e=$("select",c),f=d.typeaheadSource?d.typeaheadSource.split("."):null,g=f?f.length>1?b.$parent[f[0]][f[1]]:b.$parent[f[0]]:null;e.tagsinput(b.$parent[d.options||""]||{typeahead:{source:angular.isFunction(g)?g:null},itemValue:a(b,d.itemvalue),itemText:a(b,d.itemtext),confirmKeys:a(b,d.confirmkeys)?JSON.parse(d.confirmkeys):[13],tagClass:angular.isFunction(b.$parent[d.tagclass])?b.$parent[d.tagclass]:function(){return d.tagclass}});for(var h=0;h<b.model.length;h++)e.tagsinput("add",b.model[h]);e.on("itemAdded",function(a){-1===b.model.indexOf(a.item)&&b.model.push(a.item)}),e.on("itemRemoved",function(a){var c=b.model.indexOf(a.item);-1!==c&&b.model.splice(c,1)});var i=b.model.slice();b.$watch("model",function(){var a,c=b.model.filter(function(a){return-1===i.indexOf(a)}),d=i.filter(function(a){return-1===b.model.indexOf(a)});for(i=b.model.slice(),a=0;a<d.length;a++)e.tagsinput("remove",d[a]);for(e.tagsinput("refresh"),a=0;a<c.length;a++)e.tagsinput("add",c[a])},!0)})}}}]);
//# sourceMappingURL=bootstrap-tagsinput.min.js.map;
define("bootstrap-taginput", ["angular","bootstrap"], function(){});

/*!
 * Jasny Bootstrap v3.1.0 (http://jasny.github.com/bootstrap)
 * Copyright 2011-2014 Arnold Daniels.
 * Licensed under Apache-2.0 (https://github.com/jasny/bootstrap/blob/master/LICENSE)
 */

+function(a){"use strict";var b=window.navigator.appName=="Microsoft Internet Explorer",c=function(b,c){this.$element=a(b),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||c.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=a('<input type="hidden">').insertBefore(this.$input)),this.$preview=this.$element.find(".fileinput-preview");var d=this.$preview.css("height");this.$preview.css("display")!=="inline"&&d!=="0px"&&d!=="none"&&this.$preview.css("line-height",d),this.original={exists:this.$element.hasClass("fileinput-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.listen()};c.prototype.listen=function(){this.$input.on("change.bs.fileinput",a.proxy(this.change,this)),a(this.$input[0].form).on("reset.bs.fileinput",a.proxy(this.reset,this)),this.$element.find('[data-trigger="fileinput"]').on("click.bs.fileinput",a.proxy(this.trigger,this)),this.$element.find('[data-dismiss="fileinput"]').on("click.bs.fileinput",a.proxy(this.clear,this))},c.prototype.change=function(b){var c=b.target.files===undefined?b.target&&b.target.value?[{name:b.target.value.replace(/^.+\\/,"")}]:[]:b.target.files;b.stopPropagation();if(c.length===0){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);var d=c[0];if(this.$preview.length>0&&(typeof d.type!="undefined"?d.type.match(/^image\/(gif|png|jpeg)$/):d.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var e=new FileReader,f=this.$preview,g=this.$element;e.onload=function(b){var e=a("<img>");e[0].src=b.target.result,c[0].result=b.target.result,g.find(".fileinput-filename").text(d.name),f.css("max-height")!="none"&&e.css("max-height",parseInt(f.css("max-height"),10)-parseInt(f.css("padding-top"),10)-parseInt(f.css("padding-bottom"),10)-parseInt(f.css("border-top"),10)-parseInt(f.css("border-bottom"),10)),f.html(e),g.addClass("fileinput-exists").removeClass("fileinput-new"),g.trigger("change.bs.fileinput",c)},e.readAsDataURL(d)}else this.$element.find(".fileinput-filename").text(d.name),this.$preview.text(d.name),this.$element.addClass("fileinput-exists").removeClass("fileinput-new"),this.$element.trigger("change.bs.fileinput")},c.prototype.clear=function(a){a&&a.preventDefault(),this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(b){var c=this.$input.clone(!0);this.$input.after(c),this.$input.remove(),this.$input=c}else this.$input.val("");this.$preview.html(""),this.$element.find(".fileinput-filename").text(""),this.$element.addClass("fileinput-new").removeClass("fileinput-exists"),a!==undefined&&(this.$input.trigger("change"),this.$element.trigger("clear.bs.fileinput"))},c.prototype.reset=function(){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.$element.find(".fileinput-filename").text(""),this.original.exists?this.$element.addClass("fileinput-exists").removeClass("fileinput-new"):this.$element.addClass("fileinput-new").removeClass("fileinput-exists"),this.$element.trigger("reset.bs.fileinput")},c.prototype.trigger=function(a){this.$input.trigger("click"),a.preventDefault()};var d=a.fn.fileinput;a.fn.fileinput=function(b){return this.each(function(){var d=a(this),e=d.data("bs.fileinput");e||d.data("bs.fileinput",e=new c(this,b)),typeof b=="string"&&e[b]()})},a.fn.fileinput.Constructor=c,a.fn.fileinput.noConflict=function(){return a.fn.fileinput=d,this},a(document).on("click.fileinput.data-api",'[data-provides="fileinput"]',function(b){var c=a(this);if(c.data("bs.fileinput"))return;c.fileinput(c.data());var d=a(b.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');d.length>0&&(b.preventDefault(),d.trigger("click.bs.fileinput"))})}(window.jQuery);
define("jasny-bootstrap-fileinput", ["bootstrap"], function(){});

/*!

Holder - client side image placeholders
Version 2.8.2+c34r9
© 2015 Ivan Malopinsky - http://imsky.co

Site:     http://holderjs.com
Issues:   https://github.com/imsky/holder/issues
License:  MIT

*/
(function (window) {
  if (!window.document) return;
  var document = window.document;

  //https://github.com/inexorabletash/polyfill/blob/master/web.js
    if (!document.querySelectorAll) {
      document.querySelectorAll = function (selectors) {
        var style = document.createElement('style'), elements = [], element;
        document.documentElement.firstChild.appendChild(style);
        document._qsa = [];

        style.styleSheet.cssText = selectors + '{x-qsa:expression(document._qsa && document._qsa.push(this))}';
        window.scrollBy(0, 0);
        style.parentNode.removeChild(style);

        while (document._qsa.length) {
          element = document._qsa.shift();
          element.style.removeAttribute('x-qsa');
          elements.push(element);
        }
        document._qsa = null;
        return elements;
      };
    }

    if (!document.querySelector) {
      document.querySelector = function (selectors) {
        var elements = document.querySelectorAll(selectors);
        return (elements.length) ? elements[0] : null;
      };
    }

    if (!document.getElementsByClassName) {
      document.getElementsByClassName = function (classNames) {
        classNames = String(classNames).replace(/^|\s+/g, '.');
        return document.querySelectorAll(classNames);
      };
    }

  //https://github.com/inexorabletash/polyfill
  // ES5 15.2.3.14 Object.keys ( O )
  // https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Object/keys
  if (!Object.keys) {
    Object.keys = function (o) {
      if (o !== Object(o)) { throw TypeError('Object.keys called on non-object'); }
      var ret = [], p;
      for (p in o) {
        if (Object.prototype.hasOwnProperty.call(o, p)) {
          ret.push(p);
        }
      }
      return ret;
    };
  }

  // ES5 15.4.4.18 Array.prototype.forEach ( callbackfn [ , thisArg ] )
  // From https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/Array/forEach
  if (!Array.prototype.forEach) {
    Array.prototype.forEach = function (fun /*, thisp */) {
      if (this === void 0 || this === null) { throw TypeError(); }

      var t = Object(this);
      var len = t.length >>> 0;
      if (typeof fun !== "function") { throw TypeError(); }

      var thisp = arguments[1], i;
      for (i = 0; i < len; i++) {
        if (i in t) {
          fun.call(thisp, t[i], i, t);
        }
      }
    };
  }

  //https://github.com/inexorabletash/polyfill/blob/master/web.js
  (function (global) {
    var B64_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
    global.atob = global.atob || function (input) {
      input = String(input);
      var position = 0,
          output = [],
          buffer = 0, bits = 0, n;

      input = input.replace(/\s/g, '');
      if ((input.length % 4) === 0) { input = input.replace(/=+$/, ''); }
      if ((input.length % 4) === 1) { throw Error('InvalidCharacterError'); }
      if (/[^+/0-9A-Za-z]/.test(input)) { throw Error('InvalidCharacterError'); }

      while (position < input.length) {
        n = B64_ALPHABET.indexOf(input.charAt(position));
        buffer = (buffer << 6) | n;
        bits += 6;

        if (bits === 24) {
          output.push(String.fromCharCode((buffer >> 16) & 0xFF));
          output.push(String.fromCharCode((buffer >>  8) & 0xFF));
          output.push(String.fromCharCode(buffer & 0xFF));
          bits = 0;
          buffer = 0;
        }
        position += 1;
      }

      if (bits === 12) {
        buffer = buffer >> 4;
        output.push(String.fromCharCode(buffer & 0xFF));
      } else if (bits === 18) {
        buffer = buffer >> 2;
        output.push(String.fromCharCode((buffer >> 8) & 0xFF));
        output.push(String.fromCharCode(buffer & 0xFF));
      }

      return output.join('');
    };

    global.btoa = global.btoa || function (input) {
      input = String(input);
      var position = 0,
          out = [],
          o1, o2, o3,
          e1, e2, e3, e4;

      if (/[^\x00-\xFF]/.test(input)) { throw Error('InvalidCharacterError'); }

      while (position < input.length) {
        o1 = input.charCodeAt(position++);
        o2 = input.charCodeAt(position++);
        o3 = input.charCodeAt(position++);

        // 111111 112222 222233 333333
        e1 = o1 >> 2;
        e2 = ((o1 & 0x3) << 4) | (o2 >> 4);
        e3 = ((o2 & 0xf) << 2) | (o3 >> 6);
        e4 = o3 & 0x3f;

        if (position === input.length + 2) {
          e3 = 64; e4 = 64;
        }
        else if (position === input.length + 1) {
          e4 = 64;
        }

        out.push(B64_ALPHABET.charAt(e1),
                 B64_ALPHABET.charAt(e2),
                 B64_ALPHABET.charAt(e3),
                 B64_ALPHABET.charAt(e4));
      }

      return out.join('');
    };
  }(window));

  //https://gist.github.com/jimeh/332357
  if (!Object.prototype.hasOwnProperty){
      /*jshint -W001, -W103 */
      Object.prototype.hasOwnProperty = function(prop) {
      var proto = this.__proto__ || this.constructor.prototype;
      return (prop in this) && (!(prop in proto) || proto[prop] !== this[prop]);
    };
      /*jshint +W001, +W103 */
  }

  // @license http://opensource.org/licenses/MIT
  // copyright Paul Irish 2015


  // Date.now() is supported everywhere except IE8. For IE8 we use the Date.now polyfill
  //   github.com/Financial-Times/polyfill-service/blob/master/polyfills/Date.now/polyfill.js
  // as Safari 6 doesn't have support for NavigationTiming, we use a Date.now() timestamp for relative values

  // if you want values similar to what you'd get with real perf.now, place this towards the head of the page
  // but in reality, you're just getting the delta between now() calls, so it's not terribly important where it's placed


  (function(){

    if ('performance' in window === false) {
        window.performance = {};
    }
    
    Date.now = (Date.now || function () {  // thanks IE8
      return new Date().getTime();
    });

    if ('now' in window.performance === false){
      
      var nowOffset = Date.now();
      
      if (performance.timing && performance.timing.navigationStart){
        nowOffset = performance.timing.navigationStart;
      }

      window.performance.now = function now(){
        return Date.now() - nowOffset;
      };
    }

  })();

  //requestAnimationFrame polyfill for older Firefox/Chrome versions
  if (!window.requestAnimationFrame) {
    if (window.webkitRequestAnimationFrame) {
    //https://github.com/Financial-Times/polyfill-service/blob/master/polyfills/requestAnimationFrame/polyfill-webkit.js
    (function (global) {
      // window.requestAnimationFrame
      global.requestAnimationFrame = function (callback) {
        return webkitRequestAnimationFrame(function () {
          callback(global.performance.now());
        });
      };

      // window.cancelAnimationFrame
      global.cancelAnimationFrame = webkitCancelAnimationFrame;
    }(window));
    } else if (window.mozRequestAnimationFrame) {
      //https://github.com/Financial-Times/polyfill-service/blob/master/polyfills/requestAnimationFrame/polyfill-moz.js
    (function (global) {
      // window.requestAnimationFrame
      global.requestAnimationFrame = function (callback) {
        return mozRequestAnimationFrame(function () {
          callback(global.performance.now());
        });
      };

      // window.cancelAnimationFrame
      global.cancelAnimationFrame = mozCancelAnimationFrame;
    }(window));
    } else {
    (function (global) {
      global.requestAnimationFrame = function (callback) {
      return global.setTimeout(callback, 1000 / 60);
      };

      global.cancelAnimationFrame = global.clearTimeout;
    })(window);
    }
  }
})(this);

(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define('holderjs',factory);
	else if(typeof exports === 'object')
		exports["Holder"] = factory();
	else
		root["Holder"] = factory();
})(this, function() {
return /******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	/*
	Holder.js - client side image placeholders
	(c) 2012-2015 Ivan Malopinsky - http://imsky.co
	*/

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {/*
	Holder.js - client side image placeholders
	(c) 2012-2015 Ivan Malopinsky - http://imsky.co
	*/

	//Libraries and functions
	var onDomReady = __webpack_require__(2);
	var querystring = __webpack_require__(3);

	var SceneGraph = __webpack_require__(4);
	var utils = __webpack_require__(5);
	var SVG = __webpack_require__(6);
	var DOM = __webpack_require__(7);
	var Color = __webpack_require__(8);
	var constants = __webpack_require__(9);

	var svgRenderer = __webpack_require__(10);

	var extend = utils.extend;
	var dimensionCheck = utils.dimensionCheck;

	//Constants and definitions
	var SVG_NS = constants.svg_ns;

	var Holder = {
	    version: constants.version,

	    /**
	     * Adds a theme to default settings
	     *
	     * @param {string} name Theme name
	     * @param {Object} theme Theme object, with foreground, background, size, font, and fontweight properties.
	     */
	    addTheme: function(name, theme) {
	        name != null && theme != null && (App.settings.themes[name] = theme);
	        delete App.vars.cache.themeKeys;
	        return this;
	    },

	    /**
	     * Appends a placeholder to an element
	     *
	     * @param {string} src Placeholder URL string
	     * @param el A selector or a reference to a DOM node
	     */
	    addImage: function(src, el) {
	        //todo: use jquery fallback if available for all QSA references
	        var nodes = DOM.getNodeArray(el);
	        nodes.forEach(function (node) {
	            var img = DOM.newEl('img');
	            var domProps = {};
	            domProps[App.setup.dataAttr] = src;
	            DOM.setAttr(img, domProps);
	            node.appendChild(img);
	        });
	        return this;
	    },

	    /**
	     * Sets whether or not an image is updated on resize.
	     * If an image is set to be updated, it is immediately rendered.
	     *
	     * @param {Object} el Image DOM element
	     * @param {Boolean} value Resizable update flag value
	     */
	    setResizeUpdate: function(el, value) {
	        if (el.holderData) {
	            el.holderData.resizeUpdate = !!value;
	            if (el.holderData.resizeUpdate) {
	                updateResizableElements(el);
	            }
	        }
	    },

	    /**
	     * Runs Holder with options. By default runs Holder on all images with "holder.js" in their source attributes.
	     *
	     * @param {Object} userOptions Options object, can contain domain, themes, images, and bgnodes properties
	     */
	    run: function(userOptions) {
	        //todo: split processing into separate queues
	        userOptions = userOptions || {};
	        var engineSettings = {};
	        var options = extend(App.settings, userOptions);

	        App.vars.preempted = true;
	        App.vars.dataAttr = options.dataAttr || App.setup.dataAttr;
	        App.vars.lineWrapRatio = options.lineWrapRatio || App.setup.lineWrapRatio;

	        engineSettings.renderer = options.renderer ? options.renderer : App.setup.renderer;
	        if (App.setup.renderers.join(',').indexOf(engineSettings.renderer) === -1) {
	            engineSettings.renderer = App.setup.supportsSVG ? 'svg' : (App.setup.supportsCanvas ? 'canvas' : 'html');
	        }

	        var images = DOM.getNodeArray(options.images);
	        var bgnodes = DOM.getNodeArray(options.bgnodes);
	        var stylenodes = DOM.getNodeArray(options.stylenodes);
	        var objects = DOM.getNodeArray(options.objects);

	        engineSettings.stylesheets = [];
	        engineSettings.svgXMLStylesheet = true;
	        engineSettings.noFontFallback = options.noFontFallback ? options.noFontFallback : false;

	        stylenodes.forEach(function (styleNode) {
	            if (styleNode.attributes.rel && styleNode.attributes.href && styleNode.attributes.rel.value == 'stylesheet') {
	                var href = styleNode.attributes.href.value;
	                //todo: write isomorphic relative-to-absolute URL function
	                var proxyLink = DOM.newEl('a');
	                proxyLink.href = href;
	                var stylesheetURL = proxyLink.protocol + '//' + proxyLink.host + proxyLink.pathname + proxyLink.search;
	                engineSettings.stylesheets.push(stylesheetURL);
	            }
	        });

	        bgnodes.forEach(function (bgNode) {
	            //Skip processing background nodes if getComputedStyle is unavailable, since only modern browsers would be able to use canvas or SVG to render to background
	            if (!global.getComputedStyle) return;
	            var backgroundImage = global.getComputedStyle(bgNode, null).getPropertyValue('background-image');
	            var dataBackgroundImage = bgNode.getAttribute('data-background-src');
	            var rawURL = dataBackgroundImage || backgroundImage;

	            var holderURL = null;
	            var holderString = options.domain + '/';
	            var holderStringIndex = rawURL.indexOf(holderString);

	            if (holderStringIndex === 0) {
	                holderURL = rawURL;
	            } else if (holderStringIndex === 1 && rawURL[0] === '?') {
	                holderURL = rawURL.slice(1);
	            } else {
	                var fragment = rawURL.substr(holderStringIndex).match(/([^\"]*)"?\)/);
	                if (fragment !== null) {
	                    holderURL = fragment[1];
	                } else if (rawURL.indexOf('url(') === 0) {
	                    throw 'Holder: unable to parse background URL: ' + rawURL;
	                }
	            }

	            if (holderURL != null) {
	                var holderFlags = parseURL(holderURL, options);
	                if (holderFlags) {
	                    prepareDOMElement({
	                        mode: 'background',
	                        el: bgNode,
	                        flags: holderFlags,
	                        engineSettings: engineSettings
	                    });
	                }
	            }
	        });

	        objects.forEach(function (object) {
	            var objectAttr = {};

	            try {
	                objectAttr.data = object.getAttribute('data');
	                objectAttr.dataSrc = object.getAttribute(App.vars.dataAttr);
	            } catch (e) {}

	            var objectHasSrcURL = objectAttr.data != null && objectAttr.data.indexOf(options.domain) === 0;
	            var objectHasDataSrcURL = objectAttr.dataSrc != null && objectAttr.dataSrc.indexOf(options.domain) === 0;

	            if (objectHasSrcURL) {
	                prepareImageElement(options, engineSettings, objectAttr.data, object);
	            } else if (objectHasDataSrcURL) {
	                prepareImageElement(options, engineSettings, objectAttr.dataSrc, object);
	            }
	        });

	        images.forEach(function (image) {
	            var imageAttr = {};

	            try {
	                imageAttr.src = image.getAttribute('src');
	                imageAttr.dataSrc = image.getAttribute(App.vars.dataAttr);
	                imageAttr.rendered = image.getAttribute('data-holder-rendered');
	            } catch (e) {}

	            var imageHasSrc = imageAttr.src != null;
	            var imageHasDataSrcURL = imageAttr.dataSrc != null && imageAttr.dataSrc.indexOf(options.domain) === 0;
	            var imageRendered = imageAttr.rendered != null && imageAttr.rendered == 'true';

	            if (imageHasSrc) {
	                if (imageAttr.src.indexOf(options.domain) === 0) {
	                    prepareImageElement(options, engineSettings, imageAttr.src, image);
	                } else if (imageHasDataSrcURL) {
	                    //Image has a valid data-src and an invalid src
	                    if (imageRendered) {
	                        //If the placeholder has already been render, re-render it
	                        prepareImageElement(options, engineSettings, imageAttr.dataSrc, image);
	                    } else {
	                        //If the placeholder has not been rendered, check if the image exists and render a fallback if it doesn't
	                        (function(src, options, engineSettings, dataSrc, image) {
	                            utils.imageExists(src, function(exists) {
	                                if (!exists) {
	                                    prepareImageElement(options, engineSettings, dataSrc, image);
	                                }
	                            });
	                        })(imageAttr.src, options, engineSettings, imageAttr.dataSrc, image);
	                    }
	                }
	            } else if (imageHasDataSrcURL) {
	                prepareImageElement(options, engineSettings, imageAttr.dataSrc, image);
	            }
	        });

	        return this;
	    }
	};

	var App = {
	    settings: {
	        domain: 'holder.js',
	        images: 'img',
	        objects: 'object',
	        bgnodes: 'body .holderjs',
	        stylenodes: 'head link.holderjs',
	        themes: {
	            'gray': {
	                background: '#EEEEEE',
	                foreground: '#AAAAAA'
	            },
	            'social': {
	                background: '#3a5a97',
	                foreground: '#FFFFFF'
	            },
	            'industrial': {
	                background: '#434A52',
	                foreground: '#C2F200'
	            },
	            'sky': {
	                background: '#0D8FDB',
	                foreground: '#FFFFFF'
	            },
	            'vine': {
	                background: '#39DBAC',
	                foreground: '#1E292C'
	            },
	            'lava': {
	                background: '#F8591A',
	                foreground: '#1C2846'
	            }
	        }
	    },
	    defaults: {
	        size: 10,
	        units: 'pt',
	        scale: 1 / 16
	    }
	};

	/**
	 * Processes provided source attribute and sets up the appropriate rendering workflow
	 *
	 * @private
	 * @param options Instance options from Holder.run
	 * @param renderSettings Instance configuration
	 * @param src Image URL
	 * @param el Image DOM element
	 */
	function prepareImageElement(options, engineSettings, src, el) {
	    var holderFlags = parseURL(src.substr(src.lastIndexOf(options.domain)), options);
	    if (holderFlags) {
	        prepareDOMElement({
	            mode: null,
	            el: el,
	            flags: holderFlags,
	            engineSettings: engineSettings
	        });
	    }
	}

	/**
	 * Processes a Holder URL and extracts configuration from query string
	 *
	 * @private
	 * @param url URL
	 * @param instanceOptions Instance options from Holder.run
	 */
	function parseURL(url, instanceOptions) {
	    var holder = {
	        theme: extend(App.settings.themes.gray, null),
	        stylesheets: instanceOptions.stylesheets,
	        instanceOptions: instanceOptions
	    };

	    var parts = url.split('?');
	    var basics = parts[0].split('/');

	    holder.holderURL = url;

	    var dimensions = basics[1];
	    var dimensionData = dimensions.match(/([\d]+p?)x([\d]+p?)/);

	    if (!dimensionData) return false;

	    holder.fluid = dimensions.indexOf('p') !== -1;

	    holder.dimensions = {
	        width: dimensionData[1].replace('p', '%'),
	        height: dimensionData[2].replace('p', '%')
	    };

	    if (parts.length === 2) {
	        var options = querystring.parse(parts[1]);

	        // Colors

	        if (options.bg) {
	            holder.theme.background = utils.parseColor(options.bg);
	        }

	        if (options.fg) {
	            holder.theme.foreground = utils.parseColor(options.fg);
	        }

	        //todo: add automatic foreground to themes without foreground
	        if (options.bg && !options.fg) {
	            holder.autoFg = true;
	        }

	        if (options.theme && holder.instanceOptions.themes.hasOwnProperty(options.theme)) {
	            holder.theme = extend(holder.instanceOptions.themes[options.theme], null);
	        }

	        // Text

	        if (options.text) {
	            holder.text = options.text;
	        }

	        if (options.textmode) {
	            holder.textmode = options.textmode;
	        }

	        if (options.size) {
	            holder.size = options.size;
	        }

	        if (options.font) {
	            holder.font = options.font;
	        }

	        if (options.align) {
	            holder.align = options.align;
	        }

	        holder.nowrap = utils.truthy(options.nowrap);

	        // Miscellaneous

	        holder.auto = utils.truthy(options.auto);

	        holder.outline = utils.truthy(options.outline);

	        if (utils.truthy(options.random)) {
	            App.vars.cache.themeKeys = App.vars.cache.themeKeys || Object.keys(holder.instanceOptions.themes);
	            var _theme = App.vars.cache.themeKeys[0 | Math.random() * App.vars.cache.themeKeys.length];
	            holder.theme = extend(holder.instanceOptions.themes[_theme], null);
	        }
	    }

	    return holder;
	}

	/**
	 * Modifies the DOM to fit placeholders and sets up resizable image callbacks (for fluid and automatically sized placeholders)
	 *
	 * @private
	 * @param settings DOM prep settings
	 */
	function prepareDOMElement(prepSettings) {
	    var mode = prepSettings.mode;
	    var el = prepSettings.el;
	    var flags = prepSettings.flags;
	    var _engineSettings = prepSettings.engineSettings;
	    var dimensions = flags.dimensions,
	        theme = flags.theme;
	    var dimensionsCaption = dimensions.width + 'x' + dimensions.height;
	    mode = mode == null ? (flags.fluid ? 'fluid' : 'image') : mode;

	    if (flags.text != null) {
	        theme.text = flags.text;

	        //<object> SVG embedding doesn't parse Unicode properly
	        if (el.nodeName.toLowerCase() === 'object') {
	            var textLines = theme.text.split('\\n');
	            for (var k = 0; k < textLines.length; k++) {
	                textLines[k] = utils.encodeHtmlEntity(textLines[k]);
	            }
	            theme.text = textLines.join('\\n');
	        }
	    }

	    var holderURL = flags.holderURL;
	    var engineSettings = extend(_engineSettings, null);

	    if (flags.font) {
	        /*
	        If external fonts are used in a <img> placeholder rendered with SVG, Holder falls back to canvas.

	        This is done because Firefox and Chrome disallow embedded SVGs from referencing external assets.
	        The workaround is either to change the placeholder tag from <img> to <object> or to use the canvas renderer.
	        */
	        theme.font = flags.font;
	        if (!engineSettings.noFontFallback && el.nodeName.toLowerCase() === 'img' && App.setup.supportsCanvas && engineSettings.renderer === 'svg') {
	            engineSettings = extend(engineSettings, {
	                renderer: 'canvas'
	            });
	        }
	    }

	    //Chrome and Opera require a quick 10ms re-render if web fonts are used with canvas
	    if (flags.font && engineSettings.renderer == 'canvas') {
	        engineSettings.reRender = true;
	    }

	    if (mode == 'background') {
	        if (el.getAttribute('data-background-src') == null) {
	            DOM.setAttr(el, {
	                'data-background-src': holderURL
	            });
	        }
	    } else {
	        var domProps = {};
	        domProps[App.vars.dataAttr] = holderURL;
	        DOM.setAttr(el, domProps);
	    }

	    flags.theme = theme;

	    //todo consider using all renderSettings in holderData
	    el.holderData = {
	        flags: flags,
	        engineSettings: engineSettings
	    };

	    if (mode == 'image' || mode == 'fluid') {
	        DOM.setAttr(el, {
	            'alt': (theme.text ? theme.text + ' [' + dimensionsCaption + ']' : dimensionsCaption)
	        });
	    }

	    var renderSettings = {
	        mode: mode,
	        el: el,
	        holderSettings: {
	            dimensions: dimensions,
	            theme: theme,
	            flags: flags
	        },
	        engineSettings: engineSettings
	    };

	    if (mode == 'image') {
	        if (!flags.auto) {
	            el.style.width = dimensions.width + 'px';
	            el.style.height = dimensions.height + 'px';
	        }

	        if (engineSettings.renderer == 'html') {
	            el.style.backgroundColor = theme.background;
	        } else {
	            render(renderSettings);

	            if (flags.textmode == 'exact') {
	                el.holderData.resizeUpdate = true;
	                App.vars.resizableImages.push(el);
	                updateResizableElements(el);
	            }
	        }
	    } else if (mode == 'background' && engineSettings.renderer != 'html') {
	        render(renderSettings);
	    } else if (mode == 'fluid') {
	        el.holderData.resizeUpdate = true;

	        if (dimensions.height.slice(-1) == '%') {
	            el.style.height = dimensions.height;
	        } else if (flags.auto == null || !flags.auto) {
	            el.style.height = dimensions.height + 'px';
	        }
	        if (dimensions.width.slice(-1) == '%') {
	            el.style.width = dimensions.width;
	        } else if (flags.auto == null || !flags.auto) {
	            el.style.width = dimensions.width + 'px';
	        }
	        if (el.style.display == 'inline' || el.style.display === '' || el.style.display == 'none') {
	            el.style.display = 'block';
	        }

	        setInitialDimensions(el);

	        if (engineSettings.renderer == 'html') {
	            el.style.backgroundColor = theme.background;
	        } else {
	            App.vars.resizableImages.push(el);
	            updateResizableElements(el);
	        }
	    }
	}

	/**
	 * Core function that takes output from renderers and sets it as the source or background-image of the target element
	 *
	 * @private
	 * @param renderSettings Renderer settings
	 */
	function render(renderSettings) {
	    var image = null;
	    var mode = renderSettings.mode;
	    var el = renderSettings.el;
	    var holderSettings = renderSettings.holderSettings;
	    var engineSettings = renderSettings.engineSettings;

	    switch (engineSettings.renderer) {
	        case 'svg':
	            if (!App.setup.supportsSVG) return;
	            break;
	        case 'canvas':
	            if (!App.setup.supportsCanvas) return;
	            break;
	        default:
	            return;
	    }

	    //todo: move generation of scene up to flag generation to reduce extra object creation
	    var scene = {
	        width: holderSettings.dimensions.width,
	        height: holderSettings.dimensions.height,
	        theme: holderSettings.theme,
	        flags: holderSettings.flags
	    };

	    var sceneGraph = buildSceneGraph(scene);

	    function getRenderedImage() {
	        var image = null;
	        switch (engineSettings.renderer) {
	            case 'canvas':
	                image = sgCanvasRenderer(sceneGraph, renderSettings);
	                break;
	            case 'svg':
	                image = svgRenderer(sceneGraph, renderSettings);
	                break;
	            default:
	                throw 'Holder: invalid renderer: ' + engineSettings.renderer;
	        }

	        return image;
	    }

	    image = getRenderedImage();

	    if (image == null) {
	        throw 'Holder: couldn\'t render placeholder';
	    }

	    //todo: add <object> canvas rendering
	    if (mode == 'background') {
	        el.style.backgroundImage = 'url(' + image + ')';
	        el.style.backgroundSize = scene.width + 'px ' + scene.height + 'px';
	    } else {
	        if (el.nodeName.toLowerCase() === 'img') {
	            DOM.setAttr(el, {
	                'src': image
	            });
	        } else if (el.nodeName.toLowerCase() === 'object') {
	            DOM.setAttr(el, {
	                'data': image
	            });
	            DOM.setAttr(el, {
	                'type': 'image/svg+xml'
	            });
	        }
	        if (engineSettings.reRender) {
	            global.setTimeout(function () {
	                var image = getRenderedImage();
	                if (image == null) {
	                    throw 'Holder: couldn\'t render placeholder';
	                }
	                //todo: refactor this code into a function
	                if (el.nodeName.toLowerCase() === 'img') {
	                    DOM.setAttr(el, {
	                        'src': image
	                    });
	                } else if (el.nodeName.toLowerCase() === 'object') {
	                    DOM.setAttr(el, {
	                        'data': image
	                    });
	                    DOM.setAttr(el, {
	                        'type': 'image/svg+xml'
	                    });
	                }
	            }, 150);
	        }
	    }
	    //todo: account for re-rendering
	    DOM.setAttr(el, {
	        'data-holder-rendered': true
	    });
	}

	/**
	 * Core function that takes a Holder scene description and builds a scene graph
	 *
	 * @private
	 * @param scene Holder scene object
	 */
	//todo: make this function reusable
	//todo: merge app defaults and setup properties into the scene argument
	function buildSceneGraph(scene) {
	    var fontSize = App.defaults.size;
	    if (parseFloat(scene.theme.size)) {
	        fontSize = scene.theme.size;
	    } else if (parseFloat(scene.flags.size)) {
	        fontSize = scene.flags.size;
	    }

	    scene.font = {
	        family: scene.theme.font ? scene.theme.font : 'Arial, Helvetica, Open Sans, sans-serif',
	        size: textSize(scene.width, scene.height, fontSize, App.defaults.scale),
	        units: scene.theme.units ? scene.theme.units : App.defaults.units,
	        weight: scene.theme.fontweight ? scene.theme.fontweight : 'bold'
	    };

	    scene.text = scene.theme.text || Math.floor(scene.width) + 'x' + Math.floor(scene.height);

	    scene.noWrap = scene.theme.nowrap || scene.flags.nowrap;

	    scene.align = scene.theme.align || scene.flags.align || 'center';

	    switch (scene.flags.textmode) {
	        case 'literal':
	            scene.text = scene.flags.dimensions.width + 'x' + scene.flags.dimensions.height;
	            break;
	        case 'exact':
	            if (!scene.flags.exactDimensions) break;
	            scene.text = Math.floor(scene.flags.exactDimensions.width) + 'x' + Math.floor(scene.flags.exactDimensions.height);
	            break;
	    }

	    var sceneGraph = new SceneGraph({
	        width: scene.width,
	        height: scene.height
	    });

	    var Shape = sceneGraph.Shape;

	    var holderBg = new Shape.Rect('holderBg', {
	        fill: scene.theme.background
	    });

	    holderBg.resize(scene.width, scene.height);
	    sceneGraph.root.add(holderBg);

	    if (scene.flags.outline) {
	        var outlineColor = new Color(holderBg.properties.fill);
	        outlineColor = outlineColor.lighten(outlineColor.lighterThan('7f7f7f') ? -0.1 : 0.1);
	        holderBg.properties.outline = {
	            fill: outlineColor.toHex(true),
	            width: 2
	        };
	    }

	    var holderTextColor = scene.theme.foreground;

	    if (scene.flags.autoFg) {
	        var holderBgColor = new Color(holderBg.properties.fill);
	        var lightColor = new Color('fff');
	        var darkColor = new Color('000', {
	            'alpha': 0.285714
	        });

	        holderTextColor = holderBgColor.blendAlpha(holderBgColor.lighterThan('7f7f7f') ? darkColor : lightColor).toHex(true);
	    }

	    var holderTextGroup = new Shape.Group('holderTextGroup', {
	        text: scene.text,
	        align: scene.align,
	        font: scene.font,
	        fill: holderTextColor
	    });

	    holderTextGroup.moveTo(null, null, 1);
	    sceneGraph.root.add(holderTextGroup);

	    var tpdata = holderTextGroup.textPositionData = stagingRenderer(sceneGraph);
	    if (!tpdata) {
	        throw 'Holder: staging fallback not supported yet.';
	    }
	    holderTextGroup.properties.leading = tpdata.boundingBox.height;

	    var textNode = null;
	    var line = null;

	    function finalizeLine(parent, line, width, height) {
	        line.width = width;
	        line.height = height;
	        parent.width = Math.max(parent.width, line.width);
	        parent.height += line.height;
	    }

	    var sceneMargin = scene.width * App.vars.lineWrapRatio;
	    var maxLineWidth = sceneMargin;

	    if (tpdata.lineCount > 1) {
	        var offsetX = 0;
	        var offsetY = 0;
	        var lineIndex = 0;
	        var lineKey;
	        line = new Shape.Group('line' + lineIndex);

	        //Double margin so that left/right-aligned next is not flush with edge of image
	        if (scene.align === 'left' || scene.align === 'right') {
	            maxLineWidth = scene.width * (1 - (1 - (App.vars.lineWrapRatio)) * 2);
	        }

	        for (var i = 0; i < tpdata.words.length; i++) {
	            var word = tpdata.words[i];
	            textNode = new Shape.Text(word.text);
	            var newline = word.text == '\\n';
	            if (!scene.noWrap && (offsetX + word.width >= maxLineWidth || newline === true)) {
	                finalizeLine(holderTextGroup, line, offsetX, holderTextGroup.properties.leading);
	                holderTextGroup.add(line);
	                offsetX = 0;
	                offsetY += holderTextGroup.properties.leading;
	                lineIndex += 1;
	                line = new Shape.Group('line' + lineIndex);
	                line.y = offsetY;
	            }
	            if (newline === true) {
	                continue;
	            }
	            textNode.moveTo(offsetX, 0);
	            offsetX += tpdata.spaceWidth + word.width;
	            line.add(textNode);
	        }

	        finalizeLine(holderTextGroup, line, offsetX, holderTextGroup.properties.leading);
	        holderTextGroup.add(line);

	        if (scene.align === 'left') {
	            holderTextGroup.moveTo(scene.width - sceneMargin, null, null);
	        } else if (scene.align === 'right') {
	            for (lineKey in holderTextGroup.children) {
	                line = holderTextGroup.children[lineKey];
	                line.moveTo(scene.width - line.width, null, null);
	            }

	            holderTextGroup.moveTo(0 - (scene.width - sceneMargin), null, null);
	        } else {
	            for (lineKey in holderTextGroup.children) {
	                line = holderTextGroup.children[lineKey];
	                line.moveTo((holderTextGroup.width - line.width) / 2, null, null);
	            }

	            holderTextGroup.moveTo((scene.width - holderTextGroup.width) / 2, null, null);
	        }

	        holderTextGroup.moveTo(null, (scene.height - holderTextGroup.height) / 2, null);

	        //If the text exceeds vertical space, move it down so the first line is visible
	        if ((scene.height - holderTextGroup.height) / 2 < 0) {
	            holderTextGroup.moveTo(null, 0, null);
	        }
	    } else {
	        textNode = new Shape.Text(scene.text);
	        line = new Shape.Group('line0');
	        line.add(textNode);
	        holderTextGroup.add(line);

	        if (scene.align === 'left') {
	            holderTextGroup.moveTo(scene.width - sceneMargin, null, null);
	        } else if (scene.align === 'right') {
	            holderTextGroup.moveTo(0 - (scene.width - sceneMargin), null, null);
	        } else {
	            holderTextGroup.moveTo((scene.width - tpdata.boundingBox.width) / 2, null, null);
	        }

	        holderTextGroup.moveTo(null, (scene.height - tpdata.boundingBox.height) / 2, null);
	    }

	    //todo: renderlist
	    return sceneGraph;
	}

	/**
	 * Adaptive text sizing function
	 *
	 * @private
	 * @param width Parent width
	 * @param height Parent height
	 * @param fontSize Requested text size
	 * @param scale Proportional scale of text
	 */
	function textSize(width, height, fontSize, scale) {
	    var stageWidth = parseInt(width, 10);
	    var stageHeight = parseInt(height, 10);

	    var bigSide = Math.max(stageWidth, stageHeight);
	    var smallSide = Math.min(stageWidth, stageHeight);

	    var newHeight = 0.8 * Math.min(smallSide, bigSide * scale);
	    return Math.round(Math.max(fontSize, newHeight));
	}

	/**
	 * Iterates over resizable (fluid or auto) placeholders and renders them
	 *
	 * @private
	 * @param element Optional element selector, specified only if a specific element needs to be re-rendered
	 */
	function updateResizableElements(element) {
	    var images;
	    if (element == null || element.nodeType == null) {
	        images = App.vars.resizableImages;
	    } else {
	        images = [element];
	    }
	    for (var i = 0, l = images.length; i < l; i++) {
	        var el = images[i];
	        if (el.holderData) {
	            var flags = el.holderData.flags;
	            var dimensions = dimensionCheck(el);
	            if (dimensions) {
	                if (!el.holderData.resizeUpdate) {
	                    continue;
	                }

	                if (flags.fluid && flags.auto) {
	                    var fluidConfig = el.holderData.fluidConfig;
	                    switch (fluidConfig.mode) {
	                        case 'width':
	                            dimensions.height = dimensions.width / fluidConfig.ratio;
	                            break;
	                        case 'height':
	                            dimensions.width = dimensions.height * fluidConfig.ratio;
	                            break;
	                    }
	                }

	                var settings = {
	                    mode: 'image',
	                    holderSettings: {
	                        dimensions: dimensions,
	                        theme: flags.theme,
	                        flags: flags
	                    },
	                    el: el,
	                    engineSettings: el.holderData.engineSettings
	                };

	                if (flags.textmode == 'exact') {
	                    flags.exactDimensions = dimensions;
	                    settings.holderSettings.dimensions = flags.dimensions;
	                }

	                render(settings);
	            } else {
	                setInvisible(el);
	            }
	        }
	    }
	}

	/**
	 * Sets up aspect ratio metadata for fluid placeholders, in order to preserve proportions when resizing
	 *
	 * @private
	 * @param el Image DOM element
	 */
	function setInitialDimensions(el) {
	    if (el.holderData) {
	        var dimensions = dimensionCheck(el);
	        if (dimensions) {
	            var flags = el.holderData.flags;

	            var fluidConfig = {
	                fluidHeight: flags.dimensions.height.slice(-1) == '%',
	                fluidWidth: flags.dimensions.width.slice(-1) == '%',
	                mode: null,
	                initialDimensions: dimensions
	            };

	            if (fluidConfig.fluidWidth && !fluidConfig.fluidHeight) {
	                fluidConfig.mode = 'width';
	                fluidConfig.ratio = fluidConfig.initialDimensions.width / parseFloat(flags.dimensions.height);
	            } else if (!fluidConfig.fluidWidth && fluidConfig.fluidHeight) {
	                fluidConfig.mode = 'height';
	                fluidConfig.ratio = parseFloat(flags.dimensions.width) / fluidConfig.initialDimensions.height;
	            }

	            el.holderData.fluidConfig = fluidConfig;
	        } else {
	            setInvisible(el);
	        }
	    }
	}

	/**
	 * Iterates through all current invisible images, and if they're visible, renders them and removes them from further checks. Runs every animation frame.
	 *
	 * @private
	 */
	function visibilityCheck() {
	    var renderableImages = [];
	    var keys = Object.keys(App.vars.invisibleImages);
	    var el;

	    keys.forEach(function (key) {
	        el = App.vars.invisibleImages[key];
	        if (dimensionCheck(el) && el.nodeName.toLowerCase() == 'img') {
	            renderableImages.push(el);
	            delete App.vars.invisibleImages[key];
	        }
	    });

	    if (renderableImages.length) {
	        Holder.run({
	            images: renderableImages
	        });
	    }

	    // Done to prevent 100% CPU usage via aggressive calling of requestAnimationFrame
	    setTimeout(function () {
	        global.requestAnimationFrame(visibilityCheck);
	    }, 10);
	}

	/**
	 * Starts checking for invisible placeholders if not doing so yet. Does nothing otherwise.
	 *
	 * @private
	 */
	function startVisibilityCheck() {
	    if (!App.vars.visibilityCheckStarted) {
	        global.requestAnimationFrame(visibilityCheck);
	        App.vars.visibilityCheckStarted = true;
	    }
	}

	/**
	 * Sets a unique ID for an image detected to be invisible and adds it to the map of invisible images checked by visibilityCheck
	 *
	 * @private
	 * @param el Invisible DOM element
	 */
	function setInvisible(el) {
	    if (!el.holderData.invisibleId) {
	        App.vars.invisibleId += 1;
	        App.vars.invisibleImages['i' + App.vars.invisibleId] = el;
	        el.holderData.invisibleId = App.vars.invisibleId;
	    }
	}

	//todo: see if possible to convert stagingRenderer to use HTML only
	var stagingRenderer = (function() {
	    var svg = null,
	        stagingText = null,
	        stagingTextNode = null;
	    return function(graph) {
	        var rootNode = graph.root;
	        if (App.setup.supportsSVG) {
	            var firstTimeSetup = false;
	            var tnode = function(text) {
	                return document.createTextNode(text);
	            };
	            if (svg == null || svg.parentNode !== document.body) {
	                firstTimeSetup = true;
	            }

	            svg = SVG.initSVG(svg, rootNode.properties.width, rootNode.properties.height);
	            //Show staging element before staging
	            svg.style.display = 'block';

	            if (firstTimeSetup) {
	                stagingText = DOM.newEl('text', SVG_NS);
	                stagingTextNode = tnode(null);
	                DOM.setAttr(stagingText, {
	                    x: 0
	                });
	                stagingText.appendChild(stagingTextNode);
	                svg.appendChild(stagingText);
	                document.body.appendChild(svg);
	                svg.style.visibility = 'hidden';
	                svg.style.position = 'absolute';
	                svg.style.top = '-100%';
	                svg.style.left = '-100%';
	                //todo: workaround for zero-dimension <svg> tag in Opera 12
	                //svg.setAttribute('width', 0);
	                //svg.setAttribute('height', 0);
	            }

	            var holderTextGroup = rootNode.children.holderTextGroup;
	            var htgProps = holderTextGroup.properties;
	            DOM.setAttr(stagingText, {
	                'y': htgProps.font.size,
	                'style': utils.cssProps({
	                    'font-weight': htgProps.font.weight,
	                    'font-size': htgProps.font.size + htgProps.font.units,
	                    'font-family': htgProps.font.family
	                })
	            });

	            //Get bounding box for the whole string (total width and height)
	            stagingTextNode.nodeValue = htgProps.text;
	            var stagingTextBBox = stagingText.getBBox();

	            //Get line count and split the string into words
	            var lineCount = Math.ceil(stagingTextBBox.width / (rootNode.properties.width * App.vars.lineWrapRatio));
	            var words = htgProps.text.split(' ');
	            var newlines = htgProps.text.match(/\\n/g);
	            lineCount += newlines == null ? 0 : newlines.length;

	            //Get bounding box for the string with spaces removed
	            stagingTextNode.nodeValue = htgProps.text.replace(/[ ]+/g, '');
	            var computedNoSpaceLength = stagingText.getComputedTextLength();

	            //Compute average space width
	            var diffLength = stagingTextBBox.width - computedNoSpaceLength;
	            var spaceWidth = Math.round(diffLength / Math.max(1, words.length - 1));

	            //Get widths for every word with space only if there is more than one line
	            var wordWidths = [];
	            if (lineCount > 1) {
	                stagingTextNode.nodeValue = '';
	                for (var i = 0; i < words.length; i++) {
	                    if (words[i].length === 0) continue;
	                    stagingTextNode.nodeValue = utils.decodeHtmlEntity(words[i]);
	                    var bbox = stagingText.getBBox();
	                    wordWidths.push({
	                        text: words[i],
	                        width: bbox.width
	                    });
	                }
	            }

	            //Hide staging element after staging
	            svg.style.display = 'none';

	            return {
	                spaceWidth: spaceWidth,
	                lineCount: lineCount,
	                boundingBox: stagingTextBBox,
	                words: wordWidths
	            };
	        } else {
	            //todo: canvas fallback for measuring text on android 2.3
	            return false;
	        }
	    };
	})();

	var sgCanvasRenderer = (function() {
	    var canvas = DOM.newEl('canvas');
	    var ctx = null;

	    return function(sceneGraph) {
	        if (ctx == null) {
	            ctx = canvas.getContext('2d');
	        }
	        var root = sceneGraph.root;
	        canvas.width = App.dpr(root.properties.width);
	        canvas.height = App.dpr(root.properties.height);
	        ctx.textBaseline = 'middle';

	        var bg = root.children.holderBg;
	        var bgWidth = App.dpr(bg.width);
	        var bgHeight = App.dpr(bg.height);
	        //todo: parametrize outline width (e.g. in scene object)
	        var outlineWidth = 2;
	        var outlineOffsetWidth = outlineWidth / 2;

	        ctx.fillStyle = bg.properties.fill;
	        ctx.fillRect(0, 0, bgWidth, bgHeight);

	        if (bg.properties.outline) {
	            //todo: abstract this into a method
	            ctx.strokeStyle = bg.properties.outline.fill;
	            ctx.lineWidth = bg.properties.outline.width;
	            ctx.moveTo(outlineOffsetWidth, outlineOffsetWidth);
	            // TL, TR, BR, BL
	            ctx.lineTo(bgWidth - outlineOffsetWidth, outlineOffsetWidth);
	            ctx.lineTo(bgWidth - outlineOffsetWidth, bgHeight - outlineOffsetWidth);
	            ctx.lineTo(outlineOffsetWidth, bgHeight - outlineOffsetWidth);
	            ctx.lineTo(outlineOffsetWidth, outlineOffsetWidth);
	            // Diagonals
	            ctx.moveTo(0, outlineOffsetWidth);
	            ctx.lineTo(bgWidth, bgHeight - outlineOffsetWidth);
	            ctx.moveTo(0, bgHeight - outlineOffsetWidth);
	            ctx.lineTo(bgWidth, outlineOffsetWidth);
	            ctx.stroke();
	        }

	        var textGroup = root.children.holderTextGroup;
	        ctx.font = textGroup.properties.font.weight + ' ' + App.dpr(textGroup.properties.font.size) + textGroup.properties.font.units + ' ' + textGroup.properties.font.family + ', monospace';
	        ctx.fillStyle = textGroup.properties.fill;

	        for (var lineKey in textGroup.children) {
	            var line = textGroup.children[lineKey];
	            for (var wordKey in line.children) {
	                var word = line.children[wordKey];
	                var x = App.dpr(textGroup.x + line.x + word.x);
	                var y = App.dpr(textGroup.y + line.y + word.y + (textGroup.properties.leading / 2));

	                ctx.fillText(word.properties.text, x, y);
	            }
	        }

	        return canvas.toDataURL('image/png');
	    };
	})();

	//Helpers

	/**
	 * Prevents a function from being called too often, waits until a timer elapses to call it again
	 *
	 * @param fn Function to call
	 */
	function debounce(fn) {
	    if (!App.vars.debounceTimer) fn.call(this);
	    if (App.vars.debounceTimer) global.clearTimeout(App.vars.debounceTimer);
	    App.vars.debounceTimer = global.setTimeout(function() {
	        App.vars.debounceTimer = null;
	        fn.call(this);
	    }, App.setup.debounce);
	}

	/**
	 * Holder-specific resize/orientation change callback, debounced to prevent excessive execution
	 */
	function resizeEvent() {
	    debounce(function() {
	        updateResizableElements(null);
	    });
	}

	//Set up flags

	for (var flag in App.flags) {
	    if (!App.flags.hasOwnProperty(flag)) continue;
	    App.flags[flag].match = function(val) {
	        return val.match(this.regex);
	    };
	}

	//Properties set once on setup

	App.setup = {
	    renderer: 'html',
	    debounce: 100,
	    ratio: 1,
	    supportsCanvas: false,
	    supportsSVG: false,
	    lineWrapRatio: 0.9,
	    dataAttr: 'data-src',
	    renderers: ['html', 'canvas', 'svg']
	};

	App.dpr = function(val) {
	    return val * App.setup.ratio;
	};

	//Properties modified during runtime

	App.vars = {
	    preempted: false,
	    resizableImages: [],
	    invisibleImages: {},
	    invisibleId: 0,
	    visibilityCheckStarted: false,
	    debounceTimer: null,
	    cache: {}
	};

	//Pre-flight

	(function() {
	    var devicePixelRatio = 1,
	        backingStoreRatio = 1;

	    var canvas = DOM.newEl('canvas');
	    var ctx = null;

	    if (canvas.getContext) {
	        if (canvas.toDataURL('image/png').indexOf('data:image/png') != -1) {
	            App.setup.renderer = 'canvas';
	            ctx = canvas.getContext('2d');
	            App.setup.supportsCanvas = true;
	        }
	    }

	    if (App.setup.supportsCanvas) {
	        devicePixelRatio = global.devicePixelRatio || 1;
	        backingStoreRatio = ctx.webkitBackingStorePixelRatio || ctx.mozBackingStorePixelRatio || ctx.msBackingStorePixelRatio || ctx.oBackingStorePixelRatio || ctx.backingStorePixelRatio || 1;
	    }

	    App.setup.ratio = devicePixelRatio / backingStoreRatio;

	    if (!!document.createElementNS && !!document.createElementNS(SVG_NS, 'svg').createSVGRect) {
	        App.setup.renderer = 'svg';
	        App.setup.supportsSVG = true;
	    }
	})();

	//Starts checking for invisible placeholders
	startVisibilityCheck();

	if (onDomReady) {
	    onDomReady(function() {
	        if (!App.vars.preempted) {
	            Holder.run();
	        }
	        if (global.addEventListener) {
	            global.addEventListener('resize', resizeEvent, false);
	            global.addEventListener('orientationchange', resizeEvent, false);
	        } else {
	            global.attachEvent('onresize', resizeEvent);
	        }

	        if (typeof global.Turbolinks == 'object') {
	            global.document.addEventListener('page:change', function() {
	                Holder.run();
	            });
	        }
	    });
	}

	module.exports = Holder;

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	/*!
	 * onDomReady.js 1.4.0 (c) 2013 Tubal Martin - MIT license
	 *
	 * Specially modified to work with Holder.js
	 */

	function _onDomReady(win) {
	    //Lazy loading fix for Firefox < 3.6
	    //http://webreflection.blogspot.com/2009/11/195-chars-to-help-lazy-loading.html
	    if (document.readyState == null && document.addEventListener) {
	        document.addEventListener("DOMContentLoaded", function DOMContentLoaded() {
	            document.removeEventListener("DOMContentLoaded", DOMContentLoaded, false);
	            document.readyState = "complete";
	        }, false);
	        document.readyState = "loading";
	    }
	    
	    var doc = win.document,
	        docElem = doc.documentElement,
	    
	        LOAD = "load",
	        FALSE = false,
	        ONLOAD = "on"+LOAD,
	        COMPLETE = "complete",
	        READYSTATE = "readyState",
	        ATTACHEVENT = "attachEvent",
	        DETACHEVENT = "detachEvent",
	        ADDEVENTLISTENER = "addEventListener",
	        DOMCONTENTLOADED = "DOMContentLoaded",
	        ONREADYSTATECHANGE = "onreadystatechange",
	        REMOVEEVENTLISTENER = "removeEventListener",
	    
	        // W3C Event model
	        w3c = ADDEVENTLISTENER in doc,
	        _top = FALSE,
	    
	        // isReady: Is the DOM ready to be used? Set to true once it occurs.
	        isReady = FALSE,
	    
	        // Callbacks pending execution until DOM is ready
	        callbacks = [];
	    
	    // Handle when the DOM is ready
	    function ready( fn ) {
	        if ( !isReady ) {
	    
	            // Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
	            if ( !doc.body ) {
	                return defer( ready );
	            }
	    
	            // Remember that the DOM is ready
	            isReady = true;
	    
	            // Execute all callbacks
	            while ( fn = callbacks.shift() ) {
	                defer( fn );
	            }
	        }
	    }
	    
	    // The ready event handler
	    function completed( event ) {
	        // readyState === "complete" is good enough for us to call the dom ready in oldIE
	        if ( w3c || event.type === LOAD || doc[READYSTATE] === COMPLETE ) {
	            detach();
	            ready();
	        }
	    }
	    
	    // Clean-up method for dom ready events
	    function detach() {
	        if ( w3c ) {
	            doc[REMOVEEVENTLISTENER]( DOMCONTENTLOADED, completed, FALSE );
	            win[REMOVEEVENTLISTENER]( LOAD, completed, FALSE );
	        } else {
	            doc[DETACHEVENT]( ONREADYSTATECHANGE, completed );
	            win[DETACHEVENT]( ONLOAD, completed );
	        }
	    }
	    
	    // Defers a function, scheduling it to run after the current call stack has cleared.
	    function defer( fn, wait ) {
	        // Allow 0 to be passed
	        setTimeout( fn, +wait >= 0 ? wait : 1 );
	    }
	    
	    // Attach the listeners:
	    
	    // Catch cases where onDomReady is called after the browser event has already occurred.
	    // we once tried to use readyState "interactive" here, but it caused issues like the one
	    // discovered by ChrisS here: http://bugs.jquery.com/ticket/12282#comment:15
	    if ( doc[READYSTATE] === COMPLETE ) {
	        // Handle it asynchronously to allow scripts the opportunity to delay ready
	        defer( ready );
	    
	    // Standards-based browsers support DOMContentLoaded
	    } else if ( w3c ) {
	        // Use the handy event callback
	        doc[ADDEVENTLISTENER]( DOMCONTENTLOADED, completed, FALSE );
	    
	        // A fallback to window.onload, that will always work
	        win[ADDEVENTLISTENER]( LOAD, completed, FALSE );
	    
	    // If IE event model is used
	    } else {
	        // Ensure firing before onload, maybe late but safe also for iframes
	        doc[ATTACHEVENT]( ONREADYSTATECHANGE, completed );
	    
	        // A fallback to window.onload, that will always work
	        win[ATTACHEVENT]( ONLOAD, completed );
	    
	        // If IE and not a frame
	        // continually check to see if the document is ready
	        try {
	            _top = win.frameElement == null && docElem;
	        } catch(e) {}
	    
	        if ( _top && _top.doScroll ) {
	            (function doScrollCheck() {
	                if ( !isReady ) {
	                    try {
	                        // Use the trick by Diego Perini
	                        // http://javascript.nwbox.com/IEContentLoaded/
	                        _top.doScroll("left");
	                    } catch(e) {
	                        return defer( doScrollCheck, 50 );
	                    }
	    
	                    // detach all dom ready events
	                    detach();
	    
	                    // and execute any waiting functions
	                    ready();
	                }
	            })();
	        }
	    }
	    
	    function onDomReady( fn ) {
	        // If DOM is ready, execute the function (async), otherwise wait
	        isReady ? defer( fn ) : callbacks.push( fn );
	    }
	    
	    // Add version
	    onDomReady.version = "1.4.0";
	    // Add method to check if DOM is ready
	    onDomReady.isReady = function(){
	        return isReady;
	    };

	    return onDomReady;
	}

	module.exports = typeof window !== "undefined" && _onDomReady(window);

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	//Modified version of component/querystring
	//Changes: updated dependencies, dot notation parsing, JSHint fixes
	//Fork at https://github.com/imsky/querystring

	/**
	 * Module dependencies.
	 */

	var encode = encodeURIComponent;
	var decode = decodeURIComponent;
	var trim = __webpack_require__(11);
	var type = __webpack_require__(12);

	var arrayRegex = /(\w+)\[(\d+)\]/;
	var objectRegex = /\w+\.\w+/;

	/**
	 * Parse the given query `str`.
	 *
	 * @param {String} str
	 * @return {Object}
	 * @api public
	 */

	exports.parse = function(str){
	  if ('string' !== typeof str) return {};

	  str = trim(str);
	  if ('' === str) return {};
	  if ('?' === str.charAt(0)) str = str.slice(1);

	  var obj = {};
	  var pairs = str.split('&');
	  for (var i = 0; i < pairs.length; i++) {
	    var parts = pairs[i].split('=');
	    var key = decode(parts[0]);
	    var m, ctx, prop;

	    if (m = arrayRegex.exec(key)) {
	      obj[m[1]] = obj[m[1]] || [];
	      obj[m[1]][m[2]] = decode(parts[1]);
	      continue;
	    }

	    if (m = objectRegex.test(key)) {
	      m = key.split('.');
	      ctx = obj;
	      
	      while (m.length) {
	        prop = m.shift();

	        if (!prop.length) continue;

	        if (!ctx[prop]) {
	          ctx[prop] = {};
	        } else if (ctx[prop] && typeof ctx[prop] !== 'object') {
	          break;
	        }

	        if (!m.length) {
	          ctx[prop] = decode(parts[1]);
	        }

	        ctx = ctx[prop];
	      }

	      continue;
	    }

	    obj[parts[0]] = null == parts[1] ? '' : decode(parts[1]);
	  }

	  return obj;
	};

	/**
	 * Stringify the given `obj`.
	 *
	 * @param {Object} obj
	 * @return {String}
	 * @api public
	 */

	exports.stringify = function(obj){
	  if (!obj) return '';
	  var pairs = [];

	  for (var key in obj) {
	    var value = obj[key];

	    if ('array' == type(value)) {
	      for (var i = 0; i < value.length; ++i) {
	        pairs.push(encode(key + '[' + i + ']') + '=' + encode(value[i]));
	      }
	      continue;
	    }

	    pairs.push(encode(key) + '=' + encode(obj[key]));
	  }

	  return pairs.join('&');
	};


/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	var SceneGraph = function(sceneProperties) {
	    var nodeCount = 1;

	    //todo: move merge to helpers section
	    function merge(parent, child) {
	        for (var prop in child) {
	            parent[prop] = child[prop];
	        }
	        return parent;
	    }

	    var SceneNode = function(name) {
	        nodeCount++;
	        this.parent = null;
	        this.children = {};
	        this.id = nodeCount;
	        this.name = 'n' + nodeCount;
	        if (typeof name !== 'undefined') {
	            this.name = name;
	        }
	        this.x = this.y = this.z = 0;
	        this.width = this.height = 0;
	    };

	    SceneNode.prototype.resize = function(width, height) {
	        if (width != null) {
	            this.width = width;
	        }
	        if (height != null) {
	            this.height = height;
	        }
	    };

	    SceneNode.prototype.moveTo = function(x, y, z) {
	        this.x = x != null ? x : this.x;
	        this.y = y != null ? y : this.y;
	        this.z = z != null ? z : this.z;
	    };

	    SceneNode.prototype.add = function(child) {
	        var name = child.name;
	        if (typeof this.children[name] === 'undefined') {
	            this.children[name] = child;
	            child.parent = this;
	        } else {
	            throw 'SceneGraph: child already exists: ' + name;
	        }
	    };

	    var RootNode = function() {
	        SceneNode.call(this, 'root');
	        this.properties = sceneProperties;
	    };

	    RootNode.prototype = new SceneNode();

	    var Shape = function(name, props) {
	        SceneNode.call(this, name);
	        this.properties = {
	            'fill': '#000000'
	        };
	        if (typeof props !== 'undefined') {
	            merge(this.properties, props);
	        } else if (typeof name !== 'undefined' && typeof name !== 'string') {
	            throw 'SceneGraph: invalid node name';
	        }
	    };

	    Shape.prototype = new SceneNode();

	    var Group = function() {
	        Shape.apply(this, arguments);
	        this.type = 'group';
	    };

	    Group.prototype = new Shape();

	    var Rect = function() {
	        Shape.apply(this, arguments);
	        this.type = 'rect';
	    };

	    Rect.prototype = new Shape();

	    var Text = function(text) {
	        Shape.call(this);
	        this.type = 'text';
	        this.properties.text = text;
	    };

	    Text.prototype = new Shape();

	    var root = new RootNode();

	    this.Shape = {
	        'Rect': Rect,
	        'Text': Text,
	        'Group': Group
	    };

	    this.root = root;
	    return this;
	};

	module.exports = SceneGraph;


/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

	/**
	 * Shallow object clone and merge
	 *
	 * @param a Object A
	 * @param b Object B
	 * @returns {Object} New object with all of A's properties, and all of B's properties, overwriting A's properties
	 */
	exports.extend = function(a, b) {
	    var c = {};
	    for (var x in a) {
	        if (a.hasOwnProperty(x)) {
	            c[x] = a[x];
	        }
	    }
	    if (b != null) {
	        for (var y in b) {
	            if (b.hasOwnProperty(y)) {
	                c[y] = b[y];
	            }
	        }
	    }
	    return c;
	};

	/**
	 * Takes a k/v list of CSS properties and returns a rule
	 *
	 * @param props CSS properties object
	 */
	exports.cssProps = function(props) {
	    var ret = [];
	    for (var p in props) {
	        if (props.hasOwnProperty(p)) {
	            ret.push(p + ':' + props[p]);
	        }
	    }
	    return ret.join(';');
	};

	/**
	 * Encodes HTML entities in a string
	 *
	 * @param str Input string
	 */
	exports.encodeHtmlEntity = function(str) {
	    var buf = [];
	    var charCode = 0;
	    for (var i = str.length - 1; i >= 0; i--) {
	        charCode = str.charCodeAt(i);
	        if (charCode > 128) {
	            buf.unshift(['&#', charCode, ';'].join(''));
	        } else {
	            buf.unshift(str[i]);
	        }
	    }
	    return buf.join('');
	};

	/**
	 * Checks if an image exists
	 *
	 * @param src URL of image
	 * @param callback Callback to call once image status has been found
	 */
	exports.imageExists = function(src, callback) {
	    var image = new Image();
	    image.onerror = function() {
	        callback.call(this, false);
	    };
	    image.onload = function() {
	        callback.call(this, true);
	    };
	    image.src = src;
	};

	/**
	 * Decodes HTML entities in a string
	 *
	 * @param str Input string
	 */
	exports.decodeHtmlEntity = function(str) {
	    return str.replace(/&#(\d+);/g, function(match, dec) {
	        return String.fromCharCode(dec);
	    });
	};


	/**
	 * Returns an element's dimensions if it's visible, `false` otherwise.
	 *
	 * @param el DOM element
	 */
	exports.dimensionCheck = function(el) {
	    var dimensions = {
	        height: el.clientHeight,
	        width: el.clientWidth
	    };

	    if (dimensions.height && dimensions.width) {
	        return dimensions;
	    } else {
	        return false;
	    }
	};


	/**
	 * Returns true if value is truthy or if it is "semantically truthy"
	 * @param val
	 */
	exports.truthy = function(val) {
	    if (typeof val === 'string') {
	        return val === 'true' || val === 'yes' || val === '1' || val === 'on' || val === '✓';
	    }
	    return !!val;
	};

	/**
	 * Parses input into a well-formed CSS color
	 * @param val
	 */
	exports.parseColor = function(val) {
	    var hexre = /(^(?:#?)[0-9a-f]{6}$)|(^(?:#?)[0-9a-f]{3}$)/i;
	    var rgbre = /^rgb\((\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)$/;
	    var rgbare = /^rgba\((\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0\.\d{1,}|1)\)$/;

	    var match = val.match(hexre);
	    var retval;

	    if (match !== null) {
	        retval = match[1] || match[2];
	        if (retval[0] !== '#') {
	            return '#' + retval;
	        } else {
	            return retval;
	        }
	    }

	    match = val.match(rgbre);

	    if (match !== null) {
	        retval = 'rgb(' + match.slice(1).join(',') + ')';
	        return retval;
	    }

	    match = val.match(rgbare);

	    if (match !== null) {
	        retval = 'rgba(' + match.slice(1).join(',') + ')';
	        return retval;
	    }

	    return null;
	};

/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {var DOM = __webpack_require__(7);

	var SVG_NS = 'http://www.w3.org/2000/svg';
	var NODE_TYPE_COMMENT = 8;

	/**
	 * Generic SVG element creation function
	 *
	 * @param svg SVG context, set to null if new
	 * @param width Document width
	 * @param height Document height
	 */
	exports.initSVG = function(svg, width, height) {
	    var defs, style, initialize = false;

	    if (svg && svg.querySelector) {
	        style = svg.querySelector('style');
	        if (style === null) {
	            initialize = true;
	        }
	    } else {
	        svg = DOM.newEl('svg', SVG_NS);
	        initialize = true;
	    }

	    if (initialize) {
	        defs = DOM.newEl('defs', SVG_NS);
	        style = DOM.newEl('style', SVG_NS);
	        DOM.setAttr(style, {
	            'type': 'text/css'
	        });
	        defs.appendChild(style);
	        svg.appendChild(defs);
	    }

	    //IE throws an exception if this is set and Chrome requires it to be set
	    if (svg.webkitMatchesSelector) {
	        svg.setAttribute('xmlns', SVG_NS);
	    }

	    //Remove comment nodes
	    for (var i = 0; i < svg.childNodes.length; i++) {
	        if (svg.childNodes[i].nodeType === NODE_TYPE_COMMENT) {
	            svg.removeChild(svg.childNodes[i]);
	        }
	    }

	    //Remove CSS
	    while (style.childNodes.length) {
	        style.removeChild(style.childNodes[0]);
	    }

	    DOM.setAttr(svg, {
	        'width': width,
	        'height': height,
	        'viewBox': '0 0 ' + width + ' ' + height,
	        'preserveAspectRatio': 'none'
	    });

	    return svg;
	};

	/**
	 * Converts serialized SVG to a string suitable for data URI use
	 * @param svgString Serialized SVG string
	 * @param [base64] Use base64 encoding for data URI
	 */
	exports.svgStringToDataURI = function() {
	    var rawPrefix = 'data:image/svg+xml;charset=UTF-8,';
	    var base64Prefix = 'data:image/svg+xml;charset=UTF-8;base64,';

	    return function(svgString, base64) {
	        if (base64) {
	            return base64Prefix + btoa(global.unescape(encodeURIComponent(svgString)));
	        } else {
	            return rawPrefix + encodeURIComponent(svgString);
	        }
	    };
	}();

	/**
	 * Returns serialized SVG with XML processing instructions
	 *
	 * @param svg SVG context
	 * @param stylesheets CSS stylesheets to include
	 */
	exports.serializeSVG = function(svg, engineSettings) {
	    if (!global.XMLSerializer) return;
	    var serializer = new XMLSerializer();
	    var svgCSS = '';
	    var stylesheets = engineSettings.stylesheets;

	    //External stylesheets: Processing Instruction method
	    if (engineSettings.svgXMLStylesheet) {
	        var xml = DOM.createXML();
	        //Add <?xml-stylesheet ?> directives
	        for (var i = stylesheets.length - 1; i >= 0; i--) {
	            var csspi = xml.createProcessingInstruction('xml-stylesheet', 'href="' + stylesheets[i] + '" rel="stylesheet"');
	            xml.insertBefore(csspi, xml.firstChild);
	        }

	        xml.removeChild(xml.documentElement);
	        svgCSS = serializer.serializeToString(xml);
	    }

	    var svgText = serializer.serializeToString(svg);
	    svgText = svgText.replace(/\&amp;(\#[0-9]{2,}\;)/g, '&$1');
	    return svgCSS + svgText;
	};

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ },
/* 7 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {/**
	 * Generic new DOM element function
	 *
	 * @param tag Tag to create
	 * @param namespace Optional namespace value
	 */
	exports.newEl = function(tag, namespace) {
	    if (!global.document) return;

	    if (namespace == null) {
	        return global.document.createElement(tag);
	    } else {
	        return global.document.createElementNS(namespace, tag);
	    }
	};

	/**
	 * Generic setAttribute function
	 *
	 * @param el Reference to DOM element
	 * @param attrs Object with attribute keys and values
	 */
	exports.setAttr = function (el, attrs) {
	    for (var a in attrs) {
	        el.setAttribute(a, attrs[a]);
	    }
	};

	/**
	 * Creates a XML document
	 * @private
	 */
	exports.createXML = function() {
	    if (!global.DOMParser) return;
	    return new DOMParser().parseFromString('<xml />', 'application/xml');
	};

	/**
	 * Converts a value into an array of DOM nodes
	 *
	 * @param val A string, a NodeList, a Node, or an HTMLCollection
	 */
	exports.getNodeArray = function(val) {
	    var retval = null;
	    if (typeof(val) == 'string') {
	        retval = document.querySelectorAll(val);
	    } else if (global.NodeList && val instanceof global.NodeList) {
	        retval = val;
	    } else if (global.Node && val instanceof global.Node) {
	        retval = [val];
	    } else if (global.HTMLCollection && val instanceof global.HTMLCollection) {
	        retval = val;
	    } else if (val instanceof Array) {
	        retval = val;
	    } else if (val === null) {
	        retval = [];
	    }

	    retval = Array.prototype.slice.call(retval);

	    return retval;
	};

	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ },
/* 8 */
/***/ function(module, exports, __webpack_require__) {

	var Color = function(color, options) {
	    //todo: support rgba, hsla, and rrggbbaa notation
	    //todo: use CIELAB internally
	    //todo: add clamp function (with sign)
	    if (typeof color !== 'string') return;

	    this.original = color;

	    if (color.charAt(0) === '#') {
	        color = color.slice(1);
	    }

	    if (/[^a-f0-9]+/i.test(color)) return;

	    if (color.length === 3) {
	        color = color.replace(/./g, '$&$&');
	    }

	    if (color.length !== 6) return;

	    this.alpha = 1;

	    if (options && options.alpha) {
	        this.alpha = options.alpha;
	    }

	    this.set(parseInt(color, 16));
	};

	//todo: jsdocs
	Color.rgb2hex = function(r, g, b) {
	    function format (decimal) {
	        var hex = (decimal | 0).toString(16);
	        if (decimal < 16) {
	            hex = '0' + hex;
	        }
	        return hex;
	    }

	    return [r, g, b].map(format).join('');
	};

	//todo: jsdocs
	Color.hsl2rgb = function (h, s, l) {
	    var H = h / 60;
	    var C = (1 - Math.abs(2 * l - 1)) * s;
	    var X = C * (1 - Math.abs(parseInt(H) % 2 - 1));
	    var m = l - (C / 2);

	    var r = 0, g = 0, b = 0;

	    if (H >= 0 && H < 1) {
	        r = C;
	        g = X;
	    } else if (H >= 1 && H < 2) {
	        r = X;
	        g = C;
	    } else if (H >= 2 && H < 3) {
	        g = C;
	        b = X;
	    } else if (H >= 3 && H < 4) {
	        g = X;
	        b = C;
	    } else if (H >= 4 && H < 5) {
	        r = X;
	        b = C;
	    } else if (H >= 5 && H < 6) {
	        r = C;
	        b = X;
	    }

	    r += m;
	    g += m;
	    b += m;

	    r = parseInt(r * 255);
	    g = parseInt(g * 255);
	    b = parseInt(b * 255);

	    return [r, g, b];
	};

	/**
	 * Sets the color from a raw RGB888 integer
	 * @param raw RGB888 representation of color
	 */
	//todo: refactor into a static method
	//todo: factor out individual color spaces
	//todo: add HSL, CIELAB, and CIELUV
	Color.prototype.set = function (val) {
	    this.raw = val;

	    var r = (this.raw & 0xFF0000) >> 16;
	    var g = (this.raw & 0x00FF00) >> 8;
	    var b = (this.raw & 0x0000FF);

	    // BT.709
	    var y = 0.2126 * r + 0.7152 * g + 0.0722 * b;
	    var u = -0.09991 * r - 0.33609 * g + 0.436 * b;
	    var v = 0.615 * r - 0.55861 * g - 0.05639 * b;

	    this.rgb = {
	        r: r,
	        g: g,
	        b: b
	    };

	    this.yuv = {
	        y: y,
	        u: u,
	        v: v
	    };

	    return this;
	};

	/**
	 * Lighten or darken a color
	 * @param multiplier Amount to lighten or darken (-1 to 1)
	 */
	Color.prototype.lighten = function(multiplier) {
	    var cm = Math.min(1, Math.max(0, Math.abs(multiplier))) * (multiplier < 0 ? -1 : 1);
	    var bm = (255 * cm) | 0;
	    var cr = Math.min(255, Math.max(0, this.rgb.r + bm));
	    var cg = Math.min(255, Math.max(0, this.rgb.g + bm));
	    var cb = Math.min(255, Math.max(0, this.rgb.b + bm));
	    var hex = Color.rgb2hex(cr, cg, cb);
	    return new Color(hex);
	};

	/**
	 * Output color in hex format
	 * @param addHash Add a hash character to the beginning of the output
	 */
	Color.prototype.toHex = function(addHash) {
	    return (addHash ? '#' : '') + this.raw.toString(16);
	};

	/**
	 * Returns whether or not current color is lighter than another color
	 * @param color Color to compare against
	 */
	Color.prototype.lighterThan = function(color) {
	    if (!(color instanceof Color)) {
	        color = new Color(color);
	    }

	    return this.yuv.y > color.yuv.y;
	};

	/**
	 * Returns the result of mixing current color with another color
	 * @param color Color to mix with
	 * @param multiplier How much to mix with the other color
	 */
	/*
	Color.prototype.mix = function (color, multiplier) {
	    if (!(color instanceof Color)) {
	        color = new Color(color);
	    }

	    var r = this.rgb.r;
	    var g = this.rgb.g;
	    var b = this.rgb.b;
	    var a = this.alpha;

	    var m = typeof multiplier !== 'undefined' ? multiplier : 0.5;

	    //todo: write a lerp function
	    r = r + m * (color.rgb.r - r);
	    g = g + m * (color.rgb.g - g);
	    b = b + m * (color.rgb.b - b);
	    a = a + m * (color.alpha - a);

	    return new Color(Color.rgbToHex(r, g, b), {
	        'alpha': a
	    });
	};
	*/

	/**
	 * Returns the result of blending another color on top of current color with alpha
	 * @param color Color to blend on top of current color, i.e. "Ca"
	 */
	//todo: see if .blendAlpha can be merged into .mix
	Color.prototype.blendAlpha = function(color) {
	    if (!(color instanceof Color)) {
	        color = new Color(color);
	    }

	    var Ca = color;
	    var Cb = this;

	    //todo: write alpha blending function
	    var r = Ca.alpha * Ca.rgb.r + (1 - Ca.alpha) * Cb.rgb.r;
	    var g = Ca.alpha * Ca.rgb.g + (1 - Ca.alpha) * Cb.rgb.g;
	    var b = Ca.alpha * Ca.rgb.b + (1 - Ca.alpha) * Cb.rgb.b;

	    return new Color(Color.rgb2hex(r, g, b));
	};

	module.exports = Color;


/***/ },
/* 9 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = {
	  'version': '2.8.2',
	  'svg_ns': 'http://www.w3.org/2000/svg'
	};

/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {var SVG = __webpack_require__(6);
	var DOM = __webpack_require__(7);
	var utils = __webpack_require__(5);
	var constants = __webpack_require__(9);

	var SVG_NS = constants.svg_ns;

	var generatorComment = '\n' +
	    'Created with Holder.js ' + constants.version + '.\n' +
	    'Learn more at http://holderjs.com\n' +
	    '(c) 2012-2015 Ivan Malopinsky - http://imsky.co\n';

	module.exports = (function() {
	    //Prevent IE <9 from initializing SVG renderer
	    if (!global.XMLSerializer) return;
	    var xml = DOM.createXML();
	    var svg = SVG.initSVG(null, 0, 0);
	    var bgEl = DOM.newEl('rect', SVG_NS);
	    svg.appendChild(bgEl);

	    //todo: create a reusable pool for textNodes, resize if more words present

	    return function(sceneGraph, renderSettings) {
	        var root = sceneGraph.root;

	        SVG.initSVG(svg, root.properties.width, root.properties.height);

	        var groups = svg.querySelectorAll('g');

	        for (var i = 0; i < groups.length; i++) {
	            groups[i].parentNode.removeChild(groups[i]);
	        }

	        var holderURL = renderSettings.holderSettings.flags.holderURL;
	        var holderId = 'holder_' + (Number(new Date()) + 32768 + (0 | Math.random() * 32768)).toString(16);
	        var sceneGroupEl = DOM.newEl('g', SVG_NS);
	        var textGroup = root.children.holderTextGroup;
	        var tgProps = textGroup.properties;
	        var textGroupEl = DOM.newEl('g', SVG_NS);
	        var tpdata = textGroup.textPositionData;
	        var textCSSRule = '#' + holderId + ' text { ' +
	            utils.cssProps({
	                'fill': tgProps.fill,
	                'font-weight': tgProps.font.weight,
	                'font-family': tgProps.font.family + ', monospace',
	                'font-size': tgProps.font.size + tgProps.font.units
	            }) + ' } ';
	        var commentNode = xml.createComment('\n' + 'Source URL: ' + holderURL + generatorComment);
	        var holderCSS = xml.createCDATASection(textCSSRule);
	        var styleEl = svg.querySelector('style');
	        var bg = root.children.holderBg;

	        DOM.setAttr(sceneGroupEl, {
	            id: holderId
	        });

	        svg.insertBefore(commentNode, svg.firstChild);
	        styleEl.appendChild(holderCSS);

	        sceneGroupEl.appendChild(bgEl);

	        //todo: abstract this into a cross-browser SVG outline method
	        if (bg.properties.outline) {
	            var outlineEl = DOM.newEl('path', SVG_NS);
	            var outlineWidth = bg.properties.outline.width;
	            var outlineOffsetWidth = outlineWidth / 2;
	            DOM.setAttr(outlineEl, {
	                'd': [
	                    'M', outlineOffsetWidth, outlineOffsetWidth,
	                    'H', bg.width - outlineOffsetWidth,
	                    'V', bg.height - outlineOffsetWidth,
	                    'H', outlineOffsetWidth,
	                    'V', 0,
	                    'M', 0, outlineOffsetWidth,
	                    'L', bg.width, bg.height - outlineOffsetWidth,
	                    'M', 0, bg.height - outlineOffsetWidth,
	                    'L', bg.width, outlineOffsetWidth
	                ].join(' '),
	                'stroke-width': bg.properties.outline.width,
	                'stroke': bg.properties.outline.fill,
	                'fill': 'none'
	            });
	            sceneGroupEl.appendChild(outlineEl);
	        }

	        sceneGroupEl.appendChild(textGroupEl);
	        svg.appendChild(sceneGroupEl);

	        DOM.setAttr(bgEl, {
	            'width': bg.width,
	            'height': bg.height,
	            'fill': bg.properties.fill
	        });

	        textGroup.y += tpdata.boundingBox.height * 0.8;

	        for (var lineKey in textGroup.children) {
	            var line = textGroup.children[lineKey];
	            for (var wordKey in line.children) {
	                var word = line.children[wordKey];
	                var x = textGroup.x + line.x + word.x;
	                var y = textGroup.y + line.y + word.y;

	                var textEl = DOM.newEl('text', SVG_NS);
	                var textNode = document.createTextNode(null);

	                DOM.setAttr(textEl, {
	                    'x': x,
	                    'y': y
	                });

	                textNode.nodeValue = word.properties.text;
	                textEl.appendChild(textNode);
	                textGroupEl.appendChild(textEl);
	            }
	        }

	        //todo: factor the background check up the chain, perhaps only return reference
	        var svgString = SVG.svgStringToDataURI(SVG.serializeSVG(svg, renderSettings.engineSettings), renderSettings.mode === 'background');
	        return svgString;
	    };
	})();
	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ },
/* 11 */
/***/ function(module, exports, __webpack_require__) {

	
	exports = module.exports = trim;

	function trim(str){
	  return str.replace(/^\s*|\s*$/g, '');
	}

	exports.left = function(str){
	  return str.replace(/^\s*/, '');
	};

	exports.right = function(str){
	  return str.replace(/\s*$/, '');
	};


/***/ },
/* 12 */
/***/ function(module, exports, __webpack_require__) {

	/**
	 * toString ref.
	 */

	var toString = Object.prototype.toString;

	/**
	 * Return the type of `val`.
	 *
	 * @param {Mixed} val
	 * @return {String}
	 * @api public
	 */

	module.exports = function(val){
	  switch (toString.call(val)) {
	    case '[object Date]': return 'date';
	    case '[object RegExp]': return 'regexp';
	    case '[object Arguments]': return 'arguments';
	    case '[object Array]': return 'array';
	    case '[object Error]': return 'error';
	  }

	  if (val === null) return 'null';
	  if (val === undefined) return 'undefined';
	  if (val !== val) return 'nan';
	  if (val && val.nodeType === 1) return 'element';

	  val = val.valueOf
	    ? val.valueOf()
	    : Object.prototype.valueOf.apply(val)

	  return typeof val;
	};


/***/ }
/******/ ])
});
;
(function(ctx, isMeteorPackage) {
    if (isMeteorPackage) {
        Holder = ctx.Holder;
    }
})(this, typeof Meteor !== 'undefined' && typeof Package !== 'undefined');

/*!
	Autosize 3.0.13
	license: MIT
	http://www.jacklmoore.com/autosize
*/
!function(e,t){if("function"==typeof define&&define.amd)define('jquery-autosize',["exports","module"],t);else if("undefined"!=typeof exports&&"undefined"!=typeof module)t(exports,module);else{var n={exports:{}};t(n.exports,n),e.autosize=n.exports}}(this,function(e,t){"use strict";function n(e){function t(){var t=window.getComputedStyle(e,null);c=t.overflowY,"vertical"===t.resize?e.style.resize="none":"both"===t.resize&&(e.style.resize="horizontal"),f="content-box"===t.boxSizing?-(parseFloat(t.paddingTop)+parseFloat(t.paddingBottom)):parseFloat(t.borderTopWidth)+parseFloat(t.borderBottomWidth),isNaN(f)&&(f=0),i()}function n(t){var n=e.style.width;e.style.width="0px",e.offsetWidth,e.style.width=n,c=t,u&&(e.style.overflowY=t),o()}function o(){var t=window.pageYOffset,n=document.body.scrollTop,o=e.style.height;e.style.height="auto";var i=e.scrollHeight+f;return 0===e.scrollHeight?void(e.style.height=o):(e.style.height=i+"px",v=e.clientWidth,document.documentElement.scrollTop=t,void(document.body.scrollTop=n))}function i(){var t=e.style.height;o();var i=window.getComputedStyle(e,null);if(i.height!==e.style.height?"visible"!==c&&n("visible"):"hidden"!==c&&n("hidden"),t!==e.style.height){var r=document.createEvent("Event");r.initEvent("autosize:resized",!0,!1),e.dispatchEvent(r)}}var d=void 0===arguments[1]?{}:arguments[1],s=d.setOverflowX,l=void 0===s?!0:s,a=d.setOverflowY,u=void 0===a?!0:a;if(e&&e.nodeName&&"TEXTAREA"===e.nodeName&&!r.has(e)){var f=null,c=null,v=e.clientWidth,p=function(){e.clientWidth!==v&&i()},h=function(t){window.removeEventListener("resize",p),e.removeEventListener("input",i),e.removeEventListener("keyup",i),e.removeEventListener("autosize:destroy",h),r["delete"](e),Object.keys(t).forEach(function(n){e.style[n]=t[n]})}.bind(e,{height:e.style.height,resize:e.style.resize,overflowY:e.style.overflowY,overflowX:e.style.overflowX,wordWrap:e.style.wordWrap});e.addEventListener("autosize:destroy",h),"onpropertychange"in e&&"oninput"in e&&e.addEventListener("keyup",i),window.addEventListener("resize",p),e.addEventListener("input",i),e.addEventListener("autosize:update",i),r.add(e),l&&(e.style.overflowX="hidden",e.style.wordWrap="break-word"),t()}}function o(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=document.createEvent("Event");t.initEvent("autosize:destroy",!0,!1),e.dispatchEvent(t)}}function i(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=document.createEvent("Event");t.initEvent("autosize:update",!0,!1),e.dispatchEvent(t)}}var r="function"==typeof Set?new Set:function(){var e=[];return{has:function(t){return Boolean(e.indexOf(t)>-1)},add:function(t){e.push(t)},"delete":function(t){e.splice(e.indexOf(t),1)}}}(),d=null;"undefined"==typeof window||"function"!=typeof window.getComputedStyle?(d=function(e){return e},d.destroy=function(e){return e},d.update=function(e){return e}):(d=function(e,t){return e&&Array.prototype.forEach.call(e.length?e:[e],function(e){return n(e,t)}),e},d.destroy=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],o),e},d.update=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],i),e}),t.exports=d});
define('modules/users/module',["angular","angular-couch-potato","angular-ui-router","angular-x-editable","angular-mocks","bootstrap-taginput","jasny-bootstrap-fileinput","holderjs","jquery-autosize"],function(a,b){"use strict";var c=a.module("app.users",["ui.router","xeditable"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){a.state("app.me",{url:"/me",data:{pageTitle:"Mi perfil",pageHeader:{icon:"fa fa-user",title:"Mi perfil",subtitle:"Mi Perfil"},breadcrumbs:[{title:"Mi Perfil"}]},resolve:{deps:b.resolveDependencies(["modules/users/controllers/MeCtrl"])},views:{"content@app":{templateUrl:function(a){return Routing.generate("secured_user_api_showme")},controller:"MeCtrl",resolve:{deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.pluginProdPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/angular-xeditable/dist/css/xeditable.css",d+"/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",d+"/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css",c+"/chosen_v1.2.0/chosen.min.css"]}])}]}}}})}]),c.run(["$couchPotato","editableOptions",function(a,b){c.lazy=a,b.theme="bs3"}]),c});
define('smart-templates',["angular"],function(){angular.module("smart-templates",[]).run(["$templateCache",function(a){a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-attribute-form.tpl.html",'<form id="attributeForm" class="form-horizontal"\n      data-bv-message="This value is not valid"\n      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"\n      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"\n      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">\n\n    <fieldset>\n        <legend>\n            Set validator options via HTML attributes\n        </legend>\n\n        <div class="alert alert-warning">\n            <code>&lt; input\n                data-bv-validatorname\n                data-bv-validatorname-validatoroption="..." / &gt;</code>\n\n            <br>\n            <br>\n            More validator options can be found here:\n            <a href="http://bootstrapvalidator.com/validators/" target="_blank">http://bootstrapvalidator.com/validators/</a>\n        </div>\n\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Full name</label>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="firstName" placeholder="First name"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The first name is required and cannot be empty" />\n            </div>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="lastName" placeholder="Last name"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The last name is required and cannot be empty" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Username</label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="username"\n                       data-bv-message="The username is not valid"\n\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The username is required and cannot be empty"\n\n                       data-bv-regexp="true"\n                       data-bv-regexp-regexp="^[a-zA-Z0-9_\\.]+$"\n                       data-bv-regexp-message="The username can only consist of alphabetical, number, dot and underscore"\n\n                       data-bv-stringlength="true"\n                       data-bv-stringlength-min="6"\n                       data-bv-stringlength-max="30"\n                       data-bv-stringlength-message="The username must be more than 6 and less than 30 characters long"\n\n                       data-bv-different="true"\n                       data-bv-different-field="password"\n                       data-bv-different-message="The username and password cannot be the same as each other" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Email address</label>\n            <div class="col-lg-5">\n                <input class="form-control" name="email" type="email"\n                       data-bv-emailaddress="true"\n                       data-bv-emailaddress-message="The input is not a valid email address" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Password</label>\n            <div class="col-lg-5">\n                <input type="password" class="form-control" name="password"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The password is required and cannot be empty"\n\n                       data-bv-identical="true"\n                       data-bv-identical-field="confirmPassword"\n                       data-bv-identical-message="The password and its confirm are not the same"\n\n                       data-bv-different="true"\n                       data-bv-different-field="username"\n                       data-bv-different-message="The password cannot be the same as username" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Retype password</label>\n            <div class="col-lg-5">\n                <input type="password" class="form-control" name="confirmPassword"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The confirm password is required and cannot be empty"\n\n                       data-bv-identical="true"\n                       data-bv-identical-field="password"\n                       data-bv-identical-message="The password and its confirm are not the same"\n\n                       data-bv-different="true"\n                       data-bv-different-field="username"\n                       data-bv-different-message="The password cannot be the same as username" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Languages</label>\n            <div class="col-lg-5">\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="english"\n                               data-bv-message="Please specify at least one language you can speak"\n                               data-bv-notempty="true" />\n                        English </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="french" />\n                        French </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="german" />\n                        German </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="russian" />\n                        Russian </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="other" />\n                        Other </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n     '),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-button-group-form.tpl.html",'<form id="buttonGroupForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Gender</label>\n            <div class="col-lg-9">\n                <div class="btn-group" data-toggle="buttons">\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="male" />\n                        Male </label>\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="female" />\n                        Female </label>\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="other" />\n                        Other </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Languages</label>\n            <div class="col-lg-9">\n                <div class="btn-group" data-toggle="buttons">\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="english" />\n                        English </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="german" />\n                        German </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="french" />\n                        French </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="russian" />\n                        Russian </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="italian">\n                        Italian </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-contact-form.tpl.html",'<form id="contactForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>Showing messages in custom area</legend>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Full name</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="fullName" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Email</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="email" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Title</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="title" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Content</label>\n            <div class="col-md-6">\n                <textarea class="form-control" name="content" rows="5"></textarea>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <!-- #messages is where the messages are placed inside -->\n        <div class="form-group">\n            <div class="col-md-9 col-md-offset-3">\n                <div id="messages"></div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-movie-form.tpl.html",'<form id="movieForm" method="post">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-md-8">\n                    <label class="control-label">Movie title</label>\n                    <input type="text" class="form-control" name="title" />\n                </div>\n\n                <div class="col-md-4 selectContainer">\n                    <label class="control-label">Genre</label>\n                    <select class="form-control" name="genre">\n                        <option value="">Choose a genre</option>\n                        <option value="action">Action</option>\n                        <option value="comedy">Comedy</option>\n                        <option value="horror">Horror</option>\n                        <option value="romance">Romance</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Director</label>\n                    <input type="text" class="form-control" name="director" />\n                </div>\n\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Writer</label>\n                    <input type="text" class="form-control" name="writer" />\n                </div>\n\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Producer</label>\n                    <input type="text" class="form-control" name="producer" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-sm-12 col-md-6">\n                    <label class="control-label">Website</label>\n                    <input type="text" class="form-control" name="website" />\n                </div>\n\n                <div class="col-sm-12 col-md-6">\n                    <label class="control-label">Youtube trailer</label>\n                    <input type="text" class="form-control" name="trailer" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="control-label">Review</label>\n            <textarea class="form-control" name="review" rows="8"></textarea>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n\n            <div class="row">\n                <div class="col-sm-12 col-md-12">\n                    <label class="control-label">Rating</label>\n                </div>\n\n                <div class="col-sm-12 col-md-10">\n\n                    <label class="radio radio-inline no-margin">\n                        <input type="radio" name="rating" value="terrible" class="radiobox style-2" />\n                        <span>Terrible</span> </label>\n\n                    <label class="radio radio-inline">\n                        <input type="radio" name="rating" value="watchable" class="radiobox style-2" />\n                        <span>Watchable</span> </label>\n                    <label class="radio radio-inline">\n                        <input type="radio" name="rating" value="best" class="radiobox style-2" />\n                        <span>Best ever</span> </label>\n\n                </div>\n\n            </div>\n\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n\n '),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-product-form.tpl.html",'<form id="productForm" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Price</label>\n            <div class="col-xs-9 col-lg-6 inputGroupContainer">\n                <div class="input-group">\n                    <input type="text" class="form-control" name="price" />\n                    <span class="input-group-addon">$</span>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Amount</label>\n            <div class="col-xs-9 col-lg-6 inputGroupContainer">\n                <div class="input-group">\n                    <span class="input-group-addon">&#8364;</span>\n                    <input type="text" class="form-control" name="amount" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Color</label>\n            <div class="col-xs-9 col-lg-6 selectContainer">\n                <select class="form-control" name="color">\n                    <option value="">Choose a color</option>\n                    <option value="blue">Blue</option>\n                    <option value="green">Green</option>\n                    <option value="red">Red</option>\n                    <option value="yellow">Yellow</option>\n                    <option value="white">White</option>\n                </select>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Size</label>\n            <div class="col-xs-9 col-lg-6 selectContainer">\n                <select class="form-control" name="size">\n                    <option value="">Choose a size</option>\n                    <option value="S">S</option>\n                    <option value="M">M</option>\n                    <option value="L">L</option>\n                    <option value="XL">XL</option>\n                </select>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>\n\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-profile-form.tpl.html",'<form id="profileForm">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label>Email address</label>\n            <input type="text" class="form-control" name="email" />\n        </div>\n    </fieldset>\n    <fieldset>\n        <div class="form-group">\n            <label>Password</label>\n            <input type="password" class="form-control" name="password" />\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-toggling-form.tpl.html",'<form id="togglingForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Full name <sup>*</sup></label>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="firstName" placeholder="First name" />\n            </div>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="lastName" placeholder="Last name" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Company <sup>*</sup></label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="company"\n                       required data-bv-notempty-message="The company name is required" />\n            </div>\n            <div class="col-lg-2">\n                <button type="button" class="btn btn-info btn-sm" data-toggle="#jobInfo">\n                    Add more info\n                </button>\n            </div>\n        </div>\n    </fieldset>\n\n    <!-- These fields will not be validated as long as they are not visible -->\n    <div id="jobInfo" style="display: none;">\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Job title <sup>*</sup></label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="job" />\n                </div>\n            </div>\n        </fieldset>\n\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Department <sup>*</sup></label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="department" />\n                </div>\n            </div>\n        </fieldset>\n    </div>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Mobile phone <sup>*</sup></label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="mobilePhone" />\n            </div>\n            <div class="col-lg-2">\n                <button type="button" class="btn btn-info btn-sm" data-toggle="#phoneInfo">\n                    Add more phone numbers\n                </button>\n            </div>\n        </div>\n    </fieldset>\n    <!-- These fields will not be validated as long as they are not visible -->\n    <div id="phoneInfo" style="display: none;">\n\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Home phone</label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="homePhone" />\n                </div>\n            </div>\n        </fieldset>\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Office phone</label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="officePhone" />\n                </div>\n            </div>\n        </fieldset>\n    </div>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-checkout-form.tpl.html",'<form id="checkout-form" class="smart-form" novalidate="novalidate">\n\n<fieldset>\n    <div class="row">\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-user"></i>\n                <input type="text" name="fname" placeholder="First name">\n            </label>\n        </section>\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-user"></i>\n                <input type="text" name="lname" placeholder="Last name">\n            </label>\n        </section>\n    </div>\n\n    <div class="row">\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>\n                <input type="email" name="email" placeholder="E-mail">\n            </label>\n        </section>\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-phone"></i>\n                <input type="tel" name="phone" placeholder="Phone" data-smart-masked-input="(999) 999-9999">\n            </label>\n        </section>\n    </div>\n</fieldset>\n\n<fieldset>\n<div class="row">\n<section class="col col-5">\n<label class="select">\n<select name="country">\n<option value="0" selected="" disabled="">Country</option>\n    <option value="{{country.key}}" ng-repeat="country in countries" >{{country.value}}</option>\n</select> <i></i> </label>\n</section>\n\n<section class="col col-4">\n    <label class="input">\n        <input type="text" name="city" placeholder="City">\n    </label>\n</section>\n\n<section class="col col-3">\n    <label class="input">\n        <input type="text" name="code" placeholder="Post code">\n    </label>\n</section>\n</div>\n\n<section>\n    <label for="address2" class="input">\n        <input type="text" name="address2" id="address2" placeholder="Address">\n    </label>\n</section>\n\n<section>\n    <label class="textarea">\n        <textarea rows="3" name="info" placeholder="Additional info"></textarea>\n    </label>\n</section>\n</fieldset>\n\n<fieldset>\n    <section>\n        <div class="inline-group">\n            <label class="radio">\n                <input type="radio" name="radio-inline" checked="">\n                <i></i>Visa</label>\n            <label class="radio">\n                <input type="radio" name="radio-inline">\n                <i></i>MasterCard</label>\n            <label class="radio">\n                <input type="radio" name="radio-inline">\n                <i></i>American Express</label>\n        </div>\n    </section>\n\n    <section>\n        <label class="input">\n            <input type="text" name="name" placeholder="Name on card">\n        </label>\n    </section>\n\n    <div class="row">\n        <section class="col col-10">\n            <label class="input">\n                <input type="text" name="card" placeholder="Card number" data-mask="9999-9999-9999-9999">\n            </label>\n        </section>\n        <section class="col col-2">\n            <label class="input">\n                <input type="text" name="cvv" placeholder="CVV2" data-mask="999">\n            </label>\n        </section>\n    </div>\n\n    <div class="row">\n        <label class="label col col-4">Expiration date</label>\n        <section class="col col-5">\n            <label class="select">\n                <select name="month">\n                    <option value="0" selected="" disabled="">Month</option>\n                    <option value="1">January</option>\n                    <option value="1">February</option>\n                    <option value="3">March</option>\n                    <option value="4">April</option>\n                    <option value="5">May</option>\n                    <option value="6">June</option>\n                    <option value="7">July</option>\n                    <option value="8">August</option>\n                    <option value="9">September</option>\n                    <option value="10">October</option>\n                    <option value="11">November</option>\n                    <option value="12">December</option>\n                </select> <i></i> </label>\n        </section>\n        <section class="col col-3">\n            <label class="input">\n                <input type="text" name="year" placeholder="Year" data-mask="2099">\n            </label>\n        </section>\n    </div>\n</fieldset>\n\n<footer>\n    <button type="submit" class="btn btn-primary">\n        Validate Form\n    </button>\n</footer>\n</form>\n'),a.put("build/modules/forms/directives/form-layouts/smart-comment-form.tpl.html",'<form action="/api/plug" method="post" id="comment-form" class="smart-form">\n    <header>\n        Comment form\n    </header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-4">\n                <label class="label">Name</label>\n                <label class="input"> <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name">\n                </label>\n            </section>\n            <section class="col col-4">\n                <label class="label">E-mail</label>\n                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email">\n                </label>\n            </section>\n            <section class="col col-4">\n                <label class="label">Website</label>\n                <label class="input"> <i class="icon-append fa fa-globe"></i>\n                    <input type="url" name="url">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="label">Comment</label>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i> <textarea rows="4"\n                                                                                         name="comment"></textarea>\n            </label>\n\n            <div class="note">\n                You may use these HTML tags and attributes: &lt;a href="" title=""&gt;, &lt;abbr title=""&gt;,\n                &lt;acronym title=""&gt;, &lt;b&gt;, &lt;blockquote cite=""&gt;, &lt;cite&gt;, &lt;code&gt;,\n                &lt;del datetime=""&gt;, &lt;em&gt;, &lt;i&gt;, &lt;q cite=""&gt;, &lt;strike&gt;, &lt;strong&gt;.\n            </div>\n        </section>\n    </fieldset>\n\n    <footer>\n        <button type="submit" name="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n\n    <div class="message">\n        <i class="fa fa-check fa-lg"></i>\n\n        <p>\n            Your comment was successfully added!\n        </p>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-contacts-form.tpl.html",'<form action="/api/plug" method="post" id="contact-form" class="smart-form">\n    <header>Contacts form</header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="label">Name</label>\n                <label class="input">\n                    <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name" id="named">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="label">E-mail</label>\n                <label class="input">\n                    <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email" id="emaild">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="label">Subject</label>\n            <label class="input">\n                <i class="icon-append fa fa-tag"></i>\n                <input type="text" name="subject" id="subject">\n            </label>\n        </section>\n\n        <section>\n            <label class="label">Message</label>\n            <label class="textarea">\n                <i class="icon-append fa fa-comment"></i>\n                <textarea rows="4" name="message" id="message"></textarea>\n            </label>\n        </section>\n\n        <section>\n            <label class="checkbox"><input type="checkbox" name="copy" id="copy"><i></i>Send a copy to my\n                e-mail address</label>\n        </section>\n    </fieldset>\n\n    <footer>\n        <button type="submit" class="btn btn-primary">Validate Form</button>\n    </footer>\n\n    <div class="message">\n        <i class="fa fa-thumbs-up"></i>\n\n        <p>Your message was successfully sent!</p>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-order-form.tpl.html",'<form id="order-form" class="smart-form" novalidate="novalidate">\n    <header>\n        Order services\n    </header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name" placeholder="Name">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-briefcase"></i>\n                    <input type="text" name="company" placeholder="Company">\n                </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email" placeholder="E-mail">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-phone"></i>\n                    <input type="tel" name="phone" placeholder="Phone" data-smart-masked-input="(999) 999-9999">\n                </label>\n            </section>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="select">\n                    <select name="interested">\n                        <option value="0" selected="" disabled="">Interested in</option>\n                        <option value="1">design</option>\n                        <option value="1">development</option>\n                        <option value="2">illustration</option>\n                        <option value="2">branding</option>\n                        <option value="3">video</option>\n                    </select> <i></i> </label>\n            </section>\n            <section class="col col-6">\n                <label class="select">\n                    <select name="budget">\n                        <option value="0" selected="" disabled="">Budget</option>\n                        <option value="1">less than 5000$</option>\n                        <option value="2">5000$ - 10000$</option>\n                        <option value="3">10000$ - 20000$</option>\n                        <option value="4">more than 20000$</option>\n                    </select> <i></i> </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="startdate" id="startdate" data-smart-datepicker data-min-restrict="#finishdate" placeholder="Expected start date">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="finishdate" id="finishdate" data-smart-datepicker data-max-restrict="#startdate" placeholder="Expected finish date">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <div class="input input-file">\n                            <span class="button"><input id="file2" type="file" name="file2"\n                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input\n                    type="text" placeholder="Include some files" readonly="">\n            </div>\n        </section>\n\n        <section>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i>\n                <textarea rows="5" name="comment" placeholder="Tell us about your project"></textarea>\n            </label>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>\n'),
a.put("build/modules/forms/directives/form-layouts/smart-registration-form.tpl.html",'<form id="smart-form-register" class="smart-form">\n    <header>\n        Registration form\n    </header>\n\n    <fieldset>\n        <section>\n            <label class="input"> <i class="icon-append fa fa-user"></i>\n                <input type="text" name="username" placeholder="Username">\n                <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>\n        </section>\n\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                <input type="email" name="email" placeholder="Email address">\n                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-lock"></i>\n                <input type="password" name="password" placeholder="Password" id="password">\n                <b class="tooltip tooltip-bottom-right">Don\'t forget your password</b> </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-lock"></i>\n                <input type="password" name="passwordConfirm" placeholder="Confirm password">\n                <b class="tooltip tooltip-bottom-right">Don\'t forget your password</b> </label>\n        </section>\n    </fieldset>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="input">\n                    <input type="text" name="firstname" placeholder="First name">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input">\n                    <input type="text" name="lastname" placeholder="Last name">\n                </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="select">\n                    <select name="gender">\n                        <option value="0" selected="" disabled="">Gender</option>\n                        <option value="1">Male</option>\n                        <option value="2">Female</option>\n                        <option value="3">Prefer not to answer</option>\n                    </select> <i></i> </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="request" placeholder="Request activation on"\n                           data-smart-datepicker data-dateformat=\'dd/mm/yy\'>\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="checkbox">\n                <input type="checkbox" name="subscription" id="subscription">\n                <i></i>I want to receive news and special offers</label>\n            <label class="checkbox">\n                <input type="checkbox" name="terms" id="terms">\n                <i></i>I agree with the Terms and Conditions</label>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-review-form.tpl.html",'<form id="review-form" class="smart-form">\n    <header>\n        Review form\n    </header>\n\n    <fieldset>\n        <section>\n            <label class="input"> <i class="icon-append fa fa-user"></i>\n                <input type="text" name="name" id="name" placeholder="Your name">\n            </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                <input type="email" name="email" id="email" placeholder="Your e-mail">\n            </label>\n        </section>\n\n        <section>\n            <label class="label"></label>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i>\n                <textarea rows="3" name="review" id="review" placeholder="Text of the review"></textarea>\n            </label>\n        </section>\n\n        <section>\n            <div class="rating">\n                <input type="radio" name="quality" id="quality-5">\n                <label for="quality-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-4">\n                <label for="quality-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-3">\n                <label for="quality-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-2">\n                <label for="quality-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-1">\n                <label for="quality-1"><i class="fa fa-star"></i></label>\n                Quality of the product\n            </div>\n\n            <div class="rating">\n                <input type="radio" name="reliability" id="reliability-5">\n                <label for="reliability-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-4">\n                <label for="reliability-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-3">\n                <label for="reliability-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-2">\n                <label for="reliability-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-1">\n                <label for="reliability-1"><i class="fa fa-star"></i></label>\n                Reliability of the product\n            </div>\n\n            <div class="rating">\n                <input type="radio" name="overall" id="overall-5">\n                <label for="overall-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-4">\n                <label for="overall-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-3">\n                <label for="overall-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-2">\n                <label for="overall-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-1">\n                <label for="overall-1"><i class="fa fa-star"></i></label>\n                Overall rating\n            </div>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>')}])});
define('includes',["auth/module","auth/models/User","auth/directives/loginInfo","auth/directives/loginInfoLine","layout/module","layout/directives/smartRouterAnimationWrap","scripts/config","scripts/controllers","scripts/directives","scripts/modules/dashboard","multiacademico/multiacademico","multiacademico/estudiantes/module","multiacademico/materias/module","multiacademico/periodo/module","multiacademico/cursos/module","multiacademico/distributivos/module","multiacademico/especializaciones/module","multiacademico/proyectosescolares/module","multiacademico/docentes/calificar/module","multiacademico/docentes/calificar/factory/CalificarForm","multiacademico/reportes/malla/module","multiacademico/informes/module","modules/forms/module","modules/forms/models/FormsCrud","modules/users/module","smart-templates"],function(){"use strict"});
window.name="NG_DEFER_BOOTSTRAP!",define('main',["require","jquery","angular","domReady","bootstrap","app","includes"],function(a,b,c,d){"use strict";d(function(a){c.bootstrap(a,["app"]),c.resumeBootstrap()})});

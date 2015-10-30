define('app',["angular","angular-couch-potato","angular-ui-router","angular-animate","angular-sanitize","angular-bootstrap","angular-loading-bar","oc-lazyload"],function(a,b){var c=a.module("app",["ngSanitize","ngAnimate","oc.lazyLoad","scs.couch-potato","ui.router","ui.bootstrap","angular-loading-bar","blankonConfig","blankonController","blankonDirective","app.auth","app.dashboard","app.users","app.layout","app.forms","multiacademico","multiacademico.estudiantes","multiacademico.docentes.midistributivo","multiacademico.proyectosescolares","multiacademico.cursos","multiacademico.distributivos","multiacademico.malla","multiacademico.especializaciones","multiacademico.informes","multiacademico.materias","smart-templates"]);return b.configureApp(c),c.config(["$provide","$httpProvider","$locationProvider",function(a,b,c){c.html5Mode(!0),b.defaults.headers.common["X-Requested-With"]="XMLHttpRequest",a.factory("ErrorHttpInterceptor",["$q",function(a){function b(a){console.log(a)}return{requestError:function(c){return b(c),a.reject(c)},responseError:function(c){return b(c),a.reject(c)}}}]),b.interceptors.push("ErrorHttpInterceptor")}]),c.run(["$couchPotato","$rootScope","$state","$stateParams",function(a,b,d,e){c.lazy=a,b.$state=d,b.$stateParams=e}]),c});
define('auth/module',["angular","angular-couch-potato","angular-ui-router","angular-google-plus","angular-easyfb"],function(a,b){"use strict";var c=a.module("app.auth",["ui.router","ezfb","googleplus"]);b.configureApp(c);return c.config(["$stateProvider","$couchPotatoProvider",function(a,b){a.state("realLogin",{url:"/real-login",views:{root:{templateUrl:"build/auth/login/login.html",controller:"LoginCtrl",resolve:{deps:b.resolveDependencies(["auth/models/User","auth/directives/loginInfo","auth/login/LoginCtrl","auth/login/directives/facebookSignin","auth/login/directives/googleSignin"])}}},data:{title:"Login",rootId:"extra-page"}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
define('auth/models/User',["auth/module"],function(a){"use strict";return a.registerFactory("User",["$http","$q","$browser",function(a,b,c){var d=b.defer(),e={initialized:d.promise,username:void 0,picture:void 0};return a.get(Routing.generate("api_user",{_format:"json"})).then(function(a){e.username=a.data.username;var b=c.baseHref();b=b.replace("app_dev.php/",""),e.picture=b+a.data.picture,e.cargo=a.data.cargo,d.resolve(e)}),e}])});
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

/*!
 * Jasny Bootstrap v3.1.0 (http://jasny.github.com/bootstrap)
 * Copyright 2011-2014 Arnold Daniels.
 * Licensed under Apache-2.0 (https://github.com/jasny/bootstrap/blob/master/LICENSE)
 */

+function(a){"use strict";var b=window.navigator.appName=="Microsoft Internet Explorer",c=function(b,c){this.$element=a(b),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||c.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=a('<input type="hidden">').insertBefore(this.$input)),this.$preview=this.$element.find(".fileinput-preview");var d=this.$preview.css("height");this.$preview.css("display")!=="inline"&&d!=="0px"&&d!=="none"&&this.$preview.css("line-height",d),this.original={exists:this.$element.hasClass("fileinput-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.listen()};c.prototype.listen=function(){this.$input.on("change.bs.fileinput",a.proxy(this.change,this)),a(this.$input[0].form).on("reset.bs.fileinput",a.proxy(this.reset,this)),this.$element.find('[data-trigger="fileinput"]').on("click.bs.fileinput",a.proxy(this.trigger,this)),this.$element.find('[data-dismiss="fileinput"]').on("click.bs.fileinput",a.proxy(this.clear,this))},c.prototype.change=function(b){var c=b.target.files===undefined?b.target&&b.target.value?[{name:b.target.value.replace(/^.+\\/,"")}]:[]:b.target.files;b.stopPropagation();if(c.length===0){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);var d=c[0];if(this.$preview.length>0&&(typeof d.type!="undefined"?d.type.match(/^image\/(gif|png|jpeg)$/):d.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var e=new FileReader,f=this.$preview,g=this.$element;e.onload=function(b){var e=a("<img>");e[0].src=b.target.result,c[0].result=b.target.result,g.find(".fileinput-filename").text(d.name),f.css("max-height")!="none"&&e.css("max-height",parseInt(f.css("max-height"),10)-parseInt(f.css("padding-top"),10)-parseInt(f.css("padding-bottom"),10)-parseInt(f.css("border-top"),10)-parseInt(f.css("border-bottom"),10)),f.html(e),g.addClass("fileinput-exists").removeClass("fileinput-new"),g.trigger("change.bs.fileinput",c)},e.readAsDataURL(d)}else this.$element.find(".fileinput-filename").text(d.name),this.$preview.text(d.name),this.$element.addClass("fileinput-exists").removeClass("fileinput-new"),this.$element.trigger("change.bs.fileinput")},c.prototype.clear=function(a){a&&a.preventDefault(),this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(b){var c=this.$input.clone(!0);this.$input.after(c),this.$input.remove(),this.$input=c}else this.$input.val("");this.$preview.html(""),this.$element.find(".fileinput-filename").text(""),this.$element.addClass("fileinput-new").removeClass("fileinput-exists"),a!==undefined&&(this.$input.trigger("change"),this.$element.trigger("clear.bs.fileinput"))},c.prototype.reset=function(){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.$element.find(".fileinput-filename").text(""),this.original.exists?this.$element.addClass("fileinput-exists").removeClass("fileinput-new"):this.$element.addClass("fileinput-new").removeClass("fileinput-exists"),this.$element.trigger("reset.bs.fileinput")},c.prototype.trigger=function(a){this.$input.trigger("click"),a.preventDefault()};var d=a.fn.fileinput;a.fn.fileinput=function(b){return this.each(function(){var d=a(this),e=d.data("bs.fileinput");e||d.data("bs.fileinput",e=new c(this,b)),typeof b=="string"&&e[b]()})},a.fn.fileinput.Constructor=c,a.fn.fileinput.noConflict=function(){return a.fn.fileinput=d,this},a(document).on("click.fileinput.data-api",'[data-provides="fileinput"]',function(b){var c=a(this);if(c.data("bs.fileinput"))return;c.fileinput(c.data());var d=a(b.target).closest('[data-dismiss="fileinput"],[data-trigger="fileinput"]');d.length>0&&(b.preventDefault(),d.trigger("click.bs.fileinput"))})}(window.jQuery);
define("jasny-bootstrap-fileinput", ["bootstrap"], function(){});

/*!
	Autosize 3.0.13
	license: MIT
	http://www.jacklmoore.com/autosize
*/
!function(e,t){if("function"==typeof define&&define.amd)define('jquery-autosize',["exports","module"],t);else if("undefined"!=typeof exports&&"undefined"!=typeof module)t(exports,module);else{var n={exports:{}};t(n.exports,n),e.autosize=n.exports}}(this,function(e,t){"use strict";function n(e){function t(){var t=window.getComputedStyle(e,null);c=t.overflowY,"vertical"===t.resize?e.style.resize="none":"both"===t.resize&&(e.style.resize="horizontal"),f="content-box"===t.boxSizing?-(parseFloat(t.paddingTop)+parseFloat(t.paddingBottom)):parseFloat(t.borderTopWidth)+parseFloat(t.borderBottomWidth),isNaN(f)&&(f=0),i()}function n(t){var n=e.style.width;e.style.width="0px",e.offsetWidth,e.style.width=n,c=t,u&&(e.style.overflowY=t),o()}function o(){var t=window.pageYOffset,n=document.body.scrollTop,o=e.style.height;e.style.height="auto";var i=e.scrollHeight+f;return 0===e.scrollHeight?void(e.style.height=o):(e.style.height=i+"px",v=e.clientWidth,document.documentElement.scrollTop=t,void(document.body.scrollTop=n))}function i(){var t=e.style.height;o();var i=window.getComputedStyle(e,null);if(i.height!==e.style.height?"visible"!==c&&n("visible"):"hidden"!==c&&n("hidden"),t!==e.style.height){var r=document.createEvent("Event");r.initEvent("autosize:resized",!0,!1),e.dispatchEvent(r)}}var d=void 0===arguments[1]?{}:arguments[1],s=d.setOverflowX,l=void 0===s?!0:s,a=d.setOverflowY,u=void 0===a?!0:a;if(e&&e.nodeName&&"TEXTAREA"===e.nodeName&&!r.has(e)){var f=null,c=null,v=e.clientWidth,p=function(){e.clientWidth!==v&&i()},h=function(t){window.removeEventListener("resize",p),e.removeEventListener("input",i),e.removeEventListener("keyup",i),e.removeEventListener("autosize:destroy",h),r["delete"](e),Object.keys(t).forEach(function(n){e.style[n]=t[n]})}.bind(e,{height:e.style.height,resize:e.style.resize,overflowY:e.style.overflowY,overflowX:e.style.overflowX,wordWrap:e.style.wordWrap});e.addEventListener("autosize:destroy",h),"onpropertychange"in e&&"oninput"in e&&e.addEventListener("keyup",i),window.addEventListener("resize",p),e.addEventListener("input",i),e.addEventListener("autosize:update",i),r.add(e),l&&(e.style.overflowX="hidden",e.style.wordWrap="break-word"),t()}}function o(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=document.createEvent("Event");t.initEvent("autosize:destroy",!0,!1),e.dispatchEvent(t)}}function i(e){if(e&&e.nodeName&&"TEXTAREA"===e.nodeName){var t=document.createEvent("Event");t.initEvent("autosize:update",!0,!1),e.dispatchEvent(t)}}var r="function"==typeof Set?new Set:function(){var e=[];return{has:function(t){return Boolean(e.indexOf(t)>-1)},add:function(t){e.push(t)},"delete":function(t){e.splice(e.indexOf(t),1)}}}(),d=null;"undefined"==typeof window||"function"!=typeof window.getComputedStyle?(d=function(e){return e},d.destroy=function(e){return e},d.update=function(e){return e}):(d=function(e,t){return e&&Array.prototype.forEach.call(e.length?e:[e],function(e){return n(e,t)}),e},d.destroy=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],o),e},d.update=function(e){return e&&Array.prototype.forEach.call(e.length?e:[e],i),e}),t.exports=d});
define('modules/users/module',["angular","angular-couch-potato","angular-ui-router","angular-x-editable","angular-mocks","jasny-bootstrap-fileinput","jquery-autosize"],function(a,b){"use strict";var c=a.module("app.users",["ui.router","xeditable"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){a.state("app.me",{url:"/me",data:{pageTitle:"Mi perfil",pageHeader:{icon:"fa fa-user",title:"Mi perfil",subtitle:"Mi Perfil"},breadcrumbs:[{title:"Mi Perfil"}]},resolve:{deps:b.resolveDependencies(["modules/users/controllers/MeCtrl","modules/users/directives/loadingspiner"])},views:{"content@app":{templateUrl:function(a){return Routing.generate("secured_user_api_showme")},controller:"MeCtrl",resolve:{deps2:["$ocLazyLoad","settings",function(a,b){var c=b.pluginPath,d=b.pluginProdPath;return a.load([{insertBefore:"#load_css_before",files:[c+"/angular-xeditable/dist/css/xeditable.css",d+"/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",d+"/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css",c+"/chosen_v1.2.0/chosen.min.css"]}])}]}}}})}]),c.run(["$couchPotato","editableOptions",function(a,b){c.lazy=a,b.theme="bs3"}]),c});
define('smart-templates',["angular"],function(){angular.module("smart-templates",[]).run(["$templateCache",function(a){a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-attribute-form.tpl.html",'<form id="attributeForm" class="form-horizontal"\n      data-bv-message="This value is not valid"\n      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"\n      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"\n      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">\n\n    <fieldset>\n        <legend>\n            Set validator options via HTML attributes\n        </legend>\n\n        <div class="alert alert-warning">\n            <code>&lt; input\n                data-bv-validatorname\n                data-bv-validatorname-validatoroption="..." / &gt;</code>\n\n            <br>\n            <br>\n            More validator options can be found here:\n            <a href="http://bootstrapvalidator.com/validators/" target="_blank">http://bootstrapvalidator.com/validators/</a>\n        </div>\n\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Full name</label>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="firstName" placeholder="First name"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The first name is required and cannot be empty" />\n            </div>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="lastName" placeholder="Last name"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The last name is required and cannot be empty" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Username</label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="username"\n                       data-bv-message="The username is not valid"\n\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The username is required and cannot be empty"\n\n                       data-bv-regexp="true"\n                       data-bv-regexp-regexp="^[a-zA-Z0-9_\\.]+$"\n                       data-bv-regexp-message="The username can only consist of alphabetical, number, dot and underscore"\n\n                       data-bv-stringlength="true"\n                       data-bv-stringlength-min="6"\n                       data-bv-stringlength-max="30"\n                       data-bv-stringlength-message="The username must be more than 6 and less than 30 characters long"\n\n                       data-bv-different="true"\n                       data-bv-different-field="password"\n                       data-bv-different-message="The username and password cannot be the same as each other" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Email address</label>\n            <div class="col-lg-5">\n                <input class="form-control" name="email" type="email"\n                       data-bv-emailaddress="true"\n                       data-bv-emailaddress-message="The input is not a valid email address" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Password</label>\n            <div class="col-lg-5">\n                <input type="password" class="form-control" name="password"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The password is required and cannot be empty"\n\n                       data-bv-identical="true"\n                       data-bv-identical-field="confirmPassword"\n                       data-bv-identical-message="The password and its confirm are not the same"\n\n                       data-bv-different="true"\n                       data-bv-different-field="username"\n                       data-bv-different-message="The password cannot be the same as username" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Retype password</label>\n            <div class="col-lg-5">\n                <input type="password" class="form-control" name="confirmPassword"\n                       data-bv-notempty="true"\n                       data-bv-notempty-message="The confirm password is required and cannot be empty"\n\n                       data-bv-identical="true"\n                       data-bv-identical-field="password"\n                       data-bv-identical-message="The password and its confirm are not the same"\n\n                       data-bv-different="true"\n                       data-bv-different-field="username"\n                       data-bv-different-message="The password cannot be the same as username" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Languages</label>\n            <div class="col-lg-5">\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="english"\n                               data-bv-message="Please specify at least one language you can speak"\n                               data-bv-notempty="true" />\n                        English </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="french" />\n                        French </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="german" />\n                        German </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="russian" />\n                        Russian </label>\n                </div>\n                <div class="checkbox">\n                    <label>\n                        <input type="checkbox" name="languages[]" value="other" />\n                        Other </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n     '),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-button-group-form.tpl.html",'<form id="buttonGroupForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Gender</label>\n            <div class="col-lg-9">\n                <div class="btn-group" data-toggle="buttons">\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="male" />\n                        Male </label>\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="female" />\n                        Female </label>\n                    <label class="btn btn-default">\n                        <input type="radio" name="gender" value="other" />\n                        Other </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Languages</label>\n            <div class="col-lg-9">\n                <div class="btn-group" data-toggle="buttons">\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="english" />\n                        English </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="german" />\n                        German </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="french" />\n                        French </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="russian" />\n                        Russian </label>\n                    <label class="btn btn-default">\n                        <input type="checkbox" name="languages[]" value="italian">\n                        Italian </label>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-contact-form.tpl.html",'<form id="contactForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>Showing messages in custom area</legend>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Full name</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="fullName" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Email</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="email" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Title</label>\n            <div class="col-md-6">\n                <input type="text" class="form-control" name="title" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-md-3 control-label">Content</label>\n            <div class="col-md-6">\n                <textarea class="form-control" name="content" rows="5"></textarea>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <!-- #messages is where the messages are placed inside -->\n        <div class="form-group">\n            <div class="col-md-9 col-md-offset-3">\n                <div id="messages"></div>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-movie-form.tpl.html",'<form id="movieForm" method="post">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-md-8">\n                    <label class="control-label">Movie title</label>\n                    <input type="text" class="form-control" name="title" />\n                </div>\n\n                <div class="col-md-4 selectContainer">\n                    <label class="control-label">Genre</label>\n                    <select class="form-control" name="genre">\n                        <option value="">Choose a genre</option>\n                        <option value="action">Action</option>\n                        <option value="comedy">Comedy</option>\n                        <option value="horror">Horror</option>\n                        <option value="romance">Romance</option>\n                    </select>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Director</label>\n                    <input type="text" class="form-control" name="director" />\n                </div>\n\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Writer</label>\n                    <input type="text" class="form-control" name="writer" />\n                </div>\n\n                <div class="col-sm-12 col-md-4">\n                    <label class="control-label">Producer</label>\n                    <input type="text" class="form-control" name="producer" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <div class="row">\n                <div class="col-sm-12 col-md-6">\n                    <label class="control-label">Website</label>\n                    <input type="text" class="form-control" name="website" />\n                </div>\n\n                <div class="col-sm-12 col-md-6">\n                    <label class="control-label">Youtube trailer</label>\n                    <input type="text" class="form-control" name="trailer" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="control-label">Review</label>\n            <textarea class="form-control" name="review" rows="8"></textarea>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n\n            <div class="row">\n                <div class="col-sm-12 col-md-12">\n                    <label class="control-label">Rating</label>\n                </div>\n\n                <div class="col-sm-12 col-md-10">\n\n                    <label class="radio radio-inline no-margin">\n                        <input type="radio" name="rating" value="terrible" class="radiobox style-2" />\n                        <span>Terrible</span> </label>\n\n                    <label class="radio radio-inline">\n                        <input type="radio" name="rating" value="watchable" class="radiobox style-2" />\n                        <span>Watchable</span> </label>\n                    <label class="radio radio-inline">\n                        <input type="radio" name="rating" value="best" class="radiobox style-2" />\n                        <span>Best ever</span> </label>\n\n                </div>\n\n            </div>\n\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n\n</form>\n\n '),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-product-form.tpl.html",'<form id="productForm" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Price</label>\n            <div class="col-xs-9 col-lg-6 inputGroupContainer">\n                <div class="input-group">\n                    <input type="text" class="form-control" name="price" />\n                    <span class="input-group-addon">$</span>\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Amount</label>\n            <div class="col-xs-9 col-lg-6 inputGroupContainer">\n                <div class="input-group">\n                    <span class="input-group-addon">&#8364;</span>\n                    <input type="text" class="form-control" name="amount" />\n                </div>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Color</label>\n            <div class="col-xs-9 col-lg-6 selectContainer">\n                <select class="form-control" name="color">\n                    <option value="">Choose a color</option>\n                    <option value="blue">Blue</option>\n                    <option value="green">Green</option>\n                    <option value="red">Red</option>\n                    <option value="yellow">Yellow</option>\n                    <option value="white">White</option>\n                </select>\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-xs-2 col-lg-3 control-label">Size</label>\n            <div class="col-xs-9 col-lg-6 selectContainer">\n                <select class="form-control" name="size">\n                    <option value="">Choose a size</option>\n                    <option value="S">S</option>\n                    <option value="M">M</option>\n                    <option value="L">L</option>\n                    <option value="XL">XL</option>\n                </select>\n            </div>\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>\n\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-profile-form.tpl.html",'<form id="profileForm">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label>Email address</label>\n            <input type="text" class="form-control" name="email" />\n        </div>\n    </fieldset>\n    <fieldset>\n        <div class="form-group">\n            <label>Password</label>\n            <input type="password" class="form-control" name="password" />\n        </div>\n    </fieldset>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>\n'),a.put("build/modules/forms/directives/bootstrap-validation/bootstrap-toggling-form.tpl.html",'<form id="togglingForm" method="post" class="form-horizontal">\n\n    <fieldset>\n        <legend>\n            Default Form Elements\n        </legend>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Full name <sup>*</sup></label>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="firstName" placeholder="First name" />\n            </div>\n            <div class="col-lg-4">\n                <input type="text" class="form-control" name="lastName" placeholder="Last name" />\n            </div>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Company <sup>*</sup></label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="company"\n                       required data-bv-notempty-message="The company name is required" />\n            </div>\n            <div class="col-lg-2">\n                <button type="button" class="btn btn-info btn-sm" data-toggle="#jobInfo">\n                    Add more info\n                </button>\n            </div>\n        </div>\n    </fieldset>\n\n    <!-- These fields will not be validated as long as they are not visible -->\n    <div id="jobInfo" style="display: none;">\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Job title <sup>*</sup></label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="job" />\n                </div>\n            </div>\n        </fieldset>\n\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Department <sup>*</sup></label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="department" />\n                </div>\n            </div>\n        </fieldset>\n    </div>\n\n    <fieldset>\n        <div class="form-group">\n            <label class="col-lg-3 control-label">Mobile phone <sup>*</sup></label>\n            <div class="col-lg-5">\n                <input type="text" class="form-control" name="mobilePhone" />\n            </div>\n            <div class="col-lg-2">\n                <button type="button" class="btn btn-info btn-sm" data-toggle="#phoneInfo">\n                    Add more phone numbers\n                </button>\n            </div>\n        </div>\n    </fieldset>\n    <!-- These fields will not be validated as long as they are not visible -->\n    <div id="phoneInfo" style="display: none;">\n\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Home phone</label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="homePhone" />\n                </div>\n            </div>\n        </fieldset>\n        <fieldset>\n            <div class="form-group">\n                <label class="col-lg-3 control-label">Office phone</label>\n                <div class="col-lg-5">\n                    <input type="text" class="form-control" name="officePhone" />\n                </div>\n            </div>\n        </fieldset>\n    </div>\n\n    <div class="form-actions">\n        <div class="row">\n            <div class="col-md-12">\n                <button class="btn btn-default" type="submit">\n                    <i class="fa fa-eye"></i>\n                    Validate\n                </button>\n            </div>\n        </div>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-checkout-form.tpl.html",'<form id="checkout-form" class="smart-form" novalidate="novalidate">\n\n<fieldset>\n    <div class="row">\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-user"></i>\n                <input type="text" name="fname" placeholder="First name">\n            </label>\n        </section>\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-user"></i>\n                <input type="text" name="lname" placeholder="Last name">\n            </label>\n        </section>\n    </div>\n\n    <div class="row">\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>\n                <input type="email" name="email" placeholder="E-mail">\n            </label>\n        </section>\n        <section class="col col-6">\n            <label class="input"> <i class="icon-prepend fa fa-phone"></i>\n                <input type="tel" name="phone" placeholder="Phone" data-smart-masked-input="(999) 999-9999">\n            </label>\n        </section>\n    </div>\n</fieldset>\n\n<fieldset>\n<div class="row">\n<section class="col col-5">\n<label class="select">\n<select name="country">\n<option value="0" selected="" disabled="">Country</option>\n    <option value="{{country.key}}" ng-repeat="country in countries" >{{country.value}}</option>\n</select> <i></i> </label>\n</section>\n\n<section class="col col-4">\n    <label class="input">\n        <input type="text" name="city" placeholder="City">\n    </label>\n</section>\n\n<section class="col col-3">\n    <label class="input">\n        <input type="text" name="code" placeholder="Post code">\n    </label>\n</section>\n</div>\n\n<section>\n    <label for="address2" class="input">\n        <input type="text" name="address2" id="address2" placeholder="Address">\n    </label>\n</section>\n\n<section>\n    <label class="textarea">\n        <textarea rows="3" name="info" placeholder="Additional info"></textarea>\n    </label>\n</section>\n</fieldset>\n\n<fieldset>\n    <section>\n        <div class="inline-group">\n            <label class="radio">\n                <input type="radio" name="radio-inline" checked="">\n                <i></i>Visa</label>\n            <label class="radio">\n                <input type="radio" name="radio-inline">\n                <i></i>MasterCard</label>\n            <label class="radio">\n                <input type="radio" name="radio-inline">\n                <i></i>American Express</label>\n        </div>\n    </section>\n\n    <section>\n        <label class="input">\n            <input type="text" name="name" placeholder="Name on card">\n        </label>\n    </section>\n\n    <div class="row">\n        <section class="col col-10">\n            <label class="input">\n                <input type="text" name="card" placeholder="Card number" data-mask="9999-9999-9999-9999">\n            </label>\n        </section>\n        <section class="col col-2">\n            <label class="input">\n                <input type="text" name="cvv" placeholder="CVV2" data-mask="999">\n            </label>\n        </section>\n    </div>\n\n    <div class="row">\n        <label class="label col col-4">Expiration date</label>\n        <section class="col col-5">\n            <label class="select">\n                <select name="month">\n                    <option value="0" selected="" disabled="">Month</option>\n                    <option value="1">January</option>\n                    <option value="1">February</option>\n                    <option value="3">March</option>\n                    <option value="4">April</option>\n                    <option value="5">May</option>\n                    <option value="6">June</option>\n                    <option value="7">July</option>\n                    <option value="8">August</option>\n                    <option value="9">September</option>\n                    <option value="10">October</option>\n                    <option value="11">November</option>\n                    <option value="12">December</option>\n                </select> <i></i> </label>\n        </section>\n        <section class="col col-3">\n            <label class="input">\n                <input type="text" name="year" placeholder="Year" data-mask="2099">\n            </label>\n        </section>\n    </div>\n</fieldset>\n\n<footer>\n    <button type="submit" class="btn btn-primary">\n        Validate Form\n    </button>\n</footer>\n</form>\n'),a.put("build/modules/forms/directives/form-layouts/smart-comment-form.tpl.html",'<form action="/api/plug" method="post" id="comment-form" class="smart-form">\n    <header>\n        Comment form\n    </header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-4">\n                <label class="label">Name</label>\n                <label class="input"> <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name">\n                </label>\n            </section>\n            <section class="col col-4">\n                <label class="label">E-mail</label>\n                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email">\n                </label>\n            </section>\n            <section class="col col-4">\n                <label class="label">Website</label>\n                <label class="input"> <i class="icon-append fa fa-globe"></i>\n                    <input type="url" name="url">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="label">Comment</label>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i> <textarea rows="4"\n                                                                                         name="comment"></textarea>\n            </label>\n\n            <div class="note">\n                You may use these HTML tags and attributes: &lt;a href="" title=""&gt;, &lt;abbr title=""&gt;,\n                &lt;acronym title=""&gt;, &lt;b&gt;, &lt;blockquote cite=""&gt;, &lt;cite&gt;, &lt;code&gt;,\n                &lt;del datetime=""&gt;, &lt;em&gt;, &lt;i&gt;, &lt;q cite=""&gt;, &lt;strike&gt;, &lt;strong&gt;.\n            </div>\n        </section>\n    </fieldset>\n\n    <footer>\n        <button type="submit" name="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n\n    <div class="message">\n        <i class="fa fa-check fa-lg"></i>\n\n        <p>\n            Your comment was successfully added!\n        </p>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-contacts-form.tpl.html",'<form action="/api/plug" method="post" id="contact-form" class="smart-form">\n    <header>Contacts form</header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="label">Name</label>\n                <label class="input">\n                    <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name" id="named">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="label">E-mail</label>\n                <label class="input">\n                    <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email" id="emaild">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="label">Subject</label>\n            <label class="input">\n                <i class="icon-append fa fa-tag"></i>\n                <input type="text" name="subject" id="subject">\n            </label>\n        </section>\n\n        <section>\n            <label class="label">Message</label>\n            <label class="textarea">\n                <i class="icon-append fa fa-comment"></i>\n                <textarea rows="4" name="message" id="message"></textarea>\n            </label>\n        </section>\n\n        <section>\n            <label class="checkbox"><input type="checkbox" name="copy" id="copy"><i></i>Send a copy to my\n                e-mail address</label>\n        </section>\n    </fieldset>\n\n    <footer>\n        <button type="submit" class="btn btn-primary">Validate Form</button>\n    </footer>\n\n    <div class="message">\n        <i class="fa fa-thumbs-up"></i>\n\n        <p>Your message was successfully sent!</p>\n    </div>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-order-form.tpl.html",'<form id="order-form" class="smart-form" novalidate="novalidate">\n    <header>\n        Order services\n    </header>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-user"></i>\n                    <input type="text" name="name" placeholder="Name">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-briefcase"></i>\n                    <input type="text" name="company" placeholder="Company">\n                </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                    <input type="email" name="email" placeholder="E-mail">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-phone"></i>\n                    <input type="tel" name="phone" placeholder="Phone" data-smart-masked-input="(999) 999-9999">\n                </label>\n            </section>\n        </div>\n    </fieldset>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="select">\n                    <select name="interested">\n                        <option value="0" selected="" disabled="">Interested in</option>\n                        <option value="1">design</option>\n                        <option value="1">development</option>\n                        <option value="2">illustration</option>\n                        <option value="2">branding</option>\n                        <option value="3">video</option>\n                    </select> <i></i> </label>\n            </section>\n            <section class="col col-6">\n                <label class="select">\n                    <select name="budget">\n                        <option value="0" selected="" disabled="">Budget</option>\n                        <option value="1">less than 5000$</option>\n                        <option value="2">5000$ - 10000$</option>\n                        <option value="3">10000$ - 20000$</option>\n                        <option value="4">more than 20000$</option>\n                    </select> <i></i> </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="startdate" id="startdate" data-smart-datepicker data-min-restrict="#finishdate" placeholder="Expected start date">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="finishdate" id="finishdate" data-smart-datepicker data-max-restrict="#startdate" placeholder="Expected finish date">\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <div class="input input-file">\n                            <span class="button"><input id="file2" type="file" name="file2"\n                                                        onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input\n                    type="text" placeholder="Include some files" readonly="">\n            </div>\n        </section>\n\n        <section>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i>\n                <textarea rows="5" name="comment" placeholder="Tell us about your project"></textarea>\n            </label>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>\n'),
a.put("build/modules/forms/directives/form-layouts/smart-registration-form.tpl.html",'<form id="smart-form-register" class="smart-form">\n    <header>\n        Registration form\n    </header>\n\n    <fieldset>\n        <section>\n            <label class="input"> <i class="icon-append fa fa-user"></i>\n                <input type="text" name="username" placeholder="Username">\n                <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>\n        </section>\n\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                <input type="email" name="email" placeholder="Email address">\n                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-lock"></i>\n                <input type="password" name="password" placeholder="Password" id="password">\n                <b class="tooltip tooltip-bottom-right">Don\'t forget your password</b> </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-lock"></i>\n                <input type="password" name="passwordConfirm" placeholder="Confirm password">\n                <b class="tooltip tooltip-bottom-right">Don\'t forget your password</b> </label>\n        </section>\n    </fieldset>\n\n    <fieldset>\n        <div class="row">\n            <section class="col col-6">\n                <label class="input">\n                    <input type="text" name="firstname" placeholder="First name">\n                </label>\n            </section>\n            <section class="col col-6">\n                <label class="input">\n                    <input type="text" name="lastname" placeholder="Last name">\n                </label>\n            </section>\n        </div>\n\n        <div class="row">\n            <section class="col col-6">\n                <label class="select">\n                    <select name="gender">\n                        <option value="0" selected="" disabled="">Gender</option>\n                        <option value="1">Male</option>\n                        <option value="2">Female</option>\n                        <option value="3">Prefer not to answer</option>\n                    </select> <i></i> </label>\n            </section>\n            <section class="col col-6">\n                <label class="input"> <i class="icon-append fa fa-calendar"></i>\n                    <input type="text" name="request" placeholder="Request activation on"\n                           data-smart-datepicker data-dateformat=\'dd/mm/yy\'>\n                </label>\n            </section>\n        </div>\n\n        <section>\n            <label class="checkbox">\n                <input type="checkbox" name="subscription" id="subscription">\n                <i></i>I want to receive news and special offers</label>\n            <label class="checkbox">\n                <input type="checkbox" name="terms" id="terms">\n                <i></i>I agree with the Terms and Conditions</label>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>'),a.put("build/modules/forms/directives/form-layouts/smart-review-form.tpl.html",'<form id="review-form" class="smart-form">\n    <header>\n        Review form\n    </header>\n\n    <fieldset>\n        <section>\n            <label class="input"> <i class="icon-append fa fa-user"></i>\n                <input type="text" name="name" id="name" placeholder="Your name">\n            </label>\n        </section>\n\n        <section>\n            <label class="input"> <i class="icon-append fa fa-envelope-o"></i>\n                <input type="email" name="email" id="email" placeholder="Your e-mail">\n            </label>\n        </section>\n\n        <section>\n            <label class="label"></label>\n            <label class="textarea"> <i class="icon-append fa fa-comment"></i>\n                <textarea rows="3" name="review" id="review" placeholder="Text of the review"></textarea>\n            </label>\n        </section>\n\n        <section>\n            <div class="rating">\n                <input type="radio" name="quality" id="quality-5">\n                <label for="quality-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-4">\n                <label for="quality-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-3">\n                <label for="quality-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-2">\n                <label for="quality-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="quality" id="quality-1">\n                <label for="quality-1"><i class="fa fa-star"></i></label>\n                Quality of the product\n            </div>\n\n            <div class="rating">\n                <input type="radio" name="reliability" id="reliability-5">\n                <label for="reliability-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-4">\n                <label for="reliability-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-3">\n                <label for="reliability-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-2">\n                <label for="reliability-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="reliability" id="reliability-1">\n                <label for="reliability-1"><i class="fa fa-star"></i></label>\n                Reliability of the product\n            </div>\n\n            <div class="rating">\n                <input type="radio" name="overall" id="overall-5">\n                <label for="overall-5"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-4">\n                <label for="overall-4"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-3">\n                <label for="overall-3"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-2">\n                <label for="overall-2"><i class="fa fa-star"></i></label>\n                <input type="radio" name="overall" id="overall-1">\n                <label for="overall-1"><i class="fa fa-star"></i></label>\n                Overall rating\n            </div>\n        </section>\n    </fieldset>\n    <footer>\n        <button type="submit" class="btn btn-primary">\n            Validate Form\n        </button>\n    </footer>\n</form>')}])});
define('includes',["auth/module","auth/models/User","auth/directives/loginInfo","auth/directives/loginInfoLine","layout/module","layout/directives/smartRouterAnimationWrap","scripts/config","scripts/controllers","scripts/directives","scripts/modules/dashboard","multiacademico/multiacademico","multiacademico/estudiantes/module","multiacademico/materias/module","multiacademico/periodo/module","multiacademico/cursos/module","multiacademico/distributivos/module","multiacademico/especializaciones/module","multiacademico/proyectosescolares/module","multiacademico/docentes/calificar/module","multiacademico/docentes/calificar/factory/CalificarForm","multiacademico/reportes/malla/module","multiacademico/informes/module","modules/forms/module","modules/forms/models/FormsCrud","modules/users/module","smart-templates"],function(){"use strict"});
window.name="NG_DEFER_BOOTSTRAP!",define('main',["require","jquery","angular","domReady","bootstrap","app","includes"],function(a,b,c,d){"use strict";d(function(a){c.bootstrap(a,["app"]),c.resumeBootstrap()})});

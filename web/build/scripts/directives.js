define(["angular","angular-couch-potato","bootbox","angular-ui-router","jquery-cookie","jquery-nicescroll","ionsound","chosen","sparkline"],function(a,b,c){"use strict";var d=a.module("blankonDirective",[]).directive("refreshPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){var a=$(this).parents(".panel").find(".panel-body");a.append('<div class="indicator"><span class="spinner"></span></div>'),setInterval(function(){$.getJSON("../../../assets/admin/data/reload-sample.json",function(b){$.each(b,function(){console.log("Retrieving data from json...")}),a.find(".indicator").hide()})},5e3)})}}}).directive("collapsePanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){var a=$(this).parents(".panel").find(".panel-body"),b=$(this).parents(".panel").find(".panel-sub-heading"),c=$(this).parents(".panel").find(".panel-footer");a.is(":visible")?($(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down"),a.slideUp(),b.slideUp(),c.slideUp()):($(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up"),a.slideDown(),b.slideDown(),c.slideDown())})}}}).directive("removePanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){$(this).parents(".panel").fadeOut()})}}}).directive("expandPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){b.parents(".panel").hasClass("panel-fullsize")?($("body").find(".panel-fullsize-backdrop").remove(),b.data("bs.tooltip").options.title="Expand",b.parents(".panel").removeClass("panel-fullsize")):($("body").append('<div class="panel-fullsize-backdrop"></div>'),b.data("bs.tooltip").options.title="Minimize",b.parents(".panel").addClass("panel-fullsize"))})}}}).directive("searchPanel",function(){return{restrict:"A",link:function(a,b,c){b.click(function(){return b.parents(".panel").find(".panel-search").toggle(100),!1})}}}).directive("tooltip",function(){return{restrict:"A",link:function(a,b,c){$(b).hover(function(){$(b).tooltip("show")},function(){$(b).tooltip("hide")})}}}).directive("backTop",function(){return{restrict:"A",link:function(a,b){b.hide(),$(window).scroll(function(){$(this).scrollTop()>100?b.addClass("show animated pulse"):b.removeClass("show animated pulse")}),b.click(function(){return ion.sound.play("cd_tray"),$("body,html").animate({scrollTop:0},800),!1})}}}).directive("nicescroll",function(){return{restrict:"A",link:function(a,b){b.niceScroll({cursorwidth:"9px",cursorborder:"0px"})}}}).directive("chosenSelect",function(){return{restrict:"A",link:function(a,b){b.chosen()}}}).directive("fullscreen",function(){return{restrict:"A",link:function(a,b){var c;b.on("click",function(){if(c=!c){$(".page-sound").length&&ion.sound.play("bell_ring"),$(this).toggleClass("fg-theme"),$(this).attr("data-original-title","Exit Fullscreen");var a,b;a=document.documentElement,b=a.requestFullScreen||a.webkitRequestFullScreen||a.mozRequestFullScreen||a.msRequestFullScreen,"undefined"!=typeof b&&b&&b.call(a)}else{$(".page-sound").length&&ion.sound.play("bell_ring"),$(this).removeClass("fg-theme"),$(this).attr("data-original-title","Fullscreen");var a,b;a=document,b=a.cancelFullScreen||a.webkitCancelFullScreen||a.mozCancelFullScreen||a.msCancelFullScreen||a.exitFullscreen,"undefined"!=typeof b&&b&&b.call(a)}})}}}).directive("resetSetting",function(){return{restrict:"A",link:function(a,b){b.on("click",function(){var a=$.cookie();for(var b in a)$.removeCookie(b);location.reload(!0)})}}}).directive("setting",function(){return{restrict:"A",link:function(a,b){b.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"I am a custom dialog setting",title:"Custom setting",className:"modal-success modal-center",buttons:{success:{label:"Success!",className:"btn-success",callback:function(){alert("You are so calm!")}},danger:{label:"Danger!",className:"btn-danger",callback:function(){alert("You are so hot!")}},main:{label:"Click ME!",className:"btn-primary",callback:function(){alert("Hello World")}}}})})}}}).directive("lockScreen",["settings",function(a){return{restrict:"A",link:function(b,d){d.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"Locker with notification display, Receive your notifications directly on your lock screen",title:"Lock Screen",className:"modal-lilac modal-center",buttons:{danger:{label:"No",className:"btn-danger"},success:{label:"Yes",className:"btn-success",callback:function(){window.location=a.baseURL+"/production/admin/angularjs/account.html#/lock-screen"}}}})})}}}]).directive("logout",["settings",function(a){return{restrict:"A",link:function(b,d){d.on("click",function(){ion.sound.play("camera_flashing"),c.dialog({message:"Do you want to exit from Blankon?",title:"Logout",className:"modal-danger modal-center",buttons:{danger:{label:"No",className:"btn-danger"},success:{label:"Yes",className:"btn-success",callback:function(){window.location=a.baseURL+"/production/admin/angularjs/account.html#/sign-in"}}}})})}}}]).directive("sparklineAverage",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#37BC9B",height:"30px"})}}}).directive("sparklineTraffic",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#8CC152",height:"30px"})}}}).directive("sparklineDisk",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#E9573F",height:"30px"})}}}).directive("sparklineCpu",function(){return{restrict:"A",link:function(a,b){b.sparkline("html",{type:"bar",barColor:"#F6BB42",height:"30px"})}}}).directive("a",function(){return{restrict:"E",link:function(a,b,c){(c.ngClick||""===c.href||"#"===c.href||b.data("toggle")||b.data("slide"))&&b.on("click",function(a){a.preventDefault()})}}}).directive("navbarMessage",function(){return{restrict:"A",controller:function(a){a.messages=[{image:"",name:"john kribo",message:"I was impressed how fast the content is loaded. Congratulations. nice design.",meta:{reply:"",attach:""},time:""}]}}}).directive("activeMenu",["$location","$state",function(a,b){return{link:function(c,d,e){c.$on("$stateChangeSuccess",function(c,f,g){if(void 0!=e.href){var h=(e.activeTab||1,a.absUrl()),i=b.href(e.uiSref,null,{absolute:!0});h===i?(d.closest(".submenu").length&&(d.closest(".submenu").addClass("active"),d.closest(".submenu").parents(".submenu").addClass("active"),d.append('<span class="selected"></span>')),d.parent().addClass("active"),d.append('<span class="selected"></span>')):(d.parent().removeClass("active"),d.find(".selected").remove())}})}}}]).directive("collapseMenu",["settings",function(a){return{restrict:"A",link:function(a,b,c){b.find("a").on("click",function(){var a=$(this).parent("li"),b=$(this).parent(".submenu"),c=$(this).nextAll(),d=$(this).find(".arrow"),e=$(this).find(".plus");$(".page-sound").length&&ion.sound.play("button_click_on"),a.siblings().removeClass("active"),b.parent("ul").find("ul:visible")&&(b.parent("ul").find("ul:visible").slideUp("fast"),b.parent("ul").find(".open").removeClass("open"),b.siblings().children("a").find(".selected").remove(),a.siblings().children("a").find(".selected").remove()),c.is("ul:visible")&&(d.removeClass("open"),e.removeClass("open"),c.slideUp("fast")),c.is("ul:visible")||(c.slideDown("fast"),a.children("a").append('<span class="selected"></span>'),b.addClass("active"),b.children("a").append('<span class="selected"></span>'),d.addClass("open"),e.addClass("open"))})}}}]).directive("sidebarLeftNicescroll",function(){return{restrict:"A",link:function(){function a(){if($(".page-sidebar-fixed").length){var a=$(window).outerHeight()-$("#header").outerHeight()-$(".sidebar-footer").outerHeight()-$(".sidebar-content").outerHeight(),b=$(window).outerHeight()-$("#sidebar-right .panel-heading").outerHeight(),c=$(window).outerHeight()-$("#sidebar-right .panel-heading").outerHeight()-$("#sidebar-chat .form-horizontal").outerHeight();$("#sidebar-left .sidebar-menu").height(a).niceScroll({cursorwidth:"9px",cursorborder:"0px",railalign:"left"}),$("#sidebar-profile .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-layout .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-setting .sidebar-menu").height(b).niceScroll({cursorwidth:"3px",cursorborder:"0px"}),$("#sidebar-chat .sidebar-menu").height(c).niceScroll({cursorwidth:"3px",cursorborder:"0px"})}}a(),$(window).resize(a)}}}).directive("sidebarMinimize",function(){return{restrict:"A",link:function(a,b){function c(){var a=d.width();a>768&&1024>=a?$("body").addClass("page-sidebar-minimize-auto"):768>=a?($("body").removeClass("page-sidebar-minimize"),$("body").removeClass("page-sidebar-minimize-auto")):$("body").removeClass("page-sidebar-minimize-auto")}var d=$(window),e=$(".navbar-minimize a"),f=$(".navbar-setting a"),g=$(".navbar-minimize-mobile.left"),h=$(".navbar-minimize-mobile.right");c(),$(window).resize(c),e.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$(".page-sidebar-right-show").length&&$("body").removeClass("page-sidebar-right-show"),$(".page-sidebar-minimize-auto").length?$("body").removeClass("page-sidebar-minimize-auto"):$("body").toggleClass("page-sidebar-minimize"),"undefined"==$.cookie("page_sidebar_minimize")||"not_active"==$.cookie("page_sidebar_minimize")?$.cookie("page_sidebar_minimize","active",{expires:1}):($.removeCookie("page_sidebar_minimize"),$.cookie("page_sidebar_minimize","not_active",{expires:1}))}),f.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$(".page-sidebar-minimize.page-sidebar-right-show").length?$("body").toggleClass("page-sidebar-minimize page-sidebar-right-show"):$(".page-sidebar-minimize").length?$("body").toggleClass("page-sidebar-right-show"):$("body").toggleClass("page-sidebar-minimize page-sidebar-right-show")}),g.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$("body.page-sidebar-right-show").length&&($("body").removeClass("page-sidebar-right-show"),$("body").removeClass("page-sidebar-minimize")),$("body").toggleClass("page-sidebar-left-show")}),h.on("click",function(){$(".page-sound").length&&ion.sound.play("button_click"),$("body.page-sidebar-left-show").length&&($("body").removeClass("page-sidebar-left-show"),$("body").removeClass("page-sidebar-minimize")),$("body").toggleClass("page-sidebar-right-show")})}}}).directive("chooseThemes",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme");$.cookie("color_schemes")&&$("link#theme").attr("href","assets/admin/css/themes/"+$.cookie("color_schemes")+".theme.css"),$.cookie("navbar_color")&&$(".navbar-toolbar").attr("class","navbar navbar-toolbar navbar-"+$.cookie("navbar_color")),$.cookie("sidebar_color")&&($("#sidebar-left").hasClass("sidebar-box")?$("#sidebar-left").attr("class","sidebar-box sidebar-"+$.cookie("sidebar_color")):$("#sidebar-left").hasClass("sidebar-rounded")?$("#sidebar-left").attr("class","sidebar-rounded sidebar-"+$.cookie("sidebar_color")):$("#sidebar-left").hasClass("sidebar-circle")?$("#sidebar-left").attr("class","sidebar-circle sidebar-"+$.cookie("sidebar_color")):""==$("#sidebar-left").attr("class")&&$("#sidebar-left").attr("class","sidebar-"+$.cookie("sidebar_color"))),c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$("link#theme").attr("href","assets/admin/css/themes/"+a+".theme.css"),$.cookie("color_schemes",a,{expires:1})})}}}).directive("navbarColor",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme-navbar");c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$(".navbar-toolbar").attr("class","navbar navbar-toolbar navbar-"+a),$.cookie("navbar_color",a,{expires:1})})}}}).directive("sidebarColor",function(){return{restrict:"A",link:function(a,b){var c=b.find(".theme-sidebar");c.on("click",function(){var a=$(this).find(".hide").text();$(".page-sound").length&&ion.sound.play("camera_flashing_2"),$("#sidebar-left").hasClass("sidebar-box")?$("#sidebar-left").attr("class","sidebar-box sidebar-"+a):$("#sidebar-left").hasClass("sidebar-rounded")?$("#sidebar-left").attr("class","sidebar-rounded sidebar-"+a):$("#sidebar-left").hasClass("sidebar-circle")?$("#sidebar-left").attr("class","sidebar-circle sidebar-"+a):""==$("#sidebar-left").attr("class")&&$("#sidebar-left").attr("class","sidebar-"+a),$.cookie("sidebar_color",a,{expires:1})})}}}).directive("layoutSetting",function(){return{restrict:"A",link:function(a,b){var c=$(".layout-setting").find("input"),d=$(".header-layout-setting").find("input"),e=$(".sidebar-layout-setting").find("input"),f=$(".sidebar-type-setting").find("input"),g=$(".footer-layout-setting").find("input");$.cookie("layout_setting")&&$("body").addClass($.cookie("layout_setting")),$.cookie("header_layout_setting")&&$("body").addClass($.cookie("header_layout_setting")),$.cookie("sidebar_layout_setting")&&$("#sidebar-left").addClass($.cookie("sidebar_layout_setting")),$.cookie("sidebar_type_setting")&&$("#sidebar-left").addClass($.cookie("sidebar_type_setting")),$.cookie("footer_layout_setting")&&$("body").addClass($.cookie("footer_layout_setting")),$("body").not(".page-boxed")&&$(".layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-boxed")&&($(".layout-setting li:eq(1) input").attr("checked","checked"),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".sidebar-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".footer-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip()),$("body").not(".page-header-fixed")&&$(".header-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-header-fixed")&&$(".header-layout-setting li:eq(1) input").attr("checked","checked"),$("body").not(".page-sidebar-fixed")&&$(".sidebar-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-sidebar-fixed")&&$(".sidebar-layout-setting li:eq(1) input").attr("checked","checked"),$("#sidebar-left").not(".sidebar-box, .sidebar-rounded, .sidebar-circle")&&$(".sidebar-type-setting li:eq(0) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-box")&&$(".sidebar-type-setting li:eq(1) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-rounded")&&$(".sidebar-type-setting li:eq(2) input").attr("checked","checked"),$("#sidebar-left").hasClass("sidebar-circle")&&$(".sidebar-type-setting li:eq(3) input").attr("checked","checked"),$("body").not(".page-footer-fixed")&&$(".footer-layout-setting li:eq(0) input").attr("checked","checked"),$("body").hasClass("page-footer-fixed")&&$(".footer-layout-setting li:eq(1) input").attr("checked","checked"),c.change(function(){var a=$(this).val();$("body").hasClass("page-boxed")?($("body").removeClass("page-boxed"),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy"),$(".sidebar-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy"),$(".footer-layout-setting li:eq(1) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy")):($("body").addClass($(this).val()),$("body").removeClass("page-header-fixed"),$("body").removeClass("page-sidebar-fixed"),$("body").removeClass("page-footer-fixed"),$(".header-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".sidebar-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip(),$(".footer-layout-setting li:eq(1) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on page boxed"}).tooltip()),$.cookie("layout_setting",a,{expires:1})}),d.change(function(){var a=$(this).val();$("body").hasClass("page-header-fixed")&&($("body").removeClass("page-header-fixed"),$("body").addClass($(this).val())),$("body").addClass($(this).val()),$.cookie("header_setting",a,{expires:1})}),e.change(function(){var a=$(this).val();$("body").hasClass("page-sidebar-fixed")?($("body").removeClass("page-sidebar-fixed"),$(".header-layout-setting li:eq(0) input").removeAttr("disabled").next().css("text-decoration","inherit").parent(".rdio").tooltip("destroy")):($("body").addClass($(this).val()),$("body").addClass("page-header-fixed"),$(".header-layout-setting li:eq(0) input").attr("disabled","disabled").next().css("text-decoration","line-through").parent(".rdio").attr({"data-toggle":"tooltip","data-container":"body","data-placement":"left","data-title":"Not working on sidebar fixed"}).tooltip(),$(".header-layout-setting li:eq(1) input").attr("checked","checked")),$.cookie("sidebar_layout_setting",a,{expires:1})}),f.change(function(){var a=$(this).val();$("#sidebar-left").hasClass("sidebar-circle")&&($("#sidebar-left").removeClass("sidebar-circle"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").hasClass("sidebar-box")&&($("#sidebar-left").removeClass("sidebar-box"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").hasClass("sidebar-rounded")&&($("#sidebar-left").removeClass("sidebar-rounded"),$("#sidebar-left").addClass($(this).val())),$("#sidebar-left").addClass($(this).val()),$.cookie("sidebar_type_setting",a,{expires:1})}),g.change(function(){var a=$(this).val();$("body").hasClass("page-footer-fixed")?$("body").removeClass("page-footer-fixed"):$("body").addClass($(this).val()),$.cookie("footer_layout_setting",a,{expires:1})})}}});return b.configureApp(d),d.run(["$couchPotato",function(a){d.lazy=a}]),d});
define(["layout/module"],function(a){"use strict";a.registerDirective("fullScreen",function(){return{restrict:"A",link:function(a,b){var c=$("body"),d=function(a){c.hasClass("full-screen")?(c.removeClass("full-screen"),document.exitFullscreen?document.exitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen()):(c.addClass("full-screen"),document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen?document.documentElement.webkitRequestFullscreen():document.documentElement.msRequestFullscreen&&document.documentElement.msRequestFullscreen())};b.on("click",d)}}})});
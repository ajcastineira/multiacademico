define(["modules/users/module"],function(a){"use strict";return a.registerController("MeCtrl",["$scope","$log","$http","$browser",function(a,b,c,d){a.user={name:"Rene Arias",avatar:""},a.processForm=function(a,b){a.preventDefault();var e,f="secured_user_api_me_update_avatar";e=new FormData(document.getElementsByName(b)[0]),c({method:"POST",async:!0,url:Routing.generate(f),data:e,transformRequest:angular.identity,headers:{"Content-Type":void 0}}).then(function(a){if(202===a.status){var b=d.baseHref(),c=a.data.path;"app_dev.php/"==b.substr(-12)&&(b=b.substr(0,b.length-12)),$("#avatar").attr("src",b+c),$(".avatar img").attr("src",b+c),$(".fileinput").fileinput("clear")}},function(a){400===a.status?a.data.errores.forEach(function(a){alert(a)}):alert("Ocurrio Un Error Al subir la foto")})}}])});
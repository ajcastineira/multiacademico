define(["auth/module"],function(a){"use strict";return a.registerFactory("User",["$http","$q","$browser",function(a,b,c){var d=b.defer(),e={initialized:d.promise,username:void 0,picture:void 0};return a.get(Routing.generate("api_user",{_format:"json"})).then(function(a){e.username=a.data.username;var b=c.baseHref();b=b.replace("app_dev.php/",""),e.picture=b+a.data.picture,e.cargo=a.data.cargo,d.resolve(e)}),e}])});
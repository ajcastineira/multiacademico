define(["auth/module"],function(a){"use strict";return a.registerFactory("User",["$http","$q",function(a,b){var c=b.defer(),d={initialized:c.promise,username:void 0,picture:void 0};return a.get(Routing.generate("api_user",{_format:"json"})).then(function(a){d.username=a.data.username,d.picture=a.data.picture,d.cargo=a.data.cargo,c.resolve(d)}),d}])});
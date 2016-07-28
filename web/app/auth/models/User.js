define(['auth/module'], function (module) {

    'use strict';

   return module.registerFactory('User', function ($http, $q,$browser) {
        var dfd = $q.defer();

        var UserModel = {
            initialized: dfd.promise,
            username: undefined,
            name: undefined,
            picture: undefined,
            fToken:undefined
        };
         $http.get(Routing.generate('api_user',{'_format':'json'})).then(function(response){
             UserModel.username = response.data.username;
             UserModel.name = response.data.name;
              var base=$browser.baseHref();
              
              base=base.replace("app_dev.php/","");
              
             UserModel.picture= base+response.data.picture;
             UserModel.cargo= response.data.cargo;
             UserModel.fToken= response.data.fToken;
             dfd.resolve(UserModel);
         });

        return UserModel;
    });

});

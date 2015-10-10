define(['auth/module'], function (module) {

    'use strict';

   return module.registerFactory('User', function ($http, $q) {
        var dfd = $q.defer();

        var UserModel = {
            initialized: dfd.promise,
            username: undefined,
            picture: undefined
        };
         $http.get(Routing.generate('api_user',{'_format':'json'})).then(function(response){
             UserModel.username = response.data.username;
             UserModel.picture= response.data.picture;
             dfd.resolve(UserModel);
         });

        return UserModel;
    });

});

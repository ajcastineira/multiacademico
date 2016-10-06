

'use strict';

angular.module('app.auth').factory('User', function ($http, $q, $browser, APP_CONFIG) {
    var dfd = $q.defer();

    var UserModel = {
        initialized: dfd.promise,
        username: undefined,
        name: undefined,
        picture: undefined,
        fToken:undefined
    };
     $http.get(APP_CONFIG.apiRootUrl + '/user.json').then(function(response){
         UserModel.username = response.data.username;
             UserModel.name = response.data.name;
              var base=$browser.baseHref();
              
              base=base.replace("app_dev.php/","");
              
             //UserModel.picture= base+response.data.picture;
             UserModel.picture= response.data.picture;  //con AWS S3
             UserModel.cargo= response.data.cargo;
             UserModel.fToken= response.data.fToken;
         dfd.resolve(UserModel);
     });

    return UserModel;
});

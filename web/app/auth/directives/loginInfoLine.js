"use strict";

angular.module('app.auth').directive('loginInfoLine', function(User){

    return {
        restrict: 'A',
        templateUrl: Routing.generate('logininfoline'),
        link: function(scope, element){
            User.initialized.then(function(){
                scope.user = User
            });
        }
    }
})

define(['auth/module'], function(module){
    "use strict";

    return module.registerDirective('loginInfo', function(User){
        
        return {
            restrict: 'A',
            templateUrl: Routing.generate('logininfo'),
            link: function(scope, element){
                User.initialized.then(function(){
                    scope.user = User
                });
            }
        }
    })
});

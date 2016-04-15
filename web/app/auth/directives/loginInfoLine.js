define(['auth/module'], function(module){
    "use strict";

    return module.registerDirective('loginInfoLine', function(User){
        
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
});

/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define(['modules/users/module'], function (module) {

    'use strict';

    module.registerDirective('loadingspiner', ['$http' ,function ($http)
    {
        return {
            restrict: 'A',
            link: function (scope, elm, attrs)
            {
                scope.isLoading = function () {
                    //return $http.pendingRequests.length > 0;
                    return scope.loading;
                };

                scope.$watch(scope.isLoading, function (v)
                {
                    if(v){
                        elm.show();
                        $('.fileinput').hide();
                    }else{
                        elm.hide();
                        $('.fileinput').show();
                    }
                });
            }
        };

    }]);
});
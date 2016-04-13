'use strict';

/**
 * @ngdoc overview
 * @name app [arxisApp]
 * @description
 * # app [arxisApp]
 *
 * Main module of the application.
 */

define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router',
    'angular-animate',
    'angular-sanitize',
    'angular-bootstrap',
    'angular-loading-bar',
    'oc-lazyload'
], function (ng, couchPotato) {


    var app = ng.module('app', [
        'ngSanitize',
        'ngAnimate',
        'oc.lazyLoad',
        'scs.couch-potato',
        'ui.router',
        'ui.bootstrap',
        'angular-loading-bar',
        'blankonConfig',
        'blankonController',
        'blankonDirective',
        //app
        'app.auth',
        'app.dashboard',
        'app.users',
        'app.layout',
        'app.forms',
        'app.paypay',
        'app.paypay.ingresos',
       
     //   'app.paypay.egresos',
        'multiacademico',
        'multiacademico.estudiantes',
        'multiacademico.matriculas',
        'multiacademico.docentes',
        'multiacademico.docentes.midistributivo',
        'multiacademico.proyectosescolares',
        'multiacademico.aulas',
        'multiacademico.cursos',
        'multiacademico.distributivos',
        'multiacademico.malla',
        'multiacademico.especializaciones',
        'multiacademico.certificados',
       'multiacademico.informes',
        'multiacademico.materias',
        'multiacademico.pensiones',
        'multiacademico.representantes',
   //      'multiacademico.pagos',
       // 'multiacademico.periodo'



    ]);

   couchPotato.configureApp(app);

    app.config(function ($provide, $httpProvider, $locationProvider) {

       $locationProvider.html5Mode(true);
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        // Intercept http calls.
        $provide.factory('ErrorHttpInterceptor', function ($q) {
            var errorCounter = 0;
            function notifyError(rejection){
                console.log(rejection);
               /* $.bigBox({
                    title: rejection.status + ' ' + rejection.statusText,
                    content: rejection.data,
                    color: "#C46A69",
                    icon: "fa fa-warning shake animated",
                    number: ++errorCounter,
                    timeout: 6000
                });*/
          }

            return {
                // On request failure
                requestError: function (rejection) {
                    // show notification
                    notifyError(rejection);

                    // Return the promise rejection.
                    return $q.reject(rejection);
                },

                // On response failure
                responseError: function (rejection) {
                    // show notification
                    notifyError(rejection);
                    // Return the promise rejection.
                    return $q.reject(rejection);
                }
            };
        });
        // Add the interceptor to the $httpProvider.
        $httpProvider.interceptors.push('ErrorHttpInterceptor');

    });

    app.run(function ($couchPotato, $rootScope, $state, $stateParams) {
        app.lazy = $couchPotato;
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
        // editableOptions.theme = 'bs3';
    });

    return app;
});

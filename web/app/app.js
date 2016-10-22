'use strict';

/**
 * @ngdoc overview
 * @name app [arxisApp]
 * @description
 * # app [arxisApp]
 *
 * Main module of the application.
 */

angular.module('app', [
    'ngSanitize',
    'ngAnimate',
    'firebase',
    'oc.lazyLoad',
    'restangular',
    'ui.router',
    'ui.bootstrap',
    'angular-loading-bar',
    'blankonConfig',
    'blankonController',
    'blankonDirective',
    // Smartadmin Angular Common Module
    'SmartAdmin',
    // App
    'app.auth',
    'app.dashboard',
    'app.users',
    'app.layout',
    'app.chat',
    'app.calendar',
    'app.inbox',
    'app.graphs',
    'app.tables',
    'app.forms',
    'app.notificaciones',
    'app.paypay',
    'app.paypay.ingresos',
    'app.ui',
    'app.widgets',
    'app.maps',
    'app.appViews',
    'app.misc',
    'app.smartAdmin',
    //'app.eCommerce',

     //   'app.paypay.egresos',
    'multiacademico',
    'multiacademico.entidad',
    'multiacademico.estudiantes',
    'multiacademico.estadisticas',
    'multiacademico.matriculas',
    'multiacademico.docentes',
    'multiacademico.docentes.midistributivo',
    'multiacademico.proyectosescolares',
    'multiacademico.aulas',
    'multiacademico.actividadacademica',
    'multiacademico.actividadacademicadetalle',
    'multiacademico.areaacademica',
    'multiacademico.cursos',
        
    //'multiacademico.comportamiento', // no esta completado
    'multiacademico.distributivos',
    'multiacademico.malla',
    'multiacademico.especializaciones',
    'multiacademico.certificados',
    'multiacademico.informes',
    'multiacademico.materias',
    'multiacademico.pensiones',
    'multiacademico.representantes',
    //'multiacademico.pagos',
    //'multiacademico.periodo'



])
.config(function ($provide, $httpProvider, RestangularProvider, $locationProvider) {

         var config = {
            apiKey: "AIzaSyDPSuC3ADQFoelry5J0O1kjvhJtuCfwK8A",
            authDomain: "multiacademico.firebaseapp.com",
            databaseURL: "https://multiacademico.firebaseio.com",
            storageBucket: "multiacademico.appspot.com",
          };
          firebase.initializeApp(config);

    $locationProvider.html5Mode(true);
    //$httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    // Intercept http calls.
    $provide.factory('ErrorHttpInterceptor', function ($q) {
        var errorCounter = 0;
        function notifyError(rejection){
            console.log(rejection);
            $.bigBox({
                title: rejection.status + ' ' + rejection.statusText,
                content: rejection.data,
                color: "#C46A69",
                icon: "fa fa-warning shake animated",
                number: ++errorCounter,
                timeout: 6000
            });
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

    RestangularProvider.setBaseUrl(location.pathname.replace(/[^\/]+?$/, ''));

})
.constant('APP_CONFIG', window.appConfig)
.run(function ($rootScope
    , $state, $stateParams
    ) {
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
    // editableOptions.theme = 'bs3';

});



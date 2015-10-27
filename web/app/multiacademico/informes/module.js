/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.informes', ['ui.router']);

    couchPotato.configureApp(module);
    module.filter('ordenarCalificaciones', function() {
        return function(items, reverse) {
        var filtered = [];
        ng.forEach(items, function(item) {
        filtered.push(item);
        });
        filtered.sort(function (a, b) {
            var field1="calificacioncodmateria";
            var field2="prioridad";
        return (a[field1][field2] > b[field1][field2] ? 1 : -1);
        });
        if(reverse) filtered.reverse();
        return filtered;
    };
    });
    module.config(function ($stateProvider, $couchPotatoProvider)
    {
        $stateProvider
            .state('multiacademico.informes', {
                    url: '/informes',
                    data: {
                        pageTitle: 'Informes',
                        pageHeader: {
                            icon: 'fa flaticon-a3',
                            title: 'Informes',
                            subtitle: 'Seleccionar curso'
                        },
                        breadcrumbs: [
                            {title: 'Informes'},{title: 'Seleccionar curso'}
                        ]
                    },
                    
                    views:{
                        'content@multiacademico':{
                            templateUrl: 'views/multiacademico/informes/seleccionar-aula-informes.html',
                            controller: function ($scope, aulas) {
                            $scope.aulas = aulas;
                           },
                           resolve:{
                               aulas: function ($http) {
                                 return $http.get(Routing.generate('get_aulas_all',{'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data.aulas;
                                         });
                                         }
                                     }
                           }
                        }
                        

                })
            .state('multiacademico.informes.aula', {
                    url: '/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/{q}/{p}',
                    reloadOnSearch: false,
                    data: {
                        pageTitle: 'Informe de Aprendizaje',
                        pageHeader: {
                            icon: 'fa flaticon-tactil1',
                            title: 'Informes',
                            subtitle: 'Informe de Aprendizaje'
                        },
                        breadcrumbs: [
                            {title: 'Informes'},{title: 'Informe de Aprendizaje'}
                        ]
                    },
                    views:{
                        'content@multiacademico':{
                            templateUrl: Routing.generate('informe-aprendizaje-api'),
                            controller: 'InformesCtrl',
                           resolve:{
                               deps: $couchPotatoProvider.resolveDependencies([
                                'multiacademico/informes/controllers/InformesCtrl'//,
                               // 'multiacademico/calificaciones/Calificaciones'
                               
                                ]),
                               aula: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('get_aula',{curso: $stateParams.curso,especializacion:$stateParams.especializacion, paralelo:$stateParams.paralelo,seccion: $stateParams.seccion,periodo:$stateParams.periodo,'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data.aula;
                                         });
                                         }
                                     }   
                        }
                    }
                })




    });

    module.run(function($couchPotato){
        module.lazy = $couchPotato;
    });
    return module;
});

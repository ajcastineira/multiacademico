/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

    "use strict";

    angular.module('multiacademico.informes', ['ui.router'])

    
    .filter('ordenarCalificaciones', function() {
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
    })
    .config(function ($stateProvider)
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
                                             return response.data;
                                         });
                                         }
                                     }
                           }
                        }
                        

                })
            .state('multiacademico.informes.aula', {
                    url: '/aula/{aula}/{q}/{p}',
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
                               
                               aula: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('get_aula',{aula: $stateParams.aula,'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data;
                                         });
                                         }
                                     }   
                        }
                    }
                })
              



    });
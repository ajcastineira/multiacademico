/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */


    "use strict";

    angular.module('multiacademico.malla', ['ui.router'])

    

    .config(function ($stateProvider)
    {
        $stateProvider
    

 
              .state('multiacademico.malla-normal', {
                    url: '/malla-normal',
                    data: {
                        pageTitle: 'malla-normal',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Cuadro de calificaiones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Malla Normal'}
                        ]
                    },
                    
                    views:{
                        'content@multiacademico':{
                            templateUrl: 'views/multiacademico/malla/seleccionar-aula-malla-normal.html',
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
                
                
                .state('multiacademico.malla-normal.aula', {
                    url: '/aula/{aula}/{q}/{p}',
                    reloadOnSearch: false,
                    data: {
                        pageTitle: 'Cuadro de Calificaciones',
                        pageHeader: {
                            icon: 'fa flaticon-tactil1',
                            title: 'Malla',
                            subtitle: 'Cuadro de Calificaciones'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Cuadro de Calificaciones'}
                        ]
                    },
                    views:{
                        'content@multiacademico':{
                            templateUrl: Routing.generate('malla-normal-api'),
                            controller: 'MallaCtrl',
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


              .state('cuadro-de-calificaciones', {
                    url: '/cuadro-de-calificaciones',
                    templateUrl: 'views/multiacademico/malla/cuadro-de-calificaciones.html',
                    data: {
                        pageTitle: 'cuadro-de-calificaciones',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Cuadro de Calificaciones',
                            subtitle: 'cuadro-de-calificaciones'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Cuadro de Calificaciones'}
                        ]
                    }
                })



              .state('comportamiento', {
                    url: '/comportamiento',
                    templateUrl: 'views/multiacademico/malla/comportamiento.html',

                    data: {
                        pageTitle: 'comportamiento',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Comportamiento',
                            subtitle: 'comportamiento'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Comportamiento'}
                        ]
                    }
                })



              .state('quimestre', {
                    url: '/quimestre',
                    templateUrl: 'views/multiacademico/malla/quimestre.html',
                    data: {
                        pageTitle: 'quimestre',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Quimestre',
                            subtitle: 'quimestre'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Quimestre'}
                        ]
                    }
                })



              .state('quimestre2', {
                    url: '/quimestre2',
                    templateUrl: 'views/multiacademico/malla/quimestre2.html',
                    data: {
                        pageTitle: 'quimestre2',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Quimestre 2',
                            subtitle: 'quimestre 2'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Quimestre 2'}
                        ]
                    }
                })



              .state('dos-quimestre', {
                    url: '/dos-quimestre',
                    templateUrl: 'views/multiacademico/malla/dos-quimestre.html',
                    data: {
                        pageTitle: 'dos-quimestre',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Dos quimestre',
                            subtitle: 'dos quimestre'
                        },
                        breadcrumbs: [
                            {title: 'Malla'},{title: 'Dos quimestre'}
                        ]
                    }
             })



    });

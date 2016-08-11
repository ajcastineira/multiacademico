/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */
    "use strict";

    angular.module('multiacademico.certificados', ['ui.router'])
    .config(function ($stateProvider)
    {
        $stateProvider
            .state('multiacademico.certificados', {
                    abstract:true,
                    url: '/certificados',
                    data: {
                        pageTitle: 'Certificados',
                        pageHeader: {
                            icon: 'fa flaticon-certificate',
                            title: 'Certificados',
                            subtitle: 'Seleccionar curso'
                        },
                        breadcrumbs: [
                            {title: 'Certificados'},{title: 'Seleccionar curso'}
                        ]
                    }
                })
            .state('multiacademico.certificados.matricula', {
                    url: '/matricula',
                    data: {
                        pageTitle: 'Certificados',
                        pageHeader: {
                            icon: 'fa flaticon-certificate',
                            title: 'Certificados',
                            subtitle: 'Seleccionar curso'
                        },
                        breadcrumbs: [
                            {title: 'Certificados'},{title: 'Seleccionar curso'}
                        ]
                    },
                    
                    views:{
                        'content@multiacademico':{
                            templateUrl: 'views/multiacademico/certificados/seleccionar-aula-certificado-matricula.html',
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
            .state('multiacademico.certificados.matricula.aula', {
                    url: '/aula/{aula}',
                    data: {
                        pageTitle: 'Certificados',
                        pageHeader: {
                            icon: 'fa flaticon-certificate',
                            title: 'Certificados',
                            subtitle: 'Matricula'
                        },
                        breadcrumbs: [
                            {title: 'Certificados'},{title: 'Matricula'}
                        ]
                    },
                    views:{
                        'content@multiacademico':{
                            templateUrl: function($stateParams){
                                return Routing.generate('certificados-matricula-curso-api',{aula: $stateParams.aula});
                                }//,
                                
                           // controller: 'InformesCtrl',
                           /*resolve:{
                              
                               aula: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('get_aula',{curso: $stateParams.curso,especializacion:$stateParams.especializacion, paralelo:$stateParams.paralelo,seccion: $stateParams.seccion,periodo:$stateParams.periodo,'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data.aula;
                                         });
                                         }
                                     } */  
                        }
                    }
                })
            .state('multiacademico.certificados.promocion', {
                    url: '/promocion',
                    data: {
                        pageTitle: 'Certificados',
                        pageHeader: {
                            icon: 'fa flaticon-certificate',
                            title: 'Certificados',
                            subtitle: 'Seleccionar curso'
                        },
                        breadcrumbs: [
                            {title: 'Certificados'},{title: 'Seleccionar curso'}
                        ]
                    },
                    
                    views:{
                        'content@multiacademico':{
                            templateUrl: 'views/multiacademico/certificados/seleccionar-aula-certificado-promocion.html',
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
            .state('multiacademico.certificados.promocion.aula', {
                    url: '/aula/{aula}',
                    data: {
                        pageTitle: 'Certificados',
                        pageHeader: {
                            icon: 'fa flaticon-certificate',
                            title: 'Certificados',
                            subtitle: 'Promocion'
                        },
                        breadcrumbs: [
                            {title: 'Certificados'},{title: 'Promocion'}
                        ]
                    },
                    views:{
                        'content@multiacademico':{
                            templateUrl: function($stateParams){
                                return Routing.generate('certificados-promocion-curso-api',{aula: $stateParams.aula});
                                }//,
                                
                           // controller: 'InformesCtrl',
                           /*resolve:{
                              
                               aula: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('get_aula',{curso: $stateParams.curso,especializacion:$stateParams.especializacion, paralelo:$stateParams.paralelo,seccion: $stateParams.seccion,periodo:$stateParams.periodo,'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data.aula;
                                         });
                                         }
                                     } */  
                        }
                    }
                });    
              



    });

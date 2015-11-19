/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.certificados', ['ui.router']);

    couchPotato.configureApp(module);
    
    module.config(function ($stateProvider, $couchPotatoProvider)
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
                                             return response.data.aulas;
                                         });
                                         }
                                     }
                           }
                        }
                })
            .state('multiacademico.certificados.matricula.aula', {
                    url: '/aula/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}',
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
                                return Routing.generate('certificados-matricula-curso-api',{curso: $stateParams.curso,especializacion:$stateParams.especializacion, paralelo:$stateParams.paralelo,seccion: $stateParams.seccion,periodo:$stateParams.periodo});
                                }//,
                                
                           // controller: 'InformesCtrl',
                           /*resolve:{
                               deps: $couchPotatoProvider.resolveDependencies([
                                'multiacademico/informes/controllers/InformesCtrl'//,
                               // 'multiacademico/calificaciones/Calificaciones'
                               
                                ])//,
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

    module.run(function($couchPotato){
        module.lazy = $couchPotato;
    });
    return module;
});

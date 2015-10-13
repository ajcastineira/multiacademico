define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.estudiantes', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/estudiantes/', '/estudiantes');
        var rutas={create:'estudiantes_create',
                    new:'estudiantes_api_new',
                    edit:'estudiantes_api_edit',
                    update:'estudiantes_update',
                    list:'estudiantes_api',
                    state_created:'multiacademico.estudiantes.show',
                    state_updated:'multiacademico.estudiantes.show'
                     };
        $stateProvider
            .state ('multiacademico.estudiantes', {abstract:true})
           
            .state('multiacademico.estudiantes.list', {
                url: '/estudiantes',
                data: {
                        pageTitle: 'matriculas',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'matriculas',
                            subtitle: 'matriculas and more'
                        },
                        breadcrumbs: [
                            {title: 'matriculas'},{title: 'matriculas'}
                        ]
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('estudiantes_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.estudiantes.show', {
                url: '/estudiantes/{id:[0-9]{1,11}}',
                data: {
                    title: 'Mostrando Estudiante'
                },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('estudiantes_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.estudiantes.new', {
                url: '/estudiantes/new',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                    title: 'Nuevo'
                },
                views: {
                    "": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        }
                    }
                }
            })
            .state('multiacademico.estudiantes.edit', {
                url: '/estudiantes/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                    title: 'Editar'
                },
                views: {
                    "": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.edit($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        }
                    }
                }
            })
    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.especializaciones', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/especializaciones/', '/especializaciones');
        var rutas={create:'especializaciones_create',
                    new:'especializaciones_api_new',
                    edit:'especializaciones_api_edit',
                    update:'especializaciones_update',
                    list:'especializaciones_api',
                    state_created:'multiacademico.especializaciones.show',
                    state_updated:'multiacademico.especializaciones.show'
                     };
        $stateProvider
            .state ('multiacademico.especializaciones', {
                abstract:true,
                data: {
                        pageTitle: 'especializaciones',
                        pageHeader: {
                            icon: 'flaticon-teacher',
                            title: 'Especializaciones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Especializaciones'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.especializaciones.list', {
                url: '/especializaciones',
                data: {
                        pageTitle: 'especializaciones'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('especializaciones_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.especializaciones.show', {
                url: '/especializaciones/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teacher',
                            title: 'Especializaciones',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Especializaciones'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('especializaciones_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.especializaciones.new', {
                url: '/especializaciones/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'especializaciones',
                        pageHeader: {
                            icon: 'flaticon-teacher',
                            title: 'Especializaciones',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Especializaciones'},{title: 'nuevo'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'//,
                            ])
                        }
                    }
                }
            })
            .state('multiacademico.especializaciones.edit', {
                url: '/especializaciones/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teacher',
                            title: 'especializaciones',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'especializaciones'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
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

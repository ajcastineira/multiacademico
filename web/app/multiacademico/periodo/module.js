define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.periodo', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/periodo/', '/periodo');
        var rutas={create:'periodo_create',
                    new:'periodo_api_new',
                    edit:'periodo_api_edit',
                    update:'periodo_update',
                    list:'periodo_api',
                    state_created:'multiacademico.periodo.show',
                    state_updated:'multiacademico.periodo.show'
                     };
        $stateProvider
            .state ('multiacademico.periodo', {
                abstract:true,
                data: {
                        pageTitle: 'periodo',
                        pageHeader: {
                            icon: 'flaticon-calendar5',
                            title: 'periodo',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'periodo'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.periodo.list', {
                url: '/periodo',
                data: {
                        pageTitle: 'periodo'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('periodo_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.periodo.show', {
                url: '/periodo/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-calendar5',
                            title: 'periodo',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'periodo'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('periodo_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.periodo.new', {
                url: '/periodo/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'periodo',
                        pageHeader: {
                            icon: 'flaticon-calendar5',
                            title: 'periodo',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'periodo'},{title: 'nuevo'}
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
            .state('multiacademico.periodo.edit', {
                url: '/periodo/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-calendar5',
                            title: 'periodo',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'periodo'},{title: 'editar'}
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

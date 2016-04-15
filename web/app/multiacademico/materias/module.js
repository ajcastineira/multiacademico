define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.materias', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/materias/', '/materias');
        var rutas={create:'materias_create',
                    new:'materias_api_new',
                    edit:'materias_api_edit',
                    update:'materias_update',
                    list:'materias_api',
                    state_created:'multiacademico.materias.show',
                    state_updated:'multiacademico.materias.show'
                     };
        $stateProvider
            .state ('multiacademico.materias', {
                abstract:true,
                data: {
                        pageTitle: 'materias',
                        pageHeader: {
                            icon: 'flaticon-library',
                            title: 'Materias',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'materias'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.materias.list', {
                url: '/materias',
                data: {
                        pageTitle: 'materias'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('materias_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.materias.show', {
                url: '/materias/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-library',
                            title: 'Materias',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'materias'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('materias_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.materias.new', {
                url: '/materias/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'materias',
                        pageHeader: {
                            icon: 'flaticon-library',
                            title: 'Materias',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'materias'},{title: 'nuevo'}
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
            .state('multiacademico.materias.edit', {
                url: '/materias/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-library',
                            title: 'Materias',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'materias'},{title: 'editar'}
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

define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.pensiones', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/pensiones/', '/pensiones');
        var rutas={create:'pensiones_create',
                    new:'pensiones_api_new',
                    edit:'pensiones_api_edit',
                    update:'pensiones_update',
                    list:'pensiones_api',
                    state_created:'multiacademico.pensiones.show',
                    state_updated:'multiacademico.pensiones.show'
                     };
        $stateProvider
            .state ('multiacademico.pensiones', {
                abstract:true,
                data: {
                        pageTitle: 'Pensiones',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.pensiones.list', {
                url: '/pensiones',
                data: {
                        pageTitle: 'Pensiones'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('pensiones_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.pensiones.show', {
                url: '/pensiones/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('pensiones_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.pensiones.new', {
                url: '/pensiones/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'pensiones',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'nuevo'}
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
            .state('multiacademico.pensiones.edit', {
                url: '/pensiones/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'editar'}
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

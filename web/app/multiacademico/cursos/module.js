define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.cursos', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/cursos/', '/cursos');
        var rutas={create:'cursos_create',
                    new:'cursos_api_new',
                    edit:'cursos_api_edit',
                    update:'cursos_update',
                    list:'cursos_api',
                    state_created:'multiacademico.cursos.show',
                    state_updated:'multiacademico.cursos.show'
                     };
        $stateProvider
            .state ('multiacademico.cursos', {
                abstract:true,
                data: {
                        pageTitle: 'cursos',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'cursos',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.cursos.list', {
                url: '/cursos',
                data: {
                        pageTitle: 'cursos'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('cursos_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.cursos.show', {
                url: '/cursos/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'cursos',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('cursos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.cursos.new', {
                url: '/cursos/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'cursos',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'cursos',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'nuevo'}
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
            .state('multiacademico.cursos.edit', {
                url: '/cursos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'cursos',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'editar'}
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

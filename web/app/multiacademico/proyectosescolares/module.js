define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.proyectosescolares', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/proyectosescolares/', '/proyectosescolares');
        var rutas={create:'proyectosescolares_create',
                    new:'proyectosescolares_api_new',
                    edit:'proyectosescolares_api_edit',
                    update:'proyectosescolares_update',
                    list:'proyectosescolares_api',
                    state_created:'multiacademico.proyectosescolares.show',
                    state_updated:'multiacademico.proyectosescolares.show'
                     };
        $stateProvider
            .state ('multiacademico.proyectosescolares', {
                abstract:true,
                data: {
                        pageTitle: 'Proyectos Escolares',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Proyectos Escolares',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Proyectos Escolares'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.proyectosescolares.list', {
                url: '/proyectosescolares',
                data: {
                        pageTitle: 'Proyectos Escolares'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('proyectosescolares_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.proyectosescolares.show', {
                url: '/proyectosescolares/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Proyectos Escolares',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Proyectos Escolares'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('proyectosescolares_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.proyectosescolares.new', {
                url: '/proyectosescolares/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'Proyectos Escolares',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Proyectos Escolares',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Proyectos Escolares'},{title: 'nuevo'}
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
            .state('multiacademico.proyectosescolares.edit', {
                url: '/proyectosescolares/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Proyectos Escolares',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Proyectos Escolares'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.edit($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps:$couchPotatoProvider.resolveDependencies([
                               // 'modules/forms/directives/input/smartSelect2',
                                'multiacademico/proyectosescolares/directives/collectionForm',
                                'modules/forms/controllers/FormsCrudCtrl'
                            ]),
                            deps2: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                                    var pluginPath   = settings.pluginPath  ; // Create variable JS path
                                    return $ocLazyLoad.load( // You can lazy load files for an existing module
                                    [
                                        {
                                            insertBefore: '#load_css_before',
                                            files: [
                                                pluginPath+'/chosen/chosen.min.css'
                                            ]
                                        }
                                    ]
                                    )}]
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

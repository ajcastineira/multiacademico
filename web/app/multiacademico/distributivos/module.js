define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.distributivos', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/distributivos/', '/distributivos');
        var rutas={create:'distributivos_create',
                    new:'distributivos_api_new',
                    edit:'distributivos_api_edit',
                    update:'distributivos_update',
                    list:'distributivos_api',
                    state_created:'multiacademico.distributivos.show',
                    state_updated:'multiacademico.distributivos.show'
                     };
        $stateProvider
            .state ('multiacademico.distributivos', {
                abstract:true,
                data: {
                        pageTitle: 'Distributivos',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Distributivos',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Distributivos'},{title: 'lista'}
                        ]
                    },
                resolve:{
                    chosencss: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

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
                                    );
                                }]
                    
                }
            })
           
            .state('multiacademico.distributivos.list', {
                url: '/distributivos',
                data: {
                        pageTitle: 'Distributivos'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('distributivos_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.distributivos.show', {
                url: '/distributivos/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Distributivos',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Distributivos'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('distributivos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.distributivos.new', {
                url: '/distributivos/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'distributivos',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Distributivos',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Distributivos'},{title: 'nuevo'}
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
            .state('multiacademico.distributivos.edit', {
                url: '/distributivos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Distributivos',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Distributivos'},{title: 'editar'}
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

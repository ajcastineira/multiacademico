define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.docentes', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/docentes/', '/docentes');
        var rutas={create:'docentes_create',
                    new:'docentes_api_new',
                    edit:'docentes_api_edit',
                    update:'docentes_update',
                    list:'docentes_api',
                    state_created:'multiacademico.docentes.show',
                    state_updated:'multiacademico.docentes.show'
                     };
        $stateProvider
            .state ('multiacademico.docentes', {
                abstract:true,
                data: {
                        pageTitle: 'Docentes',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Docentes',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'lista'}
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
           
            .state('multiacademico.docentes.list', {
                url: '/docentes',
                data: {
                        pageTitle: 'Docentes'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('docentes_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.docentes.show', {
                url: '/docentes/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Docentes',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('docentes_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.docentes.new', {
                url: '/docentes/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'docentes',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Docentes',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'nuevo'}
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
            .state('multiacademico.docentes.edit', {
                url: '/docentes/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Docentes',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'editar'}
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

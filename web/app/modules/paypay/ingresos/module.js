define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.paypay.ingresos', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/ingresos/', '/ingresos');
        var rutas={create:'new_ingreso',
                    new:'new_ingreso',
                    edit:'edit_ingreso',
                    update:'edit_ingreso',
                    show:'show_ingreso',
                    list:'index_ingreso',
                    state_created:'app.paypay.ingresos.show',
                    state_updated:'app.paypay.ingresos.show'
                     };
        $stateProvider
            .state ('app.paypay.ingresos', {
                abstract:true,
                data: {
                        pageTitle: 'Ingresos',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Ingresos',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Ingresos'},{title: 'lista'}
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
           
            .state('app.paypay.ingresos.list', {
                url: '/ingresos',
                data: {
                        pageTitle: 'Ingresos'
                    },
                 views: {
                    "content@app": {
                        templateUrl: Routing.generate(rutas.list,{'_format':'html'}),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('app.paypay.ingresos.show', {
                url: '/ingresos/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Ingresos',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Ingresos'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'ingreso':$stateParams.id,'_format':'html'});
                        }
                    }
                }
            })
            .state('app.paypay.ingresos.new', {
                url: '/ingresos/new',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'ingresos',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Ingresos',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Ingresos'},{title: 'nuevo'}
                        ]
                    },
                resolve: {
                            deps:$couchPotatoProvider.resolveDependencies([
                               // 'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas,{'_format':'html'});
                             },
                        controller: 'FormsCrudCtrl'
                    }
                }
            })
            .state('app.paypay.ingresos.edit', {
                url: '/ingresos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Ingresos',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Ingresos'},{title: 'editar'}
                        ]
                    },
                resolve: {
                            deps:$couchPotatoProvider.resolveDependencies([
                               // 'modules/forms/directives/input/smartSelect2',
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
                        },    
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'ingreso':$stateParams.id,'_format':'html'});
                                  //return "Hola mundo ";
                             },
                        controller: 'FormsCrudCtrl'
                        /*resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        }*/
                    }
                }
            })
    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

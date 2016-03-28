define(['angular',
    'angular-couch-potato',
    'angular-ui-router'], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.paypay.facturas', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/facturas/', '/facturas');
        var rutas={create:'facturas_create',
                    new:'facturas_api_new',
                    edit:'facturas_api_edit',
                    update:'facturas_update',
                    list:'facturas_api',
                    state_created:'app.paypay.facturas.show',
                    state_updated:'app.paypay.facturas.show'
                     };
        $stateProvider
           
            .state('app.paypay.facturas', {
                abstract: true,
                data: {
                    title: 'Facturas'
                }
            })
           
            .state('app.paypay.facturas.list', {
                url: '/facturas',
                data: {
                    title: 'Facturas'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('facturas_api'),

                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic',
                                'modules/forms/controllers/PrintCtrl'
                            ])
                        }
                    }
                }
            })
            .state('app.paypay.facturas.show', {
                url: '/facturas/{id:[0-9]{1,11}}',
                data: {
                    title: 'Mostrando Ingreso'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate('facturas_api_show',{id:$stateParams.id});
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/controllers/PrintCtrl'
                            ])
                        }
                    }
                }
            })
            .state('app.paypay.facturas.new', {
                url: '/facturas/new',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                    title: 'Nuevo'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                              //  'modules/forms/directives/collection/collectionForm',
                                'modules/forms/controllers/FormsCrudCtrl',
                                'modules/paypay/facturas/controllers/FacturaCtrl'
                            ])
                        }
                    }
                }
            })
            .state('app.paypay.facturas.edit', {
                url: '/facturas/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                    title: 'Editar'
                },
                views: {
                    "content@app": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.edit($stateParams,rutas);
                             },
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl',
                                'modules/paypay/facturas/controllers/FacturaCtrl'
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

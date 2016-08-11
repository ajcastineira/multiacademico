    "use strict";

    angular.module('app.paypay.facturas', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
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
                        
                    }
                }
            })
    });

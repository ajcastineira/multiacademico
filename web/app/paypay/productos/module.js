    "use strict";

    angular.module('app.paypay.productos', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/productos/', '/productos');
        var rutas={create:'productos_create',
                    new:'productos_api_new',
                    edit:'productos_api_edit',
                    update:'productos_update',
                    list:'productos_api',
                    state_created:'app.paypay.productos.show',
                    state_updated:'app.paypay.productos.show'
                     };
        $stateProvider
           
            .state('app.paypay.productos', {
                abstract: true,
                data: {
                    title: 'Productos'
                }
            })
           
            .state('app.paypay.productos.list', {
                url: '/productos',
                data: {
                    title: 'Productos'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('productos_api'),

                        
                    }
                }
            })
            .state('app.paypay.productos.show', {
                url: '/productos/{id:[0-9]{1,11}}',
                data: {
                    title: 'Mostrando Ingreso'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate('productos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('app.paypay.productos.new', {
                url: '/productos/new',
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
            .state('app.paypay.productos.edit', {
                url: '/productos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                    title: 'Nuevo'
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

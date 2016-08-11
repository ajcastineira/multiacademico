    "use strict";

    angular.module('app.paypay.egresos', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/egresos/', '/egresos');
        var rutas={create:'new_egresos',
                    new:'new_egresos',
                    edit:'edit_egresos',
                    update:'edit_egresos',
                    list:'egresos_index',
                    state_created:'app.paypay.egresos.show',
                    state_updated:'app.paypay.egresos.show'
                     };
        $stateProvider
           
            .state('app.paypay.egresos', {
                abstract: true,
                data: {
                    title: 'Egresos'
                }
            })
           
            .state('app.paypay.egresos.list', {
                url: '/egresos',
                data: {
                    title: 'Egresos'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate('egresos_api'),

                        
                    }
                }
            })
            .state('app.paypay.egresos.show', {
                url: '/egresos/{id:[0-9]{1,11}}',
                data: {
                    title: 'Mostrando Egreso'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate('egresos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('app.paypay.egresos.new', {
                url: '/egresos/new',
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
            .state('app.paypay.egresos.edit', {
                url: '/egresos/{id:[0-9]{1,11}}/edit',
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

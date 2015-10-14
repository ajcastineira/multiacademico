define(['angular',
    'angular-couch-potato',
    'angular-ui-router'], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.users', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/arxis/user/', '/arxis/user');
        var rutas={create:'secured_user_create',
                    new:'secured_user_api_new',
                    edit:'secured_user_api_edit',
                    update:'secured_user_update',
                    show:'secured_user_api_show',
                    list:'secured_user_api',
                    state_created:'app.users.profile',
                    state_updated:'app.users.profile'
                     };
        $stateProvider
            
            .state('app.me', {
                url: '/me',
                data: {
                    title: 'Mi Perfil'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate('secured_user_api_showme');
                        },
                        controller: function ($scope, contact) {
                            $scope.contact = contact;
                        },
                        resolve: {
                            contact: function($http){
                                //return $http.get('api/project-list.json')
                                return 0
                            }
                        }
                    }
                }
            })    
            .state('app.users', {
                abstract: true,
                data: {
                    title: 'Usuarios'
                }
            })
           
            .state('app.users.list', {
                url: '/arxis/user',
                data: {
                    title: 'Resumen'
                },
                views: {
                    "content@app": {
                        templateUrl: Routing.generate(rutas.list),

                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }
            })
            .state('app.users.profile', {
                url: '/arxis/user/{id:[0-9]{1,11}}',
                data: {
                    title: 'Perfil Usuario'
                },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{id:$stateParams.id});
                        },
                        controller: function ($scope, contact) {
                            $scope.contact = contact;
                        },
                        resolve: {
                            contact: function($http){
                                //return $http.get('api/project-list.json')
                                return 0
                            }
                        }
                    }
                }
            })
            .state('app.users.new', {
                url: '/arxis/user/new',
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
                                'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        }
                    }
                }
            })
            .state('app.users.edit', {
                url: '/arxis/user/{id:[0-9]{1,11}}/edit',
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

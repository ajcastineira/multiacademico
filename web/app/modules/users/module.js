define(['angular',
    'angular-couch-potato',
    'angular-ui-router',
    'angular-x-editable',
    'angular-mocks','jasny-bootstrap-fileinput','jquery-autosize'],
function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.users', ['ui.router','xeditable']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
       // $urlRouterProvider.when('/arxis/user/', '/arxis/user');
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
                        pageTitle: 'Mi perfil',
                        pageHeader: {
                            icon: 'fa fa-user',
                            title: 'Mi perfil',
                            subtitle: 'Mi Perfil'
                        },
                        breadcrumbs: [
                            {title: 'Mi Perfil'}
                        ]
                    },
                resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/users/controllers/MeCtrl',
                                'modules/users/directives/loadingspiner'
                            ])
                        },  
                views: {
                    "content@app": {
                       
                        templateUrl: function($stateParams){
                            return Routing.generate('secured_user_api_showme');
                        },
                        controller: "MeCtrl",
                        /*controller: function ($scope, contact) {
                            $scope.contact = contact;
                        },*/
                        resolve: {
                            deps2: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                                var pluginPath = settings.pluginPath; // Create variable plugin path
                                var pluginProdPath=settings.pluginProdPath;
                                    return $ocLazyLoad.load( // You can lazy load files for an existing module
                                        [
                                            {
                                                insertBefore: '#load_css_before',
                                                files: [
                                                    pluginPath+'/angular-xeditable/dist/css/xeditable.css',
                                                 
                                                    pluginProdPath+'/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css',
                                               
                                                ]
                                            }

                                        ]
                                    );
                                }]
                          
                        }
                    }
                }
            })
           .state('app.users', {
                abstract: true,
                data: {
                        pageTitle: 'Usuarios',
                        pageHeader: {
                            icon: 'fa fa-user',
                            title: 'Usuarios',
                            subtitle: 'Usuarios'
                        },
                        breadcrumbs: [
                            {title: 'Usuarios'}
                        ]
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
                url: '/perfil/{id:[0-9]{1,11}}',
                data: {
                        pageTitle: 'Perfil',
                        pageHeader: {
                            icon: 'fa fa-user',
                            title: 'Perfil',
                            subtitle: 'perfil'
                        },
                        breadcrumbs: [
                            {title: 'Perfil'}
                        ]
                    },
                resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/users/controllers/MeCtrl',
                                'modules/users/directives/loadingspiner'
                            ])
                        },      
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{id:$stateParams.id});
                        },
                        controller:"MeCtrl",
                        resolve: {
                            deps2: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                                var pluginPath = settings.pluginPath; // Create variable plugin path
                                var pluginProdPath=settings.pluginProdPath;
                                    return $ocLazyLoad.load( // You can lazy load files for an existing module
                                        [
                                            {
                                                insertBefore: '#load_css_before',
                                                files: [
                                                    pluginPath+'/angular-xeditable/dist/css/xeditable.css',
                                                 
                                                    pluginProdPath+'/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css',
                                               
                                                ]
                                            }

                                        ]
                                    );
                                }]
                          
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
            });
    });

    module.run(function ($couchPotato,editableOptions) {
        module.lazy = $couchPotato;
        editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });

    return module;

});

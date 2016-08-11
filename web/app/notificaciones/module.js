
    "use strict";

    angular.module('app.notificaciones', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/notificaciones/', '/notificaciones');
        var rutas={create:'new_notificacion',
                    new:'new_notificacion',
                    edit:'new_notificacion',
                    update:'new_notificacion',
                    show:'new_notificacion',
                    list:'new_notificacion',
                    state_created:'app.notificaciones.show',
                    state_updated:'app.notificaciones.show'
                     };
        $stateProvider
            .state ('app.notificaciones', {
                abstract:true,
                data: {
                        pageTitle: 'Notificaciones',
                        pageHeader: {
                            icon: 'fa fa-bell',
                            title: 'Notificaciones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Notificaciones'},{title: 'lista'}
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
           
            .state('app.notificaciones.list', {
                url: '/notificaciones',
                data: {
                        pageTitle: 'Notificaciones'
                    },
               
                 views: {
                    "content@app": {
                        templateUrl: Routing.generate(rutas.list,{'_format':'html'})
                    }
                }    
                
            })
            .state('app.notificaciones.show', {
                url: '/notificaciones/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Notificaciones',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Notificaciones'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@app": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'notificacion':$stateParams.id,'_format':'html'});
                        }
                    }
                }
            })
            .state('app.notificaciones.new', {
                url: '/notificaciones/new',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'notificaciones',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Notificaciones',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Notificaciones'},{title: 'nuevo'}
                        ]
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
            .state('app.notificaciones.edit', {
                url: '/notificaciones/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Notificaciones',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Notificaciones'},{title: 'editar'}
                        ]
                    },
                resolve: {
                            
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
                                  return FormsCrud.editWithVars($stateParams,rutas,{'notificacion':$stateParams.id,'_format':'html'});
                                  //return "Hola mundo ";
                             },
                        controller: 'FormsCrudCtrl'
                        
                    }
                }
            })
    });


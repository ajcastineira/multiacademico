"use strict";

angular.module('multiacademico.comportamiento', ['ui.router'])
 .config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/comportamiento/', '/comportamiento');
    var rutas={create:'comportamiento_create',
                new:'comportamiento_api_new',
                edit:'comportamiento_api_edit',
                update:'comportamiento_update',
                list:'comportamiento_api',
                state_created:'multiacademico.comportamiento.show',
                state_updated:'multiacademico.comportamiento.show'
                 };
    $stateProvider
        .state ('multiacademico.comportamiento', {
            abstract:true,
            data: {
                    pageTitle: 'Comportamiento',
                    pageHeader: {
                        icon: 'flaticon-meeting',
                        title: 'Comportamiento',
                        subtitle: 'Lista'
                    },
                    breadcrumbs: [
                        {title: 'Comportamiento'},{title: 'lista'}
                    ]
                }
        })

        .state('multiacademico.comportamiento.list', {
            url: '/comportamiento',
            data: {
                    pageTitle: 'Comportamiento'
                },
             views: {
                "content@multiacademico": {
                    templateUrl: Routing.generate('comportamiento_api'),
                    
                }
            }    

        })
        .state('multiacademico.comportamiento.show', {
            url: '/comportamiento/{id:[0-9]{1,11}}',
             data: {
                    pageHeader: {
                        icon: 'flaticon-meeting',
                        title: 'Comportamiento',
                        subtitle: 'Mostrar'
                    },
                    breadcrumbs: [
                        {title: 'Comportamiento'},{title: 'mostrar'}
                    ]
                },
            views: {
                "content@multiacademico": {
                    templateUrl: function($stateParams){
                        return Routing.generate('comportamiento_api_show',{id:$stateParams.id});
                    }
                }
            }
        })
        .state('multiacademico.comportamiento.new', {
            url: '/comportamiento/new',
            params:{
              submited:false,
              formData:null
            },
             data: {
                    pageTitle: 'Comportamiento',
                    pageHeader: {
                        icon: 'flaticon-meeting',
                        title: 'Comportamiento',
                        subtitle: 'Nuevo'
                    },
                    breadcrumbs: [
                        {title: 'Comportamiento'},{title: 'nuevo'}
                    ]
                },
            views: {
                "content@multiacademico": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.nuevo($stateParams,rutas);
                         },
                    controller: 'FormsCrudCtrl',
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
                    }
                }
            }
        })
        .state('multiacademico.comportamiento.edit', {
            url: '/comportamiento/{id:[0-9]{1,11}}/edit',
            params:{
                id:undefined,
                submited:false,
                formData:null
            },
            data: {
                    pageHeader: {
                        icon: 'flaticon-meeting',
                        title: 'Comportamiento',
                        subtitle: 'Editar'
                    },
                    breadcrumbs: [
                        {title: 'Comportamiento'},{title: 'editar'}
                    ]
                },
            views: {
                "content@multiacademico": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.edit($stateParams,rutas);
                         },
                    controller: 'FormsCrudCtrl',
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
                    }
                }
            }
        })
});

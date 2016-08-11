    "use strict";

    angular.module('multiacademico.docentes', ['ui.router'])
           .config(function ($stateProvider, $urlRouterProvider) {
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
                        },
                        
                    }
                }
            })
            .state('multiacademico.docentes.authorize', {
                url: '/docentes/{id:[0-9]{1,11}}/{horas:[0-9]{1,3}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Docentes',
                            subtitle: 'Autorizar'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'autorizar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('docentes_autorizacion',{docente:$stateParams.id,horas:$stateParams.horas});
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
                        
                    }
                }
            })
    });
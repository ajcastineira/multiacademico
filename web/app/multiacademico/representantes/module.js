    "use strict";

    angular.module('multiacademico.representantes', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/representantes/', '/representantes');
        var rutas={create:'new_representante',
                    new:'new_representante',
                    edit:'edit_representante',
                    update:'edit_representante',
                    show:'get_representante',
                    list:'index_representante',
                    state_created:'multiacademico.representantes.show',
                    state_updated:'multiacademico.representantes.show'
                     };
        $stateProvider
            .state ('multiacademico.representantes', {
                abstract:true,
                data: {
                        pageTitle: 'Representantes',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Representantes',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Representantes'},{title: 'lista'}
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
           
            .state('multiacademico.representantes.list', {
                url: '/representantes',
                data: {
                        pageTitle: 'Representantes'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate(rutas.list,{'_format':'html'}),
                        
                    }
                }    
                
            })
            .state('multiacademico.representantes.show', {
                url: '/representantes/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Representantes',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Representantes'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'representante':$stateParams.id,'_format':'html'});
                        },
                        //controller: 'PrintCtrl',
                        
                    }
                }
            })
            .state('multiacademico.representantes.new', {
                url: '/representantes/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'representantes',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Representantes',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Representantes'},{title: 'nuevo'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.nuevo($stateParams,rutas,{'_format':'html'});
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            .state('multiacademico.representantes.edit', {
                url: '/representantes/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Representantes',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Representantes'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'representante':$stateParams.id,'_format':'html'});
                                  //return "Hola mundo ";
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
    });
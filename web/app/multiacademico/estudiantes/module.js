    "use strict";

    angular.module('multiacademico.estudiantes', ['ui.router'])
           .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/estudiantes/', '/estudiantes');
        var rutas={create:'estudiantes_create',
                    new:'estudiantes_api_new',
                    edit:'estudiantes_api_edit',
                    update:'estudiantes_update',
                    list:'estudiantes_api',
                    state_created:'multiacademico.estudiantes.show',
                    state_updated:'multiacademico.estudiantes.show'
                     };
        $stateProvider
            .state ('multiacademico.estudiantes', {
                abstract:true,
                data: {
                        pageTitle: 'Estudiantes',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Estudiantes',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Estudiantes'},{title: 'lista'}
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
           
            .state('multiacademico.estudiantes.list', {
                url: '/estudiantes',
                data: {
                        pageTitle: 'Estudiantes'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('estudiantes_api'),
                        
                    }
                }   
                
            })
            .state('multiacademico.estudiantes.show', {
                url: '/estudiantes/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Estudiantes',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Estudiantes'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('estudiantes_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.estudiantes.new', {
                url: '/estudiantes/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'Estudiantes',
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Estudiantes',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Estudiantes'},{title: 'nuevo'}
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
            .state('multiacademico.estudiantes.edit', {
                url: '/estudiantes/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'fa fa-users',
                            title: 'Estudiantes',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Estudiantes'},{title: 'editar'}
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
            .state('multiacademico.estudiantes.miscalificaciones', {
                url: '/miscalificaciones',
                 data: {
                        pageTitle: 'Mis Calificaciones',
                        pageHeader: {
                            icon: 'flaticon-big57',
                            title: 'Mis Calificaciones',
                            subtitle: 'Menu'
                        },
                        breadcrumbs: [
                            {title: 'Mis Calificaciones'},{title: 'menu'}
                        ]
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: "views/multiacademico/estudiantes/menu-calificaciones.html"
                    }
                }    
                
            })
            .state('multiacademico.estudiantes.miscalificaciones.informe', {
                url: '/{q}/{p}',
                 data: {
                        pageTitle: 'Mis Calificaciones',
                        pageHeader: {
                            icon: 'flaticon-schedule',
                            title: 'Mis Calificaciones',
                            subtitle: 'Informe'
                        },
                        breadcrumbs: [
                            {title: 'Mis Calificaciones'},{title: 'informe'}
                        ]
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('miscalificaciones_informe_api'),
                        controller:"MisCalificacionesCtrl",
                        resolve:{
                               
                                estudiante: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('get_miscalificaciones',{'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data.estudiante;
                                         });
                                         }
                                            
                                }
                    }   
                    
                }    
                
            })
    });

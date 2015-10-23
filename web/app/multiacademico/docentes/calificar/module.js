define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.docentes.midistributivo', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
      //  $urlRouterProvider.when('/estudiantes/', '/estudiantes');
        var rutas={//create:'estudiantes_create',
                   // new:'estudiantes_api_new',
                    edit:'calificaciones_api',
                    update:'calificaciones_api',
                    //list:'estudiantes_api',
                    state_created:'multiacademico.docentes.midistributivo.menu.calificaciones',
                    state_updated:'multiacademico.docentes.midistributivo.menu.calificaciones'
                     };
        $stateProvider
            .state ('multiacademico.docentes', {
                abstract:true,
                data: {
                        pageTitle: 'Docentes',
                        pageHeader: {
                            icon: 'flaticon-teacher',
                            title: 'Docente',
                            subtitle: 'Docente'
                        },
                        breadcrumbs: [
                            {title: 'Docentes'},{title: 'lista'}
                        ]
                    },
                
            })
            .state ('multiacademico.docentes.midistributivo', {
                //abstract:true,
                url:'/midistributivo',
                data: {
                        pageTitle: 'Calificar',
                        pageHeader: {
                            icon: 'flaticon-a1',
                            title: 'Calificar',
                            subtitle: 'Distributivo'
                        },
                        breadcrumbs: [
                            {title: 'Calificar'},{title: 'lista'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('midistributivo_api'),
                        
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.menu', {
               // abstract:true,
                url:'/menu/{id:[0-9]{1,11}}',
                data: {
                        pageTitle: 'Calificar',
                        pageHeader: {
                            icon: 'flaticon-a1',
                            title: 'Calificar',
                            subtitle: 'Distributivo'
                        },
                        breadcrumbs: [
                            {title: 'Calificar'},{title: 'lista'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('menu_calificar_api',{id:$stateParams.id});
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.menu.calificaciones', {
               // abstract:true,
                url:'/calificaciones/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Calificaciones',
                        pageHeader: {
                            icon: 'flaticon-a1',
                            title: 'Calificaciones',
                            subtitle: 'Curso'
                        },
                        breadcrumbs: [
                            {title: 'Calificaciones'},{title: 'calificar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateProvider:function($stateParams,CalificarForm){
                                
                                  return CalificarForm.calificar($stateParams,rutas);
                             },
                        controller: 'CalificarCtrl',    
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'multiacademico/docentes/calificar/controllers/CalificarCtrl',
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.proyectos', {
                url:'/proyectos/{id:[0-9]{1,11}}',
                data: {
                        pageTitle: 'Calificar Proyecto Escolar',
                        pageHeader: {
                            icon: 'flaticon-a1',
                            title: 'Proyectos Escolares',
                            subtitle: 'Distributivo'
                        },
                        breadcrumbs: [
                            {title: 'Calificar Proyecto'},{title: 'lista'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('menu_proyectos_escolares_api',{id:$stateParams.id});
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.proyectos.calificaciones', {
               // abstract:true,
                url:'/calificaciones/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Calificaciones Proyecto Escolar',
                        pageHeader: {
                            icon: 'flaticon-a1',
                            title: 'Calificaciones Proyecto Escolar',
                            subtitle: 'Curso'
                        },
                        breadcrumbs: [
                            {title: 'Calificaciones Proyecto Escolar'},{title: 'calificar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateProvider:function($stateParams,CalificarForm){
                                var rutas2={
                                            edit:'calificaciones_proyecto_api',
                                            update:'calificaciones_proyecto_api',
                                            state_created:'multiacademico.docentes.midistributivo.proyectos.calificaciones',
                                            state_updated:'multiacademico.docentes.midistributivo.proyectos.calificaciones'
                                             };
                                  return CalificarForm.calificar($stateParams,rutas2);
                             },
                        controller: 'CalificarCtrl',    
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'multiacademico/docentes/calificar/controllers/CalificarCtrl',
                                'modules/tables/directives/datatables/datatableBasic'
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

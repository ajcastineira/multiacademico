    "use strict";

    angular.module('multiacademico.docentes.midistributivo', ['ui.router'])
            .config(function ($stateProvider, $urlRouterProvider) {
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
                        
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.menu', {
               // abstract:true,
                url:'/menu/{id:[0-9]{1,11}}',
                data: {
                        pageTitle: 'Calificar',
                        pageHeader: {
                            icon: 'flaticon-teach',
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
                            icon: 'flaticon-teach',
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
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.menu.informeaprendizaje', {
               // abstract:true,
                url:'/informeaprendizaje/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Calificaciones Informe Aprendizaje',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Calificaciones',
                            subtitle: 'Curso'
                        },
                        breadcrumbs: [
                            {title: 'Calificaciones'},{title: 'calificar informe aprendizaje'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateProvider:function($stateParams,CalificarForm){
                                  var rutas_informes={
                                            edit:'calificaciones_informeaprendizaje_api',
                                            update:'calificaciones_informeaprendizaje_api',
                                            state_created:'multiacademico.docentes.midistributivo.proyectos.informeaprendizaje',
                                            state_updated:'multiacademico.docentes.midistributivo.proyectos.informeaprendizaje'
                                             };
                                  return CalificarForm.calificar($stateParams,rutas_informes);
                             },
                        controller: 'CalificarCtrl',    
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.proyectos', {
                url:'/proyectos/{id:[0-9]{1,11}}',
                data: {
                        pageTitle: 'Calificar Proyecto Escolar',
                        pageHeader: {
                            icon: 'flaticon-teach',
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
                            icon: 'flaticon-teach',
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
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.inspector', {
                url: '/inspector/{id}',
                data: {
                        pageTitle: 'Menu Inspector',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Inspector',
                            subtitle: 'Menu'
                        },
                        breadcrumbs: [
                            {title: 'Inspector'},{title: 'menu'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('menu_inspector_api',{'aula':$stateParams.aula});
                        },
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.inspector.asistencia', {
               // abstract:true,
                url:'/asistencia/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Registrar Asistencias',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Registrar Asistencias',
                            subtitle: 'Curso'
                        },
                        breadcrumbs: [
                            {title: 'Registrar Asistencias'},{title: 'registrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateProvider:function($stateParams,CalificarForm){
                                var rutas3={
                                            edit:'registrar_asistencias_api',
                                            update:'registrar_asistencias_api',
                                            state_created:'multiacademico.docentes.midistributivo.inspector.asistencia',
                                            state_updated:'multiacademico.docentes.midistributivo.inspector.asistencia',
                                             };
                                  return CalificarForm.calificar($stateParams,rutas3);
                             },
                        controller: 'CalificarCtrl',    
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.tutor', {
                url: '/tutor/{id}',
                data: {
                        pageTitle: 'Menu Tutor',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Tutor',
                            subtitle: 'Menu'
                        },
                        breadcrumbs: [
                            {title: 'Tutor'},{title: 'menu'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('menu_tutor_api',{'aula':$stateParams.aula});
                        },
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.tutor.comportamiento', {
               // abstract:true,
                url:'/comportamiento/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Calificaciones Comportamiento',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Calificaciones Comportamiento',
                            subtitle: 'Curso'
                        },
                        breadcrumbs: [
                            {title: 'Calificaciones Comportamiento'},{title: 'calificar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateProvider:function($stateParams,CalificarForm){
                                var rutas3={
                                            edit:'calificaciones_comportamiento_api',
                                            update:'calificaciones_comportamiento_api',
                                            state_created:'multiacademico.docentes.midistributivo.tutor.comportamiento',
                                            state_updated:'multiacademico.docentes.midistributivo.tutor.comportamiento'
                                             };
                                  return CalificarForm.calificar($stateParams,rutas3);
                             },
                        controller: 'CalificarCtrl',    
                        
                    }
                }        
                
            })
            .state ('multiacademico.docentes.midistributivo.tutor.calificaciones', {
               // abstract:true,
                url:'/calificaciones/:q/:p',
                params:{
                  submited:false,
                  formData:null
                },
                data: {
                        pageTitle: 'Calificaciones Proyecto Escolar',
                        pageHeader: {
                            icon: 'flaticon-teach',
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
                        
                    }
                }        
                
            })
            
    });

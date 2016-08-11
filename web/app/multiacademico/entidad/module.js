    "use strict";

    angular.module('multiacademico.entidad', ['ui.router'])
           .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/entidad/', '/entidad');
        var rutas={create:'new_entidad',
                    new:'new_entidad',
                    edit:'edit_entidad',
                    update:'edit_entidad',
                    list:'index_entidad',
                    show:'show_entidad',
                    state_created:'multiacademico.entidad.show',
                    state_updated:'multiacademico.entidad.show'
                     };
        $stateProvider
            .state ('multiacademico.entidad', {
                abstract:true,
                data: {
                        pageTitle: 'entidad',
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Entidad',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'entidad'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.entidad.list', {
                url: '/entidad',
                data: {
                        pageTitle: 'Entidad'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate(rutas.list,{'_format':'html'}),
                        
                    }
                }    
                
            })
            .state('multiacademico.entidad.show', {
                url: '/entidad/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Entidad',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'entidad'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{entidad:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.entidad.new', {
                url: '/entidad/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'entidad',
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Entidad',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'entidad'},{title: 'nuevo'}
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
            .state('multiacademico.entidad.edit', {
                url: '/entidad/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Entidad',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'entidad'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'entidad':$stateParams.id,'_format':'html'});
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
    });

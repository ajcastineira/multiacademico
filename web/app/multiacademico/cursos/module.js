    "use strict";

    angular.module('multiacademico.cursos', ['ui.router'])

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/cursos/', '/cursos');
        var rutas={create:'cursos_create',
                    new:'cursos_api_new',
                    edit:'cursos_api_edit',
                    update:'cursos_update',
                    list:'cursos_api',
                    state_created:'multiacademico.cursos.show',
                    state_updated:'multiacademico.cursos.show'
                     };
        $stateProvider
            .state ('multiacademico.cursos', {
                abstract:true,
                data: {
                        pageTitle: 'cursos',
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Cursos',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.cursos.list', {
                url: '/cursos',
                data: {
                        pageTitle: 'Cursos'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('cursos_api'),
                    }
                }    
                
            })
            .state('multiacademico.cursos.show', {
                url: '/cursos/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Cursos',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate('cursos_api_show',{id:$stateParams.id});
                        }
                    }
                }
            })
            .state('multiacademico.cursos.new', {
                url: '/cursos/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'cursos',
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Cursos',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'nuevo'}
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
            .state('multiacademico.cursos.edit', {
                url: '/cursos/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Cursos',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'cursos'},{title: 'editar'}
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

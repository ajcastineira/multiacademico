"use strict";

angular.module('multiacademico.aulas', ['ui.router'])

.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/aulas/', '/aulas');
    var rutas={create:'new_aula',
                new:'new_aula',
                edit:'edit_aula',
                update:'edit_aula',
                show:'get_aula',
                list:'get_aulas_all',
                state_created:'multiacademico.aulas.show',
                state_updated:'multiacademico.aulas.show'
                 };
    $stateProvider
        .state ('multiacademico.aulas', {
            abstract:true,
            data: {
                    pageTitle: 'Aulas',
                    pageHeader: {
                        icon: 'flaticon-teach',
                        title: 'Aulas',
                        subtitle: 'Lista'
                    },
                    breadcrumbs: [
                        {title: 'Aulas'},{title: 'lista'}
                    ]
                },
            resolve: {
                        scripts: function(lazyScript){
                            return lazyScript.register([
                                'build/vendor.ui.js',
                                'build/vendor.datatables.js'
                            ]);
                        }
                    }    

        })

        .state('multiacademico.aulas.list', {
            url: '/aulas',
            data: {
                    pageTitle: 'Aulas'
                },
             views: {
                "content@multiacademico": {
                    templateUrl: Routing.generate(rutas.list,{'_format':'html'}),

                }
            }    

        })
        .state('multiacademico.aulas.show', {
            url: '/aulas/{aula:[0-9]{1,11}}',
             data: {
                    pageHeader: {
                        icon: 'flaticon-teach',
                        title: 'Aulas',
                        subtitle: 'Mostrar'
                    },
                    breadcrumbs: [
                        {title: 'Aulas'},{title: 'mostrar'}
                    ]
                },
            views: {
                "content@multiacademico": {
                    templateUrl: function($stateParams){
                        return Routing.generate(rutas.show,{'aula': $stateParams.aula,'_format':'html'});
                    }

                }
            }
        })
        .state('multiacademico.aulas.new', {
            url: '/aulas/new',
            params:{
              submited:false,
              formData:null
            },
             data: {
                    pageTitle: 'aulas',
                    pageHeader: {
                        icon: 'flaticon-teach',
                        title: 'Aulas',
                        subtitle: 'Nuevo'
                    },
                    breadcrumbs: [
                        {title: 'Aulas'},{title: 'nuevo'}
                    ]
                },
            views: {
                "content@multiacademico": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.nuevo($stateParams,rutas,{'_format':'html'});
                         },
                    controller: 'FormsCrudCtrl'

                }
            }
        })
        .state('multiacademico.aulas.edit', {
            url: '/aulas/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}/edit',
            params:{
                id:undefined,
                curso:undefined,
                especializacion:undefined,
                paralelo:undefined,
                seccion:undefined,
                periodo:undefined,
                submited:false,
                formData:null
            },
            data: {
                    pageHeader: {
                        icon: 'flaticon-teach',
                        title: 'Aulas',
                        subtitle: 'Editar'
                    },
                    breadcrumbs: [
                        {title: 'Aulas'},{title: 'editar'}
                    ]
                },
            views: {
                "content@multiacademico": {
                     templateProvider:function($stateParams,FormsCrud){
                              return FormsCrud.editWithVars($stateParams,rutas,{'curso': $stateParams.curso,'especializacion':$stateParams.especializacion,'paralelo':$stateParams.paralelo,'seccion':$stateParams.seccion,'periodo':$stateParams.periodo,'_format':'html'});
                              //return "Hola mundo ";
                         },
                    controller: 'FormsCrudCtrl'

                }
            }
        })
});
define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.aulas', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
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
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.aulas.show', {
                url: '/aulas/{aula}',
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
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/controllers/PrintCtrl'
                            ])
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
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'//,
                            ])
                        }
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
                        controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                'modules/forms/controllers/FormsCrudCtrl'
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

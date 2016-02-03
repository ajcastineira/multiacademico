define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.matriculas', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/matriculas/', '/matriculas');
        var rutas={create:'new_matricula',
                    new:'new_matricula',
                    edit:'edit_matricula',
                    update:'edit_matricula',
                    show:'get_matricula',
                    list:'index_matricula',
                    state_created:'multiacademico.matriculas.show',
                    state_updated:'multiacademico.matriculas.show'
                     };
        $stateProvider
            .state ('multiacademico.matriculas', {
                abstract:true,
                data: {
                        pageTitle: 'Matriculas',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Matriculas',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Matriculas'},{title: 'lista'}
                        ]
                    }
            })
           
            .state('multiacademico.matriculas.list', {
                url: '/matriculas',
                data: {
                        pageTitle: 'Matriculas'
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
            .state('multiacademico.matriculas.show', {
                url: '/matriculas/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Matriculas',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Matriculas'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'id':$stateParams.id,'_format':'html'});
                        }
                    }
                }
            })
            .state('multiacademico.matriculas.new', {
                url: '/matriculas/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'matriculas',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Matriculas',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Matriculas'},{title: 'nuevo'}
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
            .state('multiacademico.matriculas.edit', {
                url: '/matriculas{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Matriculas',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Matriculas'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'id':$stateParams.id,'_format':'html'});
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

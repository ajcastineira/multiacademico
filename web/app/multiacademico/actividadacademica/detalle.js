define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.actividadacademicadetalle', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
        $urlRouterProvider.when('/misactividadesacademicas/', '/misactividadesacademicas');
        var rutas={create:'new_actividadacademicadetalle',
                    new:'new_actividadacademicadetalle',
                    edit:'edit_actividadacademicadetalle',
                  //  pay:'pay_actividadacademicadetalle',
                    update:'edit_actividadacademicadetalle',
                    show:'show_actividadacademicadetalle',
                    list:'index_actividadacademicadetalle',
                    state_created:'multiacademico.actividadacademicadetalle.show',
                    state_updated:'multiacademico.actividadacademicadetalle.show'
                     };
        $stateProvider
            .state ('multiacademico.actividadacademicadetalle', {
                abstract:true,
                data: {
                        pageTitle: 'Actividad Academica',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Actividad Academica',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Actividad Academica'},{title: 'lista'}
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
           
            .state('multiacademico.actividadacademicadetalle.list', {
                url: '/misactividadesacademicas',
                data: {
                        pageTitle: 'Actividad Academica'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate(rutas.list,{'_format':'html'}),
                        /*controller: function ($scope)
                                    {
                                        $scope.Pagar=function(e){
                                            e.preventDefault();
                                            alert("Hola");
                                        }
                                    },*/
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }    
                
            })
            .state('multiacademico.actividadacademicadetalle.show', {
                url: '/misactividadesacademicas/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Actividad Academica',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Actividad Academica'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'actividadAcademicaDetalle':$stateParams.id,'_format':'html'});
                        },
                        controller:function($scope, $window){
                            $scope.facturaDefinition=$window.facturaDefinition;
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/controllers/PrintCtrl'//,
                            ]),
 
                            
                        }
                    }
                }
            })
            .state('multiacademico.actividadacademicadetalle.new', {
                url: '/misactividadesacademicas/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'actividadacademicadetalle',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Actividad Academica',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Actividad Academica'},{title: 'nuevo'}
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
            .state('multiacademico.actividadacademicadetalle.edit', {
                url: '/misactividadesacademicas/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Actividad Academica',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Actividad Academica'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'actividadAcademicaDetalle':$stateParams.id,'_format':'html'});
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
            /*.state('multiacademico.actividadacademicadetalle.pay', {
                url: '/actividadacademicadetalle/{id:[0-9]{1,11}}/pay',
                params:{
                    id:undefined,
                    //submited:false,
                    //formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Actividad Academica',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Actividad Academica'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,$state,$http){
                                        //return "HOla mundo";
                                        return $http({
                                              method  : 'POST',
                                              async:   true,
                                              url     : Routing.generate(rutas.pay,{'actividadacademicadetalle':$stateParams.id,'_format':'json'}),
                                             }).then(function(response) { 

                                                    if(response.status===200){
                                                      $state.go(rutas.state_updated,{'id':$stateParams.id,'_format':'html'});
                                                    }else if(response.status===201)
                                                    {   
                                                        $state.go(rutas.state_updated,{'id':$stateParams.id,'_format':'html'});
                                                    }
                                                  });
                             },
                        //controller: 'FormsCrudCtrl',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/forms/directives/input/smartSelect2',
                                //'modules/forms/controllers/FormsCrudCtrl'
                            ])
                        }
                    }
                }
            })*/
    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

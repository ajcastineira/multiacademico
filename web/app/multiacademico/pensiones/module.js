    "use strict";

    angular.module('multiacademico.pensiones', ['ui.router'])

    

    .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/pensiones/', '/pensiones');
        var rutas={create:'new_pension',
                    new:'new_pension',
                    edit:'edit_pension',
                    pay:'pay_pension',
                    update:'edit_pension',
                    show:'get_pension',
                    list:'index_pension',
                    listaulas:'index_pension_aulas',
                    state_created:'multiacademico.pensiones.show',
                    state_updated:'multiacademico.pensiones.show'
                     };
        $stateProvider
            .state ('multiacademico.pensiones', {
                abstract:true,
                data: {
                        pageTitle: 'Pensiones',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'lista'}
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
           
            .state('multiacademico.pensiones.list', {
                url: '/pensiones',
                data: {
                        pageTitle: 'Pensiones'
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
                        
                    }
                }    
                
            })
            .state('multiacademico.pensiones.aulas', {
                url: '/pensiones/aulas',
                data: {
                        pageTitle: 'Pensiones Aulas'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate(rutas.listaulas,{'_format':'html'}),
                        /*controller: function ($scope)
                                    {
                                        $scope.Pagar=function(e){
                                            e.preventDefault();
                                            alert("Hola");
                                        }
                                    },*/
                        
                    }
                }    
                
            })
            .state('multiacademico.pensiones.show', {
                url: '/pensiones/{id:[0-9]{1,11}}',
                 data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                        templateUrl: function($stateParams){
                            return Routing.generate(rutas.show,{'pension':$stateParams.id,'_format':'html'});
                        },
                        controller:function($scope, $window){
                            $scope.facturaDefinition=$window.facturaDefinition;
                        },
                        
                    }
                }
            })
            .state('multiacademico.pensiones.new', {
                url: '/pensiones/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'pensiones',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'nuevo'}
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
            .state('multiacademico.pensiones.edit', {
                url: '/pension/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'pension':$stateParams.id,'_format':'html'});
                                  //return "Hola mundo ";
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            .state('multiacademico.pensiones.pay', {
                url: '/pension/{id:[0-9]{1,11}}/pay',
                params:{
                    id:undefined,
                    //submited:false,
                    //formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Pensiones',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Pensiones'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,$state,$http){
                                        //return "HOla mundo";
                                        return $http({
                                              method  : 'POST',
                                              async:   true,
                                              url     : Routing.generate(rutas.pay,{'pension':$stateParams.id,'_format':'json'}),
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
                       
                    }
                }
            })
    });

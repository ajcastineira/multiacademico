    "use strict";

    angular.module('multiacademico.areaacademica', ['ui.router'])
     
        .config(function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.when('/areaacademica/', '/areaacademica');
        var rutas={create:'new_areaacademica',
                    new:'new_areaacademica',
                    edit:'edit_areaacademica',
                    calificar:'show_areaacademica',
                    update:'edit_areaacademica',
                    show:'show_areaacademica',
                    list:'index_areaacademica',
                    state_created:'multiacademico.areaacademica.show',
                    state_updated:'multiacademico.areaacademica.show'
                     };
        $stateProvider
            .state ('multiacademico.areaacademica', {
                abstract:true,
                data: {
                        pageTitle: 'Area Academica',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Area Academica',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Area Academica'},{title: 'lista'}
                        ]
                    },
                resolve:{
                    scripts: function(lazyScript){
                            return lazyScript.register([
                                'build/vendor.ui.js',
                                'build/vendor.datatables.js'
                            ]);
                        },
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
           
            .state('multiacademico.areaacademica.list', {
                url: '/areaacademica',
                data: {
                        pageTitle: 'Area Academica'
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
            .state('multiacademico.areaacademica.show', {
                url: '/areaacademica/{id:[0-9]{1,11}}',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Area Academica',
                            subtitle: 'Mostrar'
                        },
                        breadcrumbs: [
                            {title: 'Area Academica'},{title: 'mostrar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,$state,$http){
                                     if ($stateParams.submited===true)
                                        {
                                        return $http({
                                              method  : 'POST',
                                              async:   true,
                                              data    : $stateParams.formData,
                                              url     : Routing.generate(rutas.show,{'areaAcademica':$stateParams.id,'_format':'html'}),
                                              transformRequest: angular.identity,
                                              headers : {'Content-Type': undefined }
                                             }).then(function(response) { 

                                                    if(response.status===200){
                                                      return response.data
                                                    }else if(response.status===201)
                                                    {   
                                                        return response.data
                                                    }
                                                  });
                                              }else{
                                        return $http.get(Routing.generate(rutas.show,{'areaAcademica':$stateParams.id,'_format':'html'}))
                                             .then(function(response) {
                                              return response.data;
                                               });
                                           }
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
            .state('multiacademico.areaacademica.new', {
                url: '/areaacademica/new',
                params:{
                  submited:false,
                  formData:null
                },
                 data: {
                        pageTitle: 'areaacademica',
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Area Academica',
                            subtitle: 'Nuevo'
                        },
                        breadcrumbs: [
                            {title: 'Area Academica'},{title: 'nuevo'}
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
            .state('multiacademico.areaacademica.edit', {
                url: '/areaacademica/{id:[0-9]{1,11}}/edit',
                params:{
                    id:undefined,
                    submited:false,
                    formData:null
                },
                data: {
                        pageHeader: {
                            icon: 'flaticon-teach',
                            title: 'Area Academica',
                            subtitle: 'Editar'
                        },
                        breadcrumbs: [
                            {title: 'Area Academica'},{title: 'editar'}
                        ]
                    },
                views: {
                    "content@multiacademico": {
                         templateProvider:function($stateParams,FormsCrud){
                                  return FormsCrud.editWithVars($stateParams,rutas,{'areaAcademica':$stateParams.id,'_format':'html'});
                                  //return "Hola mundo ";
                             },
                        controller: 'FormsCrudCtrl',
                        
                    }
                }
            })
    });
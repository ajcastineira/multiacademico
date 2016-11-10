/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

    "use strict";

    angular.module('multiacademico.juntadearea', ['ui.router'])

    .config(function ($stateProvider)
    {
        $stateProvider
              .state('multiacademico.juntadearea', {
                //abstract:true,
                url: '/junta-de-area',
                data: {
                        pageTitle: 'Junta de Area',
                        pageHeader: {
                            icon: 'fa flaticon-cinema3',
                            title: 'Junta de Area',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Junta de Area'},{title: 'lista'}
                        ]
                    },
                 views:{
                            'content@multiacademico':{
                                templateUrl: 'views/multiacademico/juntadearea/seleccionar-area-academica.html',
                                controller: function ($scope, areas, $stateParams) {
                                $scope.areas = areas;
                               },
                               resolve:{
                                   areas: function ($http) {
                                     return $http.get(Routing.generate('get_areaacademicas_all',{'_format':'json'}))
                                             .then(function successCallback(response)
                                             {
                                                 return response.data;
                                             });
                                             }
                                         }
                               }
                        }    
            })
              .state('multiacademico.juntadearea.estadistica', {
                    url: '/{area}/{q}/{p}',
                    reloadOnSearch: false,
                    data: {
                        pageTitle: 'Cuadro de Calificaciones Estadistico',
                        pageHeader: {
                            icon: 'fa flaticon-cinema3',
                            title: 'Junta de Area',
                            subtitle: 'Junta de Area Informe'
                        },
                        breadcrumbs: [
                            {title: 'Junta de Area'},{title: 'Junta de Area'}
                        ]
                    },
                    views:{
                        'content@multiacademico':{
                            templateUrl: Routing.generate('junta-de-area-api'),
                           // controller: 'MallaCtrl',
                           resolve:{
                               
                               area: function ($http,$stateParams) {
                                 return $http.get(Routing.generate('junta_areaacademica',{areaAcademica: $stateParams.area,quimestre:$stateParams.q,parcial:$stateParams.p,'_format':'json'}))
                                         .then(function successCallback(response)
                                         {
                                             return response.data;
                                         });
                                         }
                                     }
                        }
                    }
                })
                




    });

 
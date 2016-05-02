/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico.estadisticas', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider)
    {
        $stateProvider
              .state('multiacademico.estadisticas', {
                abstract:true,
                url: '/estadisticas',
                data: {
                        pageTitle: 'Estadisticas',
                        pageHeader: {
                            icon: 'fa fa-chart',
                            title: 'Estadisticas',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'Estadisticas'},{title: 'lista'}
                        ]
                    }//,
                /*resolve:{
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
                    
                }*/
            })
            .state('multiacademico.estadisticas.matriculados', {
                url: '/matriculados',
                data: {
                        pageTitle: 'Estadisticas'
                    },
                 views: {
                    "content@multiacademico": {
                        templateUrl: Routing.generate('matriculados_estadistica',{'_format':'html'}),
                        controller:function($scope){
                            $scope.encabezado={titulo:'Estadisticas de Matriculados Por Aulas'};
                        },
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'modules/graphs/directives/inline/sparklineContainer',    
                                'modules/tables/directives/datatables/datatableBasic',
                                'modules/forms/controllers/PrintCtrl'
                            ]),
                            
                        }
                    }
                }    
                
            })
                




    });

    module.run(function($couchPotato){
        module.lazy = $couchPotato;
    });
    return module;
});

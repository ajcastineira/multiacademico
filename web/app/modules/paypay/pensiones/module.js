define(['angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.paypay.pensiones', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider,$urlRouterProvider) {
       $urlRouterProvider.when('/pensiones/', '/pensiones');
        var rutas={list:'pensiones_api'};
        $stateProvider
            .state ('app.paypay.pensiones', {
                abstract:true,
                data: {
                        pageTitle: 'pensiones',
                        pageHeader: {
                            icon: 'flaticon-filing',
                            title: 'Pensiones',
                            subtitle: 'Lista'
                        },
                        breadcrumbs: [
                            {title: 'pensiones'},{title: 'lista'}
                        ]
                    }
            })

            .state('app.paypay.pensiones.list', {
                url: '/pensiones',
                data: {
                        pageTitle: 'Pensiones'
                    },
                 views: {
                    "content@app": {
                        templateUrl: Routing.generate('pensiones_api'),
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'modules/tables/directives/datatables/datatableBasic'
                            ])
                        }
                    }
                }

            })
            // .state('app.paypay.pensiones.download',{
            //     url: '/pensiones/download',
            //     data: {
            //             pageTitle: 'Pensionesd'
            //         },
            //      views: {
            //         "content@app": {
            //             templateUrl: Routing.generate('pensiones_download'),
            //             resolve: {
            //                 deps: $couchPotatoProvider.resolveDependencies([
            //                     'modules/tables/directives/datatables/datatableBasic'
            //                 ])
            //             }
            //         }
            //     }

            // }
            // )




    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

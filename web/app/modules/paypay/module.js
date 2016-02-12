define(['angular',
    'angular-couch-potato',
    'angular-ui-router'], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('app.paypay', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider) {

        $stateProvider
            .state('app.paypay', {
                abstract: true,
                data: {
                        pageTitle: 'Finanzas',
                        pageHeader: {
                            //icon: 'fa fa-user',
                            title: 'Finanzas',
                            subtitle: 'Finanzas'
                        },
                        breadcrumbs: [
                            {title: 'Finanzas'}
                        ]
                    }
            });

    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

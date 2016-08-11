    "use strict";

    angular.module('app.paypay', ['ui.router'])

    

    .config(function ($stateProvider) {

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

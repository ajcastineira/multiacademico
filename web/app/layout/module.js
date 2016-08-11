"use strict";


angular.module('app.layout', ['ui.router'])

.config(function ($stateProvider, $urlRouterProvider) {


    $stateProvider
        .state('app', {
            abstract: true,
            template:'<div data-smart-router-animation-wrap="content content@app" data-wrap-for="#content">'+
                                        '<div data-ui-view="content" data-autoscroll="false"></div>'+
                                  '</div>',
            /*views: {
                root: {
                    templateUrl: Routing.generate('layout',{_format:'html'})
                }
            }*/
        });
    $urlRouterProvider.otherwise('/');

})


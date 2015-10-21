define(['angular',
    'angular-couch-potato',
    'angular-ui-router'], function (ng, couchPotato) {

    "use strict";


    var module = ng.module('app.layout', ['ui.router']);


    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider, $urlRouterProvider) {


        $stateProvider
            .state('app2', {
                abstract: true,
                views: {
                    root: {
                        //templateUrl: Routing.generate('layout',{_format:'html'}),
                        template: "<b>Nothing</b>"//,
                        /*resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'auth/directives/loginInfo',
                              //  'modules/graphs/directives/inline/sparklineContainer',
                              //  'components/inbox/directives/unreadMessagesCount',
                               // 'components/chat/api/ChatApi',
                               // 'components/chat/directives/asideChatWidget'
                            ])
                        }*/
                    }
                }
            });
        //$urlRouterProvider.otherwise('/inicio');

    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

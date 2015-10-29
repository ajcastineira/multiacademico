define(['angular',
    'angular-couch-potato',
    'angular-ui-router'], function (ng, couchPotato) {

    "use strict";


    var module = ng.module('app.layout', ['ui.router']);


    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider, $urlRouterProvider) {


         $stateProvider
             .state ('app', {
                        abstract:true,
                        template:'<div data-smart-router-animation-wrap="content content@app" data-wrap-for="#content">'+
                                        '<div data-ui-view="content" data-autoscroll="false"></div>'+
                                  '</div>',
                        resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                                'auth/directives/loginInfo'//,
                                //'modules/graphs/directives/inline/sparklineContainer',
                                //'components/inbox/directives/unreadMessagesCount',
                                //'components/chat/api/ChatApi',
                                //'components/chat/directives/asideChatWidget'
                            ])}
                    })
            //.state('app2', {
               // abstract: true,
                //views: {
                   // root: {
                        //templateUrl: Routing.generate('layout',{_format:'html'}),
                       // template: "<b>Nothing</b>"//,
                        /*resolve: {
                            deps: $couchPotatoProvider.resolveDependencies([
                               // 'auth/directives/loginInfo',
                              //  'modules/graphs/directives/inline/sparklineContainer',
                              //  'components/inbox/directives/unreadMessagesCount',
                               // 'components/chat/api/ChatApi',
                               // 'components/chat/directives/asideChatWidget'
                            ])
                        }*/
               //     }
              //  }
          //  });*/
       // $urlRouterProvider.otherwise('/inicio');
        //$urlRouterProvider.otherwise('/page-error-404');

    });

    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });

    return module;

});

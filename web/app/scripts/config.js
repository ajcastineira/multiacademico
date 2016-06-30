 // =========================================================================
// CONFIGURATION ROUTE
// =========================================================================
define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router',
    'angular-loading-bar',
    'oc-lazyload'
], function (ng, couchPotato) {
'use strict';
 var module=ng.module('blankonConfig', ['angular-loading-bar','oc.lazyLoad'])

    // Setup global settings
    .factory('settings', ['$rootScope','$browser', function($rootScope,$browser) {

        var baseURL = $browser.baseHref().replace("app_dev.php/",""), // Setting base url app
            settings = {
                baseURL                 : baseURL,
                pluginPath              : 'plugin',
                pluginProdPath          : 'plugin',
                pluginCommercialPath    : baseURL+'/assets/commercial/plugins',
                globalImagePath         : 'img',
                adminImagePath          : baseURL+'/assets/admin/img',
                cssPath                 : baseURL+'app/styles',
                jsPath                  : 'app/scripts',
                dataPath                : 'data',
                additionalPath          : baseURL+'/assets/global/plugins/bower_components'
        };
        $rootScope.settings = settings;
        return settings;
    }])

    // Configuration angular loading bar
    .config(['cfpLoadingBarProvider',function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = true;
    }])

    // Configuration event, debug and cache
    .config(['$ocLazyLoadProvider', function($ocLazyLoadProvider) {

        $ocLazyLoadProvider.config({
            events: true,
            debug: false,
            cache:false,
            cssFilesInsertBefore: 'ng_load_plugins_before',
            modules:[
                {
                    name: 'blankonApp.core.demo',
                    files: ['app/scripts/modules/core/demo.js']
                }
            ]
        });
    }])

    // Configuration ocLazyLoad with ui router
    .config(["$stateProvider", "$couchPotatoProvider",function($stateProvider, $couchPotatoProvider, $urlRouterProvider) {
        // Redirect any unmatched url
        // $urlRouterProvider.otherwise('/page-error-404');

        $stateProvider
            
            // =========================================================================
            // SIGN IN
            // =========================================================================
            .state('signin', {
                url: '/login',
                //templateUrl: 'views/sign/sign-in.html',
                data: {
                    pageTitle: 'Iniciar Sesion'
                },
                //controller: 'SigninCtrl',
               /* resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {
        
                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        // you can lazy load files for an existing module
                        return $ocLazyLoad.load(
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/sign.css'
                                    ]
                                },
                                {
                                    files: [
                                        pluginPath+'/jquery-validation/dist/jquery.validate.min.js'
                                    ]
                                },
                                {
                                    name: 'blankonApp.account.signin',
                                    files: [
                                        jsPath+'/modules/sign/signin.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }*/
            })
/*
            // =========================================================================
            // SIGN IN TYPE 2
            // =========================================================================
            .state('signintype2', {
                url: '/sign-in-type-2',
                templateUrl: 'views/sign/sign-in-type-2.html',
                data: {
                    pageTitle: 'SIGN IN TYPE 2'
                },
                controller: 'SigninCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        // you can lazy load files for an existing module
                        return $ocLazyLoad.load(
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/sign-type-2.css'
                                    ]
                                },
                                {
                                    files: [
                                        pluginPath+'/jquery-validation/dist/jquery.validate.min.js',
                                        pluginPath+'/jquery-backstretch/jquery.backstretch.min.js'
                                    ]
                                },
                                {
                                    name: 'blankonApp.account.signin.type2',
                                    files: [
                                        jsPath+'/modules/sign/signin-type2.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // SIGN UP
            // =========================================================================
            .state('signUp', {
                url: '/sign-up',
                templateUrl: 'views/sign/sign-up.html',
                data: {
                    pageTitle: 'SIGN UP'
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        // you can lazy load files for an existing module
                        return $ocLazyLoad.load(
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/sign.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // LOST PASSWORD
            // =========================================================================
            .state('lostPassword', {
                url: '/lost-password',
                templateUrl: 'views/sign/lost-password.html',
                data: {
                    pageTitle: 'LOST PASSWORD'
                },
                resolve: {
                  deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                    var cssPath = settings.cssPath; // Create variable css path

                    // you can lazy load files for an existing module
                    return $ocLazyLoad.load(
                      [
                        {
                          insertBefore: '#load_css_before',
                          files: [
                            cssPath+'/pages/sign.css'
                          ]
                        }
                      ]
                    );
                  }]
                }
            })

            // =========================================================================
            // LOCK SCREEN
            // =========================================================================
            .state('lockScreen', {
                url: '/lock-screen',
                templateUrl: 'views/sign/lock-screen.html',
                data: {
                    pageTitle: 'LOCK SCREEN'
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        // you can lazy load files for an existing module
                        return $ocLazyLoad.load(
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/sign.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // BLANKON VERSIONS
            // =========================================================================
            .state('blankonVersions', {
                url: '/blankon-versions',
                templateUrl: 'views/blankon-versions.html',
                data: {
                    pageTitle: 'BLANKON VERSIONS',
                    pageHeader: {
                        icon: 'fa fa-dropbox',
                        title: 'Blankon Versions',
                        subtitle: 'all within bundle'
                    },
                    breadcrumbs: [
                        {title: 'Blankon Versions'}
                    ]
                }
            })

            // =========================================================================
            // FRONTEND THEMES
            // =========================================================================
            .state('frontendThemes', {
                url: '/frontend-themes',
                templateUrl: 'views/frontend-themes.html',
                data: {
                    pageTitle: 'FRONTEND THEMES',
                    pageHeader: {
                        icon: 'fa fa-leaf',
                        title: 'Frontend Themes',
                        subtitle: 'All within bundle AngularJS version'
                    },
                    breadcrumbs: [
                        {title: 'Frontend Themes'}
                    ]
                },
                controller: 'FrontendThemesCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        // you can lazy load files for an existing module
                        return $ocLazyLoad.load(
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/frontend-themes.css',
                                        pluginPath+'/jquery.gritter/css/jquery.gritter.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.frontendThemes',
                                    files: [
                                        jsPath+'/modules/frontend-themes.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })
*/
            // =========================================================================
            // DASHBOARD
            // =========================================================================
            .state('dashboard', {
                url: '/',
                data: {
                    pageTitle: 'Inicio',
                    pageHeader: {
                        icon: 'fa fa-home',
                        title: 'Inicio',
                        subtitle: 'inicio & resumen'
                    }
                },
                views:{
                "":{
                    templateUrl: Routing.generate('dashboardview',{_format:'html'}),
                    controller: 'DashboardCtrl',
                    resolve: {
                        deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginProdPath = settings.pluginProdPath; // Create variable plugin path
                        var cssPath = settings.cssPath;    

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                       
                                        pluginProdPath+'/jquery.gritter/css/jquery.gritter.css',
                                         cssPath+'/pages/timeline.css',
                                        cssPath+'/pages/timeline2.css'
                                    
                                        
                                    ]
                                }
                            ]);
                        }],
                        ResumenInicio:['$http',function($http){
                                return $http.get(Routing.generate('get_estadisticas_all',{'_format':'json'}))
                                .then(function(response){
                       
                                return response.data;
                            });
                            }],
                        activities:['$http',function($http){
                                return $http.get(Routing.generate('get_activities_all',{'_format':'json'}))
                                .then(function(response){
                       
                                return response.data.activities;
                            });
                            }]
                    }
                 }
                }
            })
/*
            // =========================================================================
            // BLOG GRID
            // =========================================================================
            .state('blogGrid', {
                url: '/blog-grid',
                templateUrl: 'views/blog/blog-grid.html',
                data: {
                    pageTitle: 'BLOG GRID',
                    pageHeader: {
                        icon: 'fa fa-file-text',
                        title: 'Blog Grid',
                        subtitle: 'blog grid type and post samples'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Blog Grid'}
                    ]
                },
                controller: 'BlogCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.blog.blogGrid',
                                    files: [
                                        pluginPath+'/masonry/dist/masonry.pkgd.min.js',
                                        jsPath+'/modules/blog/grid.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // BLOG LIST
            // =========================================================================
            .state('blogList', {
                url: '/blog-list',
                templateUrl: 'views/blog/blog-list.html',
                data: {
                    pageTitle: 'BLOG LIST',
                    pageHeader: {
                        icon: 'fa fa-file-text',
                        title: 'Blog List',
                        subtitle: 'blog list type and post samples'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Blog List'}
                    ]
                }
            })

            // =========================================================================
            // BLOG SINGLE
            // =========================================================================
            .state('blogSingle', {
                url: '/blog-single',
                templateUrl: 'views/blog/blog-single.html',
                data: {
                    pageTitle: 'BLOG SINGLE',
                    pageHeader: {
                        icon: 'fa fa-file-text',
                        title: 'Blog Single',
                        subtitle: 'blog single sample'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Blog Single'}
                    ]
                },
                controller: 'BlogSingleCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                          jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.blog.single',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js',
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
                                        jsPath+'/modules/blog/single.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // MAIL BOX
            // =========================================================================
            .state('mailInbox', {
                url: '/mail-inbox',
                templateUrl: 'views/mail/mail-inbox.html',
                data: {
                    pageTitle: 'MAIL INBOX',
                    pageHeader: {
                        icon: 'fa fa-inbox',
                        title: 'Inbox',
                        subtitle: 'mail inbox sample'
                    },
                    breadcrumbs: [
                        {title: 'Mail'},{title: 'Inbox'}
                    ]
                },
                controller: 'MailInboxCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/mail.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.mail.inbox',
                                    files: [
                                        jsPath+'/modules/mail/inbox.js'
                                    ]
                                }
                            ]
                        );

                    }]
                }
            })

            // =========================================================================
            // MAIL COMPOSE
            // =========================================================================
            .state('mailCompose', {
                url: '/mail-compose',
                templateUrl: 'views/mail/mail-compose.html',
                data: {
                    pageTitle: 'MAIL COMPOSE',
                    pageHeader: {
                        icon: 'fa fa-pencil',
                        title: 'Compose',
                        subtitle: 'mail compose sample'
                    },
                    breadcrumbs: [
                        {title: 'Mail'},{title: 'Compose'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            cssPath = settings.cssPath, // Create variable css path
                            jsPath = settings.jsPath, // Create variable JS path
                            additionalPath = settings.additionalPath; // Create variable additional path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css',
                                        additionalPath+'/bootstrap-fileupload/css/bootstrap-fileupload.min.css',
                                        cssPath+'/pages/mail.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.mail.compose',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js',
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
                                        additionalPath+'/bootstrap-fileupload/js/bootstrap-fileupload.min.js',
                                        jsPath+'/modules/mail/compose.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // MAIL VIEW
            // =========================================================================
            .state('mailView', {
                url: '/mail-view',
                templateUrl: 'views/mail/mail-view.html',
                data: {
                    pageTitle: 'MAIL VIEW',
                    pageHeader: {
                        icon: 'fa fa-eye',
                        title: 'View',
                        subtitle: 'mail view sample'
                    },
                    breadcrumbs: [
                        {title: 'Mail'},{title: 'View'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/mail.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // GALLERY
            // =========================================================================
            .state('pageGallery', {
                url: '/page-gallery',
                templateUrl: 'views/pages/page-gallery.html',
                data: {
                    pageTitle: 'GALLERY',
                    pageHeader: {
                        icon: 'fa fa-picture-o',
                        title: 'Gallery',
                        subtitle: 'gallery style'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Gallery'}
                    ]
                },
                controller: 'GalleryCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/gallery.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.pages.gallery',
                                    files: [
                                        pluginPath+'/mixitup/build/jquery.mixitup.min.js',
                                        jsPath+'/modules/pages/gallery.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FAQ
            // =========================================================================
            .state('pageFAQ', {
                url: '/page-faq',
                templateUrl: 'views/pages/page-faq.html',
                data: {
                    pageTitle: 'FAQ',
                    pageHeader: {
                        icon: 'fa fa-comments',
                        title: 'FAQ',
                        subtitle: 'frequently asked questions'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'FAQ'}
                    ]
                },
                controller: 'FAQCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginCommercialPath = settings.pluginCommercialPath, // Create variable plugin commercial path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginCommercialPath+'/cube-portfolio/cubeportfolio/css/cubeportfolio.css',
                                        cssPath+'/pages/faq.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.pages.faq',
                                    files: [
                                        pluginCommercialPath+'/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js',
                                        jsPath+'/modules/pages/faq.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // INVOICE
            // =========================================================================
            .state('pageInvoice', {
                url: '/page-invoice',
                templateUrl: 'views/pages/page-invoice.html',
                data: {
                    pageTitle: 'INVOICE',
                    pageHeader: {
                        icon: 'fa fa-file-o',
                        title: 'Invoice',
                        subtitle: 'invoice sample'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Invoice'}
                    ]
                },
                controller: 'InvoiceCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/invoice.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.pages.invoice',
                                    files: [jsPath+'/modules/pages/invoice.js']
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // MESSAGES
            // =========================================================================
            .state('pageMessages', {
                url: '/page-messages',
                templateUrl: 'views/pages/page-messages.html',
                data: {
                    pageTitle: 'MESSAGES',
                    pageHeader: {
                        icon: 'fa fa-comments',
                        title: 'Messages',
                        subtitle: 'messages sample'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Messages'}
                    ]
                },
                controller: 'MessagesCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/messages.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.pages.messages',
                                    files: [
                                        jsPath+'/modules/pages/messages.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // TIMELINE
            // =========================================================================
            .state('pageTimeline', {
                url: '/page-timeline',
                templateUrl: 'views/pages/page-timeline.html',
                data: {
                    pageTitle: 'TIMELINE',
                    pageHeader: {
                        icon: 'fa fa-child',
                        title: 'Timeline',
                        subtitle: 'timeline activity'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Timeline'}
                    ]
                },
                controller: 'TimelineCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            cssPath = settings.cssPath, // Create variable css path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/timeline.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.pages.timeline',
                                    files: [
                                        pluginPath+'/gmap3/dist/gmap3.min.js',
                                        jsPath+'/modules/pages/timeline.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // PROFILE
            // =========================================================================
            .state('pageProfile', {
                url: '/page-profile',
                templateUrl: 'views/pages/page-profile.html',
                data: {
                    pageTitle: 'PROFILE',
                    pageHeader: {
                        icon: 'fa fa-male',
                        title: 'Profile',
                        subtitle: 'profile sample'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Profile'}
                    ]
                }
            })

            // =========================================================================
            // SEARCH COURSE
            // =========================================================================
            .state('pageSearchCourse', {
                url: '/page-search-course',
                templateUrl: 'views/pages/page-search-course.html',
                data: {
                    pageTitle: 'SEARCH COURSE',
                    pageHeader: {
                        icon: 'fa fa-pencil',
                        title: 'Search Course',
                        subtitle: 'Search Result Course Page'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Search Course'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath; // Create variable plugin path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/search.css',
                                        pluginPath+'/chosen/chosen.min.css'
                                    ]
                                },
                                {
                                    files: [
                                        pluginPath+'/chosen/chosen.jquery.min.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // ERROR 400
            // =========================================================================
            .state('pageError403', {
                url: '/page-error-403',
                templateUrl: 'views/pages/page-error-403.html',
                data: {
                    pageTitle: 'ERROR 403',
                    pageHeader: {
                        icon: 'fa fa-ban',
                        title: 'Error 403',
                        subtitle: 'access is denied'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Error 403'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/error-page.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })
*/
            // =========================================================================
            // ERROR 404
            // =========================================================================
            .state('pageError404', {
                url: '/page-error-404',
                templateUrl: 'views/pages/page-error-404.html',
                data: {
                    pageTitle: 'ERROR 404',
                    pageHeader: {
                        icon: 'fa fa-ban',
                        title: 'Error 404',
                        subtitle: 'page not found'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Error 404'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/error-page.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })
/*
            // =========================================================================
            // ERROR 500
            // =========================================================================
            .state('pageError500', {
                url: '/page-error-500',
                templateUrl: 'views/pages/page-error-500.html',
                data: {
                    pageTitle: 'ERROR 500',
                    pageHeader: {
                        icon: 'fa fa-ban',
                        title: 'Error 500',
                        subtitle: 'internal server error'
                    },
                    breadcrumbs: [
                        {title: 'Pages'},{title: 'Error 500'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath; // Create variable css path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/error-page.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })
*/
        ;
     
       
    }])

    // Init app run
    .run(['$rootScope', 'settings', '$state', function($rootScope, settings, $state, $location) {
        $rootScope.$state = $state; // state to be accessed from view
        $rootScope.$location = $location; // location to be accessed from view
        $rootScope.settings = settings; // global settings to be accessed from view
    }]);
    couchPotato.configureApp(module);
    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });
    return module; 
});

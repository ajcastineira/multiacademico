// =========================================================================
// CONFIGURATION ROUTE
// =========================================================================

'use strict';
angular.module('blankonConfig', [])

    // Setup global settings
    .factory('settings', ['$rootScope', function($rootScope) {
        var baseURL = 'http://localhost/blankon-fullpack-admin-theme', // Setting base url app
            settings = {
                baseURL                 : baseURL,
                pluginPath              : 'bower_components',
                pluginCommercialPath    : baseURL+'/assets/commercial/plugins',
                globalImagePath         : 'img',
                adminImagePath          : baseURL+'/assets/admin/img',
                cssPath                 : 'styles',
                jsPath                  : 'scripts',
                dataPath                : 'data',
                additionalPath          : baseURL+'/assets/global/plugins/bower_components'
        };
        $rootScope.settings = settings;
        return settings;
    }])

    // Configuration angular loading bar
    .config(function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.includeSpinner = true;
    })

    // Configuration event, debug and cache
    .config(['$ocLazyLoadProvider', function($ocLazyLoadProvider) {

        $ocLazyLoadProvider.config({
            events: true,
            debug: true,
            cache:false,
            cssFilesInsertBefore: 'ng_load_plugins_before',
            modules:[
                {
                    name: 'blankonApp.core.demo',
                    files: ['scripts/modules/core/demo.js']
                }
            ]
        });
    }])

    // Configuration ocLazyLoad with ui router
    .config(function($stateProvider, $locationProvider, $urlRouterProvider) {
        // Redirect any unmatched url
        $urlRouterProvider.otherwise('page-error-404');

        $stateProvider

            // =========================================================================
            // SIGN IN
            // =========================================================================
            .state('signin', {
                url: '/sign-in',
                templateUrl: 'views/sign/sign-in.html',
                data: {
                    pageTitle: 'SIGN IN'
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
                }
            })

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

            // =========================================================================
            // DASHBOARD
            // =========================================================================
            .state('dashboard', {
                url: '/dashboard',
                templateUrl: 'views/dashboard.html',
                data: {
                    pageTitle: 'DASHBOARD',
                    pageHeader: {
                        icon: 'fa fa-home',
                        title: 'Dashboard',
                        subtitle: 'dashboard & statistics'
                    }
                },
                controller: 'DashboardCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath;

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/dropzone/dist/min/dropzone.min.css',
                                        pluginPath+'/jquery.gritter/css/jquery.gritter.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.dashboard',
                                    files: [
                                        pluginPath+'/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js',
                                        pluginPath+'/flot/jquery.flot.pack.js',
                                        pluginPath+'/dropzone/dist/min/dropzone.min.js',
                                        pluginPath+'/jquery.gritter/js/jquery.gritter.min.js',
                                        pluginPath+'/skycons-html5/skycons.js',
                                        jsPath+'/modules/dashboard.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

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

            // =========================================================================
            // FORM ELEMENT
            // =========================================================================
            .state('formElement', {
                url: '/form-element',
                templateUrl: 'views/forms/form-element.html',
                data: {
                    pageTitle: 'FORM ELEMENT',
                    pageHeader: {
                        icon: 'fa fa-list-alt',
                        title: 'Form Elements',
                        subtitle: 'form elements and more'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'Form Elements'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath, // Create variable JS path
                            additionalPath = settings.additionalPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
                                        additionalPath+'/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css',
                                        pluginPath+'/chosen/chosen.min.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.forms.element',
                                    files: [
                                        pluginPath+'/bootstrap-tagsinput/dist/bootstrap-tagsinput-angular.min.js',
                                        additionalPath+'/jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min.js',
                                        pluginPath+'/holderjs/holder.js',
                                        pluginPath+'/bootstrap-maxlength/bootstrap-maxlength.min.js',
                                        additionalPath+'/jquery-autosize/jquery.autosize.min.js',
                                        pluginPath+'/chosen/chosen.jquery.min.js',
                                        jsPath+'/modules/forms/element.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM ADVANCED
            // =========================================================================
            .state('formAdvanced', {
                url: '/form-advanced',
                templateUrl: 'views/forms/form-advanced.html',
                data: {
                    pageTitle: 'FORM ADVANCED',
                    pageHeader: {
                        icon: 'fa fa-list-alt',
                        title: 'Form Advanced',
                        subtitle: 'form advanced plugins'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'Form Advanced'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/dropzone/dist/min/dropzone.min.css',
                                        pluginPath+'/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
                                        pluginPath+'/bootstrap-datepicker-vitalets/css/datepicker.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.forms.advanced',
                                    files: [
                                        pluginPath+'/dropzone/dist/min/dropzone.min.js',
                                        pluginPath+'/bootstrap-switch/dist/js/bootstrap-switch.min.js',
                                        pluginPath+'/jquery.inputmask/dist/jquery.inputmask.bundle.min.js',
                                        pluginPath+'/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js',
                                        jsPath+'/modules/forms/advanced.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM LAYOUT
            // =========================================================================
            .state('formLayout', {
                url: '/form-layout',
                templateUrl: 'views/forms/form-layout.html',
                data: {
                    pageTitle: 'FORM LAYOUT',
                    pageHeader: {
                        icon: 'fa fa-list-alt',
                        title: 'Form Layouts',
                        subtitle: 'variant form layouts'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'Form Layouts'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                          jsPath = settings.jsPath, // Create variable JS path
                          additionalPath = settings.additionalPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        additionalPath+'/bootstrap-fileupload/css/bootstrap-fileupload.min.css',
                                        pluginPath+'/chosen/chosen.min.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.forms.layout',
                                    files: [
                                        additionalPath+'/bootstrap-fileupload/js/bootstrap-fileupload.min.js',
                                        pluginPath+'/chosen/chosen.jquery.min.js',
                                        jsPath+'/modules/forms/layout.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM VALIDATION
            // =========================================================================
            .state('formValidation', {
                url: '/form-validation',
                templateUrl: 'views/forms/form-validation.html',
                data: {
                    pageTitle: 'FORM VALIDATION',
                    pageHeader: {
                        icon: 'fa fa-warning',
                        title: 'Form Validations',
                        subtitle: 'form validation samples'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'Form Validations'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.forms.validation',
                                    files: [
                                        pluginPath+'/chosen/chosen.jquery.min.js',
                                        pluginPath+'/jquery-mockjax/dist/jquery.mockjax.min.js',
                                        pluginPath+'/jquery-validation/dist/jquery.validate.min.js',
                                        jsPath+'/modules/forms/validation.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM WIZARD
            // =========================================================================
            .state('formWizard', {
                url: '/form-wizard',
                templateUrl: 'views/forms/form-wizard.html',
                data: {
                    pageTitle: 'FORM WIZARD',
                    pageHeader: {
                        icon: 'fa fa-th-list',
                        title: 'Form Wizard',
                        subtitle: 'form wizard sample'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'Form Wizard'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath, // Create variable JS path
                            additionalPath = settings.additionalPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.forms.wizard',
                                    files: [
                                        pluginPath+'/jquery-validation/dist/jquery.validate.min.js',
                                        additionalPath+'/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js',
                                        jsPath+'/modules/forms/wizard.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM WYSIWYG
            // =========================================================================
            .state('formWysiwyg', {
                url: '/form-wysiwyg',
                templateUrl: 'views/forms/form-wysiwyg.html',
                data: {
                    pageTitle: 'FORM WYSIWYG',
                    pageHeader: {
                        icon: 'fa fa-edit',
                        title: 'WYSIWYG',
                        subtitle: 'form text editor'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'WYSIWYG'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css',
                                        pluginPath+'/summernote/dist/summernote.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.forms.wysiwyg',
                                    files: [
                                        pluginPath+'/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js',
                                        pluginPath+'/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
                                        pluginPath+'/summernote/dist/summernote.min.js',
                                        jsPath+'/modules/forms/wysiwyg.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // FORM X-EDITABLE
            // =========================================================================
            .state('formXeditable', {
                url: '/form-xeditable',
                templateUrl: 'views/forms/form-xeditable.html',
                data: {
                    pageTitle: 'FORM X-EDITABLE',
                    pageHeader: {
                        icon: 'fa fa-edit',
                        title: 'X-Editable',
                        subtitle: 'form x-editable'
                    },
                    breadcrumbs: [
                        {title: 'Forms'},{title: 'X-Editable'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/angular-xeditable/dist/css/xeditable.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.forms.xeditable',
                                    files: [
                                        pluginPath+'/angular-mocks/angular-mocks.js',
                                        pluginPath+'/angular-xeditable/dist/js/xeditable.min.js',
                                        jsPath+'/modules/forms/xeditable.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // TABLE DEFAULT
            // =========================================================================
            .state('tableDefault', {
                url: '/table-default',
                templateUrl: 'views/tables/table-default.html',
                data: {
                    pageTitle: 'TABLE DEFAULT',
                    pageHeader: {
                        icon: 'fa fa-table',
                        title: 'Table',
                        subtitle: 'basic table samples'
                    },
                    breadcrumbs: [
                        {title: 'Tables'},{title: 'Table Default'}
                    ]
                },
                controller: 'TableDefaultCtrl',
                resolve: {
                  deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                    var jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.tables.default',
                                    files: [
                                        jsPath+'/modules/tables/default.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // TABLE COLOR
            // =========================================================================
            .state('tableColor', {
                url: '/table-color',
                templateUrl: 'views/tables/table-color.html',
                data: {
                    pageTitle: 'TABLE COLOR',
                    pageHeader: {
                        icon: 'fa fa-table',
                        title: 'Table Color',
                        subtitle: 'variant table colors'
                    },
                    breadcrumbs: [
                        {title: 'Tables'},{title: 'Table Color'}
                    ]
                },
                controller: 'TableColorCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.tables.color',
                                    files: [
                                        jsPath+'/modules/tables/color.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // TABLE DATATABLE
            // =========================================================================
            .state('tableDatatable', {
                url: '/table-datatable',
                templateUrl: 'views/tables/table-datatable.html',
                data: {
                    pageTitle: 'DATATABLE',
                    pageHeader: {
                        icon: 'fa fa-table',
                        title: 'Datatable',
                        subtitle: 'responsive datatable samples'
                    },
                    breadcrumbs: [
                        {title: 'Tables'},{title: 'Datatable'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath, // Create variable JS path
                            additionalPath = settings.additionalPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        additionalPath+'/datatables/css/dataTables.bootstrap.css',
                                        additionalPath+'/datatables/css/datatables.responsive.css',
                                        pluginPath+'/fuelux/dist/css/fuelux.min.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.tables.datatable',
                                    files: [
                                        additionalPath+'/datatables/js/jquery.dataTables.min.js',
                                        additionalPath+'/datatables/js/dataTables.bootstrap.js',
                                        additionalPath+'/datatables/js/datatables.responsive.js',
                                        pluginPath+'/fuelux/dist/js/fuelux.min.js',
                                        jsPath+'/modules/tables/datatable.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // MAP GOOGLE
            // =========================================================================
            .state('mapGoogle', {
                url: '/maps-google',
                templateUrl: 'views/maps/maps-google.html',
                data: {
                    pageTitle: 'GOOGLE MAPS',
                    pageHeader: {
                        icon: 'fa fa-map-marker',
                        title: 'Google Map',
                        subtitle: 'google map samples'
                    },
                    breadcrumbs: [
                        {title: 'Maps'},{title: 'Google Map'}
                    ]
                },
                controller: 'GoogleMapCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.maps.google',
                                    files: [
                                        pluginPath+'/gmap3/dist/gmap3.min.js',
                                        jsPath+'/modules/maps/map-google.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // MAP VECTOR
            // =========================================================================
            .state('mapVector', {
                url: '/maps-vector',
                templateUrl: 'views/maps/maps-vector.html',
                data: {
                    pageTitle: 'VECTOR MAPS',
                    pageHeader: {
                        icon: 'fa fa-globe',
                        title: 'Vector Map',
                        subtitle: 'interactive vector map samples'
                    },
                    breadcrumbs: [
                        {title: 'Maps'},{title: 'Vector Map'}
                    ]
                },
                controller: 'VectorMapCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/jqvmap/jqvmap/jqvmap.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.maps.vector',
                                    files: [
                                        pluginPath+'/jqvmap/jqvmap/jquery.vmap.min.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/jquery.vmap.world.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/jquery.vmap.algeria.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.africa.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.asia.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.australia.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.europe.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.north-america.js',
                                        pluginPath+'/jqvmap/jqvmap/maps/continents/jquery.vmap.south-america.js',
                                        pluginPath+'/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
                                        jsPath+'/modules/maps/map-vector.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // CHART FLOT
            // =========================================================================
            .state('chartFlot', {
                url: '/chart-flot',
                templateUrl: 'views/charts/chart-flot.html',
                data: {
                    pageTitle: 'FLOT CHART',
                    pageHeader: {
                        icon: 'fa fa-signal',
                        title: 'Flot Charts',
                        subtitle: 'visual charts & graphs'
                    },
                    breadcrumbs: [
                        {title: 'Charts'},{title: 'Flot Charts'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.charts.flot',
                                    files: [
                                        pluginPath+'/flot/jquery.flot.js',
                                        pluginPath+'/flot/jquery.flot.spline.min.js',
                                        pluginPath+'/flot/jquery.flot.tooltip.min.js',
                                        pluginPath+'/flot/jquery.flot.resize.js',
                                        pluginPath+'/flot/jquery.flot.categories.js',
                                        pluginPath+'/flot/jquery.flot.pie.js',
                                        jsPath+'/modules/charts/flot.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // CHART MORRIS
            // =========================================================================
            .state('chartMorris', {
                url: '/chart-morris',
                templateUrl: 'views/charts/chart-morris.html',
                data: {
                    pageTitle: 'MORRIS CHART',
                    pageHeader: {
                        icon: 'fa fa-signal',
                        title: 'Morris Charts',
                        subtitle: 'visual charts & graphs'
                    },
                    breadcrumbs: [
                        {title: 'Charts'},{title: 'Morris Charts'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/morris.js/morris.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.charts.morris',
                                    files: [
                                        pluginPath+'/raphael/raphael-min.js',
                                        pluginPath+'/morris.js/morris.min.js',
                                        jsPath+'/modules/charts/morris.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // CHART CHARTJS
            // =========================================================================
            .state('chartChartjs', {
                url: '/chart-chartjs',
                templateUrl: 'views/charts/chart-chartjs.html',
                data: {
                    pageTitle: 'CHARTJS CHART',
                    pageHeader: {
                        icon: 'fa fa-signal',
                        title: 'Chartjs',
                        subtitle: 'visual charts & graphs'
                    },
                    breadcrumbs: [
                        {title: 'Charts'},{title: 'Chartjs'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.charts.chartjs',
                                    files: [
                                        pluginPath+'/Chart.js/Chart.min.js',
                                        jsPath+'/modules/charts/chartjs.js'
                                    ]
                                },
                                {
                                    name: 'tc.chartjs', // Another support plugin chartjs
                                    files: [
                                        pluginPath+'/tc-angular-chartjs/dist/tc-angular-chartjs.min.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // CHART C3JS
            // =========================================================================
            .state('chartC3JS', {
                url: '/chart-c3js',
                templateUrl: 'views/charts/chart-c3js.html',
                data: {
                    pageTitle: 'FLOT CHART',
                    pageHeader: {
                        icon: 'fa fa-signal',
                        title: 'C3js chart',
                        subtitle: 'visual charts & graphs'
                    },
                    breadcrumbs: [
                        {title: 'Charts'},{title: 'C3js chart'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/c3/c3.min.css'
                                    ]
                                },
                                {
                                    name: 'gridshore.c3js.chart',
                                    files: [
                                        pluginPath+'/d3/d3.min.js',
                                        pluginPath+'/c3/c3.min.js',
                                        pluginPath+'/c3-angular/c3js-directive.js'
                                    ]
                                },
                                {
                                    name: 'blankonApp.charts.c3js',
                                    files: [
                                        jsPath+'/modules/charts/c3js.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS GRID SYSTEM
            // =========================================================================
            .state('componentGridSystem', {
                url: '/component-grid-system',
                templateUrl: 'views/components/component-grid-system.html',
                data: {
                    pageTitle: 'GRID SYSTEM',
                    pageHeader: {
                        icon: 'fa fa-columns',
                        title: 'Grid Layout',
                        subtitle: 'grid system support'
                    },
                    breadcrumbs: [
                        {title: 'Layout'},{title: 'Grid'}
                    ]
                }
            })

            // =========================================================================
            // COMPONENTS BUTTONS
            // =========================================================================
            .state('componentButtons', {
                url: '/component-buttons',
                templateUrl: 'views/components/component-buttons.html',
                data: {
                    pageTitle: 'BUTTONS',
                    pageHeader: {
                        icon: 'fa fa-square',
                        title: 'Buttons',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Buttons'}
                    ]
                }
            })

            // =========================================================================
            // COMPONENTS TYPOGRAPHY
            // =========================================================================
            .state('componentTypography', {
                url: '/component-typography',
                templateUrl: 'views/components/component-typography.html',
                data: {
                    pageTitle: 'TYPOGRAPHY',
                    pageHeader: {
                        icon: 'fa fa-text-height',
                        title: 'Typography',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Typography'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/google-code-prettify/bin/prettify.min.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.components.typography',
                                    files: [
                                        pluginPath+'/google-code-prettify/bin/prettify.min.js',
                                        jsPath+'/modules/components/typography.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS PANEL
            // =========================================================================
            .state('componentPanel', {
                url: '/component-panel',
                templateUrl: 'views/components/component-panel.html',
                data: {
                    pageTitle: 'PANELS',
                    pageHeader: {
                        icon: 'fa fa-list-alt',
                        title: 'Panel',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Panel'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/c3/c3.min.css'
                                    ]
                                },
                                {
                                    name: 'gridshore.c3js.chart',
                                    files: [
                                        pluginPath+'/d3/d3.min.js',
                                        pluginPath+'/c3/c3.min.js',
                                        pluginPath+'/c3-angular/c3js-directive.js'
                                    ]
                                },
                                {
                                    name: 'blankonApp.charts.c3js',
                                    files: [
                                        jsPath+'/modules/charts/c3js.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS ALERTS
            // =========================================================================
            .state('componentAlerts', {
                url: '/component-alerts',
                templateUrl: 'views/components/component-alerts.html',
                data: {
                    pageTitle: 'ALERTS',
                    pageHeader: {
                        icon: 'fa fa-info-circle',
                        title: 'Alerts',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Alerts'}
                    ]
                },
                controller: 'AlertCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    name: 'ui.bootstrap',
                                    files: [
                                        pluginPath+'/angular-bootstrap/ui-bootstrap-tpls.min.js'
                                    ]
                                },
                                {
                                    name: 'ui.bootstrap.alert',
                                    files: [
                                        jsPath+'/modules/bootstrap/alert.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS MODALS
            // =========================================================================
            .state('componentModals', {
                url: '/component-modals',
                templateUrl: 'views/components/component-modals.html',
                data: {
                    pageTitle: 'MODALS',
                    pageHeader: {
                        icon: 'fa fa-circle-o-notch',
                        title: 'Modals',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Modals'}
                    ]
                },
                controller: 'AccordionCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    name: 'ui.bootstrap',
                                    files: [
                                        pluginPath+'/angular-bootstrap/ui-bootstrap-tpls.min.js'
                                    ]
                                },
                                {
                                    name: 'ui.bootstrap.accordion',
                                    files: [jsPath+'/modules/bootstrap/accordion.js']
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS VIDEO
            // =========================================================================
            .state('componentVideo', {
                url: '/component-video',
                templateUrl: 'views/components/component-video.html',
                data: {
                    pageTitle: 'VIDEO',
                    pageHeader: {
                        icon: 'fa fa-video-camera',
                        title: 'Video',
                        subtitle: 'responsive embed'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Video'}
                    ]
                }
            })

            // =========================================================================
            // COMPONENTS TABS & ACCORDION
            // =========================================================================
            .state('componentTabsaccordion', {
                url: '/component-tabsaccordion',
                templateUrl: 'views/components/component-tabsaccordion.html',
                data: {
                    pageTitle: 'TABS & ACCORDION',
                    pageHeader: {
                        icon: 'fa fa-bars',
                        title: 'Tabs & Accordion',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Tabs & Accordion'}
                    ]
                },
                controller: 'AccordionCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // you can lazy load files for an existing module
                            [
                                {
                                    name: 'ui.bootstrap',
                                    files: [
                                        pluginPath+'/angular-bootstrap/ui-bootstrap-tpls.min.js'
                                    ]
                                },
                                {
                                    name: 'ui.bootstrap.accordion',
                                    files: [jsPath+'/modules/bootstrap/accordion.js']
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS SLIDERS
            // =========================================================================
            .state('componentSliders', {
                url: '/component-sliders',
                templateUrl: 'views/components/component-sliders.html',
                data: {
                    pageTitle: 'SLIDERS',
                    pageHeader: {
                        icon: 'fa fa-sliders',
                        title: 'Sliders',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Sliders'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/ion.rangeSlider/css/ion.rangeSlider.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.components.slider',
                                    files: [
                                        pluginPath+'/ion.rangeSlider/js/ion.rangeSlider.min.js',
                                        jsPath+'/modules/pages/slider.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS ICON GLYPHICONS
            // =========================================================================
            .state('componentGlyphicons', {
                url: '/component-glyphicons',
                templateUrl: 'views/components/component-glyphicons.html',
                data: {
                    pageTitle: 'GLYPHICONS',
                    pageHeader: {
                        icon: 'fa fa-paw',
                        title: 'Glyphicons',
                        subtitle: 'icon components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Glyphicons'}
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
                                        cssPath+'/pages/glyphicons.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS ICON GLYPHICONS PRO
            // =========================================================================
            .state('componentGlyphiconsPro', {
                url: '/component-glyphicons-pro',
                templateUrl: 'views/components/component-glyphicons-pro.html',
                data: {
                    pageTitle: 'GLYPHICONS PRO',
                    pageHeader: {
                        icon: 'fa fa-plus-square',
                        title: 'Glyphicons PRO',
                        subtitle: 'icon components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Glyphicons PRO'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginCommercialPath = settings.pluginCommercialPath; // Create variable commercial plugin path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/glyphicons.css',
                                        pluginCommercialPath+'/glyphicons-pro/glyphicons/web/html_css/css/glyphicons.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS ICON FONT AWESOME
            // =========================================================================
            .state('componentFontAwesome', {
                url: '/component-font-awesome',
                templateUrl: 'views/components/component-font-awesome.html',
                data: {
                    pageTitle: 'FONT AWESOME',
                    pageHeader: {
                        icon: 'fa fa-paw',
                        title: 'Font Awesome',
                        subtitle: 'icon components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Font Awesome'}
                    ]
                }
            })

            // =========================================================================
            // COMPONENTS ICON WEATHER ICONS
            // =========================================================================
            .state('componentWeatherIcons', {
                url: '/component-weather-icons',
                templateUrl: 'views/components/component-weather-icons.html',
                data: {
                    pageTitle: 'WEATHER ICONS',
                    pageHeader: {
                        icon: 'wi wi-day-sunny-overcast',
                        title: 'Weather Icons',
                        subtitle: 'icon components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Weather Icons'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath; // Create variable plugin path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/weather-icons.css',
                                        pluginPath+'/weather-icons/css/weather-icons.min.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS MAP ICONS
            // =========================================================================
            .state('componentMapIcons', {
                url: '/component-map-icons',
                templateUrl: 'views/components/component-map-icons.html',
                data: {
                    pageTitle: 'MAP ICONS',
                    pageHeader: {
                        icon: 'fa fa-paw',
                        title: 'Icons Map',
                        subtitle: 'Icon font for use with Google Maps API'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Icons Map'}
                    ]
                },
                controller: 'IconMapCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        pluginPath+'/map-icons/css/map-icons.css'
                                    ]
                                },
                                {
                                    name: 'blankonApp.maps.icon',
                                    files: [
                                        pluginPath+'/map-icons/js/map-icons.min.js',
                                        jsPath+'/modules/maps/map-icons.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS SIMPLE LINE ICONS
            // =========================================================================
            .state('componentSimpleLineIcons', {
                url: '/component-simple-line-icons',
                templateUrl: 'views/components/component-simple-line-icons.html',
                data: {
                    pageTitle: 'SIMPLE LINE ICONS',
                    pageHeader: {
                        icon: 'fa fa-paw',
                        title: 'Simple Line Icons',
                        subtitle: 'icon components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Simple Line Icons'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var cssPath = settings.cssPath, // Create variable css path
                            pluginPath = settings.pluginPath;

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    insertBefore: '#load_css_before',
                                    files: [
                                        cssPath+'/pages/icon.css',
                                        pluginPath+'/simple-line-icons/css/simple-line-icons.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // COMPONENTS OTHER
            // =========================================================================
            .state('componentOther', {
                url: '/component-other',
                templateUrl: 'views/components/component-other.html',
                data: {
                    pageTitle: 'OTHER COMPONENT',
                    pageHeader: {
                        icon: 'fa fa-slack',
                        title: 'Other Component',
                        subtitle: 'general ui components'
                    },
                    breadcrumbs: [
                        {title: 'Components'},{title: 'Icons'},{title: 'Others'}
                    ]
                }
            })

            // =========================================================================
            // ANIMATE.CSS
            // =========================================================================
            .state('animate', {
                url: '/animate',
                templateUrl: 'views/animate.html',
                data: {
                    pageTitle: 'ANIMATE.CSS',
                    pageHeader: {
                        icon: 'fa fa-forumbee',
                        title: 'Animate.css',
                        subtitle: 'Just-add-water CSS animations'
                    },
                    breadcrumbs: [
                        {title: 'Animate.css'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.animate',
                                    files: [
                                        jsPath+'/modules/animate.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // WIDGET OVERVIEW
            // =========================================================================
            .state('widgetOverview', {
                url: '/widget-overview',
                templateUrl: 'views/widget/widget-overview.html',
                data: {
                    pageTitle: 'OVERVIEW WIDGET',
                    pageHeader: {
                        icon: 'fa fa-bar-chart-o',
                        title: 'Overview Widget',
                        subtitle: 'overview widget and more'
                    },
                    breadcrumbs: [
                        {title: 'Widget'},{title: 'Overview'}
                    ]
                },
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.widget.overview',
                                    files: [
                                        pluginPath+'/raphael/raphael-min.js',
                                        pluginPath+'/flot/jquery.flot.pack.js',
                                        pluginPath+'/morris.js/morris.min.js',
                                        jsPath+'/modules/widget/overview.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // WIDGET SOCIAL
            // =========================================================================
            .state('widgetSocial', {
                url: '/widget-social',
                templateUrl: 'views/widget/widget-social.html',
                data: {
                    pageTitle: 'SOCIAL WIDGET',
                    pageHeader: {
                        icon: 'fa fa-share-alt',
                        title: 'Social Widget',
                        subtitle: 'social widget and more'
                    },
                    breadcrumbs: [
                        {title: 'Widget'},{title: 'Social'}
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
                                        cssPath+'/pages/timeline.css'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // WIDGET BLOG
            // =========================================================================
            .state('widgetBlog', {
                url: '/widget-blog',
                templateUrl: 'views/widget/widget-blog.html',
                data: {
                    pageTitle: 'BLOG WIDGET',
                    pageHeader: {
                        icon: 'fa fa-pencil',
                        title: 'Blog Widget',
                        subtitle: 'blog widget and more'
                    },
                    breadcrumbs: [
                        {title: 'Widget'},{title: 'Blog'}
                    ]
                }
            })

            // =========================================================================
            // WIDGET WEATHER
            // =========================================================================
            .state('widgetWeather', {
                url: '/widget-weather',
                templateUrl: 'views/widget/widget-weather.html',
                data: {
                    pageTitle: 'WEATHER WIDGET',
                    pageHeader: {
                        icon: 'wi wi-day-sunny-overcast',
                        title: 'Weather Widget',
                        subtitle: 'weather widget and more'
                    },
                    breadcrumbs: [
                        {title: 'Widget'},{title: 'Weather'}
                    ]
                },
                controller: 'widgetWeatherCtrl',
                resolve: {
                    deps: ['$ocLazyLoad', 'settings', function($ocLazyLoad, settings) {

                        var pluginPath = settings.pluginPath, // Create variable plugin path
                            jsPath = settings.jsPath; // Create variable JS path

                        return $ocLazyLoad.load( // You can lazy load files for an existing module
                            [
                                {
                                    name: 'blankonApp.widget.weather',
                                    files: [
                                        pluginPath+'/skycons-html5/skycons.js',
                                        jsPath+'/modules/widget/weather.js'
                                    ]
                                }
                            ]
                        );
                    }]
                }
            })

            // =========================================================================
            // WIDGET MISC
            // =========================================================================
            .state('widgetMisc', {
                url: '/widget-misc',
                templateUrl: 'views/widget/widget-misc.html',
                data: {
                    pageTitle: 'MISC WIDGET',
                    pageHeader: {
                        icon: 'fa fa-puzzle-piece',
                        title: 'Misc Widget',
                        subtitle: 'miscellanous widget and more'
                    },
                    breadcrumbs: [
                        {title: 'Widget'},{title: 'Misc'}
                    ]
                }
            });

    })

    // Init app run
    .run(['$rootScope', 'settings', '$state', function($rootScope, settings, $state, $location) {
        $rootScope.$state = $state; // state to be accessed from view
        $rootScope.$location = $location; // location to be accessed from view
        $rootScope.settings = settings; // global settings to be accessed from view
    }]);

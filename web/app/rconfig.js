var require = {
    waitSeconds: 0,
    paths: {

        'jquery': [
            '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min',
            '../plugin/jquery/dist/jquery.min'
        ],
        'jquery-ui': ['//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min',
                      '../plugin/jquery-ui/jquery-ui.min'
        ],

        'bootstrap': ['//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min',
                      '../plugin/bootstrap/dist/js/bootstrap.min'],

        'angular': ['//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min',
                    '../plugin/angular/angular.min'],
        'angular-cookies': ['//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-cookies.min',
                            '../plugin/angular-cookies/angular-cookies.min'],
        'angular-resource': ['//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-resource.min',
                            '../plugin/angular-resource/angular-resource.min'],
        'angular-sanitize': ['//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-sanitize.min',
                            '../plugin/angular-sanitize/angular-sanitize.min'],
        'angular-animate': ['//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-animate.min',
                            '../plugin/angular-animate/angular-animate.min'],


        'domReady': '../plugin/requirejs-domready/domReady',

        'angular-ui-router': '../plugin/angular-ui-router/release/angular-ui-router.min',

        'angular-bootstrap': '../plugin/angular-bootstrap/ui-bootstrap-tpls.min',

        'angular-couch-potato': '../plugin/angular-couch-potato/dist/angular-couch-potato',
        
        'angular-google-maps': '../plugin/angular-google-maps/dist/angular-google-maps.min',
        
        'angular-loading-bar': '../plugin/angular-loading-bar/build/loading-bar.min',
        
        'angular-mocks': '../plugin/angular-mocks/angular-mocks',

       

        'angular-easyfb': '../plugin/angular-easyfb/angular-easyfb.min',
        'angular-google-plus': '../plugin/angular-google-plus/dist/angular-google-plus.min',

        'pace':'../plugin/pace/pace.min',

        'fastclick': '../plugin/fastclick/lib/fastclick',

        'jquery-color': '../plugin/jquery-color/jquery.color',

        'select2': '../plugin/select2/dist/js/select2.min',
        'chosen': '../plugin/chosen/chosen.jquery.min',

        'summernote': '../plugin/summernote/dist/summernote.min',

        'he': '../plugin/he/he',
        'to-markdown': '../plugin/to-markdown/src/to-markdown',
        'markdown': '../plugin/markdown/lib/markdown',
        'bootstrap-markdown': '../plugin/bootstrap-markdown/js/bootstrap-markdown',
        'bootstrap-session-timeout':'../plugin/bootstrap-session-timeout/dist/bootstrap-session-timeout.min',
        
        'bootstrap-taginput':'../plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput-angular.min',
        
        'bootstrap-daterangepicker':['//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker',
                                     '../plugin/bootstrap-daterangepicker/bootstrap-daterangepicker'],
        
        'jasny-bootstrap-fileinput':'../plugin/jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min',
        'holderjs':'../plugin/holderjs/holder',
        'bootstrap-maxlength':'../plugin/bootstrap-maxlength/bootstrap-maxlength.min',

        'ckeditor': '../plugin/ckeditor/ckeditor',

        'moment': ['//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment-with-locales.min',
                    '../plugin/moment/min/moment-with-locales.min'],
       // 'moment-timezone': '../plugin/moment-timezone/moment-timezone',

        'sparkline': '../plugin/relayfoods-jquery.sparkline/dist/jquery.sparkline.min',
        'easy-pie': '../plugin/jquery.easy-pie-chart/dist/jquery.easypiechart.min',

        'flot': '../plugin/flot/jquery.flot.cust.min',
        'flot-resize': '../plugin/flot/jquery.flot.resize.min',
        'flot-fillbetween': '../plugin/flot/jquery.flot.fillbetween.min',
        'flot-orderBar': '../plugin/flot/jquery.flot.orderBar.min',
        'flot-pie': '../plugin/flot/jquery.flot.pie.min',
        'flot-time': '../plugin/flot/jquery.flot.time.min',
        'flot-tooltip': '../plugin/flot/jquery.flot.tooltip.min',
        'flot-pack': '../plugin/flot/jquery.flot.pack',

        'raphael': '../plugin/morris/raphael.min',
        'morris': '../plugin/morris/morris.min',

        'dygraphs': '../plugin/dygraphs/dygraph-combined.min',
        'dygraphs-demo': '../plugin/dygraphs/demo-data.min',

        'chartjs': '../plugin/chartjs/chart.min',

        
        'datatables.net': ['//cdn.datatables.net/1.10.10/js/jquery.dataTables.min',
                       '../plugin/datatables/media/js/jquery.dataTables.min'
                        ],
        
        'datatables.net-buttons': ['https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min',
                            '../plugin/datatables-buttons/js/dataTables.buttons.min'
                        ],
        'datatables.net-buttons.colvis': ['https://cdn.datatables.net/buttons/1.1.0/js/buttons.colVis.min',
                            '../plugin/datatables-buttons/js/buttons.colVis.min'
                        ],
        'datatables.net-buttons.flash': ['https://cdn.datatables.net/buttons/1.1.0/js/buttons.flash.min',
                            '../plugin/datatables-buttons/js/buttons.flash.min'
                        ],                   
        
        'datatables.net-buttons.html5': ['https://cdn.datatables.net/buttons/1.1.0/js/buttons.html5.min',
                            '../plugin/datatables-buttons/js/buttons.html5.min'
                        ],
        
        'datatables.net-buttons.print': ['https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min',
                            '../plugin/datatables-buttons/js/buttons.print.min'
                        ],                
        
        'datatables.net-buttons.bootstrap': ['https://cdn.datatables.net/buttons/1.1.0/js/buttons.bootstrap.min',
                            '../plugin/datatables-buttons/js/buttons.bootstrap.min'
                        ],                                   
    
        'datatables.net-bs': '../plugin/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min',
    
        'datatables.net-responsive': '../plugin/datatables-responsive/js/datatables.responsive.min',
        'datatables.net-responsive.bootstrap': '../plugin/datatables-responsive/js/responsive.bootstrap.min',
        
        'pdfmake':["https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min",
                    '../plugin/pdfmake/build/pdfmake.min'],
        'pdfmakefonts':"../plugin/pdfmake/build/vfs_fonts",
        'jszip':'https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min',
        
        
        'jqgrid':'../plugin/jqgrid/js/minified/jquery.jqGrid.min',
        'jqgrid-locale-en':'../plugin/jqgrid/js/i18n/grid.locale-en',


        'jquery-maskedinput': '../plugin/jquery-maskedinput/dist/jquery.maskedinput.min',
        'jquery-validation': '../plugin/jquery-validation/dist/jquery.validate.min',
        'jquery-form': '../plugin/jquery-form/jquery.form',
        'jquery-cookie': '../plugin/jquery-cookie/jquery.cookie',
        'jquery-nicescroll': '../plugin/jquery-nicescroll/jquery.nicescroll',
        'jquery-gritter': '../plugin/jquery.gritter/js/jquery.gritter.min',
        'jquery-autosize':'../plugin/jquery-autosize/dist/autosize.min',
         
        'bootstrap-validator': '../plugin/bootstrapvalidator/dist/js/bootstrapValidator.min',

        'bootstrap-timepicker': '../plugin/bootstrap3-fontawesome-timepicker/js/bootstrap-timepicker.min',
        'clockpicker': '../plugin/clockpicker/dist/bootstrap-clockpicker.min',
        'nouislider': '../plugin/nouislider/distribute/jquery.nouislider.min',
        'ionslider': '../plugin/ion.rangeSlider/js/ion.rangeSlider.min',
        'bootstrap-duallistbox': '../plugin/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min',
        'bootstrap-colorpicker': '../plugin/bootstrap-colorpicker/js/bootstrap-colorpicker',
        'jquery-knob': '../plugin/jquery-knob/dist/jquery.knob.min',
        'bootstrap-slider': '../plugin/seiyria-bootstrap-slider/dist/bootstrap-slider.min',
        'bootstrap-tagsinput': '../plugin/bootstrap-tagsinput/dist/bootstrap-tagsinput.min',
        'x-editable': '../plugin/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min',
        'angular-x-editable': '../plugin/angular-xeditable/dist/js/xeditable.min',

        'fuelux-wizard': '../plugin/fuelux/js/wizard',

        'dropzone': '../plugin/dropzone/dist/min/dropzone.min',

        'jcrop': '../plugin/jcrop/js/jquery.Jcrop.min',


        'bootstrap-progressbar': '../plugin/bootstrap-progressbar/bootstrap-progressbar.min',
        'jquery-nestable': '../plugin/jquery-nestable/jquery.nestable',

        'superbox': '../plugin/superbox/superbox.min',


        'jquery-jvectormap': '../plugin/vectormap/jquery-jvectormap-1.2.2.min',
        'jquery-jvectormap-world-mill-en': '../plugin/vectormap/jquery-jvectormap-world-mill-en',


        'lodash': '../plugin/lodash/lodash.min',
        //'handlebars':'../plugin/handlebars/handlebars-v4.0.5',
        'typeahead': '../plugin/typeahead.js/typeahead.jquery.min',
        'bloodhound': '../plugin/typeahead.js/bloodhound.min',
        //'typeahead.bundle': '../plugin/typeahead.js/typeahead.bundle',
        
        'ionsound': '../plugin/ionsound/js/ion.sound.min',
        'skycons':'../plugin/skycons-html5/skycons',
        'bootbox':'../plugin/bootbox/bootbox',


        'magnific-popup': '../plugin/magnific-popup/dist/jquery.magnific-popup',
        'oc-lazyload':'../plugin/oclazyload/dist/ocLazyLoad.require.min',

       // 'fullcalendar': '../smartadmin-plugin/fullcalendar/jquery.fullcalendar.min',
       // 'smartwidgets': '../smartadmin-plugin/smartwidgets/jarvis.widget.min',
       // 'notification': '../smartadmin-plugin/notification/SmartNotification.min',

        // app js file includes
        'appConfig': '../app.config',
        'modules-includes': 'includes'

    },
    shim: {
        'angular': {'exports': 'angular', deps: ['jquery']},
        /*'handlebars': {
                exports: 'Handlebars'
            },*/
        'angular-animate': { deps: ['angular'] },
        'angular-resource': { deps: ['angular'] },
        'angular-cookies': { deps: ['angular'] },
        'angular-sanitize': { deps: ['angular'] },
        'angular-bootstrap': { deps: ['angular'] },
        'angular-ui-router': { deps: ['angular'] },
        'angular-google-maps': { deps: ['angular'] },
        'angular-loading-bar': { deps: ['angular'] },
        'angular-mocks': { deps: ['angular'] },
        
        'angular-couch-potato': { deps: ['angular'] },
        
        'angular-x-editable': { deps: ['angular'] },
        
        'socket.io': { deps: ['angular'] },

        'anim-in-out': { deps: ['angular-animate'] },
        'angular-easyfb': { deps: ['angular'] },
        'angular-google-plus': { deps: ['angular'] },

        'select2': { deps: ['jquery']},
        'chosen': { deps: ['jquery']},
        
        'summernote': { deps: ['jquery']},

        'to-markdown': {deps: ['he']},

        'bootstrap-markdown': { deps: ['jquery', 'markdown', 'to-markdown']},

        'ckeditor': { deps: ['jquery']},

       // 'moment': {'exports': 'moment'},
      //  'moment-timezone': { deps: ['moment']},
       // 'moment-timezone-data': { deps: ['moment']},
       // 'moment-helper': { deps: ['moment-timezone-data']},
        'bootstrap-daterangepicker': { deps: ['jquery']},

        'flot': { deps: ['jquery']},
        'flot-resize': { deps: ['flot']},
        'flot-fillbetween': { deps: ['flot']},
        'flot-orderBar': { deps: ['flot']},
        'flot-pie': { deps: ['flot']},
        'flot-time': { deps: ['flot']},
        'flot-tooltip': { deps: ['flot']},
        'flot-pack': { deps: ['jquery']},

        'morris': {deps: ['raphael']},

        'datatables.net':{deps: ['jquery','bootstrap-daterangepicker']},
        'datatables.net-buttons' :{deps: ['datatables.net']},
        'datatables.net-buttons.colvis':{deps: ['datatables.net','datatables.net-buttons']},
        'datatables.net-buttons.html5':{deps: ['datatables.net','datatables.net-buttons','jszip']},
        'datatables.net-buttons.flash':{deps: ['datatables.net','datatables.net-buttons']},
        'datatables.net-buttons.print':{deps: ['datatables.net','datatables.net-buttons']},
        
       // 'datatables-colvis':{deps: ['datatables']},
       // 'datatables-tools':{deps: ['datatables']},
        //'datatables-bootstrap':{deps: ['datatables','datatables-tools','datatables-colvis']},
       'datatables.net-responsive': {deps: ['datatables.net']},
       'datatables.net-bs':{deps: ['datatables.net','datatables.net-buttons','datatables.net-responsive']},
       'datatables.net-buttons.bootstrap':{deps: ['datatables.net-bs','datatables.net-buttons']},
       'datatables.net-responsive.bootstrap': {deps: ['datatables.net-bs','datatables.net-responsive']},

        'jqgrid' : {deps: ['jquery']},
        'jqgrid-locale-en' : {deps: ['jqgrid']},

        'jquery-maskedinput':{deps: ['jquery']},
        'jquery-validation':{deps: ['jquery']},
        'jquery-form':{deps: ['jquery']},
        'jquery-color':{deps: ['jquery']},
        'jquery-cookie':{deps: ['jquery']},
        'jquery-nicescroll':{deps: ['jquery']},
        'jquery-gritter':{deps: ['jquery']},
        'jquery-autosize':{deps: ['jquery']},

        'jcrop':{deps: ['jquery-color']},

        'bootstrap-validator':{deps: ['jquery']},

        'bootstrap-timepicker':{deps: ['jquery']},
        'clockpicker':{deps: ['jquery']},
        'nouislider':{deps: ['jquery']},
        'ionslider':{deps: ['jquery']},
        'bootstrap-duallistbox':{deps: ['jquery']},
        'bootstrap-colorpicker':{deps: ['jquery']},
        'jquery-knob':{deps: ['jquery']},
        'bootstrap-slider':{deps: ['jquery']},
        'bootstrap-tagsinput':{deps: ['jquery']},
        'x-editable':{deps: ['jquery']},
        
        'bootstrap-taginput':{deps: ['angular','bootstrap']},
        'jasny-bootstrap-fileinput':{deps: ['bootstrap']},
        'fuelux-wizard':{deps: ['jquery']},
        'bootstrap':{deps: ['jquery']},

        'magnific-popup': { deps: ['jquery']},
        'modules-includes': { deps: ['angular']},
        'sparkline': { deps: ['jquery']},
        'easy-pie': { deps: ['jquery']},
        'jquery-jvectormap': { deps: ['jquery']},
        'jquery-jvectormap-world-mill-en': { deps: ['jquery']},

        'dropzone': { deps: ['jquery']},

        'bootstrap-progressbar': { deps: ['bootstrap']},
        'bootstrap-session-timeout': { deps: ['bootstrap']},


        'jquery-ui': { deps: ['jquery']},
        'jquery-nestable': { deps: ['jquery']},

        'superbox': { deps: ['jquery']},
        
        'oc-lazyload': { deps: ['angular']},

        'typeahead': { deps: ['jquery']},
        'bloodhound': { deps: ['jquery']},
        
       //'typeahead.bundle': { deps: ['jquery','typehead','bloodhound']},
        
        'pdfmakefonts': { deps: ['pdfmake']}//,

       // 'notification': { deps: ['jquery']},

        //'smartwidgets': { deps: ['jquery-ui']}

    },
    priority: [
        'jquery',
        'bootstrap',
        'angular'
    ]
};
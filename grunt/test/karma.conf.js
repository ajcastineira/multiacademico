// Karma configuration
// http://karma-runner.github.io/0.12/config/configuration-file.html
// Generated on 2015-10-04 using
// generator-karma 1.0.0

module.exports = function(config) {
  'use strict';

  config.set({
    // enable / disable watching file and executing tests whenever any file changes
    autoWatch: true,

    // base path, that will be used to resolve files and exclude
    basePath: '../../',

    // testing framework to use (jasmine/mocha/qunit/...)
    // as well as any additional frameworks (requirejs/chai/sinon/...)
    frameworks: [
      "jasmine"
    ],

    // list of files / patterns to load in the browser
    files: [
      // bower:js
      '../web/vendor/jquery/dist/jquery.js',
      '../web/vendor/angular/angular.js',
      '../web/vendor/bootstrap-sass-official/assets/javascripts/bootstrap.js',
      '../web/vendor/angular-animate/angular-animate.js',
      '../web/vendor/angular-aria/angular-aria.js',
      '../web/vendor/angular-cookies/angular-cookies.js',
      '../web/vendor/angular-messages/angular-messages.js',
      '../web/vendor/angular-resource/angular-resource.js',
      '../web/vendor/angular-route/angular-route.js',
      '../web/vendor/angular-sanitize/angular-sanitize.js',
      '../web/vendor/angular-touch/angular-touch.js',
      '../web/vendor/angular-ui-router/release/angular-ui-router.js',
      '../web/vendor/angular-loading-bar/build/loading-bar.js',
      '../web/vendor/oclazyload/dist/ocLazyLoad.js',
      '../web/vendor/html5shiv/dist/html5shiv.js',
      '../web/vendor/respond-minmax/dest/respond.src.js',
      '../web/vendor/jquery-cookie/jquery.cookie.js',
      '../web/vendor/jquery-nicescroll/jquery.nicescroll.js',
      '../web/vendor/ionsound/js/ion.sound.js',
      '../web/vendor/bootstrap/dist/js/bootstrap.js',
      '../web/vendor/bootbox/bootbox.js',
      '../web/vendor/jquery-mousewheel/jquery.mousewheel.js',
      '../web/vendor/angular-mocks/angular-mocks.js',
      '../web/vendor/angular-bootstrap/ui-bootstrap-tpls.js',
      '../web/vendor/angular-xeditable/dist/js/xeditable.js',
      '../web/vendor/blockUI/jquery.blockUI.js',
      '../web/vendor/underscore/underscore.js',
      '../web/vendor/moment/moment.js',
      '../web/vendor/bootstrap-calendar/js/calendar.js',
      '../web/vendor/bootstrap-maxlength/bootstrap-maxlength.js',
      '../web/vendor/bootstrap-switch/dist/js/bootstrap-switch.js',
      '../web/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.js',
      '../web/vendor/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
      '../web/vendor/d3/d3.js',
      '../web/vendor/c3/c3.js',
      '../web/vendor/c3-angular/c3js-directive.js',
      '../web/vendor/Chart.js/Chart.js',
      '../web/vendor/chosen/chosen.jquery.min.js',
      '../web/vendor/eventie/eventie.js',
      '../web/vendor/doc-ready/doc-ready.js',
      '../web/vendor/dropzone/dist/min/dropzone.min.js',
      '../web/vendor/flot/jquery.flot.js',
      '../web/vendor/requirejs/require.js',
      '../web/vendor/fuelux/dist/js/fuelux.js',
      '../web/vendor/gmap3/dist/gmap3.min.js',
      '../web/vendor/google-code-prettify/bin/prettify.min.js',
      '../web/vendor/holderjs/holder.js',
      '../web/vendor/ion.rangeSlider/js/ion.rangeSlider.js',
      '../web/vendor/jasny-bootstrap/dist/js/jasny-bootstrap.js',
      '../web/vendor/jquery.gritter/js/jquery.gritter.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.extensions.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.date.extensions.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.numeric.extensions.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.phone.extensions.js',
      '../web/vendor/jquery.inputmask/dist/inputmask/jquery.inputmask.regex.extensions.js',
      '../web/vendor/jquery-autosize/dist/autosize.js',
      '../web/vendor/jquery-backstretch/jquery.backstretch.js',
      '../web/vendor/jquery-mockjax/dist/jquery.mockjax.js',
      '../web/vendor/jquery-smooth-scroll/jquery.smooth-scroll.js',
      '../web/vendor/jquery-validation/dist/jquery.validate.js',
      '../web/vendor/jquery-waypoints/lib/noframework.waypoints.min.js',
      '../web/vendor/jstzdetect/jstz.min.js',
      '../web/vendor/less/dist/less.js',
      '../web/vendor/get-style-property/get-style-property.js',
      '../web/vendor/get-size/get-size.js',
      '../web/vendor/eventEmitter/EventEmitter.js',
      '../web/vendor/matches-selector/matches-selector.js',
      '../web/vendor/fizzy-ui-utils/utils.js',
      '../web/vendor/outlayer/outlayer.js',
      '../web/vendor/masonry/masonry.js',
      '../web/vendor/mixitup/src/jquery.mixitup.js',
      '../web/vendor/raphael/raphael.js',
      '../web/vendor/mocha/mocha.js',
      '../web/vendor/morris.js/morris.js',
      '../web/vendor/respond/dest/respond.src.js',
      '../web/vendor/select2/dist/js/select2.js',
      '../web/vendor/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
      '../web/vendor/summernote/dist/summernote.js',
      '../web/vendor/tc-angular-chartjs/dist/tc-angular-chartjs.min.js',
      '../web/vendor/typeahead.js/dist/typeahead.bundle.js',
      // endbower
      "app/scripts/**/*.js",
      "test/mock/**/*.js",
      "test/spec/**/*.js"
    ],

    // list of files / patterns to exclude
    exclude: [
    ],

    // web server port
    port: 8080,

    // Start these browsers, currently available:
    // - Chrome
    // - ChromeCanary
    // - Firefox
    // - Opera
    // - Safari (only Mac)
    // - PhantomJS
    // - IE (only Windows)
    browsers: [
      "PhantomJS"
    ],

    // Which plugins to enable
    plugins: [
      "karma-phantomjs-launcher",
      "karma-jasmine"
    ],

    // Continuous Integration mode
    // if true, it capture browsers, run tests and exit
    singleRun: false,

    colors: true,

    // level of logging
    // possible values: LOG_DISABLE || LOG_ERROR || LOG_WARN || LOG_INFO || LOG_DEBUG
    logLevel: config.LOG_INFO,

    // Uncomment the following lines if you are using grunt's server to run the tests
    // proxies: {
    //   '/': 'http://localhost:9000/'
    // },
    // URL root prevent conflicts with the site root
    // urlRoot: '_karma_'
  });
};

// Karma configuration
// http://karma-runner.github.io/0.12/config/configuration-file.html
// Generated on 2015-06-07 using
// generator-karma 1.0.0

module.exports = function(config) {
  'use strict';

  config.set({
    // enable / disable watching file and executing tests whenever any file changes
    autoWatch: true,

    // base path, that will be used to resolve files and exclude
    basePath: '../',

    // testing framework to use (jasmine/mocha/qunit/...)
    // as well as any additional frameworks (requirejs/chai/sinon/...)
    frameworks: [
      "jasmine"
    ],

    // list of files / patterns to load in the browser
    files: [
      // bower:js
      'bower_components/jquery/dist/jquery.js',
      'bower_components/angular/angular.js',
      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.js',
      'bower_components/angular-animate/angular-animate.js',
      'bower_components/angular-aria/angular-aria.js',
      'bower_components/angular-cookies/angular-cookies.js',
      'bower_components/angular-messages/angular-messages.js',
      'bower_components/angular-resource/angular-resource.js',
      'bower_components/angular-route/angular-route.js',
      'bower_components/angular-sanitize/angular-sanitize.js',
      'bower_components/angular-touch/angular-touch.js',
      'bower_components/angular-ui-router/release/angular-ui-router.js',
      'bower_components/angular-loading-bar/build/loading-bar.js',
      'bower_components/oclazyload/dist/ocLazyLoad.js',
      'bower_components/html5shiv/dist/html5shiv.js',
      'bower_components/respond-minmax/dest/respond.src.js',
      'bower_components/jquery-cookie/jquery.cookie.js',
      'bower_components/jquery-nicescroll/jquery.nicescroll.js',
      'bower_components/ionsound/js/ion.sound.js',
      'bower_components/bootstrap/dist/js/bootstrap.js',
      'bower_components/bootbox/bootbox.js',
      'bower_components/jquery-mousewheel/jquery.mousewheel.js',
      'bower_components/angular-mocks/angular-mocks.js',
      'bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
      'bower_components/angular-xeditable/dist/js/xeditable.js',
      'bower_components/blockUI/jquery.blockUI.js',
      'bower_components/underscore/underscore.js',
      'bower_components/moment/moment.js',
      'bower_components/bootstrap-calendar/js/calendar.js',
      'bower_components/bootstrap-maxlength/bootstrap-maxlength.js',
      'bower_components/bootstrap-switch/dist/js/bootstrap-switch.js',
      'bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js',
      'bower_components/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
      'bower_components/d3/d3.js',
      'bower_components/c3/c3.js',
      'bower_components/c3-angular/c3js-directive.js',
      'bower_components/Chart.js/Chart.js',
      'bower_components/chosen/chosen.jquery.min.js',
      'bower_components/eventie/eventie.js',
      'bower_components/doc-ready/doc-ready.js',
      'bower_components/dropzone/dist/min/dropzone.min.js',
      'bower_components/flot/jquery.flot.js',
      'bower_components/requirejs/require.js',
      'bower_components/fuelux/dist/js/fuelux.js',
      'bower_components/gmap3/dist/gmap3.min.js',
      'bower_components/google-code-prettify/bin/prettify.min.js',
      'bower_components/holderjs/holder.js',
      'bower_components/ion.rangeSlider/js/ion.rangeSlider.js',
      'bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js',
      'bower_components/jquery.gritter/js/jquery.gritter.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.extensions.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.date.extensions.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.numeric.extensions.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.phone.extensions.js',
      'bower_components/jquery.inputmask/dist/inputmask/jquery.inputmask.regex.extensions.js',
      'bower_components/jquery-autosize/dist/autosize.js',
      'bower_components/jquery-backstretch/jquery.backstretch.js',
      'bower_components/jquery-mockjax/dist/jquery.mockjax.js',
      'bower_components/jquery-smooth-scroll/jquery.smooth-scroll.js',
      'bower_components/jquery-validation/dist/jquery.validate.js',
      'bower_components/jquery-waypoints/lib/noframework.waypoints.min.js',
      'bower_components/jstzdetect/jstz.min.js',
      'bower_components/less/dist/less.js',
      'bower_components/get-style-property/get-style-property.js',
      'bower_components/get-size/get-size.js',
      'bower_components/eventEmitter/EventEmitter.js',
      'bower_components/matches-selector/matches-selector.js',
      'bower_components/fizzy-ui-utils/utils.js',
      'bower_components/outlayer/outlayer.js',
      'bower_components/masonry/masonry.js',
      'bower_components/mixitup/src/jquery.mixitup.js',
      'bower_components/raphael/raphael.js',
      'bower_components/mocha/mocha.js',
      'bower_components/morris.js/morris.js',
      'bower_components/respond/dest/respond.src.js',
      'bower_components/select2/dist/js/select2.js',
      'bower_components/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
      'bower_components/summernote/dist/summernote.js',
      'bower_components/tc-angular-chartjs/dist/tc-angular-chartjs.min.js',
      'bower_components/typeahead.js/dist/typeahead.bundle.js',
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

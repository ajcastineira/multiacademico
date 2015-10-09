// Defer AngularJS bootstrap
window.name = "NG_DEFER_BOOTSTRAP!";

define([
    'require',
    'jquery',
    'angular',
    'domReady',

    //'pace',
    'bootstrap',
    //'bootbox',
    //'appConfig',
    'app',
    'includes'
], function (require, $, ng, domReady) {
    'use strict';

    //$.sound_path = appConfig.sound_path;
   // $.sound_on = appConfig.sound_on;


    domReady(function (document) {
        
        ng.bootstrap(document, ['app']);
        ng.resumeBootstrap();
       // console.log("aqui paso algo ya");
    });
});

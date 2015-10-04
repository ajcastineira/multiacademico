/* ==========================================================================
 * Template: Blankon Fullpack Admin Theme
 * Version: 1.0.8
 * ---------------------------------------------------------------------------
 * Author: Djava UI
 * Website: http://djavaui.com
 * Email: maildjavaui@gmail.com
 * ==========================================================================
*/
define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {
  

'use strict';
// =========================================================================
// BLANKON MODULE APP
// =========================================================================
 var module= ng.module('blankonApp', [
    'ui.router',
    'oc.lazyLoad',
    'angular-loading-bar',
    'ngSanitize',
    'ngAnimate',
    'blankonConfig',
    'blankonDirective',
    'blankonController'
]);
 couchPotato.configureApp(module);

    module.run(function($couchPotato){
        module.lazy = $couchPotato;
    });

    return module;


});
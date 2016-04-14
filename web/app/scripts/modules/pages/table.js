/* ==========================================================================
 * Plugins used: datatable
 * ---------------------------------------------------------------------------
 * TABLE OF CONTENT
 * - DATATABLE
 * - USING AJAX
 * - USING DOM
 ============================================================================ */
"use strict";
(function(){
    var app = angular.module('blankonApp.table', []);

    app.controller('xxx',function(){
        this.header = [{test: 'hello world'}];
    });

})();
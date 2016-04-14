/* ==========================================================================
 * Plugins used: bootstrap wysihtml5
 ============================================================================ */
"use strict";
(function(){
    angular.module('blankonApp.blog.blogGrid', [])

        .controller('BlogCtrl', ['$scope', function($scope) {
            // Create handle function
            $(window).load(function () {
                var container = document.querySelector('#blog-grid');
                var msnry = new Masonry( container, {
                    // options
                    columnWidth: '.col-xs-12',
                    itemSelector: '.col-xs-12',
                    isAnimated: true
                });

                // CHECK ON LOAD
                if($(window).width() <= 480 )
                    msnry.destroy();

                // CHECK ON RESIZE
                $(window).resize(function(){
                    if($(this).width() <= 480 )
                        msnry.destroy();
                });

                // CHECK ON SIDEBAR LEFT TOGGLE
                $('.navbar-minimize a').on('click',function(){
                    msnry.layout();
                });

                // CHECK ON SIDEBAR RIGHT TOGGLE
                $('.navbar-setting a').on('click',function(){
                    msnry.layout();
                });
            });

            var container = document.querySelector('#blog-grid');
            var msnry = new Masonry( container, {
                // options
                columnWidth: '.col-xs-12',
                itemSelector: '.col-xs-12',
                isAnimated: true
            });

            // CHECK ON LOAD
            if($(window).width() <= 480 )
                msnry.destroy();

            // CHECK ON RESIZE
            $(window).resize(function(){
                if($(this).width() <= 480 )
                    msnry.destroy();
            });

            // CHECK ON SIDEBAR LEFT TOGGLE
            $('.navbar-minimize a').on('click',function(){
                msnry.layout();
            });

            // CHECK ON SIDEBAR RIGHT TOGGLE
            $('.navbar-setting a').on('click',function(){
                msnry.layout();
            });

        }]);

})();

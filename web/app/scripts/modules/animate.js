"use strict";
(function(){
    angular.module('blankonApp.animate', [])

        .directive('toggleAnimate', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    $(element).click(function(e){
                        e.preventDefault();
                        $('#animation-sample').removeClass().addClass($(this).data('animate') + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                            $(this).removeClass();
                        });
                    });
                }
            }
        })

})();
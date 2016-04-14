"use strict";
(function(){
    angular.module('blankonApp.mail.inbox', [])

        .controller('MailInboxCtrl', function($scope, $http, settings) {
            $scope.mails = [];
            $http.get(settings.dataPath+'/views/mail/inbox.json') // Simple GET request example :
                .success(function(data) {
                    // this callback will be called asynchronously
                    // when the response is available
                    $scope.mails = data;
                })
                .error(function(data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
        })

        // =========================================================================
        // CHECK
        // =========================================================================
        .directive('checkAction', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.click(function(){
                        var list = $(this);
                        if(list.is(':checked')){
                            list.closest('tr').addClass('selected');
                        } else {
                            list.closest('tr').removeClass('selected');
                        }
                    });
                }
            }
        })

        // =========================================================================
        // STAR
        // =========================================================================
        .directive('starAction', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.click(function(){
                        if(!$(this).hasClass('star-checked')) {
                            $(this).addClass('star-checked');
                        }
                        else
                            $(this).removeClass('star-checked');
                        return false;
                    });
                }
            }
        })

        // =========================================================================
        // READ MAIL
        // =========================================================================
        .directive('readMail', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.click(function(){
                        location.href="#/mail-view";
                    });
                }
            }
        })

})();
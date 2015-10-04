"use strict";
(function(){
angular.module('ui.bootstrap.alert', [])

    .controller('AlertCtrl', function ($scope) {
        // Default alerts Bootstrap style
        $scope.alerts = [
            {type: 'success', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'info', msg: 'Heads up! This alert needs your attention, but it is not super important.'},
            {type: 'warning', msg: 'Warning! Better check yourself, you are not looking too good.'},
            {type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.'}
        ];

        // Additional alerts style
        $scope.additionalAlerts = [
            {type: 'default', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'lilac', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'inverse', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'teals', msg: 'Well done! You successfully read this important alert message.'}
        ];

        // Link on alerts
        $scope.linkAlerts = [
            {type: 'success', msg: 'Well done! You successfully read <a href="#">this important alert message</a>.'},
            {type: 'info', msg: 'Heads up! This <a href="#">alert needs your attention</a>, but it is not super important.'},
            {type: 'warning', msg: 'Warning! Better check yourself, you are <a href="#">not looking too good</a>.'},
            {type: 'danger', msg: 'Oh snap! <a href="#">Change a few things up</a> and try submitting again.'}
        ];

        // alert with icons
        $scope.iconAlerts = [
            {
                type: 'info',
                icon: 'fa fa-envelope-o',
                msg: '<a href="#">Pack Suparman</a> send you a mail',
                subMsg: 'Blueprint for next project',
                time: '5 min ago'
            },
            {
                type: 'success',
                icon: 'fa fa-twitter',
                msg: '<a href="#">Jennifer Poiyem</a> mentioned you in a post',
                subMsg: 'Love you so much :P',
                time: '2 Hours Ago'
            },
            {
                type: 'danger',
                icon: 'fa fa-comments-o',
                msg: 'You have 2 message unread',
                subMsg: '<a href="#">Tenny Imoet, Leli Madang, Rebecca Cabean</a> and <a href="#">3 others</a>',
                time: '1 min ago'
            },
            {
                type: 'warning',
                icon: 'fa fa-bell-o',
                msg: 'Website has been server down',
                subMsg: 'Urgent for repair website',
                time: '7 Days Ago'
            }
        ];

        // Callout style
        $scope.callouts = [
            {
                type: 'info',
                msg: '<strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it is not super important.'
            },
            {
                type: 'warning',
                msg: '<strong>Warning!</strong> Better check yourself, you are <a href="#" class="alert-link">not looking too good</a>.'
            },
            {
                type: 'danger',
                msg: '<strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.'
            }
        ];

        // Adding alert trigger
        $scope.addAlert = function() {
            $scope.alerts.push({msg: 'Another alert!'});
        };

        // Close alert trigger
        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
    });
})();

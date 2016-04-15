"use strict";
(function(){
    angular.module('blankonApp.forms.xeditable', ['xeditable'])

        // =========================================================================
        // SET THEME IN APP.RUN
        // =========================================================================
        .run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
        })

        // =========================================================================
        // TEXT
        // =========================================================================
        .controller('TextSimpleCtrl', function($scope) {
            $scope.user = {
                name: 'awesome user'
            };
        })

        // =========================================================================
        // SELECT LOCAL
        // =========================================================================
        .controller('SelectLocalCtrl', function($scope, $filter) {
            $scope.user = {
                status: 2
            };

            $scope.statuses = [
                {value: 1, text: 'status1'},
                {value: 2, text: 'status2'},
                {value: 3, text: 'status3'},
                {value: 4, text: 'status4'}
            ];

            $scope.showStatus = function() {
                var selected = $filter('filter')($scope.statuses, {value: $scope.user.status});
                return ($scope.user.status && selected.length) ? selected[0].text : 'Not set';
            };
        })

        // =========================================================================
        // HTML5 INPUTS
        // =========================================================================
        .controller('Html5InputsCtrl', function($scope) {
            $scope.user = {
                email: 'email@example.com',
                tel: '123-45-67',
                number: 29,
                range: 10,
                url: 'http://example.com',
                search: 'blabla',
                color: '#6a4415',
                date: null,
                time: '12:30',
                datetime: null,
                month: null,
                week: null
            };
        })

        // =========================================================================
        // TEXTAREA
        // =========================================================================
        .controller('TextareaCtrl', function($scope) {
            $scope.user = {
                desc: 'Awesome user \ndescription!'
            };
        })

        // =========================================================================
        // CHECKBOX
        // =========================================================================
        .controller('CheckboxCtrl', function($scope) {
            $scope.user = {
                remember: true
            };
        })

        // =========================================================================
        // CHECKLIST
        // =========================================================================
        .controller('ChecklistCtrl', function($scope, $filter) {
            $scope.user = {
                status: [2, 3]
            };

            $scope.statuses = [
                {value: 1, text: 'status1'},
                {value: 2, text: 'status2'},
                {value: 3, text: 'status3'}
            ];

            $scope.showStatus = function() {
                var selected = [];
                angular.forEach($scope.statuses, function(s) {
                    if ($scope.user.status.indexOf(s.value) >= 0) {
                        selected.push(s.text);
                    }
                });
                return selected.length ? selected.join(', ') : 'Not set';
            };

        })

        // =========================================================================
        // RADIOLIST
        // =========================================================================
        .controller('RadiolistCtrl', function($scope, $filter) {
            $scope.user = {
                status: 2
            };

            $scope.statuses = [
                {value: 1, text: 'status1'},
                {value: 2, text: 'status2'}
            ];

            $scope.showStatus = function() {
                var selected = $filter('filter')($scope.statuses, {value: $scope.user.status});
                return ($scope.user.status && selected.length) ? selected[0].text : 'Not set';
            };
        });

})();
// =========================================================================
// CONTROLLER APP
// =========================================================================
define([
    'angular',
    'angular-couch-potato',
    'ionsound',
    'angular-ui-router'
    
], function (ng,couchPotato){
'use strict';


var module = ng.module('blankonController', [])

     .controller('BlankonCtrl',['$scope', '$http', 'settings', '$firebaseObject', '$firebaseArray', 'User', function($scope, $http, settings, $firebaseObject, $firebaseArray, User) {

          User.initialized.then(function(){
              firebase.auth().signInWithCustomToken(User.fToken).then(function(authData) {
                console.log("Logged in as:", authData.uid);
              }).catch(function(error) {
                console.log("Authentication failed:", error);
              });
          });
          var ref = firebase.database().ref();
        // =========================================================================
        // SUPPORT IE
        // =========================================================================
        $scope.supportIE = function () {
            // IE mode
            var isIE8 = false;
            var isIE9 = false;
            var isIE10 = false;

            // initializes main settings for IE
            isIE8 = !! navigator.userAgent.match(/MSIE 8.0/);
            isIE9 = !! navigator.userAgent.match(/MSIE 9.0/);
            isIE10 = !! navigator.userAgent.match(/MSIE 10.0/);

            if (isIE10) {
                $('html').addClass('ie10'); // detect IE10 version
            }

            if (isIE10 || isIE9 || isIE8) {
                $('html').addClass('ie'); // detect IE8, IE9, IE10 version
            }

            // Fix input placeholder issue for IE8 and IE9
            if (isIE8 || isIE9) { // ie8 & ie9
                // this is html5 placeholder fix for inputs, inputs with placeholder-no-fix class will be skipped(e.g: we need this for password fields)
                $('input[placeholder]:not(.placeholder-no-fix), textarea[placeholder]:not(.placeholder-no-fix)').each(function () {
                    var input = $(this);

                    if (input.val() == '' && input.attr("placeholder") != '') {
                        input.addClass("placeholder").val(input.attr('placeholder'));
                    }

                    input.focus(function () {
                        if (input.val() == input.attr('placeholder')) {
                            input.val('');
                        }
                    });

                    input.blur(function () {
                        if (input.val() == '' || input.val() == input.attr('placeholder')) {
                            input.val(input.attr('placeholder'));
                        }
                    });
                });
            }
        };

        // =========================================================================
        // COOKIE SIDEBAR MINIMIZE
        // =========================================================================
        $scope.cookieSidebarMinimize = function () {
            // Check (onLoad) if the cookie is there and set the class if it is
            if ($.cookie('page_sidebar_minimize') == 'active') {
                $('body').addClass('page-sidebar-minimize');
            }
        };

        // =========================================================================
        // SOUND PAGE
        // =========================================================================
        $scope.soundPage = function () {
            // Sounds setting
            if($('.page-sound').length){
                ion.sound({
                    sounds: [
                        {name: "beer_can_opening"},
                        {name: "bell_ring", volume: 0.6},
                        {name: "branch_break", volume: 0.3},
                        {name: "button_click"},
                        {name: "button_click_on"},
                        {name: "button_push"},
                        {name: "button_tiny", volume: 0.6},
                        {name: "camera_flashing"},
                        {name: "camera_flashing_2", volume: 0.6},
                        {name: "cd_tray", volume: 0.6},
                        {name: "computer_error"},
                        {name: "door_bell"},
                        {name: "door_bump", volume: 0.3},
                        {name: "glass"},
                        {name: "keyboard_desk"},
                        {name: "light_bulb_breaking", volume: 0.6},
                        {name: "metal_plate"},
                        {name: "metal_plate_2"},
                        {name: "pop_cork"},
                        {name: "snap"},
                        {name: "staple_gun"},
                        {name: "tap", volume: 0.6},
                        {name: "water_droplet"},
                        {name: "water_droplet_2"},
                        {name: "water_droplet_3", volume: 0.6}
                    ],
                    path: "assets/global/plugins/bower_components/ionsound/sounds/",
                    preload: true
                });
                // Add effect sound water droplet type 3
                $('.dropdown-toggle').on('click', function(){
                    ion.sound.play("water_droplet_3");
                });

            }
        };

        // =========================================================================
        // TOOLTIP
        // =========================================================================
        $scope.tooltip = function () {
            if($('[data-toggle=tooltip]').length){
                $('[data-toggle=tooltip]').tooltip({
                    animation: 'fade'
                });
            }
        };

        // =========================================================================
        // POPOVER
        // =========================================================================
        $scope.popover = function () {
            if($('[data-toggle=popover]').length){
                $('[data-toggle=popover]').popover();
            }
        };

        // =========================================================================
        // NAVBAR MESSAGES
        // =========================================================================
        $scope.navbarMessages = [];
        $http.get(settings.dataPath+'/partials/header/navbar-messages.json') // Simple GET request example :
            .success(function(data) {
                // this callback will be called asynchronously
                // when the response is available
                $scope.navbarMessages = data;
            })
            .error(function(data, status, headers, config) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });

        // =========================================================================
        // NAVBAR NOTIFICATIONS
        // =========================================================================
        
        
        // download physicsmarie's profile data into a local object
        // all server changes are applied in realtime
        //$scope.profile = $firebaseObject(ref.child('profiles').child('physicsmarie'));
        
        User.initialized.then(function(){
         var misNotificaciones=ref.child('notificaciones').child(User.username).orderByChild('date');
        $scope.navbarNotifications = {"title":"Notificaciones",
                                      "length":function(){
                                              return this.data.length;
                                      },
                                      "unread":function(){
                                          function isRead(m) {
                                                return m.read === false;
                                            }
                                          return this.data.filter(isRead).length;

                                      },
                                      "data":$firebaseArray(misNotificaciones)
                                      };
                                  
        });
        $scope.leerNotificacion=function(n){
            n.read=true; 
            $http.post(Routing.generate('notificaciones_read',{id:n.$id})) // Simple GET request example :
            .success(function(data) {
               n.read=true;
            })
            .error(function(data, status, headers, config) {
                n.read=false; 
            });
            
        };
        $scope.timeago=function(time){
            return timeago(time);
        };

        // =========================================================================
        // SIDEBAR RIGHT (PROFILE TAB)
        // =========================================================================
        $scope.profile = [];
        $http.get(settings.dataPath+'/partials/sidebar-right/profile.json') // Simple GET request example :
            .success(function(data) {
                $scope.profile = data;
            })
            .error(function(data, status, headers, config) {
                // Error actions
            });

        // =========================================================================
        // SIDEBAR RIGHT (PROFILE TAB)
        // =========================================================================
        $scope.chats = [];
        $http.get(settings.dataPath+'/partials/sidebar-right/chat.json') // Simple GET request example :
            .success(function(data) {
                $scope.chats = data;
            })
            .error(function(data, status, headers, config) {
                // Error actions
            });

        // =========================================================================
        // LOG EVENTS
        // =========================================================================
        // Log view event module loaded
        $scope.$on('ocLazyLoad.moduleLoaded', function(e, params) {
            console.log('event module loaded', params);
        });

        // Log view event component loaded
        $scope.$on('ocLazyLoad.componentLoaded', function(e, params) {
            console.log('event component loaded', params);
        });

        // Log view event file loaded
        $scope.$on('ocLazyLoad.fileLoaded', function(e, file) {
            console.log('event file loaded', file);
        });

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        $scope.cookieSidebarMinimize(); // Call cookie sidebar minimize
        $scope.soundPage(); // Call sound page
        $scope.tooltip(); // Call tooltip
        $scope.popover(); // Call popover

    }]);
    couchPotato.configureApp(module);
    module.run(function ($couchPotato) {
        module.lazy = $couchPotato;
    });    
    return module;
    
});

function timeago($timestamp)
{
    
    var tempo= {
        "fechainteligente": function (timestamp) 
                             {
                                 
                                /*if (!is_int(timestamp)and !is_numeric(timestamp)) 
                                {
                                        timestamp=strtotime(timestamp, 0);
                                }*/
                                var $diff = Math.floor(Date.now()/1000) - timestamp;
                                if ($diff <= 0) return 'Ahora';
                                else if ($diff < 60) return "hace "+this.ConSoSinS(Math.floor($diff), ' segundo(s)');
                                else if ($diff < 60*60) return "hace "+this.ConSoSinS(Math.floor($diff/60), ' minuto(s)');
                                else if ($diff < 60*60*24) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60)), ' hora(s)');
                                else if ($diff < 60*60*24*30) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24)), ' día(s)');
                                else if ($diff < 60*60*24*30*12) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24*30)), ' mes(es)');
                                else return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24*30*12)), ' año(s)');
                             },
        "getColor": function (timestamp)
        {
                /*if (!is_int($timestamp)) 
                {
                        timestamp=strtotime($timestamp, 0);
                }*/
                var $diff = Math.floor(Date.now()/1000) - timestamp;
                if ($diff <= 0) return 'orange';
                else if ($diff < 60) return "orange";
                else if ($diff < 60*60) return "green";
                else if ($diff < 60*60*24) return "blue";
                else if ($diff < 60*60*24*30) return "grey";
                else if ($diff < 60*60*24*30*12) return "grey";
                else return "grey";
             },
     "ConSoSinS": function(val, sentence) 
     {
        if (val > 1) return val+sentence.replace(/\u0028|\u0029/g, '');
	else return val+sentence.replace(/\u0028s\u0029|\u0028es\u0029/g, '');
     }
 };
    return tempo.fechainteligente($timestamp);
}
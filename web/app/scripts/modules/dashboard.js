/* ==========================================================================
 * TABLE OF CONTENT
 * ==========================================================================
 * - GRITTER NOTIFICATION
 * - VISITOR CHART & SERVER STATUS
 * - REAL TIME STATUS
 * - DEMO COUNT NUMBER
 * - SESSION TIMEOUT
 * --------------------------------------------------------------------------
 * Plugins used : Flot chart, Gritter notification
 ============================================================================ */
/*define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router',
    'bootstrap-session-timeout',
    'jquery-gritter',
    'flot-pack',
    'dropzone',
    'skycons'
], function (ng, couchPotato) {*/
    
    'use strict';
    angular.module('app.dashboard', [])

        //.config(function ($stateProvider)
        
 
 
        // =========================================================================
        // GRITTER NOTIFICATION
        // =========================================================================
        // display marketing alert only once
           .controller('DashboardCtrl',['$scope', '$http','$browser', 'settings','activities', function ($scope, $http,$browser, settings,activities) {
           /* if($('#wrapper').css('opacity')) {
                if (!$.cookie('intro')) {

                    // Gritter notification intro 1
                    setTimeout(function () {
                        var uniqueId = $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Bienvenido a Multiacademico',
                            // (string | mandatory) the text inside the notification
                            text: 'Multiacademico te notificará las nuevas actualizaciones, para un mejor soporte no dudes en contactarnos.',
                            // (string | optional) the image to display on the left
                            //image: settings.globalImagePath+'/icon/64/contact.png',
                            // (bool | optional) if you want it to fade out on its own or just sit there
                            sticky: false,
                            // (int | optional) the time you want it to be alive for before fading out
                            time: ''
                        });

                        // You can have it return a unique id, this can be used to manually remove it later using
                        setTimeout(function () {
                            $.gritter.remove(uniqueId, {
                                fade: true,
                                speed: 'slow'
                            });
                        }, 12000);
                    }, 5000);
                   
                    // Gritter notification intro 2
                    setTimeout(function () {
                        $.gritter.add({
                            // (string | mandatory) the heading of the notification
                            title: 'Bienvenido a Multiacademico',
                            // (string | mandatory) the text inside the notification
                            text: 'Multiacademico te notificará las nuevas actualizaciones, para un mejor soporte no dudes en contactarnos.',
                            // (string | optional) the image to display on the left
                            //image: settings.globalImagePath+'/icon/64/sound.png',
                            // (bool | optional) if you want it to fade out on its own or just sit there
                            sticky: true,
                            // (int | optional) the time you want it to be alive for before fading out
                            time: ''
                        });
                    }, 5000);

                    // Set cookie intro
                    $.cookie('intro',1, {expires: 1});
                }
            }*/
                
               //var base=$browser.baseHref();
              
                //base=base.replace("app_dev.php/","");
               
                 $scope.activities=activities;
                 
                 $scope.formData={};
                 $scope.publicPostForm=function(e,formulario) {
                                e.preventDefault();
                                var dataForm;
                                var formPost=document.getElementsByName(formulario)[0];
                                dataForm =new FormData(formPost);
                                
                                $http({
                                              method  : 'POST',
                                              async:   true,
                                              url     : Routing.generate('post_create'),
                                              data    : dataForm,  // pass in data as strings
                                              transformRequest: angular.identity,
                                              headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                             }).then(function(response) { 
                                                // console.log(response);
                                                    if(response.status===200){
                                                      return response.data;  
                                                    }else if(response.status===201)
                                                    {   
                                                        //console.log("se creo el post");
                                                        var timeline=document.getElementsByClassName('timeline')[0];
                                                        $scope.activities.unshift(response.data.activity);
                                                        formPost.reset();
                                                        
                                                        //$state.go(rutas.state_created,{id:response.data.id});
                                                        
                                                        //return "<div>se ha guardado correctamente</div>";
                                                    }
                                                  },function(response){
                                                      console.log("ocurrio error");
                                                      alert("Ha ocurrido un  error al publicar este estado");
                                                  });
                        
                                
                                
                                //$state.go($state.$current,{submited:true,formData:dataForm},{reload:true});
                            };
                // Session timeout
               /* $.sessionTimeout({
                  title: 'Su sesion esta a punto de expirar!',
                  logoutButton: 'Logout',
                  keepAliveButton: 'Seguir Conectado',
                  message: 'Su sesion sera bloqueada en 2 minutos',
                  keepAliveUrl: '#',
                  logoutUrl: 'logout',
                  redirUrl: 'login',
                  ignoreUserActivity: false,
                  warnAfter: 240000,
                  redirAfter: 360000
                });*/
                
                

        }])

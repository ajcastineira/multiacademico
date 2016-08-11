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
           .controller('DashboardCtrl',['$scope', '$http','$browser', 'settings','ResumenInicio','activities', function ($scope, $http,$browser, settings,ResumenInicio,activities) {
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
                
               var base=$browser.baseHref();
              
                base=base.replace("app_dev.php/","");
               
                $scope.resumen=ResumenInicio;
                if (ResumenInicio.mejoresparcial.length>0)
                {
                    $scope.mejorestudianteparcial=ResumenInicio.mejoresparcial[0];
                    $scope.mejorestudianteparcialfoto=base+$scope.mejorestudianteparcial.calificaciones.calificacionnummatricula.matriculacodestudiante.usuario.picture;
                    $scope.mejorestudiante2parcial=ResumenInicio.mejoresparcial[1];
                    $scope.mejorestudiante2parcialfoto=base+$scope.mejorestudiante2parcial.calificaciones.calificacionnummatricula.matriculacodestudiante.usuario.picture;
                    $scope.mejorestudiante3parcial=ResumenInicio.mejoresparcial[2];
                    $scope.mejorestudiante3parcialfoto=base+$scope.mejorestudiante3parcial.calificaciones.calificacionnummatricula.matriculacodestudiante.usuario.picture;
                }else
                {
                    $scope.mejorestudianteparcial=null;
                    $scope.mejorestudiante2parcial=null;
                    $scope.mejorestudiante3parcial=null;
                    $scope.mejorestudianteparcialfoto=null;
                    $scope.mejorestudiante2parcialfoto=null;
                    $scope.mejorestudiante3parcialfoto=null;
                }    
                if (ResumenInicio.mejoresquimestre.length>0)
                {
                $scope.mejorestudiantequimestre=ResumenInicio.mejoresquimestre[0];
                $scope.mejorestudiantequimestrefoto=base+$scope.mejorestudiantequimestre.calificaciones.calificacionnummatricula.matriculacodestudiante.usuario.picture;
                }
                else
                {
                    $scope.mejorestudiantequimestre=null;
                    $scope.mejorestudiantequimestrefoto=null;
                }
                
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

        // =========================================================================
        // VISITOR CHART & SERVER STATUS
        // =========================================================================
        /*.directive('visitorChart', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    $.plot(element, [{
                        label: 'New Visitor',
                        color: 'rgba(0, 177, 225, 0.35)',
                        data: [
                            ['Jan', 450],
                            ['Feb', 532],
                            ['Mar', 367],
                            ['Apr', 245],
                            ['May', 674],
                            ['Jun', 897],
                            ['Jul', 745]
                        ]
                    }, {
                        label: 'Old Visitor',
                        color: 'rgba(233, 87, 63, 0.36)',
                        data: [
                            ['Jan', 362],
                            ['Feb', 452],
                            ['Mar', 653],
                            ['Apr', 756],
                            ['May', 670],
                            ['Jun', 352],
                            ['Jul', 243]
                        ]
                    }], {
                        series: {
                            lines: { show: false },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 2,
                                fill: 0.5
                            },
                            points: {
                                show: true,
                                radius: 4
                            }
                        },
                        grid: {
                            borderColor: 'transparent',
                            borderWidth: 0,
                            hoverable: true,
                            backgroundColor: 'transparent'
                        },
                        tooltip: true,
                        tooltipOpts: { content: '%x : %y' + ' People' },
                        xaxis: {
                            tickColor: 'transparent',
                            mode: 'categories'
                        },
                        yaxis: { tickColor: 'transparent' },
                        shadowSize: 0
                    });
                }
            };
        })*/

        // =========================================================================
        // REAL TIME STATUS
        // =========================================================================
        /*.directive('realtimeStatus', function () {
            return {
                restrict: 'A',
                link: function(scope, element){
                    var data = [], totalPoints = 50;

                    function getRandomData() {

                        if (data.length > 0)
                            data = data.slice(1);

                        // Do a random walk
                        while (data.length < totalPoints) {

                            var prev = data.length > 0 ? data[data.length - 1] : 50,
                                y = prev + Math.random() * 10 - 5;

                            if (y < 0) {
                                y = 0;
                            } else if (y > 100) {
                                y = 100;
                            }
                            data.push(y);
                        }

                        // Zip the generated y values with the x values
                        var res = [];
                        for (var i = 0; i < data.length; ++i) {
                            res.push([i, data[i]]);
                        }
                        return res;
                    }


                    // Set up the control widget
                    var updateInterval = 1000;

                    var plot4 = $.plot(element, [ getRandomData() ], {
                        colors: ['#F6BB42'],
                        series: {
                            lines: {
                                fill: true,
                                lineWidth: 0
                            },
                            shadowSize: 0	// Drawing is faster without shadows
                        },
                        grid: {
                            borderColor: '#ddd',
                            borderWidth: 1,
                            labelMargin: 10
                        },
                        xaxis: {
                            color: '#eee'
                        },
                        yaxis: {
                            min: 0,
                            max: 100,
                            color: '#eee'
                        }
                    });

                    function update() {

                        plot4.setData([getRandomData()]);

                        // Since the axes don't change, we don't need to call plot.setupGrid()
                        plot4.draw();
                        setTimeout(update, updateInterval);
                    }

                    update();
                }
            };
        })*/

        // =========================================================================
        // DEMO COUNT NUMBER
        // =========================================================================
        /*.directive('countNumber', function () {
            return {
                restrict: 'A',
                link: function (){
                    $.fn.digits = function(){
                        return this.each(function(){
                            $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,') );
                        });
                    };
                    function counter($selector){
                        $({countNum: $('.counter-' + $selector).text()}).animate({countNum: $('.counter-' + $selector).data('counter')}, {
                            duration: 8000,
                            easing:'linear',
                            step: function() {
                                $('.counter-' + $selector).text(Math.floor(this.countNum)).digits();
                            },
                            complete: function() {
                                $('.counter-' + $selector).text(this.countNum).digits();
                            }
                        });
                    }
                    // Check if wrapper design is opacity 1
                    if($('#wrapper').css('opacity')) {
                        counter('visit');
                        counter('unique');
                        counter('page');
                    }
                }
            };
        });*/
  
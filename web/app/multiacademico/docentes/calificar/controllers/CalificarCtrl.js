/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['multiacademico/docentes/calificar/module'], function (module) {

    'use strict';

    module.registerController('CalificarCtrl', function ($scope,$http,$state,$stateParams) {
                            
                            $scope.state=$stateParams;
                          //  $scope.controlador="holamundo";
                            $scope.qop=[
                                    {id:1,label:"PRIMER QUIMESTRE"},
                                    {id:2,label:"SEGUNDO QUIMESTRE"},
                                  //  {id:3,label:"ANUAL"}
                            ];
                            $scope.pop=[
                                    {id:1,label:"Primer Parcial"},
                                    {id:2,label:"Segundo Parcial"},
                                    {id:3,label:"Tercer Parcial"}//,
                                  //  {id:4,label:"Total Parciales"},
                                 //   {id:5,label:"Total Quimestre"}
                            ];
                             
                            $scope.changeq=function(){
                                    $state.go($state.$current,{q:$scope.q,p:$scope.p});
                                };
                            $scope.formData={};
                            // process the form
                            $scope.processForm = function(e,formulario) {
                                e.preventDefault();
                                var dataForm;
                                dataForm =new FormData(document.getElementsByName(formulario)[0]);
                               $state.go($state.$current,{submited:true,formData:dataForm});
                            };
                        });
});




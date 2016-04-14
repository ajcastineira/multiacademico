/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['modules/forms/module'], function (module) {

    'use strict';

    module.registerController('FormsCrudCtrl', function ($scope,$http,$state,$stateParams) {
                            
                            $scope.state=$stateParams;
                            $scope.controlador="holamundo";
                            $scope.formData={};
                            // process the form
                            $scope.processForm = function(e,formulario) {
                                e.preventDefault();
                                var dataForm;
                                dataForm =new FormData(document.getElementsByName(formulario)[0]);
                                $state.go($state.$current,{submited:true,formData:dataForm},{reload:true});
                            };
                        });
});




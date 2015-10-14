/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['modules/forms/module'], function (module) {

    'use strict';

    module.registerController('FormsCrudCtrl', function ($scope,$http,$state,$stateParams) {
                            
                            $scope.state=$stateParams;
                            $scope.formData={};
                            // process the form
                            $scope.processForm = function(formulario) {
                                var dataForm;
                                dataForm =new FormData(document.getElementsByName(formulario)[0]);
                               $state.go($state.$current,{submited:true,formData:dataForm});
                            };
                        });
});




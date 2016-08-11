/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
    'use strict';
    
    function retornaletra(cantidad){

    var letra="";
     if (cantidad  <= 4 )
     {
         letra="E";
     }

     if ((cantidad > 4 )&&(cantidad < 7 )) 
     {
       letra="D";
     }

     if ((cantidad >= 7 )&&(cantidad < 9)) 
     {
          letra="C";
     }


     if ((cantidad >= 9 )&&(cantidad < 10))
     {
         letra="B";
     }

     if (cantidad == 10 ){
         letra="A";
     }


     return (letra);
    }

     angular.module('multiacademico.docentes').controller('CalificarCtrl', function ($scope,$uibModal,$log,$http,$state,$stateParams,Calificaciones) {
                            
                            $scope.state=$stateParams;
                          
                            $scope.qop=[
                                    {id:1,label:"PRIMER QUIMESTRE"},
                                    {id:2,label:"SEGUNDO QUIMESTRE"},
                                    {id:3,label:"ANUAL"}
                            ];
                            $scope.pop=[
                                    {id:1,label:"Primer Parcial"},
                                    {id:2,label:"Segundo Parcial"},
                                    {id:3,label:"Tercer Parcial"}//,
                                  //  {id:4,label:"Total Parciales"},
                                 //   {id:5,label:"Total Quimestre"}
                            ];
                            $scope.letras={
                                            'A':10,
                                            'B':9,
                                            'C':8,
                                            'D':6,
                                            'E':4,
                                            'F':3,
                                            '':0
                                          };   
                            
                            $scope.promedioletras=function(a,b,c){
                                var promedio=(($scope.letras[a]+$scope.letras[b]+$scope.letras[c])/3)
                                var pl=retornaletra(promedio)
                                return pl;
                            }
                            $scope.promediofinal=function(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia){
                                return Calificaciones.calcularPromedioFinal(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia)
                            };    
                            $scope.changeq=function(){
                                    $state.go($state.$current,{submited:false,q:$scope.q,p:$scope.p});
                                };
                             $scope.urlCalificacionesPrint=function(){
                                    return Routing.generate('imprimir_calificaciones',{id:$stateParams.id,q:$stateParams.q,p:$stateParams.p});
                                };
                            $scope.urlResumenCalificacionesQuimestrePrint=function(){
                                    return Routing.generate('imprimir_calificaciones',{id:$stateParams.id,q:$stateParams.q,p:4});
                                };    
                            $scope.urlResumenCalificacionesAnualPrint=function(){
                                    return Routing.generate('imprimir_calificaciones',{id:$stateParams.id,q:3,p:1});
                                };        
                            $scope.imprimirCalificaciones = function () {
                                angular.element(".printable").html(angular.element("#remoteModalCalificaciones .modal-content").html());
                             };     
                             $scope.openModal = function () {
                                var modalInstance = $uibModal.open({
                                    templateUrl: Routing.generate('imprimir_calificaciones',{id:$stateParams.id,q:$stateParams.q,p:$stateParams.p}),
                                     size: 'lg',
                                     controller: function($scope, $uibModalInstance){
                                        $scope.closeModal = function(){
                                            $uibModalInstance.close();
                                        }
                                    }
                                });
                                 modalInstance.rendered.then(function () {
                                    angular.element(".modal-dialog").addClass("noprint");
                                    angular.element(".printable").html(angular.element("#remoteModalCalificaciones").html());
                                    $log.info('Modal rendered at: ' + new Date());
                                   
                                });
                                modalInstance.result.then(function () {
                                    $log.info('Modal closed at: ' + new Date());

                                }, function () {
                                    $log.info('Modal dismissed at: ' + new Date());
                                });


                            };    
                            $scope.openModalExpanded = function (url) {
                                var modalInstance = $uibModal.open({
                                    templateUrl: url,
                                     size: 'lg',
                                     controller: function($scope, $uibModalInstance){
                                        $scope.closeModal = function(){
                                            $uibModalInstance.close();
                                        }
                                    }
                                });
                                 modalInstance.rendered.then(function () {
                                    angular.element(".modal-dialog").addClass("noprint");
                                    angular.element(".printable").html(angular.element("#remoteModalCalificaciones").html());
                                    $log.info('Modal rendered at: ' + new Date());
                                   
                                });
                                modalInstance.result.then(function () {
                                    $log.info('Modal closed at: ' + new Date());

                                }, function () {
                                    $log.info('Modal dismissed at: ' + new Date());
                                });


                            };    

                            $scope.formData={};
                            // process the form
                            $scope.processForm = function(e,formulario) {
                                e.preventDefault();
                                var dataForm;
                                dataForm =new FormData(document.getElementsByName(formulario)[0]);
                               $state.go($state.$current,{submited:true,formData:dataForm},{reload:true});
                            };
                        });





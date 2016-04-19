/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['modules/forms/module',
        'pdfmake',
        'pdfmakefonts',
        'modules/forms/html2pdf'
    ], function (module) {

    'use strict';

    module.registerController('PrintCtrl', function ($scope,$modal,$log,$http,$state,$stateParams) {
                            
                            $scope.urlPrint=function(route,object)
                            {
                                return Routing.generate(route,object);
                            };
                            $scope.openModal = function (link,vars) {
                                var modalInstance = $modal.open({
                                    templateUrl: Routing.generate(link,vars),
                                     size: 'lg',
                                     controller: function($scope, $modalInstance){
                                        $scope.closeModal = function(){
                                            $modalInstance.close();
                                        };
                                    }
                                });
                               modalInstance.rendered.then(function () {
                                    angular.element(".modal-dialog").addClass("noprint");
                                    angular.element(".printable").html(angular.element("#remoteModalContent").html());
                                    //angular.element(".printable").html(angular.element("#remoteModalContent .modal-content").html());
                                    $log.info('Modal rendered at: ' + new Date());
                                });
                                
                                modalInstance.result.then(function () {
                                    $log.info('Modal closed at: ' + new Date());

                                }, function () {
                                    $log.info('Modal dismissed at: ' + new Date());
                                });


                            }; 
                            $scope.printPDF= function (documentDefinition){
                                  pdfMake.fonts={
                                      opensans:{
                                          normal:'OpenSans-Regular.ttf'
                                      }
                                  }
                                  pdfMake.createPdf(documentDefinition).download();
                            }
                            
                            
                        });
});
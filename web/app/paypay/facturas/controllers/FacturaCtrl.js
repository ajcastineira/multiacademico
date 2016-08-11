/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
    'use strict';
    angular.module("app.paypay.facturas")
           .controller('FacturaCtrl', function ($scope,$modal,$log,$http,$state,$stateParams,$sce) {
                            
                            
                            $scope.currencySymbol="$";
                            $scope.productos=[];
                            $scope.cantidad=5;
                            $scope.unitario=2;
                            $scope.total=0;
                            $scope.prototipo = '';
                             $scope.dibujarPrototipo = function(proto,i) {
                               proto=proto.replace(/__name__/g, i);
                                 return $sce.trustAsHtml(proto);
                             };
                            $scope.factura={
                                                items:[
                                                        //{ qty: 10, cost: 9.95,producto:"2"}
                                                    ],
                                                tax:12,
                                            };
                            $scope.addItem = function() {
                               $scope.factura.items.push({ qty:0, cost:0, producto:null });
                            };
                            
                            // Remotes an item from the invoice
                              $scope.removeItem = function(item) {
                                $scope.factura.items.splice($scope.factura.items.indexOf(item), 1);
                            };
                            
                                                    // Calculates the sub total of the invoice
                          $scope.facturaSubTotal = function() {
                            var total = 0.00;
                            angular.forEach($scope.factura.items, function(item, key){
                              total += (item.qty * item.cost);
                            });
                            return total;
                          };

                          // Calculates the tax of the invoice
                          $scope.calculateTax = function() {
                            return (($scope.factura.tax * $scope.facturaSubTotal())/100);
                          };

                          // Calculates the grand total of the invoice
                          $scope.calculateGrandTotal = function() {
                            //saveInvoice();
                            return $scope.calculateTax() + $scope.facturaSubTotal();
                          };
                            
                        });





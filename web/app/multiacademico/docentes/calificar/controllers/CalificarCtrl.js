/* 
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */
define(['multiacademico/docentes/calificar/module'], function (module) {

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
                                
                            
                             
                            $scope.changeq=function(){
                                    $state.go($state.$current,{submited:false,q:$scope.q,p:$scope.p});
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




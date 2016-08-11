    "use strict";

    angular.module("app.users").controller('MeCtrl', function($scope,$log,$http,$browser,User){

            $scope.loading = false;
            
            $scope.user = User;
             $scope.processForm=function(e,formulario){
                 e.preventDefault();
                 //console.log($('.fileinput'));
                // $('.fileinput').fileinput('reset')
                 $scope.loading = true;
                 var ruta_avatar_update='secured_user_api_me_update_avatar';
                 var dataForm;
                  dataForm =new FormData(document.getElementsByName(formulario)[0]);
                    $http({
                                              method  : 'POST',
                                              async:   true,
                                              url     : Routing.generate(ruta_avatar_update),
                                              data    : dataForm,  // pass in data as strings
                                              transformRequest: angular.identity,
                                              headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                             }).then(function(response) { 
                                                  
                                                    if(response.status===202){
                                                      
                                                      var base=$browser.baseHref();
                                                      var avatarpath=response.data.path;
                                                      if(base.substr(-12)=="app_dev.php/")
                                                      {
                                                          base=base.substr(0,base.length-12);
                                                      }
                                                    
                                                      User.picture=base+avatarpath;
                                                      $('.fileinput').fileinput('clear');
                                                      //return response.data;  
                                                    }
                                                     $scope.loading=false;
                                                     
                                                  },function(response){
                                                      if(response.status===400)
                                                      {
                                                        
                                                        response.data.errores.forEach(function(e){
                                                                     alert(e);
                                                                 }
                                                                  );
                                                      }
                                                      else
                                                      {    
                                                      alert("Ocurrio Un Error Al subir la foto");
                                                       
                                                        }
                                                       $scope.loading=false;
                                                  });

                 
             }
   
    });

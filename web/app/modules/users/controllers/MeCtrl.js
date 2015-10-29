define(['modules/users/module'], function(module){
    "use strict";

    return module.registerController('MeCtrl', function($scope, $log,$http,$browser){

      
            $scope.user = {
                name: 'Rene Arias',
                avatar:''
            };
             $scope.processForm=function(e,formulario){
                 e.preventDefault();
                 //console.log($('.fileinput'));
                // $('.fileinput').fileinput('reset')
                 
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
                                                      $('#avatar').attr("src",base+avatarpath);
                                                      $('.avatar img').attr("src",base+avatarpath);
                                                      
                                                      $('.fileinput').fileinput('clear');
                                                      //return response.data;  
                                                    }
                                                    
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
                                                  });
                  //$state.go($state.$current,{submited:true,formData:dataForm},{reload:true});
                 //console.log($('#avatar'));
                 
                 
             }
       
       /* $scope.username = 'superuser';
        $scope.firstname = null;
        $scope.sex = 'not selected';
        $scope.group = "Admin";
        $scope.vacation = "25.02.2013";
        $scope.combodate = "15/05/1984";
        $scope.event = null;
        $scope.comments = 'awesome user!';
        $scope.state2 = 'California';
        $scope.fruits = 'peach<br/>apple';
        

        $scope.fruits_data = [
            {value: 'banana', text: 'banana'},
            {value: 'peach', text: 'peach'},
            {value: 'apple', text: 'apple'},
            {value: 'watermelon', text: 'watermelon'},
            {value: 'orange', text: 'orange'}]
        ;


        $scope.genders =  [
            {value: 'not selected', text: 'not selected'},
            {value: 'Male', text: 'Male'},
            {value: 'Female', text: 'Female'}
        ];

        $scope.groups =  [
            {value: 'Guest', text: 'Guest'},
            {value: 'Service', text: 'Service'},
            {value: 'Customer', text: 'Customer'},
            {value: 'Operator', text: 'Operator'},
            {value: 'Support', text: 'Support'},
            {value: 'Admin', text: 'Admin'}
        ]; */

    })

});
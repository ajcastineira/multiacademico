    "use strict";
    
    angular.module('multiacademico.docentes').factory('CalificarForm', function($http,$state)
    {
            return {
                     calificar:function(params,rutas){
                        if (params.submited===true)
                        {
                            return $http({
                                              method  : 'POST',
                                              async:   true,
                                              url     : Routing.generate(rutas.update,{'id':params.id,'q':params.q,'p':params.p}),
                                              data    : params.formData,  // pass in data as strings
                                              transformRequest: angular.identity,
                                              headers : {'Content-Type': undefined }  // set the headers so angular passing info as form data (not request payload)
                                             }).then(function(response) { 
                                                // console.log(response);
                                                    if(response.status===200){
                                                      return response.data;  
                                                    }else if(response.status===201)
                                                    {   
                                                        $state.go(rutas.state_updated,{id:response.data.id});
                                                        return "<div>se ha actualizado correctamente</div>";
                                                    }
                                                  });
                        }else{
                                        return $http.get(Routing.generate(rutas.edit,{'id':params.id,'q':params.q,'p':params.p}))
                                             .then(function(response) {
                                              return response.data;
                                               });
                                           }}               
                   };
            }
        );
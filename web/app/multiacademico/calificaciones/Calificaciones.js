/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define(['multiacademico/multiacademico'], function(module){

    "use strict";
    
    return module.registerService('Calificaciones', function()
    {
        var letras={    'A':10,
                        'B':9,
                        'C':8,
                        'D':6,
                        'E':4,
                        'F':3,
                        '':0
                      }; 
                      
        var quimestres=[
                                    {id:1,label:"PRIMER QUIMESTRE"},
                                    {id:2,label:"SEGUNDO QUIMESTRE"}//,
                                  //  {id:3,label:"ANUAL"}
                            ];
        var parciales=[
                               {id:1,label:"Primer Parcial"},
                               {id:2,label:"Segundo Parcial"},
                                {id:3,label:"Tercer Parcial"},
                                {id:4,label:"Resumen Parciales"}
                                //   {id:5,label:"Total Quimestre"}
                            ]; 
        function redondear(value, decimals) {
            //return Number(Math.round(value+'e'+decimals)+'e-'+decimals); //HALF_UP
             return ((value+'e'+decimals)%0.5 === 0) ? Number(Math.floor(value+'e'+decimals)+'e-'+decimals) : Number(Math.round(value+'e'+decimals)+'e-'+decimals); //HALF_DOWN
        };
        
        function retornasiglascualidad(cantidad){

             var letra="";
             if (cantidad  < 4 ){
                 letra="NAR";
             }

             if ((cantidad >= 4 )&&(cantidad < 7 )){
               letra="PAAR";
             }

             if ((cantidad >= 7 )&&(cantidad < 9)){
                  letra="AAR";
             }


             if ((cantidad >= 9 )&&(cantidad < 10)){
                 letra="DAR";
             }

             if (cantidad == 10 ){
                 letra="DAR";
             }


             return (letra);
         }
                    
        
        return {
                    quimestres:quimestres, 
                    parciales:parciales, 
                    getPromedioParcial:function (q,p,calificacion)
                          {
                           
                            if(typeof calificacion === 'undefined')
                             {
                                return('N/A');
                             }
                              var sum=calificacion['q'+q+'_p'+p+'_n1']+
                                      calificacion['q'+q+'_p'+p+'_n2']+
                                      calificacion['q'+q+'_p'+p+'_n3']+
                                      calificacion['q'+q+'_p'+p+'_n4']+
                                      calificacion['q'+q+'_p'+p+'_n5'];
                              
                                return redondear(sum/5,2);
                                },
                    getPromedioParciales:function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var sum=this.getPromedioParcial(q,1,calificacion)+
                                      this.getPromedioParcial(q,2,calificacion)+
                                      this.getPromedioParcial(q,3,calificacion);
                                return redondear(sum/3,2);
                                },
                    getPromedioParciales80:function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=this.getPromedioParciales(q,calificacion)*0.8;
                                return redondear(r,2);
                                },  
                    getExamen20:function (q,calificacion)
                          {
                            if(typeof calificacion === 'undefined'){return('N/A');}
                            var r=calificacion['q'+q+'_ex']*0.20
                                return redondear(r,2);
                                },
                    getPromedioQuimestre:function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=this.getPromedioParciales80(q,calificacion)+this.getExamen20(q,calificacion);
                                return redondear(r,2);
                                },              
                   getNotaCualitativa:function(nota)
                   {
                       return retornasiglascualidad(nota);
                   }
               };
            }
        );
   

});


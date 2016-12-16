/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

    "use strict";
    
    angular.module('multiacademico').service('Calificaciones', function(qualitativeScores, LETRAS,LETRAS_PROYECTOS, A_LETRAS,A_LETRAS_PROYECTOS, QUIMESTRES,PARCIALES,CALIFICACION_MINIMA,CALIFICACION_META)
    {
        var parcialesnotas={
                               1:{label:"Primera Nota Parcial"},
                               2:{label:"Segunda Nota Parcial"},
                               3:{label:"Tercera Nota Parcial"},
                               4:{label:"PROMEDIO PARCIALES"}
                                //   {id:5,label:"Total Quimestre"}
                                };                     
        function redondear(value, decimals) {
            //return Number(Math.round(value+'e'+decimals)+'e-'+decimals); //HALF_UP
             return ((value+'e'+decimals)%0.5 === 0) ? Number(Math.floor(value+'e'+decimals)+'e-'+decimals) : Number(Math.round(value+'e'+decimals)+'e-'+decimals); //HALF_DOWN
        };
        
        function alturaNota(nota){
            if (nota<CALIFICACION_MINIMA){
                   return 'baja';
               }else if(nota>=CALIFICACION_MINIMA&&nota<CALIFICACION_META){
                   return 'media';
               }else if(nota>CALIFICACION_META){
                   return 'alta';
               };
            return null;   
        }
        var filterMateriasBasicas = function (calificaciones){
            return _.filter(calificaciones,function(calificacion) {
                                                  return calificacion.calificacioncodmateria.materiatipo !== 'OFERTAINST'; 
                                                    });
        };
        var getPromedioParcial = function (q,p,calificacion)
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
                                };
        var getPromedioParciales = function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var sum=getPromedioParcial(q,1,calificacion)+
                                      getPromedioParcial(q,2,calificacion)+
                                      getPromedioParcial(q,3,calificacion);
                                return redondear(sum/3,2);
                                };
        var getPromedioTotalParcial = function (q,p,calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               for (var index in calificaciones)
                               {
                                    i++;
                                    var calificacion = calificaciones[index]; 
                                    s+=getPromedioParcial(q,p,calificacion);
                                };
                            var r=(s/i);
                                return redondear(r,2);
                           };
        var getPromedioParciales80 = function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=getPromedioParciales(q,calificacion)*0.8;
                                return redondear(r,2);
                                };
        var getExamen = function (q,calificacion)
                          {
                            if(typeof calificacion === 'undefined'){return('N/A');}
                            var r=calificacion['q'+q+'_ex'];
                                return redondear(r,2);
                            };
        var getExamen20 = function (q,calificacion)
                          {
                            if(typeof calificacion === 'undefined'){return('N/A');}
                            var r=getExamen(q,calificacion)*0.20;
                                return redondear(r,2);
                            };
        var getPromedioQuimestre=function (q,calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=getPromedioParciales80(q,calificacion)+getExamen20(q,calificacion);
                                return redondear(r,2);
                                };
        var getPromedioTotalQuimestreMateriasBasicas=function (q,calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               var calificacionesDeMateriasBasicas = filterMateriasBasicas(calificaciones);
                               var promedios=_.map(calificacionesDeMateriasBasicas,function(calificacion){
                                   return getPromedioQuimestre(q,calificacion);
                               });
                                return redondear(_.mean(promedios),2);
                           };                        
        var getPromedioTotalQuimestre=function (q,calificaciones) //total de quimestres unicamente
                          {
                               var promedios=_.map(calificaciones,function(calificacion){
                                   return getPromedioQuimestre(q,calificacion);
                               });
                                return redondear(_.mean(promedios),2);
                           };
        var getPromedioAnual=function (calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=getPromedioQuimestre(1,calificacion)+getPromedioQuimestre(2,calificacion);
                                return redondear(r/2,2);
                                };          
        var getPromedioFinal = function (calificacion)
                     {
                        if(typeof calificacion === 'undefined'){return('N/A');}
                        
                        var quimestre1=getPromedioQuimestre(1,calificacion);
                        var quimestre2=getPromedioQuimestre(2,calificacion);
                        var mejoramiento=calificacion['mejoramiento'];
                        var supletorio=calificacion['supletorio'];
                        var remedial=calificacion['remedial'];
                        var gracia=calificacion['gracia'];
                        return calcularPromedioFinal(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia);
                     };
        var calcularPromedioFinal = function(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia)
                     {
                      
                        

                        var promedio_quimestres=redondear((quimestre1+quimestre2)/2,2);
                        var quimestre_mayor=0;
                        var quimestre_menor=0;
                        var quimestre_mejorado=0;
                        if (quimestre1>quimestre2)
                        {
                            quimestre_mayor=quimestre1;
                            quimestre_menor=quimestre2;
                        }
                        else
                        {
                            quimestre_mayor=quimestre2;
                            quimestre_menor=quimestre1;
                        }

                            if (mejoramiento>quimestre_menor)
                              {
                                quimestre_mejorado=mejoramiento;
                              }
                              else
                              {
                                quimestre_mejorado=quimestre_menor;
                              }

                              var promedio_mejorado= redondear(((quimestre_mayor+quimestre_mejorado)/2),2);

                              if(promedio_quimestres>=7)
                              {
                               return promedio_mejorado;
                              }
                              else if(promedio_mejorado>=7)
                              {
                               return promedio_mejorado;
                              }
                              else if(promedio_mejorado>=4)
                              {
                                 if (supletorio>=7)
                                  {return 7;}
                                 else if (remedial>=7)
                                  {return 7;}
                                 else if (gracia>=7)
                                  {return 7;}
                                 else
                                   {return promedio_mejorado;}          

                               }
                              else if(promedio_mejorado<4)
                              {
                                if (remedial>=7)
                                   {return 7;}
                                   else if (gracia>=7)
                                  {return 7;}
                                  else
                                   {return promedio_mejorado;}
                              }
                              else
                              {
                                return promedio_mejorado;
                              }

                     };
        var apruebaMateria = function (calificacion)
         {
           if (getPromedioFinal(calificacion)>=7)
            return true;
            else 
            return false;
         };
        var getSumaFinal = function (calificaciones) //total de quimestres unicamente
              {
                   var s=0;
                   for (var index in calificaciones)
                   {
                        var calificacion = calificaciones[index]; 
                        s+=getPromedioFinal(calificacion);
                };

                    return redondear(s,2);
               };  
        var getPromedioGeneral = function (calificaciones) //total de quimestres unicamente
              {
                   var s=0,i=0;
                   for (var index in calificaciones)
                   {
                        i++;
                        var calificacion = calificaciones[index]; 
                        s+=getPromedioFinal(calificacion);
                };
                var r=(s/i);
                    return redondear(r,2);
               };   

        var apruebaAnio = function (calificaciones)
            {
                for (var index in calificaciones)
                   {

                        var calificacion = calificaciones[index]; 
                        if (!apruebaMateria(calificacion))
                        {
                            return false;
                        }
                    };

                    return true;
            };             


        var getPromedioComportamientoQuimestre=function(comportamiento,q){
                return A_LETRAS[Math.floor((LETRAS[comportamiento['agdc_q'+q+'_p1']]+
                       LETRAS[comportamiento['agdc_q'+q+'_p2']]+
                       LETRAS[comportamiento['agdc_q'+q+'_p3']])/3)];

        };
        var getPromedioProyectoEscolarQuimestre=function(proyecto,q){
                return A_LETRAS_PROYECTOS[Math.floor((LETRAS_PROYECTOS[proyecto['nota_q'+q+'_p1']]+
                       LETRAS_PROYECTOS[proyecto['nota_q'+q+'_p2']]+
                       LETRAS_PROYECTOS[proyecto['nota_q'+q+'_p3']])/3)];
        };
        
        return {
                    quimestres: QUIMESTRES,
                    parciales: PARCIALES,
                    parcialesnotas: parcialesnotas,
                    redondear: redondear,
                    findCalificacionOnAlumno : function(alumno, idmateria){
                                return _.find(alumno.calificaciones, {'calificacioncodmateria':{'id':idmateria}});
                            },
                    getPromedioParcial:getPromedioParcial,
                    getPromedioParciales:getPromedioParciales,
                    getPromedioTotalParcial:getPromedioTotalParcial,
                    getPromedioTotalQuimestre:getPromedioTotalQuimestre,       
                    getPromedioTotalQuimestreMateriasBasicas:getPromedioTotalQuimestreMateriasBasicas,
                    getPromedioParciales80:getPromedioParciales80,  
                    getExamen:getExamen,
                    getExamen20:getExamen20,
                    getPromedioQuimestre:getPromedioQuimestre,
                    getPromedioAnual:getPromedioAnual,            
                    getPromedioFinal:getPromedioFinal,
                    calcularPromedioFinal:calcularPromedioFinal,
                    apruebaMateria:apruebaMateria,
                    getSumaFinal:getSumaFinal,  
                    getPromedioGeneral:getPromedioGeneral,    
                    apruebaAnio:apruebaAnio,
                    getAlturaNota: alturaNota,
                    getNotaCualitativa: qualitativeScores.getNotaCualitativa,
                    getCualitativa: qualitativeScores.getCualitativa,
                    getPromedioComportamientoQuimestre:getPromedioComportamientoQuimestre,
                    getPromedioProyectoEscolarQuimestre:getPromedioProyectoEscolarQuimestre
                    
               };
            }
        );
   




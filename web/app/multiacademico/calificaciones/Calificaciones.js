/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

    "use strict";
    
    angular.module('multiacademico').service('Calificaciones', function(qualitativeScores, LETRAS,QUIMESTRES,PARCIALES,CALIFICACION_MINIMA,CALIFICACION_META)
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
        
        return {
                    quimestres:QUIMESTRES,
                    parciales:PARCIALES,
                    parcialesnotas:parcialesnotas,
                    findOnCalificacionesByMateriaId : function(id){
                                return function(calificacion){
                                  return calificacion.calificacioncodmateria.id === id;
                                };
                            },
                    findCalificacionOnAlumno : function(alumno, idmateria){
                                return alumno.calificaciones.filter(this.findOnCalificacionesByMateriaId(idmateria))[0];
                            },
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
                    getPromedioTotalParcial:function (q,p,calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               for (var index in calificaciones)
                               {
                                    i++;
                                    var calificacion = calificaciones[index]; 
                                    s+=this.getPromedioParcial(q,p,calificacion);
                                };
                            var r=(s/i);
                                return redondear(r,2);
                           },
                    getPromedioTotalQuimestre:function (q,calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               for (var index in calificaciones)
                               {
                                    i++;
                                    var calificacion = calificaciones[index]; 
                                    s+=this.getPromedioQuimestre(q,calificacion);
                                };
                            var r=(s/i);
                                return redondear(r,2);
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
                    getPromedioTotalQuimestre:function (q,calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               for (var index in calificaciones)
                               {
                                    i++;
                                    var calificacion = calificaciones[index]; 
                                    s+=this.getPromedioQuimestre(q,calificacion);
                            };
                            var r=(s/i);
                                return redondear(r,2);
                           },            
                    getPromedioAnual:function (calificacion)
                          {
                             if(typeof calificacion === 'undefined'){return('N/A');}
                              var r=this.getPromedioQuimestre(1,calificacion)+this.getPromedioQuimestre(2,calificacion)
                                return redondear(r/2,2);
                                },            
                     getPromedioFinal:function (calificacion)
                     {
                        if(typeof calificacion === 'undefined'){return('N/A');}
                        
                        var quimestre1=this.getPromedioQuimestre(1,calificacion);
                        var quimestre2=this.getPromedioQuimestre(2,calificacion);
                        var mejoramiento=calificacion['mejoramiento'];
                        var supletorio=calificacion['supletorio'];
                        var remedial=calificacion['remedial'];
                        var gracia=calificacion['gracia'];
                        return this.calcularPromedioFinal(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia)
                     },
                     calcularPromedioFinal: function(quimestre1,quimestre2,mejoramiento,supletorio,remedial,gracia)
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

                     },
                     apruebaMateria:function (calificacion)
                     {
                       if (this.getPromedioFinal(calificacion)>=7)
                        return true;
                        else 
                        return false;
                     },
                     getSumaFinal:function (calificaciones) //total de quimestres unicamente
                          {
                               var s=0;
                               for (var index in calificaciones)
                               {
                                    var calificacion = calificaciones[index]; 
                                    s+=this.getPromedioFinal(calificacion);
                            };
                            
                                return redondear(s,2)
                           },  
                    getPromedioGeneral:function (calificaciones) //total de quimestres unicamente
                          {
                               var s=0,i=0;
                               for (var index in calificaciones)
                               {
                                    i++;
                                    var calificacion = calificaciones[index]; 
                                    s+=this.getPromedioFinal(calificacion);
                            };
                            var r=(s/i);
                                return redondear(r,2);
                           },    
                    
                    apruebaAnio:function (calificaciones)
                        {
                            for (var index in calificaciones)
                               {
                                    
                                    var calificacion = calificaciones[index]; 
                                    if (!this.apruebaMateria(calificacion))
                                    {
                                        return false;
                                    }
                                };
                            
                                return true;
                        },
                    getAlturaNota: alturaNota,
                    getNotaCualitativa: qualitativeScores.getNotaCualitativa,
                    getCualitativa: qualitativeScores.getCualitativa
                    
               };
            }
        );
   




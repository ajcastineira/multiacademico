define(["multiacademico/multiacademico"],function(a){"use strict";return a.registerService("Calificaciones",function(){function a(a,b){return(a+"e"+b)%.5===0?Number(Math.floor(a+"e"+b)+"e-"+b):Number(Math.round(a+"e"+b)+"e-"+b)}function b(a){var b="";return 4>a&&(b="NAR"),a>=4&&7>a&&(b="PAAR"),a>=7&&9>a&&(b="AAR"),a>=9&&10>a&&(b="DAR"),10==a&&(b="DAR"),b}function c(a){var b="";return 4>a&&(b="No alcanza los aprendizajes requeridos"),a>=4&&7>a&&(b="Esta proximo a alcanzar los aprendizajes requeridos"),a>=7&&9>a&&(b="Alcanza los aprendizajes requeridos"),a>=9&&10>a&&(b="Domina los aprendizajes requeridos"),10==a&&(b="Domina los aprendizajes requeridos"),b}var d=[{id:1,label:"PRIMER QUIMESTRE"},{id:2,label:"SEGUNDO QUIMESTRE"},{id:3,label:"ANUAL"}],e=[{id:1,label:"Primer Parcial",labelabrv:"1er Parcial"},{id:2,label:"Segundo Parcial",labelabrv:"2do Parcial"},{id:3,label:"Tercer Parcial",labelabrv:"3er Parcial"},{id:4,label:"Resumen Parciales",labelabrv:"Total Parciales"}],f={1:{label:"Primera Nota Parcial"},2:{label:"Segunda Nota Parcial"},3:{label:"Tercera Nota Parcial"},4:{label:"PROMEDIO PARCIALES"}};return{quimestres:d,parciales:e,parcialesnotas:f,getPromedioParcial:function(b,c,d){if("undefined"==typeof d)return"N/A";var e=d["q"+b+"_p"+c+"_n1"]+d["q"+b+"_p"+c+"_n2"]+d["q"+b+"_p"+c+"_n3"]+d["q"+b+"_p"+c+"_n4"]+d["q"+b+"_p"+c+"_n5"];return a(e/5,2)},getPromedioParciales:function(b,c){if("undefined"==typeof c)return"N/A";var d=this.getPromedioParcial(b,1,c)+this.getPromedioParcial(b,2,c)+this.getPromedioParcial(b,3,c);return a(d/3,2)},getPromedioParciales80:function(b,c){if("undefined"==typeof c)return"N/A";var d=.8*this.getPromedioParciales(b,c);return a(d,2)},getExamen20:function(b,c){if("undefined"==typeof c)return"N/A";var d=.2*c["q"+b+"_ex"];return a(d,2)},getPromedioQuimestre:function(b,c){if("undefined"==typeof c)return"N/A";var d=this.getPromedioParciales80(b,c)+this.getExamen20(b,c);return a(d,2)},getPromedioTotalQuimestre:function(b,c){var d=0,e=0;for(var f in c){e++;var g=c[f];d+=this.getPromedioQuimestre(b,g)}var h=d/e;return a(h,2)},getPromedioAnual:function(b){if("undefined"==typeof b)return"N/A";var c=this.getPromedioQuimestre(1,b)+this.getPromedioQuimestre(2,b);return a(c/2,2)},getPromedioFinal:function(b){var c=this.getPromedioQuimestre(1,b),d=this.getPromedioQuimestre(2,b),e=this.getPromedioAnual(b),f=0,g=0,h=0;c>d?(f=c,g=d):(f=d,g=c),h=g<b.mejoramiento?b.mejoramiento:g;var i=a((f+h)/2,2);return e>=7?e:i>=7?i:i>=4?b.supletorio>=7?7:b.remedial>=7?7:b.gracia>=7?7:i:4>i?b.remedial>=7?7:b.gracia>=7?7:i:i},apruebaMateria:function(a){return this.getPromedioFinal(a)>=7?!0:!1},getSumaFinal:function(b){var c=0;for(var d in b){var e=b[d];c+=this.getPromedioFinal(e)}return a(c,2)},getPromedioGeneral:function(b){var c=0,d=0;for(var e in b){d++;var f=b[e];c+=this.getPromedioFinal(f)}var g=c/d;return a(g,2)},apruebaAnio:function(a){for(var b in a){var c=a[b];if(!this.apruebaMateria(c))return!1}return!0},getNotaCualitativa:function(a){return b(a)},getCualitativa:function(a){return c(a)}}})});
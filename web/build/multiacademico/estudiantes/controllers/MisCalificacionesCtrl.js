define(["multiacademico/informes/module","multiacademico/calificaciones/Calificaciones","multiacademico/calificaciones/EnLetras"],function(a){"use strict";a.registerController("MisCalificacionesCtrl",["$scope","$state","$stateParams","estudiante","Calificaciones","EnLetras",function(a,b,c,d,e,f){a.estudiante=d,a.qop=e.quimestres,a.pop=e.parciales,a.parnot=e.parcialesnotas,a.q=c.q,a.p=c.p,a.encabezado={titulo:function(){return a.p<=3?"Informe Parcial de Aprendizaje":4==a.p?"Informe Quimestral de Aprendizaje":void 0},colspan:function(){return a.p<=3?2:4==a.p?4:7}},a.Calificaciones=e,a.Materias={},a.prparcial=function(b,c,d){return"undefined"==typeof b&&(b=a.q),"undefined"==typeof c&&(c=a.p),e.getPromedioParcial(b,c,d)},a.prtp=function(b,c,d){return"undefined"==typeof b&&(b=a.q),"undefined"==typeof c&&(c=a.p),e.getPromedioTotalParcial(b,c,d)},a.prparciales=function(b,c){return"undefined"==typeof b&&(b=a.q),e.getPromedioParciales(b,c)},a.prparciales80=function(b,c){return"undefined"==typeof b&&(b=a.q),e.getPromedioParciales80(b,c)},a.ex20=function(b,c){return"undefined"==typeof b&&(b=a.q),e.getExamen20(b,c)},a.prq=function(b,c){return"undefined"==typeof b&&(b=a.q),e.getPromedioQuimestre(b,c)},a.prtq=function(b,c){return"undefined"==typeof b&&(b=a.q),e.getPromedioTotalQuimestre(b,c)},a.cualitativa=function(a){return e.getCualitativa(a)},a.cualitativasiglas=function(a){return e.getNotaCualitativa(a)},a.notaEnLetras=function(a){return f.EnLetras.ValorEnLetras(a)},a.changeq=function(){}}])});
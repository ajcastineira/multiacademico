define(["multiacademico/reportes/malla/module","multiacademico/calificaciones/Calificaciones"],function(a){"use strict";a.registerController("MallaCtrl",["$scope","$state","$stateParams","aula","Calificaciones",function(a,b,c,d,e){a.aula=d,a.qop=e.quimestres,a.pop=e.parciales,a.q=c.q,a.p=c.p,a.encabezado={titulo:"CUADRO DE CALIFICACIONES DEL PARCIAL"+a.p,materiacolspan:function(){return a.p<=3?7:4==a.p?8:7}},a.Calificaciones=e,a.Materias={},a.prparcial=function(b,c,d,f){"undefined"==typeof d&&(d=a.q),"undefined"==typeof f&&(f=a.p);var g=a.aula.matriculados[b].calificaciones[c];return e.getPromedioParcial(d,f,g)},a.prparciales=function(b,c,d){"undefined"==typeof d&&(d=a.q);var f=a.aula.matriculados[b].calificaciones[c];return e.getPromedioParciales(d,f)},a.prparciales80=function(b,c,d){"undefined"==typeof d&&(d=a.q);var f=a.aula.matriculados[b].calificaciones[c];return e.getPromedioParciales80(d,f)},a.ex20=function(b,c,d){"undefined"==typeof d&&(d=a.q);var f=a.aula.matriculados[b].calificaciones[c];return e.getExamen20(d,f)},a.prq=function(b,c,d){"undefined"==typeof d&&(d=a.q);var f=a.aula.matriculados[b].calificaciones[c];return e.getPromedioQuimestre(d,f)},a.cualitativa=function(a){return e.getNotaCualitativa(a)},a.changeq=function(){a.p<=3&&(a.encabezado.titulo="CUADRO DE CALIFICACIONES DEL PARCIAL "+a.p),4==a.p&&(a.encabezado.titulo="CUADRO DE CALIFICACIONES DEL QUIMESTRE "+a.q)}}])});
define(["multiacademico/proyectosescolares/module","jquery"],function(a){"use strict";function b(a){var b=$('<td><a class="btn btn-danger btn-xs" href="#"><i class="fa fa-times"></i> Quitar Estudiante</a></td>');a.append(b),b.on("click",function(b){b.preventDefault(),a.remove()})}function c(a,c){var d=a.data("prototype"),e=a.data("index"),f=d.replace(/__name__/g,e);a.data("index",e+1);var g=$("<tr></tr>").append("<td>"+f+"</td>");b(g),c.before(g)}a.registerDirective("collectionForm",["$state",function(a){return{restrict:"A",link:function(a,d,e){var f,g=$('<td><a class="btn btn-success btn-xs"  href="#" class="add_tag_link"><i class="fa fa-plus"></i>Agregar Estudiante</a></td>'),h=$("<tr></tr>").append(g);f=d,f.find("tbody tr").each(function(){b($(this))}),f.append(h),f.data("index",f.find(":input").length),g.on("click",function(a){a.preventDefault(),c(f,h)})}}}])});
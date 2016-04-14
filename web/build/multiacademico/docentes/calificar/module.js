define(["angular","angular-couch-potato","angular-ui-router"],function(a,b){"use strict";var c=a.module("multiacademico.docentes.midistributivo",["ui.router"]);return b.configureApp(c),c.config(["$stateProvider","$couchPotatoProvider","$urlRouterProvider",function(a,b,c){var d={edit:"calificaciones_api",update:"calificaciones_api",state_created:"multiacademico.docentes.midistributivo.menu.calificaciones",state_updated:"multiacademico.docentes.midistributivo.menu.calificaciones"};a.state("multiacademico.docentes.midistributivo",{url:"/midistributivo",data:{pageTitle:"Calificar",pageHeader:{icon:"flaticon-a1",title:"Calificar",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:Routing.generate("midistributivo_api"),resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.menu",{url:"/menu/{id:[0-9]{1,11}}",data:{pageTitle:"Calificar",pageHeader:{icon:"flaticon-teach",title:"Calificar",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_calificar_api",{id:a.id})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.menu.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones",pageHeader:{icon:"flaticon-teach",title:"Calificaciones",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){return b.calificar(a,d)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.proyectos",{url:"/proyectos/{id:[0-9]{1,11}}",data:{pageTitle:"Calificar Proyecto Escolar",pageHeader:{icon:"flaticon-teach",title:"Proyectos Escolares",subtitle:"Distributivo"},breadcrumbs:[{title:"Calificar Proyecto"},{title:"lista"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_proyectos_escolares_api",{id:a.id})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.proyectos.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones Proyecto Escolar",pageHeader:{icon:"flaticon-teach",title:"Calificaciones Proyecto Escolar",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones Proyecto Escolar"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){var c={edit:"calificaciones_proyecto_api",update:"calificaciones_proyecto_api",state_created:"multiacademico.docentes.midistributivo.proyectos.calificaciones",state_updated:"multiacademico.docentes.midistributivo.proyectos.calificaciones"};return b.calificar(a,c)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.tutor",{url:"/tutor/{curso}/{especializacion}/{paralelo}/{seccion}/{periodo}",data:{pageTitle:"Menu Tutor",pageHeader:{icon:"flaticon-teach",title:"Tutor",subtitle:"Menu"},breadcrumbs:[{title:"Tutor"},{title:"menu"}]},views:{"content@multiacademico":{templateUrl:function(a){return Routing.generate("menu_tutor_api",{curso:a.curso,especializacion:a.especializacion,paralelo:a.paralelo,seccion:a.seccion,periodo:a.periodo})},resolve:{deps:b.resolveDependencies(["modules/tables/directives/datatables/datatableBasic"])}}}}).state("multiacademico.docentes.midistributivo.tutor.calificaciones",{url:"/calificaciones/:q/:p",params:{submited:!1,formData:null},data:{pageTitle:"Calificaciones Proyecto Escolar",pageHeader:{icon:"flaticon-teach",title:"Calificaciones Proyecto Escolar",subtitle:"Curso"},breadcrumbs:[{title:"Calificaciones Proyecto Escolar"},{title:"calificar"}]},views:{"content@multiacademico":{templateProvider:["$stateParams","CalificarForm",function(a,b){var c={edit:"calificaciones_proyecto_api",update:"calificaciones_proyecto_api",state_created:"multiacademico.docentes.midistributivo.proyectos.calificaciones",state_updated:"multiacademico.docentes.midistributivo.proyectos.calificaciones"};return b.calificar(a,c)}],controller:"CalificarCtrl",resolve:{deps:b.resolveDependencies(["multiacademico/docentes/calificar/controllers/CalificarCtrl","modules/tables/directives/datatables/datatableBasic"])}}}})}]),c.run(["$couchPotato",function(a){c.lazy=a}]),c});
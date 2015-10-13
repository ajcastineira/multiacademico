/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define([
    'angular',
    'angular-couch-potato',
    'angular-ui-router'
], function (ng, couchPotato) {

    "use strict";

    var module = ng.module('multiacademico', ['ui.router']);

    couchPotato.configureApp(module);

    module.config(function ($stateProvider, $couchPotatoProvider)
    {
        $stateProvider
    

             .state ('multiacademico', {abstract:true,template:'<div data-ui-view="content" />'})



              .state('matriculas', {
                    url: '/matriculas',
                    templateUrl: 'views/matriculas.html',
                    data: {
                        pageTitle: 'matriculas',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'matriculas',
                            subtitle: 'matriculas and more'
                        },
                        breadcrumbs: [
                            {title: 'matriculas'},{title: 'matriculas'}
                        ]
                    }
                })



              .state('calificaciones', {
                    url: '/calificaciones',
                    templateUrl: 'views/calificaciones.html',
                    data: {
                        pageTitle: 'calificaciones',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget calificaciones'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
               })



              .state('malla-normal', {
                    url: '/malla-normal',
                    templateUrl: 'views/multiacademico/malla/malla-normal.html',
                    data: {
                        pageTitle: 'malla-normal',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Malla Normal',
                            subtitle: 'malla-normal and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'malla-normal'}
                        ]
                    }
                })


              .state('cuadro-de-calificaciones', {
                    url: '/cuadro-de-calificaciones',
                    templateUrl: 'views/multiacademico/malla/cuadro-de-calificaciones.html',
                    data: {
                        pageTitle: 'cuadro-de-calificaciones',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget cuadro-de-calificaciones'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('comportamiento', {
                    url: '/comportamiento',
                    templateUrl: 'views/comportamiento.html',

                    data: {
                        pageTitle: 'comportamiento',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget comportamiento'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('quimestre', {
                    url: '/quimestre',
                    templateUrl: 'views/quimestre.html',
                    data: {
                        pageTitle: 'quimestre',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'quimestre',
                            subtitle: 'quimestre and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'quimestre'}
                        ]
                    }
                })



              .state('quimestre2', {
                    url: '/quimestre2',
                    templateUrl: 'views/quimestre2.html',
                    data: {
                        pageTitle: 'quimestre2',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'quimestre2',
                            subtitle: 'quimestre2 and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'quimestre2'}
                        ]
                    }
                })



              .state('dos-quimestre', {
                    url: '/dos-quimestre',
                    templateUrl: 'views/dos-quimestre.html',
                    data: {
                        pageTitle: 'dos-quimestre',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget dos-quimestre'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
             })



              .state('cursos', {
                    url: '/cursos',
                    templateUrl: 'views/cursos.html',
                    data: {
                        pageTitle: 'cursos',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'cursos',
                            subtitle: 'cursos and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'cursos'}
                        ]
                    }
                })



              .state('especialidades', {
                    url: '/especialidades',
                    templateUrl: 'views/especialidades.html',
                    data: {
                        pageTitle: 'especialidades',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget especialidades' 
                        },

                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('materias', {
                    url: '/materias',
                    templateUrl: 'views/materias.html',
                    data: {
                        pageTitle: 'materias',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'materias',
                            subtitle: 'materias and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'materias'}
                        ]
                    }
                })



              .state('docentes', {
                    url: '/docentes',
                    templateUrl: 'views/docentes.html',
                    data: {
                        pageTitle: 'docentes',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'docentes',
                            subtitle: 'docentes and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'docentes'}
                        ]
                    }
                })



              .state('distributivos', {
                    url: '/distributivos',
                    templateUrl: 'views/distributivos.html',
                    data: {
                        pageTitle: 'distributivos',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget distributivos'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('clubes', {
                    url: '/clubes',
                    templateUrl: 'views/clubes.html',
                    data: {
                        pageTitle: 'clubes',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'clubes',
                            subtitle: 'clubes and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'clubes'}
                        ]
                    }
                })



              .state('ínformesortalf', {
                    url: '/ínformesortalf',
                    templateUrl: 'views/ínformesortalf.html',
                    data: {
                        pageTitle: 'ínformesortalf',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget ínformesortalf'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



    /* */
              .state('informesortnum', {
                    url: '/informesortnum',
                    templateUrl: 'views/informesortnum.html',
                    data: {
                        pageTitle: 'informesortnum',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget informesortnum'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('reportesortcourse', {
                    url: '/reportesortcourse',
                    templateUrl: 'views/reportesortcourse.html',
                    data: {
                        pageTitle: 'reportesortcourse',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget reportesortcourse'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('reportesorterror', {
                    url: '/reportesorterror',
                    templateUrl: 'views/reportesorterror.html',
                    data: {
                        pageTitle: 'reportesorterror',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget reportesorterror'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('reportelibro', {
                    url: '/reportelibro',
                    templateUrl: 'views/reportelibro.html',
                    data: {
                        pageTitle: 'reportelibro',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'reportelibro',
                            subtitle: 'reportelibro and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'reportelibro'}
                        ]
                    }
                })



              .state('reportedocente', {
                    url: '/reportedocente',
                    templateUrl: 'views/reportedocente.html',
                    data: {
                        pageTitle: 'reportedocente',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget reportedocente'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('reportedocenteclave', {
                    url: '/reportedocenteclave',
                    templateUrl: 'views/reportedocenteclave.html',
                    data: {
                        pageTitle: 'reportedocenteclave',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget reportedocenteclave'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('certificadomatricula', {
                    url: '/certificadomatricula',
                    templateUrl: 'views/certificadomatricula.html',
                    data: {
                        pageTitle: 'certificadomatricula',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget certificadomatricula'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('certificadomatriculacurso', {
                    url: '/certificadomatriculacurso',
                    templateUrl: 'views/certificadomatriculacurso.html',
                    data: {
                        pageTitle: 'certificadomatriculacurso',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget certificadomatriculacurso'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('certificadopromocion', {
                    url: '/certificadopromocion',
                    templateUrl: 'views/certificadopromocion.html',
                    data: {
                        pageTitle: 'certificadopromocion',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget certificadopromocion'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('certificadopromocioncurso', {
                    url: '/certificadopromocioncurso',
                    templateUrl: 'views/certificadopromocioncurso.html',
                    data: {
                        pageTitle: 'certificadopromocioncurso',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget certificadopromocioncurso'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('periodo1', {
                    url: '/periodo1',
                    templateUrl: 'views/periodo1.html',
                    data: {
                        pageTitle: 'periodo1',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'periodo1',
                            subtitle: 'periodo1 and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'periodo1'}
                        ]
                    }
                })



              .state('periodo2', {
                    url: '/periodo2',
                    templateUrl: 'views/periodo2.html',
                    data: {
                        pageTitle: 'periodo2',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'periodo2',
                            subtitle: 'periodo2 and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'periodo2'}
                        ]
                    }
                })



              .state('unidadeducativa', {
                    url: '/unidadeducativa',
                    templateUrl: 'views/unidadeducativa.html',
                    data: {
                        pageTitle: 'unidadeducativa',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'Blog Widget',
                            subtitle: 'blog widget unidadeducativa'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'Blog'}
                        ]
                    }
                })



              .state('menus', {
                    url: '/menus',
                    templateUrl: 'views/menus.html',
                    data: {
                        pageTitle: 'menus',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'menus',
                            subtitle: 'menus and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'menus'}
                        ]
                    }
                })



              .state('modulos', {
                    url: '/modulos',
                    templateUrl: 'views/modulos.html',
                    data: {
                        pageTitle: 'modulos',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'modulos',
                            subtitle: 'modulos and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'modulos'}
                        ]
                    }
                })



              .state('permisos', {
                    url: '/permisos',
                    templateUrl: 'views/permisos.html',
                    data: {
                        pageTitle: 'permisos',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'permisos',
                            subtitle: 'permisos and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'permisos'}
                        ]
                    }
                })



              .state('usuarios', {
                    url: '/usuarios',
                    templateUrl: 'views/usuarios.html',
                    data: {
                        pageTitle: 'usuarios',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'usuarios',
                            subtitle: 'usuarios and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'usuarios'}
                        ]
                    }

                })



              .state('ayuda', {
                    url: '/ayuda',
                    templateUrl: 'views/ayuda.html',
                    data: {
                        pageTitle: 'ayuda',
                        pageHeader: {
                            icon: 'fa fa-pencil',
                            title: 'ayuda',
                            subtitle: 'ayuda and more'
                        },
                        breadcrumbs: [
                            {title: 'Widget'},{title: 'ayuda'}
                        ]
                    }
                })

    });

    module.run(function($couchPotato){
        module.lazy = $couchPotato;
    });
    return module;
});

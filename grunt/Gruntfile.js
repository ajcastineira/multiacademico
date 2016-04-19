var requirejsCompileSkip = require('./tasks/requirejs-compile-skip.json');

var pkg = require('./package.json');

var pub = pkg.smartadmin.public;
var plg = pkg.smartadmin.plugin;
var tmp = pkg.smartadmin.temp;
var bld = pkg.smartadmin.build;
var fnt = pkg.smartadmin.fonts;

module.exports = function (grunt) {


    // Project configuration.
    grunt.initConfig({
        dump_dir: {
            options: {
              rootPath: fnt,
              pre:'window.pdfMake = window.pdfMake || {}; window.pdfMake.vfs = '
            },
            'files':{
                         src:  [fnt+'OpenSans-Regular.ttf' ],
                         dest: plg + 'pdfmake/build/vfs_fonts.js'
                    }
                },
        turnOffPotatoDeclaration: {
            tmp: {
                expand: true,
                src: [
                    tmp + '*/**/*.js',
                    tmp + 'app.js'
                ]
            }
        },
        ngAnnotate: {
            tmp: {
                expand: true,
                src: [
                    tmp + '*/**/*.js',
                    tmp + 'app.js'
                ],
                ext: '.js', // Dest filepaths will have this extension.
                extDot: 'last'
            }
        },
        turnOnPotatoDeclaration: {
            tmp: {
                expand: true,
                src: [
                    tmp + '*/**/*.js',
                    tmp + 'app.js'
                ]
            }
        },
        adjustTemplateUrls: {
            tmp: {
                options: {
                    from: 'app',
                    to: 'build'
                },
                expand: true,
                src: [
                    tmp + '*/**/*.*',
                    tmp + 'app.js'
                ]
            }
        },
        html2js: {
            options: {
                base: tmp,
                module: 'smart-templates',
                singleModule: true,
                rename: function (moduleName) {
                    return 'build/' + moduleName;
                }
            },
            main: {
                src: [tmp + '**/*.tpl.html'],
                dest: tmp + 'smart-templates.js'
            }
        },
        addIncludes:{
            options:{
                appFile: tmp + 'app.js',
                includesFile: tmp + 'includes.js'
            },
            templates:{
                options:{
                    angularModule: true,
                    wrapToDefine: true,
                    name: 'smart-templates',
                    injectToApp: true
                },
                src: [
                    tmp + 'smart-templates.js'
                ]

            }

        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
                
              },
            target: {
                    files: [{
                      expand: true,
                      cwd: tmp+'styles',
                      src: ['**/*.css','!**/*.theme.css', '!*.min.css'],
                      dest: tmp+'styles',
                      ext: '.css'
                    },
                    {
                      expand: true,
                      cwd: tmp+'styles',
                      src: ['**/*.theme.css'],
                      dest: tmp+'styles',
                      ext: '.theme.css'
                    }
                    ]
                  }
            },
        uglify: {
            tmp: {
                expand: true,
                cwd: tmp,
                src: [
                    '**/*.js'
                ],
                dest: tmp,
                ext: '.js'
            }
        },
        
        clean: {
            pre: {
                options: {
                    force: true
                },
                src: [
                    bld,
                    tmp
                ]
            },
            post: {
                options: {
                    force: true
                },
                src: [
                    tmp
                ]
            }
        },
        copy: {
            pre: {
                expand: true,
                cwd: pub + 'app/',
                src: [
                    '**'
                ],
                dest: tmp
            },
            post: {
                expand: true,
                cwd: tmp,
                src: [
                    '*/**',
                    'rconfig.js',
                    '!**/*.tpl.html'
                ],
                dest: bld
            }
        },
        requirejs: {
            compile: {
                options: {
                    baseUrl: tmp,
                    paths: requirejsCompileSkip,
                    mainConfigFile: tmp + 'rconfig.js',
                    name: "main",
                    optimize: 'none',
                    uglify2: {
                        mangle: false
                    },
                    out: bld + 'main.js',
                    done: function (done, output) {
                        console.log('done requirejs');
                        done();
                    }
                }
            }
        }
    });
    
    grunt.loadNpmTasks('grunt-dump-dir');

    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.loadNpmTasks('grunt-contrib-copy');

    grunt.loadNpmTasks('grunt-ng-annotate');

    grunt.loadNpmTasks('grunt-contrib-uglify');

    grunt.loadNpmTasks('grunt-contrib-requirejs');
    
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    
    grunt.loadNpmTasks('grunt-html2js');
    
    grunt.loadTasks('tasks');


    grunt.registerTask('default', [
        'clean:pre',
        'copy:pre',
        'turnOffPotatoDeclaration',
        'ngAnnotate:tmp',
        'turnOnPotatoDeclaration',
        'adjustTemplateUrls',
        'html2js',
      
        'addIncludes',
        'uglify',
        'cssmin',
        'requirejs',
        
        'copy:post',
        
        'clean:post'
    ]);

    grunt.registerTask('vtp', [
        'vendor-to-plugin',
        'default'
    ]);



};
'use strict';

module.exports = function (grunt) {
    /**
     * JIT
     */
    const sass = require('node-sass');

    require('jit-grunt')(grunt, {
        cmq: 'grunt-combine-media-queries'
    });

    grunt.loadNpmTasks('grunt-file-hash');

    /**
     * Project config
     */
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        project: {
            app: 'content/themes/ivn-base-theme',
            assets: '<%= project.app %>/assets',
            css: [
                '<%= project.assets %>/css/source/style.scss'
            ],
            js: [
                '<%= project.assets %>/js/source/main.js'
            ],
            js_admin: [
                '<%= project.assets %>/js/source/admin.js'
            ]
        },

        tag: {
            banner: '/*! <%= pkg.title %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' */\n'
        },

        express: {
            all: {
                options: {
                    port: 9000,
                    hostname: "0.0.0.0",
                    bases: ['./src'],
                    livereload: true
                }
            }
        },

        watch: {
            all: {
                files: [
                    '<%= project.app %>/{,*/}*.html',
                    '<%= project.assets %>/css/*.css',
                    '<%= project.assets %>/js/{,*/}*.js',
                    '<%= project.assets %>/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ],
                options: {
                    livereload: true,
                    spawn: false
                }
            },
            styles: {
                files: '<%= project.assets %>/css/source/{,*/}*.scss',
                tasks: ['ivn:styles:dev']
            },
            scripts: {
                files: '<%= project.assets %>/js/source/{,*/}*.js',
                tasks: ['ivn:scripts:dev']
            }
        },

        open: {
            all: {
                path: 'http://localhost:<%= express.all.options.port%>'
            }
        },

        clean: {
            all: ['<%= project.assets %>/css/*.css', '<%= project.assets %>/css/routes/*.css', '<%= project.assets %>/js/*.js', '<%= project.assets %>/js/routes/*.js', '<%= project.assets %>/js/vendor/*.js']
        },

        sass: {
            options: {
                implementation: sass,
                banner: '<%= tag.banner %>'
            },
            dev: {
                files: [
                    {
                        '<%= project.assets %>/css/style.css': '<%= project.css %>'
                    },
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/css/source/routes',
                        src: ['*.scss'],
                        dest: '<%= project.assets %>/css/routes',
                        ext: '.css'
                    }
                ]
            },
            build: {
                files: [
                    {
                        '<%= project.assets %>/css/style.unprefixed.css': '<%= project.css %>'
                    },
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/css/source/routes',
                        src: ['*.scss'],
                        dest: '<%= project.assets %>/css/routes',
                        ext: '.css'
                    }
                ]
            }
        },

        cmq: {
            options: {
                log: false
            },
            build: {
                files: [
                    {
                        '<%= project.assets %>/css/style.unprefixed.css': '<%= project.assets %>/css/style.unprefixed.css'
                    },
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/css/routes',
                        src: ['*.css'],
                        dest: '<%= project.assets %>/css/routes',
                        ext: '.css'
                    }
                ]
            }
        },

        postcss: {
            stylesGlobal: {
                options: {
                    map: false,
                    processors: [
                        require('autoprefixer')({
                            browsers: ['> 5%', 'last 8 versions', 'ie >= 8']
                        }),
                        require('postcss-urlrev')({
                            replacer: function (url, hash) {
                                return url + '?ver=' + hash;
                            }
                        })
                    ]
                },
                src: '<%= project.assets %>/css/style.unprefixed.css',
                dest: '<%= project.assets %>/css/style.css'
            },
            stylesSpecific: {
                options: {
                    map: false,
                    processors: [
                        require('autoprefixer')({
                            browsers: ['> 5%', 'last 8 versions', 'ie >= 8']
                        }),
                        require('postcss-urlrev')({
                            replacer: function (url, hash) {
                                return url + '?ver=' + hash;
                            }
                        })
                    ]
                },
                src: '<%= project.assets %>/css/routes/*.css',
            }
        },

        cssmin: {
            options: {
                advanced: false,
                aggressiveMerging: true,
                mediaMerging: true,
                shorthandCompacting: false,
                roundingPrecision: -1,
                rebase: false
            },
            build: {
                files: [
                    {
                        '<%= project.assets %>/css/style.css': '<%= project.assets %>/css/style.css'
                    },
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/css/routes',
                        src: ['*.css'],
                        dest: '<%= project.assets %>/css/routes',
                        ext: '.css'
                    }
                ],
            }
        },

        jshint: {
            files: ['<%= project.js %>', '<%= project.js_admin %>', '<%= project.assets %>/js/source/routes/*.js'],
            options: {
                jshintrc: '.jshintrc',
                reporterOutput: ''
            }
        },

        concat: {
            options: {
                separator: grunt.util.linefeed
            },
            vendor: {
                expand: true,
                cwd: '<%= project.assets %>/js/source/vendor',
                src: ['*.js'],
                dest: '<%= project.assets %>/js/vendor',
                ext: '.js'
            },
            admin: {
                src: ['<%= project.js_admin %>'],
                dest: '<%= project.assets %>/js/admin.js'
            },
            main: {
                src: ['<%= project.js %>'],
                dest: '<%= project.assets %>/js/main.js'
            },
            routes: {
                expand: true,
                cwd: '<%= project.assets %>/js/source/routes',
                src: ['*.js'],
                dest: '<%= project.assets %>/js/routes',
                ext: '.js'
            },
        },

        uglify: {
            options: {
                banner: "<%= tag.banner %>"
            },
            build: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/js/source/vendor',
                        src: ['*.js'],
                        dest: '<%= project.assets %>/js/vendor',
                        ext: '.js'
                    },
                    {
                        '<%= project.assets %>/js/admin.js': '<%= project.js_admin %>',
                        '<%= project.assets %>/js/main.js': '<%= project.js %>'
                    },
                    {
                        expand: true,
                        cwd: '<%= project.assets %>/js/source/routes',
                        src: ['*.js'],
                        dest: '<%= project.assets %>/js/routes',
                        ext: '.js'
                    }
                ]
            }
        },

        filehash: {
            options: {
                mapping: '{{= dest}}/mapping.json',
                mappingKey: '{{= basename}}',
                mappingValue: '{{= basename}}.{{= hash}}{{= extname}}',
                etag: null,
                algorithm: 'md5',
                keep: false,
                merge: false,
                hashlen: 10
            },
            all: {
                files: [{
                    cwd: '<%= project.assets %>',
                    src: ['js/*.js', 'css/*.css'],
                    dest: '<%= project.assets %>'
                }]
            }
        }
    });

    /**
     *
     */
    grunt.task.registerTask('ivn', function () {
        var arrayMerge = Array.prototype.concat,
            authorizedTasks = {}, tasksArr = [],
            notAuthorized = false;

        authorizedTasks.styles = {
            dev: [
                'sass:dev',
                'postcss:all'
            ],
            build: [
                'sass:build',
                'cmq:build',
                'postcss:stylesGlobal',
                'postcss:stylesSpecific',
                'cssmin:build'
            ]
        };
        authorizedTasks.scripts = {
            dev: [
                'concat'
            ],
            build: [
                'jshint',
                'uglify:build'
            ]
        };
        authorizedTasks.dev = arrayMerge.call(['clean:all'], authorizedTasks.styles.dev, authorizedTasks.scripts.dev, ['filehash:all']);
        authorizedTasks.build = arrayMerge.call(['clean:all'], authorizedTasks.styles.build, authorizedTasks.scripts.build, ['filehash:all']);

        if (!this.args.length) {
            grunt.fail.fatal('IVN: please provide the task name that should be run');
        }

        if (!authorizedTasks.hasOwnProperty(this.args[0])) {
            notAuthorized = true;
        }

        if (this.args.length > 1) {
            if ('object' !== typeof authorizedTasks[this.args[0]]) {
                notAuthorized = true;
            } else if (!authorizedTasks[this.args[0]].hasOwnProperty(this.args[1])) {
                notAuthorized = true;
            } else {
                tasksArr = authorizedTasks[this.args[0]][this.args[1]];
            }
        } else {
            tasksArr = authorizedTasks[this.args[0]];
        }

        if (notAuthorized) {
            grunt.fail.fatal('IVN: the task you are trying to run has not been found in the list of authorized tasks');
        }

        if (tasksArr instanceof Array && tasksArr.length) {
            grunt.task.run(tasksArr);
        }
    });

    /**
     * Default task
     * Run `grunt` on the command line
     */
    grunt.task.registerTask('default', ['ivn:dev']);
};
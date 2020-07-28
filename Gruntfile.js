module.exports = function ( grunt ) {

    require( 'load-grunt-tasks' )( grunt );

    var conf = {
        plugin_branches: {
            include_files: [
                'assets/css/**',
                'assets/js/**',
                'assets/img/**',
                'includes/**',
                'admin/**',
                'public/**',
                'vendor/**',
                'disqus-conditional-load.php',
                'index.php',
                'LICENSE',
                'readme.txt',
                'uninstall.php'
            ]
        },

        plugin_dir: 'disqus-conditional-load/',
        plugin_file: 'disqus-conditional-load.php'
    };

    // Project configuration.
    grunt.initConfig( {

        pkg: grunt.file.readJSON( 'package.json' ),

        // Make .pot file for translation.
        makepot: {
            options: {
                domainPath: 'languages',
                exclude: [
                    'vendor/.*'
                ],
                mainFile: 'disqus-conditional-load.php',
                potFilename: 'disqus-conditional-load.pot',
                potHeaders: {
                    'poedit': true,
                    'language-team': 'Joel James <me@joelsays.com>',
                    'report-msgid-bugs-to': 'https://dclwp.com/',
                    'last-translator': 'Joel James <me@joelsays.com>',
                    'x-generator': 'grunt-wp-i18n'
                },
                type: 'wp-plugin',
                updateTimestamp: false, // Update POT-Creation-Date header if no other changes are detected.
                cwd: ''
            },
            // Make .pot file for the plugin.
            main: {
                options: {
                    cwd: ''
                }
            },
            // Make .pot file for the release.
            release: {
                options: {
                    cwd: 'releases/disqus-conditional-load'
                }
            }
        },

        // Make .mo file from .pot file for translation.
        po2mo: {
            // Make .mo file for the plugin.
            main: {
                src: 'languages/disqus-conditional-load.pot',
                dest: 'languages/disqus-conditional-load.mo'
            },
            // Make .mo file for the release.
            release: {
                src: 'releases/disqus-conditional-load/languages/disqus-conditional-load.pot',
                dest: 'releases/disqus-conditional-load/languages/disqus-conditional-load.mo'
            }
        },

        jshint: {
            files: [
                'assets/src/js/**/*.js'
            ],
            options: {
                expr: true,
                globals: {
                    jQuery: true,
                    console: true,
                    module: true,
                    document: true
                }
            }
        },
        sass: {
            all: {
                options: {
                    style: 'compressed',
                    sourcemap: false
                },
                files: {
                    'assets/css/admin/admin.min.css': 'assets/src/scss/admin/admin.scss'
                }
            }
        },
        uglify: {
            all: {
                options: {
                    report: 'gzip'
                },
                files: {
                    'assets/js/public/embed.min.js': 'assets/src/js/public/embed.js',
                    'assets/js/public/embed-click.min.js': 'assets/src/js/public/embed-click.js',
                    'assets/js/public/embed-count.min.js': 'assets/src/js/public/embed-count.js',
                    'assets/js/public/embed-count-click.min.js': 'assets/src/js/public/embed-count-click.js',
                    'assets/js/public/embed-count-scroll.min.js': 'assets/src/js/public/embed-count-scroll.js',
                    'assets/js/public/embed-scroll.min.js': 'assets/src/js/public/embed-scroll.js'
                }
            }
        },

        // Clean temp folders and release copies.
        clean: {
            temp: {
                src: [
                    '**/*.tmp',
                    '**/.afpDeleted*',
                    '**/.DS_Store',
                ],
                dot: true,
                filter: 'isFile'
            },
            folder_v2: [
                'releases/**',
                'assets/css/**',
                'assets/js/**'
            ],
        },

        // Verify in text domain is used properly.
        checktextdomain: {
            options: {
                text_domain: 'disqus-conditional-load',
                keywords: [
                    '__:1,2d',
                    '_e:1,2d',
                    '_x:1,2c,3d',
                    'esc_html__:1,2d',
                    'esc_html_e:1,2d',
                    'esc_html_x:1,2c,3d',
                    'esc_attr__:1,2d',
                    'esc_attr_e:1,2d',
                    'esc_attr_x:1,2c,3d',
                    '_ex:1,2c,3d',
                    '_n:1,2,4d',
                    '_nx:1,2,4c,5d',
                    '_n_noop:1,2,3d',
                    '_nx_noop:1,2,3c,4d'
                ]
            },
            files: {
                src: [
                    'admin/**/*.php',
                    'includes/**/*.php',
                    'public/**/*.php',
                    'disqus-conditional-load.php'
                ],
                expand: true
            }
        },

        // Copy selected folder and files for release.
        copy: {
            files: {
                src: conf.plugin_branches.include_files,
                dest: 'releases/<%= pkg.name %>/'
            }
        },

        // Compress release folder with version number.
        compress: {
            files: {
                options: {
                    mode: 'zip',
                    archive: './releases/<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                expand: true,
                cwd: 'releases/<%= pkg.name %>/',
                src: ['**/*'],
                dest: conf.plugin_dir
            }
        }
    } );

    // Check if text domain is used properly.
    grunt.registerTask( 'prepare', ['checktextdomain'] );

    // Make pot file from files.
    grunt.registerTask( 'translate', ['makepot:main', 'po2mo:main'] );

    // Compile and generate assets.
    grunt.registerTask( 'compile', [
        'jshint',
        'uglify',
        'sass'
    ] );

    // Run build task to create release copy.
    grunt.registerTask( 'build', 'Run all tasks.', function () {
        grunt.task.run( 'clean' );
        grunt.task.run( 'translate' );
        grunt.task.run( 'compile' );
        grunt.task.run( 'copy' );
        grunt.task.run( 'makepot:release' );
        grunt.task.run( 'po2mo:release' );
        grunt.task.run( 'compress' );
    } );
};
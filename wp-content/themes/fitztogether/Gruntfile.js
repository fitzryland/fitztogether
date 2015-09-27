module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // JavaScript
        concat: {
            // 2. Configuration for concatinating files goes here.
            dist: {
                src: [
                    'js/vendors/*.js', // All JS in the libs folder
                    'js/lib/*.js', // All JS in the libs folder
                    'js/main.js'  // This specific file
                ],
                dest: 'js/production.js',
                sourceMap: true
            }
        },
        uglify: {
            build: {
                src: 'js/production.js',
                dest: 'js/production.min.js',
                sourceMap: true
            }
        },
        // Style
        sass: {
            dist: {
                files: {
                    '.tmp/style.css': 'sass/style.scss'
                }
            },
            options: {
                sourceMap: true,
                outputStyle: 'nested',
                imagePath: "../img"
            }
        },
        autoprefixer: {
            dist: {
                files: {
                    'style.css': '.tmp/style.css'
                },
                options: {
                    map: true
                }
            }
        },

        watch: {
            // options: {
            //     livereload: true,
            // },
            css: {
                files: ['sass/*.scss'],
                tasks: ['sass', 'autoprefixer'],
                options: {
                    spawn: false,
                }
            },
            scripts: {
                files: ['js/*.js'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                },
            }
        },

        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        'style.css',
                        '*.php',
                        'js/main.js',
                        'js/**/*.js',
                    ]
                },
                options: {
                    watchTask: true,
                    proxy: 'localhost:8888/fitztogether',
                    port: '8888'
                }
            }
        }

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-sass');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify', 'sass', 'autoprefixer', 'browserSync', 'watch']);

};
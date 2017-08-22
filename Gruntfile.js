module.exports = function( grunt ) {
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		shell: {
			target: {
				command: 'wp2md convert readme.txt > readme.md'
			}
		},

		version: {
			readme: {
				options: {
					prefix: 'Stable tag:\\s*'
				},
				src: ['readme.txt']
			},
			scss: {
				options: {
					prefix: 'Version:\\s*'
				},
				src: ['sass/style.scss']
			},
			package: {
				src: ['package.json']
			}
		},

		clean: {
			main: ['release/<%= pkg.version %>']
		},

		copy: {
			main: {
				src: [
					'focus.php',
					'LICENSE',
					'readme.txt',
					'includes/**'
				],
				dest: 'release/<%= pkg.version %>/'
			},
			flexslider: {
				expand: true,
				cwd: '_build/FlexSlider',
				src: [
					'jquery.flexslider.js',
					'jquery.flexslider-min.js',
					'flexslider.css',
					'images/**',
					'fonts/**',
				],
				dest: 'flexslider/'
			}
		},

		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: './release/<%= pkg.name %>-v<%= pkg.version %>.zip'
				},
				expand: true,
				cwd: 'release/<%= pkg.version %>/',
				src: ['**/*'],
				dest: '<%= pkg.name %>/'
			}
		},

		replace: {
			readme: {
				src: ['release/<%= pkg.version %>/readme.txt'],
				overwrite: true, // overwrite matched source files
				replacements: [{
					from: "[![Build Status](https://travis-ci.org/emrikol/focus.svg?branch=master)](https://travis-ci.org/emrikol/focus)\n\n",
					to: ''
				}]
			}
		},

		sass: {
			all: {
				options: {
					unixNewlines: true
				},
				files: {
					'style.css': 'sass/style.scss',
					'flexslider-custom.css': 'sass/flexslider-custom.scss',
				}
			}
		},

		watch: {
			styles: {
				files: [ 'sass/**/*.scss' ],
				tasks: [ 'version::patch', 'sass', 'beep' ],
				options: {
					debounceDelay: 500
				}
			}
		},

		// Bump plugin: grunt version:plugin:patch; grunt version:readme:patch
		// Bump dropin: grunt version:dropin:patch
		// Bump everything: grunt version::patch

		/*version: {
			readme: {
				options: {
					prefix: 'Stable tag:\\s*'
				},
				src: ['readme.txt']
			},
			plugin: {
				options: {
					prefix: 'Version:\\s*'
				},
				src: [ 'focus.php', 'includes/admin-page.php' ]
			},
			dropin: {
				options: {
					prefix: 'Version:\\s*'
				},
				src: [ 'includes/object-cache.php' ]
			},
			package: {
				src: ['package.json']
			}
		},*/

		exec: {
			postcss: {
				command: 'npm run postcss'
			}
		},

		cssmin: {
			main: {
				options: {
					keepSpecialComments: 0,
					specialComments: 0
				},
				target: {
					files: [{
						expand: true,
						src: [
							'*.css',
							'!*.min.css'
						],
						ext: '.min.css'
					}]
				}
			},
			flexslider: {
				target: {
					files: [{
						expand: true,
						cwd: 'flexslider',
						src: ['*.css', '!*.min.css'],
						ext: '.min.css'
					}]
				}
			}
		}

	} );

	require( 'load-grunt-tasks' )( grunt );

	grunt.registerTask( 'build', [ 'sass', 'exec:postcss' ] );
	grunt.registerTask( 'flexslider', [ 'copy:flexslider', 'cssmin:flexslider' ] );
	grunt.registerTask( 'readme', [ 'shell' ] );
	grunt.registerTask( 'release', [ 'clean', 'copy', 'replace', 'compress' ] );

	grunt.util.linefeed = '\n';
};
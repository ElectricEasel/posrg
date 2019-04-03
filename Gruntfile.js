var grunt = require('grunt');

module.exports = function(grunt){
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	
	grunt.registerTask('default', ['less', 'uglify', 'watch']);
	
	grunt.initConfig({
		concat: {
		    css: {
		    	src: [
		    		'templates/posrg/css/jquery-ui.css',
		    		'templates/posrg/js/chosen/chosen.css',
		    		'templates/posrg/css/jquery.fancybox.min.css',
		    		'templates/posrg/css/slick.css',
		    		'templates/posrg/css/style.css',
		    	],
		    	dest: 'templates/posrg/css/combined.css'
			}
		},
		cssmin: {
			css: {
				src: 'templates/posrg/css/combined.css',
				dest: 'templates/posrg/css/combined.min.css'
			}
		},
		uglify: {
			options: {
				mangle: false
			},
			target: {
				files: {
					'templates/posrg/js/combined.min.js':
					[
						'media/system/js/core.js',
						'templates/posrg/js/jquery.min.js',
						'templates/posrg/js/jquery-ui.js',
						'templates/posrg/js/jquery.fancybox.min.js',
						'templates/posrg/js/jquery.fancybox-media.min.js',
						'templates/posrg/js/chosen/chosen.jquery.min.js',
						'templates/posrg/js/slick.min.js',
						'templates/posrg/js/site.js'
					],
				}
			}
		},
		watch: {
			css: {
				files: 'templates/posrg/css/style.css',
				tasks: ['concat','cssmin'],
				options: {
					livereload: true
				},
			},
			js: {
				files: [
							'templates/posrg/js/site.js',
						],
				tasks: ['uglify'],
				options: {
					livereload: true
				},
			},
		}
	});
};
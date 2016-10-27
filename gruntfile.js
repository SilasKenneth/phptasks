module.exports =function(grunt){
  grunt.initConfig({
    uglify:{
      build:{
	src: './js/*.js',
	dest: 'scripts.min.js'
    }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('default',['uglify:build']);
}

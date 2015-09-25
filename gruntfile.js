// Gruntfile.js

// our wrapper function (required by grunt and its plugins)
// all configuration goes inside this function
module.exports = function(grunt) {

  // ===========================================================================
  // CONFIGURE GRUNT ===========================================================
  // ===========================================================================
  grunt.initConfig({

    // get the configuration info from package.json ----------------------------
    // this way we can use things like name and version (pkg.name)
    pkg: grunt.file.readJSON('package.json'),

    // configure jshint to validate js files -----------------------------------
    jshint: {
      options: {
        reporter: require('jshint-stylish')
      }
    },
    compass: {
      dev: {
        options: {
          cssDir: 'css',
          sassDir: 'sass',
          imagesDir: 'imgs',
          javascriptsDir: 'js',
          outputStyle: 'expanded',
          require: ['breakpoint']
        }
      }
    },
    watch: {
      scripts: {
        files: ['js/**/*.js'],
        tasks: ['jshint']
      },
      css: {
        files: ['sass/**/*.scss'],
        tasks: ['compass', 'sync'],
        options: {
          livereload: true
        }
      }
    },
    ftp_push: {
      your_target: {
        options: {
          host: "tidalconcepts.com",
          dest: "/tidalwp/wp-content/themes/tidal",
          port: 21,
          username: "tidalftp@tidalconcepts.com",
          password: "o+n+?STbM[Uq",
        },
        files: [
          {
            expand: true,
            cwd: '.',
            src: [
              "css/**"
            ]
          }
        ]
      }
    },
    sync: {
      main: {
        files: [
          {expand: true, src: ['css/*.css'], dest: 'W:/emanationwp/wp-content/themes/jdandco/'},
        ],
      },
    },
  });
  

  // ===========================================================================
  // LOAD GRUNT PLUGINS ========================================================
  // ===========================================================================
  // we can only load these if they are in our package.json
  // make sure you have run npm install so our app can find these
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-ftp-push');
  grunt.loadNpmTasks('grunt-sync');
};

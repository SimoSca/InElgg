/**
 * Documentazione creata via ApiDoc.
 *
 *
 * 
 * Task Manager: grunt, con plugin grunt-apidoc.
 *
 *
 * 
 * Questo file deve essere accompagnato da:
 *
 * 		- package.json  , file di configurazione di nodejs (runnare npm install)
 * 		- apidoc.json   , file di configurazione di apidoc.
 *
 *
 * 
 * Operazioni di inizializzazione:
 *
 * $ npm init                             , per creare un file di configurazione standard (package.json)
 * $ npm install grunt --save-dev         , per installare localmente grunt e salvare questa configurazione in package.json
 * $ npm install grunt-apidoc --save-dev  , per installare localmente grunt e salvare questa configurazione in package.json
 * $ npm install grunt-composer --save-dev
 * $ npm install expose --save-dev
 *
 *
 * 
 * svolti questi preparativi, per aggiornare la documentazione mi basta runnare
 *
 *  $ grunt
 */

module.exports = function(grunt) {
  
  // to execute shell command
  var shell = require('shelljs');

  // Project configuration.
  grunt.initConfig({
    apidoc: {
      myapp: {
        src: "foowd_alpha2/api_foowd/app/routes",
        dest: "foowd_alpha2/doc/foowd_api/doc"
      }
    },
    /*composer : {
      options : {
        usePhp: true,
        cwd: "foowd_alpha2/api_offerte/app"
      }
    },
    bgShell: {
          _defaults: {
            bg: true
          },
          gruntComposer: {
            cmd: 'grunt composer:dump-autoload'
          }
        }*/
  });


  // Load the plugin that provides the "apidoc" task.
  grunt.loadNpmTasks('grunt-apidoc');
  grunt.registerTask('apidc', ['apidoc']);

  // custom par
  var current = shell.pwd();

  // autoload composer
  grunt.registerTask('propel-model','propel model:build', function() {
    var work = current + '/foowd_alpha2/api_foowd/app';
    shell.cd(work + "/data"); // relative path, but could be absolute
    shell.exec(work + '/vendor/bin/propel model:build');
    shell.cd(current);
  });


  // autoload composer
  grunt.registerTask('dump-auto','composer dump-autoload', function() {
    shell.cd("foowd_alpha2/api_foowd/app"); // relative path, but could be absolute
    shell.exec('composer dump-autoload');
    shell.cd(current);
  });


  // default
  //grunt.registerTask('default', 'My "default" task description.', function() {
  //  grunt.log.writeln('Currently running the "default" task.');
  //});


  // ogni volta eseguo questa azione
  var myTouch = "type nul >>check-auto-reload.touch & copy check-auto-reload.touch +,,";
  shell.exec(myTouch);

};

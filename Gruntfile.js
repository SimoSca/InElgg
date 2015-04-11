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
  var fs    = require('fs');

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
  var current = shell.pwd()+'/';
  var foowd = current+'foowd_alpha2/api_foowd/';
  var appDir = foowd + 'app/';
  var dataDir = appDir + 'data/';
  var propelExec = appDir + 'vendor/bin/propel';

  var PathExec = function(path, exec){ // path absolute
    shell.cd(path);
    shell.exec(exec);
    shell.cd(current);
  }
  // controllo se una directory esiste, e in caso contrario eseguo una determinata azione
  function ensureExists(path, mask, cb) {
      if (typeof mask == 'function') { // allow the `mask` parameter to be optional
          cb = mask;
          mask = 0777;
      }
      fs.mkdir(path, mask, function(err) {
          if (err) {
              if (err.code == 'EEXIST') cb(null); // ignore the error if the folder already exists
              else cb(err); // something else went wrong
          } else cb(null); // successfully created folder
      });
  }

  // autoload composer
  grunt.registerTask('propel-model','propel model:build', function() {
    //var work = foowd+'app/';
    shell.cd(appDir + "data/"); // relative path, but could be absolute
    shell.exec(propelExec +' model:build');
    shell.cd(current);
  });


  // autoload composer
  grunt.registerTask('dump-auto','composer dump-autoload', function() {
    shell.cd(appDir); // relative path, but could be absolute
    shell.exec('composer dump-autoload');
    shell.cd(current);
  });


  // inizializzazione, per la prima volta che importo il repo:
  grunt.registerTask('init-composer-propel','init composer and propel', function() {
    var classDir = dataDir + 'generated-classes/';
    // se non esiste, creo la directory
    ensureExists(classDir, function(err) {
        if(err){
          fs.mkdirSync(classDir);
        }else {

        }
    });

    PathExec(appDir, 'composer install');
    PathExec(dataDir, propelExec +' sql:build');
    PathExec(dataDir, propelExec +' model:build');
    PathExec(dataDir, propelExec +' config:convert');
    //PathExec(appDir, 'composer install');
    PathExec(appDir, 'composer dump-autoload');
  });  


  // default
  //grunt.registerTask('default', 'My "default" task description.', function() {
  //  grunt.log.writeln('Currently running the "default" task.');
  //});


  // ogni volta eseguo questa azione
  var myTouch = "type nul >>check-auto-reload.touch & copy check-auto-reload.touch +,,";
  shell.exec(myTouch);

};

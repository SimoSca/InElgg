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
  
  // custom par
  var current = shell.pwd()+'/';
  var foowd = current+'foowd_alpha2/api_foowd/';
  var appDir = foowd + 'app/';
  var dataDir = appDir + 'data/';
  var propelExec = appDir + 'vendor/bin/propel'; // command, not directory
  var modDir = current+'foowd_alpha2/mod_elgg/';

  // carico i files in jsList : contiene solo i js che voglio documentare
  var jsList = [];
  listJsDoc(jsList, modDir, ['gruntfile', 'assets/', 'vendor/', 'node_modules', 'bower_components/', 'foowd_theme', 'css/', 'js/imgareaselect'/*, 'foowd_theme/views/css/jquery'*/] );

  // Project configuration.
  grunt.initConfig({
    apidoc: {
      myapp: {
        src: "foowd_alpha2/api_foowd/app/routes",
        dest: "foowd_alpha2/doc/foowd_api/doc"
      }
    },
    jsdoc : {
            dist : {
                src: jsList,
                options: {
                    destination: 'doc/js/',
                    //recurse: true,
                    //ignoreWarnings: true
                    access: "all"
                } 
                //jsdoc: "./node_modules/bin/jsdoc"
            }
    },
    phpdocumentor: {
           dist: {
               options: {
                   target : 'doc/php/',
                   directory : [modDir/*, foowd*/],
                   ignore: ['foowd_theme/', 'vendor/', 'data/generated-*', 'bower_components/']
               }
           }
       }
    /*composer : {
      options : {
        usePhp: true,
        cwd: "foowd_alpha2/api_offerte/app"
      }
    }*/
  });


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
    grunt.task.run('dump-auto');
    shell.cd(current);
  });


  // autoload composer
  grunt.registerTask('dump-auto','composer dump-autoload', function() {
    shell.cd(appDir); // relative path, but could be absolute
    shell.exec('composer dump-autoload --optimize');
    shell.cd(current);
  });


  // composer foowd_theme
  grunt.registerTask('theme-install','runs composer install inside foowd_theme', function() {
    shell.cd(modDir+'foowd_theme/'); // relative path, but could be absolute
    shell.exec('composer install');
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

  // inizializzazione, per la prima volta che importo il repo:
  grunt.registerTask('update-propel-composer','update propel (diff merge model) and  composer autoload', function() {
    console.log('### Run propel diff');
    PathExec(dataDir, propelExec +' diff');
    console.log('### Run propel migrate');
    PathExec(dataDir, propelExec +' migrate');
    console.log('### Run propel model:build');
    PathExec(dataDir, propelExec +' model:build');
    console.log('### Run propel config:convert');
    PathExec(dataDir, propelExec +' config:convert');
    //PathExec(appDir, 'composer install');
    console.log('### Run composer dump-autoload');
    PathExec(appDir, 'composer dump-autoload');
  });

  // Load the Dcoumentation plugins.
  grunt.loadNpmTasks('grunt-apidoc');
  //grunt.registerTask('apidc', ['apidoc']);
  grunt.loadNpmTasks('grunt-jsdoc');
  //grunt.registerTasks('jsdc', ['jsdoc']);
  grunt.loadNpmTasks('grunt-phpdocumentor');
  //grunt.registerTasks('phpdc', ['phpdocumentor']);
  
  grunt.registerTask('doc', ['apidoc', 'jsdoc', 'phpdocumentor']);



  // default
  //grunt.registerTask('default', 'My "default" task description.', function() {
  //  grunt.log.writeln('Currently running the "default" task.');
  //});


  // ogni volta eseguo questa azione
  var myTouch = "type nul >>check-auto-reload.touch & copy check-auto-reload.touch +,,";
  shell.exec(myTouch);


  /**
   * listo tutti i javascript nella directory e sub, e inoltre evito quelli che matchano exclude
   *
   */
  function listJsDoc(ar, path, exclude){
    // sanitize path

    // search
    var isJs = new RegExp('.js$', 'i');

    var files = fs.readdirSync(path)

      
          files.forEach(function(fileName) {
             var filePath = path+fileName; // filePath with root
             var stats = fs.statSync(filePath);
             var isDir = stats.isDirectory();
            //console.log(fileName)
             
             if (isDir) {
               listJsDoc(ar,filePath+'/', exclude);
             }else{
                var check = true;
                for(var i in exclude){
                  var r = new RegExp(exclude[i]);
                  if(filePath.match(r)){
                    check=false;
                    break;
                  }
                }
                if(fileName && check && fileName.match(isJs) ) {
                  //var f = filePath+'/'+fileName;
                  //var rxx = new RegExp('\\', 'g');
                  //ar.push(f.replace(/\\/, '/'));
                  ar.push(filePath);
                }
             }
    
    });

  }

};

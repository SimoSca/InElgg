//** add proper build system to sublime project config (edit project)
// "build_systems":
// 	[
// 		{
// 			"cmd":
// 			[
// 				"jake"
// 			],
// 			"name": "ElggProj",
// 			"shell": true,
// 			"working_dir": "C:\\wamp\\www\\ElggProject"
// 		}
// 	],
//***********************************************




//START "title" [/D path] [options] "command" [parameters]

// var source = {
//   bower : 'tree/java/utils/bower.json'
// };

// var target = {
//   bower : '../java/utils/bower.json' 
// };

// // obtain windows path
// function winFile(str){
//   return str.replace(/\//g, '\\');
// }

// // obtain windows directory
// function winDir(str){
//   //return str.replace(/\//g, '\\');
//   return str.substring(0, str.lastIndexOf("/")).replace(/\//g, '\\');
// }


// filepart e' la parte dopo l'ultimo slash...
// function splitPath(path) {
//   var dirPart, filePart;
//   path.replace(/^(.*\/)?([^/]*)$/, function(_, dir, file) {
//     dirPart = dir; filePart = file;
//   });
//   return { dirPart: dirPart, filePart: filePart };
// }


function baseName(str){
   var base = new String(str).substring(str.lastIndexOf('/') + 1); 
    if(base.lastIndexOf(".") != -1)       
        base = base.substring(0, base.lastIndexOf("."));
   return base;
}

// default - dipende da target.bower, e se questo risulta piu recente di source.bower,
// allora gli faccio eseguire la task di bower.

desc("start default, that is load config.php and touch a check file");
task('default', [/*target.bower*/], function (ext, file) {

	var cmds = [];

  var executed = false;
	
	if(ext === 'sass'){
    cmds.push('sass --style expanded --compass '+file+ ' '+baseName(file)+'.css');
    vpsSync(ext, file, cmds);
  } 
  if(ext === 'styl'){
    if(file.match(/\\mod_elgg\\foowd_utenti\\css\\/gi)){
      // sostituisco il file con quello di default
      file = file.replace(/[^\\]+$/gi, 'foowd-utenti.styl');
      cmds.push('stylus -u nib '+file/*+ ' '+baseName(file)+'.css'*/);
      vpsSync(ext, file, cmds);
      executed = true;
    }
    if(file.match(/\\mod_elgg\\foowd_offerte\\css\\/gi)){
      // sostituisco il file con quello di default
      file = file.replace(/[^\\]+$/gi, 'foowd_offerte.styl');
      cmds.push('stylus -u nib '+file/*+ ' '+baseName(file)+'.css'*/);
      vpsSync(ext, file, cmds);
      executed = true;
    }
  }
  if(ext === 'coffee'){
    cmds.push('coffee -c '+file/*+ ' '+baseName(file)+'.css'*/);
    vpsSync(ext, file, cmds);
    executed = true;
  } 
    

  var hbrsPath =  'C:\\xampp\\htdocs\\www\\ElggProject\\foowd_alpha2\\mod_elgg\\foowd_theme\\pages\\templates\\';
  if(ext === 'handlebars'){
    file = hbrsPath+'templates-amd.js';
    console.log(file)
    cmds.push('python handlebars.py');
    vpsSync(ext, file, cmds);
    executed = true;
  } 
  if(file.match(/\\mod_elgg\\foowd_theme\\lib\\css\\styl\\/gi)){
    console.log(file)
    var base = file.split('\\');
    var baseName = base[base.length-1].replace(/\.styl/, '')
    var re = new RegExp('styl\\\\'+baseName+'.styl'); 
    file2 = file.replace(re, 'partials\\'+baseName+'.css');
    console.log(file2)
    baseDir = file.replace(re, '' );
    var cmdl = []
    cmdl.push('stylus -u nib -u jeet -u rupture '+ file + ' -o ' + file2);
    cmdl.push('python template-style.py')
    // jake.exec(cmdl, {interactive: true}, function () {});
    file = baseDir + 'style.css';
    vpsSync(ext, file, cmdl);
    executed = true;
  }

  if(!executed) vpsSync(ext, file, cmds);
  
  //'echo "ora genero il file per il check di auto-reload"',

  var cmd = ["type nul >>check-auto-reload.touch & copy check-auto-reload.touch +,,"];
  jake.exec(cmd, {interactive: true}, function () {
    complete();
  });


});


function vpsSync(ext, file, cmd){

  var Path = [], mod = {}, api = {};
  mod.dest = "/var/www/html/elgg-1.10.4/mod/";
  mod.target = "/foowd_alpha2/mod_elgg/";
  Path.push(mod);
  api.dest = "/var/www/html/api_foowd/";
  api.target = "/foowd_alpha2/api_foowd/";
  Path.push(api);
  // variabile nodejs
  // Desktop/prova.txt enomis@5.196.228.146:/home/enomis/
  // ottengo i path dei file locali in stile linuxlike

  var check = false, fileLinux, PathMod;
  for(var i = 0 ; i < Path.length; i++){
    var p = Path[i];
    var BaseLocal = (__dirname + p.target).replace(/\\/gi, "/")
    var fileLinux = file.replace(/\\/gi, "/");
    var rb = new RegExp(BaseLocal,'');
    if(fileLinux.match(rb, BaseLocal)){ 
      check = true;
      PathMod = p.dest;
      break;
    }  
  }
  // console.log(fileLinux)
  
  // se non matcha ritorno in quanto non devo sincronizzarla col remoto
  if(!check){
    console.log('### file: ' + fileLinux +' , no regular to push in vps')
    return;
  }

  
  var origin = [fileLinux] 
  var dest = [PathMod + fileLinux.replace(rb, '')]
  
  var eT = {
    'coffee' : 'js',
    'saas' : 'css',
    'styl' : 'css'
  }

  // controllo se c'e' l'estensione giust
  if( typeof eT[ext] !== 'undefined' ){
    origin.push( origin[0].replace(/.[^\.]*$/gi, '') + '.' + eT[ext] )
    dest.push( dest[0].replace(/.[^\.]*$/gi, '') + '.' + eT[ext] )
  }

  // Buon tutorial ssh: http://www.unixwiz.net/techtips/ssh-agent-forwarding.html
  // var cmd = []
  var preCmd = /*'pageant C:\\Users\\black\\ProgramsConfig\\Putty\\ssh\\elgg_rsa.ppk -c '*/'pscp '

  for( var i = 0 ; i < origin.length; i++){
    cmd.push(  preCmd + origin[i] + ' enomis@5.196.228.146:' + dest[i] )
  }

  console.log('### Sto per eseguire i comandi:')
  console.log(cmd)

  var exec = require('child_process').execSync;
  // var cmd = 'prince -v builds/pdf/book.html -o builds/pdf/book.pdf';
  // Eseguo tutti i comandi
  
  // l'errore di copiatura in removo lo rilevo una sola volta
  // dunque questo e' inteso come trigger. Questo serve nel caso cerchi di salvare piu files, come quando compilo un .styl
  var pscpError = false;

  for(var i = 0 ; i < cmd.length;  i++){
    var buff = exec(cmd[i])/*, function(error, stdout, stderr) {
      console.log('bella')
      console.log('stdout: ' + stdout);
      console.log('stderr: ' + stderr);
      if (error !== null) {
        console.log('exec error: ' + error);
      }
    });*/
    // console.log(buff)
    
    /*if(buff.error){
      console.log('### E\' avvenuto un errore.' );

      var call = buff.error.syscall;

      if(call.match(/pscp/) && !pscpError){
        pscpError = true;
        var msg = 'Errore in ~pscp~: probabilmente devi attivare la pubkey con pageant';
        var sendAlert = 'mshta javascript:alert("'+ msg +'");close();';
        require('child_process').execSync(sendAlert);
      }

      console.log('Se non riesci a trovare l\'errore ti conviene cambiare da "spawnSync" a "execSync"');
    }*/
  }

}// end vpsSync



// Nota bene: in generale dovrei fare un touch di target.bower, per fare in modo che risulti
// successivo (ovvero generato successivamente) all'ultima modifica di source.bower
// In questo caso il touch non serve perche' ci pensa gia' la task - default - a aggiornare il 
// target.bower

// desc("start bower, if bower is modified...");
// // async: vuol dire che la task deve essere considerata asyncrona
// //        in sostanza quando finisce deve emettere un "complete" per far eseguire le task che la chiamano. 
// //        Senza il complete, le task chiamanti non vengono eseguite, e il programma eventualmente termina.
// file(target.bower, [source.bower], {async: true}, function (params) {
//   var cmds = [
//   // pushd mi fa cambiare la directory, salvando quella da cui lo sto eseguendo
//   // popd mi fa tornare alla directory salvata con pushd
//     'pushd '+ winDir(target.bower) +' & bower install & popd',
//   	'echo "eseguo ' + 'pushd '+ winDir(target.bower) +' & bower install & popd' + '"'
//   ];

//   jake.exec(cmds, {interactive: true}, function () {
//     complete();
//   });

// });




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
	
	if(ext === 'sass') cmds.push('sass --style expanded --compass '+file+ ' '+baseName(file)+'.css');
  if(ext === 'styl') cmds.push('stylus -u nib '+file+ ' '+baseName(file)+'.styl');
	// console.log(cmds[0]);

  	//"php config.php",
  	//'echo "ora genero il file per il check di auto-reload"',
	cmds.push("type nul >>check-auto-reload.touch & copy check-auto-reload.touch +,,");

  jake.exec(cmds, {interactive: true}, function () {
    complete();
  });
});



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




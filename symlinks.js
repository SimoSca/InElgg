
console.log('start create symlinks')

// to execute shell command
var shell = require('shelljs');
var fs    = require('fs');

// custom par
var current = shell.pwd()+'\\';
var foowd = current+'foowd_alpha2/api_foowd/';
var appDir = foowd + 'app/';
var dataDir = appDir + 'data/';
var propelExec = appDir + 'vendor/bin/propel'; // command, not directory
var modDir = current+'foowd_alpha2/mod_elgg/';



var destDir = current + 'elgg-1.10.5\\mod\\';
var srcDir = current + 'foowd_alpha2\\mod_elgg\\';



console.log('Directory Sorgente: ' + srcDir);
console.log('Directory Destinazione: ' + destDir);

// lettura conferma da terminale
var stdin = process.stdin;

console.log('I parametri vanno bene? (y per si)');
// without this, we would only get streams once enter is pressed
stdin.setRawMode( true );

// resume stdin in the parent process (node app won't quit all by itself
// unless an error or process.exit() happens)
stdin.resume();

// i don't want binary, do you?
stdin.setEncoding( 'utf8' );

// on any data into stdin
stdin.on( 'data', function( key ){
  // ctrl-c ( end of text )
  console.log(key)

  if(key.match(/y/) ){

    setModDirs(srcDir);
    //setApiDir();
    console.log('Success!')

  }
  else{
    console.log('Do nothing...')
  }

  // tasto enter
  // if ( key === '\u0003' ) {
    process.exit();
  // }
  // write the key to stdout all normal like
  // process.stdout.write( key );
  stdin.resume();
});


// Creo i links nella directory mod di elgg
function setModDirs (dir){
    var files = fs.readdirSync(dir);
    for (var i in files){

        var src = dir +  files[i];
    	var dest = destDir + files[i];

        if (fs.statSync(src).isDirectory() && !fs.statSync(dest).isDirectory() && src!==dir ){
    		// console.log(src)
    		// console.log(dest)
    		// creo i files
    		cmd = 'mklink /D ' + dest + ' ' + src
            console.log('\n### Comando eseguito:');
    		console.log(cmd)
    		shell.exec(cmd)
        }
    }
    // return files_;
}

// setModDirs(srcDir)

// creo il link alla directory api
function setApiDir(){
	var src = current + 'foowd_alpha2\\api_foowd\\'

	shell.cd('..');
	var dest = shell.pwd() +'\\api_foowd\\'
	
	cmd = 'mklink /D ' + dest + ' ' + src;
	shell.exec(cmd)

}

// setApiDir();

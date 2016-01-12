<!-- logTest.php<br/>
http://docstore.mik.ua/orelly/webprog/php/ch13_04.htm<br/>
https://support.tridia.com/faq/showfaq.php?faq_id=245<br/>
http://nyphp.org/PHundamentals/7_PHP-Error-Handling<br/>
http://stackoverflow.com/questions/9186038/php-generate-rgb -->

<?php

/***

define('APPPATH', 'where_ever_is_best');

 ini_set('error_log', APPPATH .'php_error_' .date('Y-m-d-h-m') .'.log');

 echo ini_get('error_log');
 # where_ever_is_best//php_error_2012-05-11-06-05.log

 die;


***/

	// ini_set('error_log','my_error_file.log');
	

	 // error_log("You messed up!", 1, "errors.log");


	// function log_roller($error, $error_string) {
	//   $file = 'c:\wamp\logs\php_error.log';
	//   var_dump(filesize($file));
	//   if(filesize($file) > 1024000) {
	//     rename($file, (string) 'c:\wamp\logs\\'.time().'.log');
	//     clearstatcache( );
	//   }
	  
	//   error_log($error_string, 3, $file);
	// }
	  
	// set_error_handler('log_roller');
	//   for($i = 0; $i < 5000; $i++) {
	//     trigger_error(time( ) . ": Just an error, ma'am.\n");
	//   }
	// restore_error_handler( );
	// require ('lolg.dacchio');
	
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	} 
	
	// Config
	
	$dirs[] = '../foowd_alpha2/api_foowd/log';
	$dirs[] = '../foowd_alpha2/mod_elgg/foowd_utility/log/';
	$timeDiff = 7; 

	$date = new \DateTime();
	// eventualmente impostare opzione config
	// opzione per opacity
	
	
	?>

	<style>
		body{
			color:#ffffff;
			background-color:#000000;
			font-size: 0.9em;
			font-family: monospace;
		}
		div{
			color: #000000;
			margin-top: 1px;
			background-color: #ffffff;
		}

		.error{
			border-left:10px solid red;
			padding-left: 5px;
		}

		.warning{
			border-left:10px solid yellow;
			padding-left: 5px;	
		}

		.debug{
			border-left:10px solid green;
			padding-left: 5px;	
		}

		.info{
			border-left:10px solid purple;
			padding-left: 5px;	
		}

		.notice{
			border-left:10px solid blue;
			padding-left: 5px;		
		}

	</style>

	<?php 
	




	class Highlight{

		public $originFile = array();
		public $colorFile = array();

		public $actualDate = null;

		public function setColor($file){

			 if(! isset($this->colorFile[$file]) ){ 

			 $hash = md5('color' . rand(0,1000) ); // modify 'color' to get a different palette
			 $ar =implode( array(
			    			hexdec(substr($hash, 0, 2)), // r
			    			hexdec(substr($hash, 2, 2)), // g
			    			hexdec(substr($hash, 4, 2)), // b
			    			0.7) // a
			 			, ',');

			 $this->colorFile[$file] = $ar;
			}

			return $this->colorFile[$file];
		}

		public function useMatch($ar){
			if(!is_array($ar)) return;

			$color = $this->setColor($ar[3]);
			$this->originFile[$ar[1]][]=array( 'log' =>$ar[0], 'color'=> $color, 'class'=>$ar[2]);
			// var_dump($ar[2]);

		}

		public function printAll(){
			// sort
			ksort($this->originFile);
			$reverse = array_reverse($this->originFile);

			$now = new \DateTime();

			foreach($reverse as $time => $line){

				
				$date = new DateTime($time);
				
				// se e' una nuova data, aggiorno
				if( $date->format('Y-m-d') != $this->actualDate){

					$this->actualDate = $date->format('Y-m-d');
					
					if($now->diff($date)->d > 7){
						break;	
					}

					echo '<h1>'.$this->actualDate.'</h1>';
				}
				foreach($line as $info)
				// var_dump($info);
				 echo '<div class="'.$info['class'].'" style="background-color:rgba('.$info['color'].');">'.$info['log'].'</div>';
			}
		}
		
	}


	$cls = new Highlight();

	foreach($dirs as $dir){
		foreach(new \DirectoryIterator($dir) as $f){
			if($f->isFile()){
				// var_dump($f->getPathname());
				parseFile($f->getPathname(), $cls);
			}
		}
	}

	$cls->printAll();


	function parseFile($f, $cls){


		foreach(file($f) as $line) {
		   // echo $line. "<br/>\n";
		   // se matcha
		   if(preg_match('@api_foowd@', $line) ){
		   		preg_replace_callback('@\[([^\]]+).*\.(\w+):.*file":"([^"]+)@', "api_match", $line);
		   }else{
		   		preg_replace_callback('@\[([^\]]+).*\.(\w+):.*File: ([^ ]+)@', "api_match", $line);
		   }

		   $cls->useMatch($_SESSION['matches']);

		}

		// var_dump($cls);
	}

	function api_match ($matches){
	  // $matches[0] e' la stringa stessa
	   // var_dump($matches[1]);
	   // return $matches;
	   $matches[2] = strtolower($matches[2]);
	   $_SESSION['matches'] = $matches;
	}

	// function logStatus($str){
	// 	array = ('DEBUG', 'ERROR');

	// }
	



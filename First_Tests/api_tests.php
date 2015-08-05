<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Test API</title>
</head>
<body>


<?php


// ottengo e visualizzo l'immagine
// $data['ExternalId'] = '5';
// $data['type']='search';
// $data['return']='Description,Image';
// $r = API::Request('user','POST', $data);
// var_dump($r);
// function base64_to_jpeg( $base64_string, $output_file ) {
//     $ifp = fopen( $output_file, "wb" ); 
//     fwrite( $ifp, base64_decode( $base64_string) ); 
//     fclose( $ifp ); 
//     return( $output_file ); 
// }
// $image = base64_to_jpeg( $r->Image, 'tmp.jpg' );
// echo '<img src="data:image/jpeg;base64,' . $r->Image . '" />';



// // ora salvo l'immagine
// $fp = fopen("tmp.jpg", "rb");
// // fclose($fp);
// $fp = base64_encode(stream_get_contents($fp));
// // var_dump($fp);
// // salvo l'immagine
// $data['ExternalId'] = '617';
// $data['type']='update';
// $data['Description']='superbellissimo';
// $data['Image']=$fp;
// $r = API::Request('user','POST', $data);
// var_dump($r);


// // last check
// // ottengo e visualizzo l'immagine
// $data['ExternalId'] = '617';
// $data['type']='search';
// $data['return']='Description,Image';

// $r = API::Request('user','POST', $data);
// var_dump($r);
// echo $r->Description;
// echo '<img src="data:image;base64,' . $r->Image . '" />';





?>

</body>
</html>

<?php

class API{

	// /**
	//  * faccio partire curl per la chiamata al servizio
	//  * @return [type] [description]
	//  */

	public static function Request($url, $method , array $params){
		
		// CURL check
		if(is_callable('curl_init')){
			// inizializzo la chiamata
			//$url="http://localhost/api_offerte/public_html/api/offers";
			$url = 'http://localhost/api_foowd/public_html/api/' . $url;
			$ch = curl_init($url);
		}else{
			var_dump("Impossibile eseguire l'azione");
			// qui eventualmente generare il log per avvisare che curl non funziona
		   	return false;
		}
		
		// converto tutti i dati in un array da passare in formato json via curl
		$numeric = array('Price', 'Minqt','Maxqt');
		foreach($params as $field => $value){
			// elimino gli spazi inutili
			$value = trim($value);
			// se e' vuoto, evito di mandarlo
			if(empty($value)) continue;
			// modifico automaticamente le virgole in punti, 
			// in modo da passare il corretto formato per salvataggio mysql.
			if(in_array($field, $numeric)) $value = preg_replace('@,@', '.', $value);			
			$ar[$field] = $value;
		}


		// se non e' impostato type, allora non vado avanti
		$testPost = (isset($ar['type']) && $method==="POST" );
		$testGet = (preg_match('@type@i', $url) && $method==="GET");
		if(!$testPost && !$testGet){
			var_dump('Error: undefined type');
			return false;
		}

		// set Headers
		$now = (new \DateTime(null, new \DateTimeZone("UTC")))->format('U');
		$headers = array('Content-Type: application/json', 'F-Time:'.$now);
		// se il metodo e' post, allora implemento un piccolo controllo
		if($testPost || true){
			array_push($headers, 'F-Check:'.hash_hmac('sha256', $now, 'KFOOWD'));
		}
		

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    // curl_setopt($ch, CURLOPT_URL, $URL);
	    // curl_setopt($ch, CURLOPT_USERAGENT, $this->_agent);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    // curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->_cookie_file_path);
	    // curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->_cookie_file_path);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ar));
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

	    // utile per debug tramite POSTMAN
	    //register_error(json_encode($ar));

		// dovrebbe ritornare un formato json
		$output=curl_exec($ch);

		// var_dump($output);
		
		$returned = json_decode($output);


		// i prezzi li visualizzo con la virgola
		// foreach ($returned->body as $key => $value) {
		// 	foreach($value as $field => $var){
		// 		// i valori numerici per convenzione hanno la virgola come separatore decimale
		// 		if(in_array($field, $numeric)){
		// 			// $returned->body[$key]->{$field} = preg_replace('@\.@', ',', $var);
		// 		}	
		// 	}
		// }

		return $returned;
	}

}
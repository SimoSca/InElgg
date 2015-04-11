<?php
	
	// con questo schema, per gurl mandare una richiesta tramite GET o tramite URL non cambia nulla!


	/*** la POST REQUEST con slim riesce a mandare sia i parametri url (slim->PARAMS) che come body (slim->getBODY)	****/
	// $method = 'POST';


	/*** la GET REQUEST con slim riesce a mandare sia i parametri url (slim->PARAMS) che come body (slim->getBODY) ****/
	$method = 'GET';

	$url="http://localhost/api_offerte/public_html/api/offers?url=funzia&app=".$method;
	$ar['par'] =$method;
	$ar['body'] ='corpo';
	
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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

	// dovrebbe ritornare un formato json
	$output=curl_exec($ch);
	//$_SESSION['my']=json_encode($url);
	var_dump($output);
	
	$returned = json_decode($output);
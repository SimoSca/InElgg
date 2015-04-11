<?php

$app->get('/offers', function () {

	$offers = OfferQuery::create()
 		->orderByName()
  		->find();

	
    $offerArray = array();
    foreach($offers as $offer){
      array_push($offerArray, $offer->toArray());
    }
    echo json_encode($offerArray);

});



//Esempio API OFFERTE
//

//Crea offerta 
//Per ora 
$app->post('/offers', function () use ($app) {
    //Create book
	$offer = new Offer();
	var_dump($app->request->post('name'));
	$offer->setName($app->request->post('name'));
	$offer->setPrice(floatval($app->request->post('price')));
	$offer->setPublisher(0);

	if($offer->validate()){
		$offer->save();
		echo "Creata ".$app->request->post('name');	
	}else{
		echo "Mancano dei dati";
		foreach ($offer->getValidationFailures() as $failure) {
	        echo "Property ".$failure->getPropertyPath().": ".$failure->getMessage()."\n";
	    }	
	}

	// try{
		//}

});

// visualizzo tabella
$app->get('/visualize', function(){
	echo "visualize here!!!";
	$offer = new Offer();
	var_dump($offer);
	//$items = ItemQuery::create()->find(); // one query to retrieve all items




});

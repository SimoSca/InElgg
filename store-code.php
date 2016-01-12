<?php

	
	/**
	 *
	 * @api {get} /offers offerList
	 * @apiName offerList
	 * @apiGroup Offers
	 * 
 	 * @apiDescription Per ottenere la lista delle offerte di un dato Publisher.
 	 *
 	 * NB: allo stato attuale e' sufficiente utilizzare il metodo SEARCH, secondo l'url http://localhost/api_offerte/public_html/api/offers?Publisher={{Publisher}}&type=search
	 * 
	 * @apiParam {String} 		type 		metodo da chiamare
	 * @apiParam {Integer}  	Publisher 	id dell'offerente
	 *
	 * @apiParamExample {url} URL-Example:
	 * http://localhost/api_offerte/public_html/api/offers?type=offerList&Publisher=37
	 *
	 * @apiUse MyResponse
	 * 
	 */
	// protected function offerList($data){

		
	// 	$offer = \OfferQuery::create()
	// 			->filterByPublisher($data->Publisher)
	// 			->find();
		
	// 	$Json = array();
		
	// 	if(!$offer->count()){
	// 		 $Json['errors'] = "Publisher doesn't exists or hasn't offers.";
	// 		 $Json['response'] = false;
	// 	}
		
	// 	$return = array();
		
	// 	foreach ($offer as $single) {

	// 		$ar = $single->toArray();
	// 		$tgs = $single->getTags();
	// 		$ar['Tag'] ='';
	// 		foreach ($tgs as $value) {
	// 			foreach(\TagQuery::create()->filterById($value->getId())->find() as $t){
	// 				$ar['Tag'] .= $t->getName().', ';
	// 			}
	// 		}
	// 		array_push($return, $ar);
	// 	}

	// 	if(!isset($Json['response'])) $Json['response'] = true;
	// 	$Json['body'] = $return;
	// 	return $Json;
		
	// }
	// 
	// 
	/**
	 *
	 * @api {get} /offers single
	 * @apiName single
	 * @apiGroup Offers
	 * 
 	 * @apiDescription Per ottenere l'offerta specifica di un utente. 
 	 *
 	 * NB: allo stato attuale e' sufficiente utilizzare il metodo SEARCH, secondo l'url http://localhost/api_offerte/public_html/api/offers?Publisher={{Publisher}}&type=search&Id=88
	 * 
	 * @apiParam {String} 		type 		metodo da chiamare
	 * @apiParam {Integer}  	Publisher 	id dell'offerente
	 * @apiParam {Integer}  	Id 			id dell'offerta
	 *
	 * @apiParamExample {url} Request-Example:
	 * http://localhost/api_offerte/public_html/api/offers?Publisher=37&Id=31&type=single
	 *
	 * @apiUse MyResponse
	 * 
	 */
	// protected function single($data){

	// 	$offer = \OfferQuery::create()
	// 			->filterByPublisher($data->Publisher)
	// 			->filterById($data->Id)
	// 			->find();
		
		
	// 	$return = array();
		
	// 	foreach ($offer as $single) {
			
	// 		// raccolgo tutta la riga della tabella
	// 		$ar = $single->toArray();

	// 		// aggiungo la lista dei tag
	// 		$tgs = $single->getTags();// doppia s!
	// 		$ar['Tag'] ='';
	// 		foreach ($tgs as $value) {
	// 			foreach(\TagQuery::create()->filterById($value->getId())->find() as $t){
	// 				$ar['Tag'] .= $t->getName().', ';
	// 			}
	// 		}
	// 		array_push($return,  $ar);
	// 	}

	// 	return array('body'=>$return, 'response'=>true);
	// }
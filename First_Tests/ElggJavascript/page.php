Pagina di esempio: contiene l'inserimento di una immagine

- ho javascript inline
- posso caricare script in elgg sia con load che con elgg_require:
	
		elgg_load_js('jquery');
	
		elgg_require_js('foowd_utility/use_crop');	

	in particolare lo script 'foowd_utility/use_crop.js' si trova in 

	foowd_utility/views/default/js/foowd_utility/use_crop.js

gli script di esempio si trovano in questa directory;

<?php

$entity = $vars['entity'];
unset($vars['entity']);
// var_dump(elgg_get_site_url ());
// var_dump(elgg_normalize_url("action/file/download"));
// var_dump($_SERVER);

// return;
var_dump($vars);

$src = $vars['dir'].'/'.$vars['files']['image']['name'];
$src = str_replace('\\','/', $src);

var_dump($src);
var_dump(str_replace('\\','/',__FILE__) );

// metodo macchinoso ma necessario per caricare l'immagine come file e non come url
$image = $src;
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// Echo out a sample image
echo '<center>Seleziona l\'area da ritagliare.<div><img id="sorgente" src="' . $src . '" style="width:300px;"></div></center>';
// echo '<img src="' . elgg_get_site_url().'mod/foowd_utility/actions/foowd_utility/37/06012011297.jpg" style="width:300px;">';

echo '<div id="selector"></div>';

elgg_load_js('jquery');
// load from view
// elgg_require_js('foowd_utility/use_crop');
?>

<div id="crop">
	<input type="hidden" name="crop['x1']" value="" />
	<input type="hidden" name="crop['y1']" value="" />
	<input type="hidden" name="crop['x2']" value="" />
	<input type="hidden" name="crop['y2']" value="" />    
</div>

<?php echo elgg_view('input/submit', array('value' => elgg_echo('upload'))); ?>

<!-- <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" /> -->
<!-- Vendor Style Libraries -->
  <script type="text/javascript" src="<?php echo elgg_get_site_url ();?>mod/foowd_utility/test/test.js"></script>
    <link href="<?php echo elgg_get_site_url ();?>mod/foowd_utility/test/imgareaselect/css/imgareaselect-default.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo elgg_get_site_url ();?>mod/foowd_utility/test/imgareaselect/scripts/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo elgg_get_site_url ();?>mod/foowd_utility/test/imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>


<!-- <canvas id="myCanvas" width="500" height="400"></canvas> -->
<script>
// convenzioni:
// gli oggetti e le variabili globali sono precedute dal $
// le costanti sono precedute da _
// i nomi delle classi iniziano con lettera maiuscola



"use strict";

/////////////////////////////////
// oggetti e variabili globali //
/////////////////////////////////

// immagine concreta
var $img = new Image();
$img.src = document.getElementById('sorgente').getAttribute("src");

// finestre oggetti preview associati alla finestre
var $preWindos = [];

// css
var $margin = '20px';

// oggetto globale che utilizzo solo in una funzione
var scale = {
	setScale : function(num){
		this.w = Math.round(num*scale.x);
		this.h = Math.round(num*scale.y);
		this.k = Math.min(scale.x, scale.y);
		this.l = Math.min(scale.w, scale.h);
	},

	setL : function(l1,l2){
		this.l = Math.min(l1, l2);
	}
};


// inizializzo tutto dopo aver caricato l'immagine
$img.onload = function() {
	// alert(this.width);
	start();
	// $('img[id^="sorgente-"]').parent().css({
	// 	border: '2px solid blue',
	// 	display: 'inline-box'
	// });
};


///////////////////////////////////////////////////////////////////
// inizilizzazione:                                              //
// imposto le finestre e la funzione imgAreaSelect, con callback //
///////////////////////////////////////////////////////////////////
function start(){
	
	// setto la scala: il valore piu piccolo corrisponde a 1 e l'altro scala in proporzione
	// uso il piu piccolo in quanto sto usando l'overflow
	var decimals = 100000; // non penso di avere immagini che superino scale dei 1000px
	if($img.width >= $img.height){
		scale.x = Math.round(decimals * $img.width/$img.height)/decimals;
		scale.y = 1;
	}else{
		scale.x = 1;
		scale.y = Math.round(dcimals * $img.height/$img.width)/decimals;
	}


	// imposto la finestra di riferimento e prendo la sua sorgente
	var div = $('img#sorgente');
	var src = div.attr('src');
	
	// costruisco le finestre di preview
	scale.setScale(100);
	$preWindos.push(new PrevWindow('small', div , scale ));

	scale.setScale(250);
	$preWindos.push(new PrevWindow('medium', div , scale ));


    // imposto i dati per l'inizializzazione dello script di "crop"
    scale.setL(div.width(), div.height());
    div.imgAreaSelect({ aspectRatio: '1:1', handles: true ,onSelectChange: preview ,  x1:0,y1:0,x2:scale.l, y2:scale.l});
}

/**
 * classe che rappresenta la finestra di zoom
 * 
 * @param  {[type]} size      small, medium, etc
 * @param  {[type]} div       il selettore jquery del box di crop
 * @param  {[type]} scale 	  classe che contiene i parametri delle scale
 * @return {[type]}           [description]
 */
var PrevWindow = function(size ,div, scale){
	// dimensioni immagine di crop
	this.x = scale.w;
	this.y = scale.h;
	 
	
	// identificativo del selettore
	var box = div.attr("id") + '-' + size;
	var src = div.attr("src");
	// titolo della finestra

	// creo la preview
	// ho il box prev-container che contiene il titolo e il div con dentro il tag img,
	// in particolare il div con tag img mi fa da preview, pertanto esso per visualizzare l'immagine non deve contenere altro
	var Jpre = $('<div><img id="'+box+'" src="'+src+'" style="width:'+scale.w+'px; height:'+scale.h+'px;" /><div>')
	    .css({
	        // position: 'relative',
	        overflow: 'hidden',
	        width: scale.l+'px',
	        height: scale.l+'px',
	        // margin : $margin,
	        // 'float': 'left'
	    })
	    // .prepend(title)
	    // uso parent() perche' li inserisco dopo il div che contiene l'immagine, e non dopo l'immagine stessa
	    .insertAfter(div.parent());
	 // racchiudo tutto in un box che non ha proprieta
	 Jpre.wrap('<div class=\'prev-container\'></div>');
	 var title = '<div style="margin-top: 5px; padding: 2px; background-color: rgba(70, 144, 214, 0.8);">Preview '+size+'</div>';
	 Jpre.parent().css({'float': 'left', position:'relative', margin: $margin}).prepend(title);


	// selettore jquery: DEVE essere inserito solo dopo aver creato l'oggetto DOM
	this.divj = $('#' + box); 
	// console.log(this.divj)


	// lunghezza minima, ovvero il lato della preview
	this.k = Math.min(this.x, this.y);

	// modifico la preview
	this.draw = function(img, selection){
		// ratio rappresenta la %di zoom rispetto alle dimensioni originali
		// se zoommo di 1/3 (ovvero la selezione rispetto alle dimensioni originali)
		// allora l'immagine della finestra di preview devono essere triplicate (scleX e scale Y)
		
		var ratiox = selection.width / img.width;
		var ratioy = selection.height / img.height;

	    var scaleX = this.k / (ratiox || 1);
	    var scaleY = this.k / (ratioy || 1);
	  
	  	// adatto l'immagine di previwe
	    this.divj.css({
	        width: Math.round(scaleX) + 'px',
	        height: Math.round(scaleY) + 'px',
	        marginLeft: '-' + Math.round( scaleX * selection.x1 / img.width ) + 'px',
	        marginTop: '-' + Math.round( scaleY * selection.y1 / img.height ) + 'px'
	    });			
	};
}


// immagine concreta, e oggetto coordinate della selezione, ovvero x1, 
function preview(img, selection) {

	// disegno le previews
	for(var i in $preWindos){
		$preWindos[i].draw(img, selection);
	}
	
	// riempio il form
	var normalized = {};
	normalized.x1 = selection.x1 / img.width;
	normalized.x2 = selection.x2 / img.width;
	normalized.y1 = selection.y1 / img.height;
	normalized.y2 = selection.y2 / img.height;
	// arrotondo a 5 decimali
	for (var property in normalized) {
	    // if (object.hasOwnProperty(property)) {
	        // alert(property)
	        normalized[property] = Math.round(100000 * normalized[property])/100000;
	        // seleziono l'input che matcha la proprieta', cosi' riempio il form normalizzato
	        $('input[name*='+property+']').val(normalized[property]);
	    // }
	}

}

</script>

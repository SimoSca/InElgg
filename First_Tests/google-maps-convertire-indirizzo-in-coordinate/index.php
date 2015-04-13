<?php
/***************************
Trovate questo e altri script su http://www.manuelmarangoni.it , descritti e commentati nei dettagli.

Autore: Manuel Marangoni
Data messa online dello script: 3 marzo 2012

Lo script permette di caricare una google maps e di settare l'indirizzo (latitudine e longitudine) trascinando il marker o cliccando su un punto qualsiasi della mappa. Inoltre, dà la possibilità di convertire un indirizzo fisico in coordinate con la semplice pressione di un tasto. Una volta recuperate le coordinate in questo modo, saranno aggiornati anche gli input che contengono le nuove latitudine e longitudine. 

Si presuppone la presenza di un database mysql e di una tabella chiamata utenti che conterrà almeno questi campi:
- id (autoincrementale e univoco)
- indirizzo
- citta
- cap
- provincia
- lat : conterrà la latitudine dell'indirizzo
- lng : conterrà la longitudine dell'indirizzo

Da notare che i quattro campi dell'indirizzo potrebbero essere riuniti in un unico campo (va modificato di conseguenza lo script). Qui sono distinti per questione di efficienza.

Assumiamo di prendere il primo utente (id=1) e di estrarre inizialmente i suoi dati dal database.
***************************/

include("config.inc.php"); //parametri di connessione al database
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="keywords" content="" />
	<meta name="description" content="Google Maps - Selezione indirizzo con trascinamento del marker" />
	<title>Google Maps - Selezione indirizzo con trascinamento del marker</title>
	
	<meta http-equiv="Pragma" content="no-cache" />

	<meta content="no-cache" http-equiv="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="jquery.js"></script> <!-- funzioni base di jquery -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> <!-- api di google maps -->
    <script type="text/javascript" src="google_maps.js"></script> <!-- file js da me creato, con le funzioni per lo script -->
			
</head>


<body>
	
	<?php
	if(isset($_POST['salva'])){
		$q="update utenti set indirizzo='".$_POST['indirizzo']."', citta='".$_POST['citta']."', cap='".$_POST['cap']."', provincia='".$_POST['provincia']."', lat='".$_POST['lat']."', lng='".$_POST['lng']."' where id=1";
		mysql_query($q, $db);	
	}
	
	
	//assegno all'array $row il valore dei post passati (utile in caso di ritorno errori) o, in alternativa, i valori dei campi presi dal database
	if(isset($_POST['salva']))
		$row=$_POST;
	else{
		$q="select * from utenti where id=1";
		$query=mysql_query($q, $db);
		$row=mysql_fetch_array($query);
	}
	
	?>
	
	
	<div id="istruzioni"><span style="font-weight:bold;">Istruzioni:</span> all'apertura della pagina si usano le coordinate che abbiamo inserito di default (indirizzo di Verona, Italia).<br />
	Inserire un indirizzo valido nei quattro input (indirizzo, città, cap e provincia): è il classico indirizzo da inserire in Google Maps, qui sezionato. Cliccare quindi su "Ricarica la mappa" per visualizzare l'indirizzo scelto sulla mappa. In caso di indirizzo non valido, apparirà un alert di errore.<br />
	Trascinare il marker o cliccare su un punto qualsiasi della mappa per prendere in automatico le nuove latitudine e longitudine (cambierà il valore degli input relativi).<br />
	</div>
	<div class="clear"></div>
	
	
	<form action="" method="post" enctype="multipart/form-data" id="form">
		
        <div class="blocco">
            <div class="nome_campo">Indirizzo</div>
            <input type="text" name="indirizzo" id="indirizzo" value="<?php if(isset($row['indirizzo'])) echo $row['indirizzo'];?>" class="input" />
        </div>
		
		<div class="blocco">
			<div class="nome_campo">Città</div>
			<input type="text" name="citta" id="citta" value="<?php if(isset($row['citta'])) echo $row['citta'];?>" class="input" />
		</div>
		
		<div class="clear"></div>
		
		<div class="blocco">
			<div class="nome_campo">CAP</div>
			<input type="text" name="cap" id="cap" value="<?php if(isset($row['cap'])) echo $row['cap'];?>" class="input" />
		</div>
		
		<div class="blocco">
			<div class="nome_campo">Provincia</div>
			<input type="text" name="provincia" id="provincia" value="<?php if(isset($row['provincia'])) echo $row['provincia'];?>" class="input" />
		</div>
		
		<div class="clear"></div>
		
        <input type="button" value="Ricarica la mappa" class="input" onclick="codeAddress( $('#indirizzo').val()+', '+$('#citta').val()+' '+$('#cap').val()+' '+$('#provincia').val())">
		
		<div class="clear"></div>
		
		<?php 
		// se lat e lng sono state salvate su db, vengono prese di default;
		if($row['lat']!="" and $row['lng']!=""){?>
			<script type="text/javascript">
			var lat=' <?php echo $row["lat"]; ?>';
			var lng=' <?php echo $row["lng"]; ?>';
			$(window).load(function(){
				initialize();
			});
			</script>
		<?php
		
		// se non esistono, centro la  mappa in base all'indirizzo
		}elseif(isset($row['citta']) and $row['citta']!=''){?>
			<script type="text/javascript">
				var address="<?php echo $row['indirizzo'].", ".$row['citta']." ".$row['provincia']; ?>";
				$(window).load(function(){
					initialize();
					codeAddress(address);
				});
			</script>
		<?php
		
		// se non esiste nemmeno l'indirizzo, setto la mappa in un indirizzo di default
		}else{?>
			<script type="text/javascript">
				var lat='0';
				var lng='0';
				var address="verona, italia";
				$(window).load(function(){
					initialize();
					codeAddress(address);
				});
			</script>
		<?php }?>
		
		<div id="map"></div>
		<div class="clear"></div>
		
		Latitudine <input type="text" name="lat" value="<?php if($row['lat']!="") echo $row['lat'];?>" id="coord_lat" class="input" />
		<span style="margin-left:10px;">Longitudine <input type="text" name="lng" value="<?php if($row['lng']!="") echo $row['lng'];?>" id="coord_lng" class="input" /></span>
		
		<br /><br />
		<input type="submit" name="salva" value="Salva coordinate nel database" />
	
	</form>


</body>
</html>
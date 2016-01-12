<?php
echo '<label>TAGS:</label><br/>';  
	?>
	<!-- mi serve js perche' la validita' dei tags la testo prima del submit -->
	<noscript><div style="color:red;">Mi dispiace, ma per inserire i tags devi avere abilitato javascript.</div></noscript>
   <textarea id="tags" name="params[tags]" rows="<?php echo $row; ?>" cols="50"><?php echo $value; ?></textarea>
   <div style="font-style: italic; font-size:11px;">Puoi inserire singole parole separate da virgola e andare a capo.</div>
   <?php //echo elgg_view('input/longtext', array('name'=>'params[tags]') );?>
   <textarea id="tagss" name="params[tagss]" rows="<?php echo $row; ?>" cols="50"><?php echo $value; ?></textarea>



<script>

$(function(){
	// $('#tags').css('overflow', 'hidden');
  $('#tags').on('keyup', function(){
    var offset = this.offsetHeight - this.clientHeight;
    $(this).css('height', 'auto').css('height', this.scrollHeight + offset);
  });
  // faccio qui un check dei tags
  $('form').on('submit', function(evt){
  	var tags = $('#tags').val();

  	var check = true;

  	// elimino le linee vuote
  	tags = tags.replace(/^\s*[\r\n]/gm,'');
  	// elimino la virgola finale e la riga vuota
  	// tags = tags.replace(/,\n$/g,'').replace(/^$/, '');
  	$('#tags').val(tags);
  	
  	tags = tags.split(/\r?\n/);
  	for(var i in tags){

  		line = tags[i];
  		console.log(line);

  		if(!line.match(/, +$/)) tags[i] += ',';

  		if(i == tags.length-1) tags[i] = tags[i].replace(/,$/g, "");
  		console.log(JSON.stringify(tags[i]));

  		if(line.match(/[\u00E0-\u00FC]/gi)){
  			alert('lettere accentate vietate');
  			check = false;
  		}

  		if(line.match(/\w+ +\w+/g)){
  			alert('tra due parole DEVI inserire la virgola');
  			check = false;
  		}
  		// elimino le virgole consecutive e gli spazi finali tra una virgola e la fine linea
  		tags[i] = tags[i].replace(/,+ +,+/g, '').replace(/ +$/g,'');

  		
  	}

  	// salvo i cambiamenti
  	$('#tags').val(tags.join(" \n"));
  	// check = false;
  	if(!check) evt.preventDefault();


  })
});

</script>
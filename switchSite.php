<html>
<head>
<!-- color site: http://paletton.com/#uid=1000u0kllllaFw0g0qFqFg0w0aF -->
<style>
body{
  background-color:   #A26433;
  width: 400px;
  margin: auto; 
}

form, #response, #actual, #redirect{
  margin-top: 20px;
  padding: 15px;
  width: 100%;
  background-color: #909E31;
}
input[type="submit"]{
  margin-top: 20px;
}
#response{
  background-color: #1F625F;
}
#actual{
  background-color:   #61236A;
}
#redirect{
  background-color: #909E31;
}

</style>
</head>
<body>

<?php
$CONFIG = new stdClass;

/**
 * The database username
 */
$CONFIG->dbuser = 'ElggAdmin';

/**
 * The database password
 */
$CONFIG->dbpass = '99elggadmin';

/**
 * The database name
 */
$CONFIG->dbname = 'elggdb';

/**
 * The database host.
 *
 * For most installations, this is 'localhost'
 */
$CONFIG->dbhost = 'localhost';

/**
 * The database prefix
 *
 * This prefix will be appended to all Elgg tables.  
 */
$CONFIG->dbprefix = 'elgg_';

# gestione delle eccezioni in fase di connessione con PDO

// collegamento al database
$col = 'mysql:host='.$CONFIG->dbhost.';dbname='.$CONFIG->dbname;

// blocco try per il lancio dell'istruzione
try {
  // connessione tramite creazione di un oggetto PDO
  $db = new PDO($col , $CONFIG->dbuser, $CONFIG->dbpass);
}
// blocco catch per la gestione delle eccezioni
catch(PDOException $e) {
  // notifica in caso di errorre
  echo 'Attenction: '.$e->getMessage();
}

$file = $db->query("SELECT * FROM {$CONFIG->dbprefix}datalists WHERE name='path'");

while($row = $file->fetch(PDO::FETCH_ASSOC)){  
    //var_dump($row);  
    echo '<div id="actual">Versione attuale: '. $row['value'] .'</div>';
} 

/**
 * Function to switch the elgg database configurations (the only I need to change elgg version for testing)
 *
 * see http://learn.elgg.org/en/latest/admin/duplicate-installation.html
 * 
 * @param  string $version the Elgg versio I would switch to
 * @return void
 */

function switchTest($version, $db, $CONFIG){

  // lancio di una transazione con PDO
  $db->beginTransaction();

  // change installation path
  $sql[0] = "UPDATE {$CONFIG->dbprefix}datalists
     SET value = 'C:/wamp/www/ElggProject/elgg-{$version}/'
     WHERE name = 'path'";
  
  // change the data directory
  $sql[1] = "UPDATE {$CONFIG->dbprefix}datalists
     SET value = 'C:/wamp/www/ElggProject/elgg-{$version}-data/'
     WHERE name = 'dataroot'";

  // change the site url
  $sql[2] = "UPDATE {$CONFIG->dbprefix}sites_entity
     SET url = 'http://localhost/ElggProject/elgg-{$version}/'";

  // about data directory:
  // if doesn't exists, than elgg recreate this!
  
  //change the filestore data directory
  $sql[3] = "UPDATE {$CONFIG->dbprefix}metastrings
    SET string = 'C:/wamp/www/ElggProject/elgg-{$version}-data/'
    WHERE id = (
       SELECT value_id
       FROM {$CONFIG->dbprefix}metadata
       WHERE name_id = (
          SELECT *
          FROM (
             SELECT id
             FROM {$CONFIG->dbprefix}metastrings
             WHERE string = 'filestore::dir_root'
          ) as ms2
       )
       LIMIT 1
    )";

  foreach ($sql as $query) {
    $sql = $db->exec($query);
    if(is_bool($sql) && !$sql) var_dump($query);
  }


  // applicazione delle modifiche
  $db->commit();

// at the end, to regenerate cached data, make sure to run http://my_site_elgg_url/upgrade.php
// here i can use a location redirect
}

@$vers = $_POST['version'];
if(isset($vers)){
  switchTest($vers, $db, $CONFIG);
  ?>
  <div id="response">Impostato Elgg per eserguire la versione <b><?php echo $vers; ?></b></div>
  <!-- <meta HTTP-EQUIV="REFRESH" content="5; url=http://localhost/ElggProject/elgg-'.$vers.'/upgrade.php"> -->
  <div id="redirect">Entro <span id="countdown"></span> secondi verrai reindirizzato alla home prestabilita</div>
  <!-- reindirizzare serve per aggiornare la cache data presente nella directory data che ho impostato -->
  
  <script type="text/javascript">
  (function () {
      var timeLeft = 5,
          cinterval;
      var el = document.getElementById('countdown');
      el.innerHTML = timeLeft;

      var timeDec = function (){
          timeLeft--;
          el.innerHTML = timeLeft;
          if(timeLeft === 0){
              clearInterval(cinterval);
              // nota il codice php dentro alla stringa!
              location.href = "http://localhost/ElggProject/elgg-<?php echo $vers ?>/upgrade.php";
          }
      };

      cinterval = setInterval(timeDec, 1000);
  })();
  </script>
  
  <?php
}else{
?>
  <div id="response">Da qui puoi impostare una versione di Elgg</div>
  <!-- with type button, I can multiple select, but is inconsistent with my purpose -->
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <fieldset>
    <legend>Sceli la versione da impostare nel DB di Elgg</legend>
        <input type="radio" name="version" value="1.9.7"/>1.9.7 <br/>
        <input type="radio" name="version" value="1.10.3"/>1.10.3<br/>
    <input type="submit">
  </fieldset>
  </form>

</body>
</html>
<?php

}

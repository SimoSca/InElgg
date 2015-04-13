<?php
/******************
Parametri di configurazione del database
******************/
$db_host="localhost";
$db_user="root";
$db_password="kogamysql";
$database1="test";

$db = mysql_connect($db_host, $db_user, $db_password);
if ($db == FALSE)
	die ("Errore nella connessione db1. Verificare i parametri nel file config.inc.php");
mysql_select_db($database1, $db)
	or die ("Errore nella selezione del database1. Verificare i parametri nel file config.inc.php");

?>

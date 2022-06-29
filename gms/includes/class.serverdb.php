<?php
session_start();
$site = 'https://www.syntaxonline.nl/portal/gms';
$site2 = 'https://www.syntaxonline.nl/portal/';

$database['user'] = 'root';
$database['password'] = 'Marco2001@';
$database['database'] = 'essentialsmode';
$database['host'] = '127.0.0.1';


$serverdb = new mysqli($database['host'], $database['user'], $database['password'], $database['database']);

if ($serverdb->connect_error) {
    echo "Whoops, Geen server database connectie! Meld dit aan een Administrator!<br>";
    echo "Error:(" . $db->connect_error . "): " . $db->connect_error;
}
//error_log('class.serverdb.php: '.mysqli_error($serverdb) . "\n", 3, "error/error.log");


?>

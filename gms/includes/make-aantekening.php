<?php
include_once("class.database.php");

$aantekening = $db->real_escape_string($_POST['aantekening']);
$mid = $db->real_escape_string($_POST['mid']);

$db->query("INSERT INTO gms_melding_aantekening (mid, aantekening) VALUES ('".$mid."', '".$aantekening."')");
//error_log('make-aantekening.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

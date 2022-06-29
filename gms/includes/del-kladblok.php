<?php
include_once("class.database.php");

$id = $db->real_escape_string($_GET['id']);

$db->query("DELETE FROM gms_melding_aantekening WHERE id = '" . $id . "'");
//error_log('delete-kladblok.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

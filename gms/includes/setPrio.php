<?php
include_once("class.database.php");
$prio = $db->real_escape_string($_GET['prio']);
$mid = $db->real_escape_string($_GET['mid']);

$db->query("UPDATE gms_meldingen SET prio = '".$prio."' WHERE id = '".$mid."'");
//error_log('setPrio.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

<?php
include_once("class.database.php");

$mid = $db->real_escape_string($_GET['mid']);

$deleted = $db->query("DELETE FROM gms_meldingen WHERE id = '".$mid."'");

if($deleted){

    $getkoppeld = $db->query("SELECT * FROM gms_melding_koppel WHERE mid = '".$mid."'");
    while($fetchKoppeld = $getkoppeld->fetch_array()){
        $db->query("UPDATE gms_ingemeld SET status = '1' WHERE uid = '".$fetchKoppeld['uid']."'");
    }

    $deleteKoppels = $db->query("DELETE FROM gms_melding_koppel WHERE mid = '".$mid."'");
}
//error_log('delete-melding.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

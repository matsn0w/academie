<?php
include_once('../includes/class.database.php');
$titel = $db->real_escape_string($_GET['titel']);
$uid = $db->real_escape_string($_GET['uid']);
$bericht = $db->real_escape_string($_GET['bericht']);


        $updateQuery = $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['eenheid']."', '".$titel."', '".$bericht."', '0', NOW())");

        if($updateQuery){
            echo 'Succes';
        }else{
            echo 'Error';
        }
//error_log('set-log.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

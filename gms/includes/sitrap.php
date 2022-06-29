<?php
include_once("class.database.php");
$sitrap = $db->real_escape_string($_GET['sitrap']);
$uid = $userFetch['id'];

if(empty($sitrap)){
    echo 'Je hebt niks ingevult?';
}else{
    $titel = $userFetch['username'].' heeft een sitrap ingevult';
    $bericht = '<strong>Sitrap:</strong> '.$sitrap;
    $query = $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");

    if($query){
        echo 'Succes!';
        echo $sitrap;
    }else{
        echo 'Er ging iets mis!';
    }
}
//error_log('sitrap.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

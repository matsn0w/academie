<?php
include_once("class.database.php");
$getKoppel = $db->query("SELECT * FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");
$fetchKoppel = $getKoppel->fetch_assoc();

$getKlad = $db->query("SELECT * FROM gms_melding_aantekening WHERE mid = '".$fetchKoppel['mid']."'");
while($fetchKlad = $getKlad->fetch_array()){

    echo $fetchKlad['aantekening'].'<br />';

}
//error_log('show-kladblok.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

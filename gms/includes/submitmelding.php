<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once("class.database.php");
$mid = $db->real_escape_string($_GET['mid']);
$uid = $db->real_escape_string($_GET['uid']);

if(empty($mid)){
    echo 'Geen Incidenten ID ingevult!';
}else{

    $getIngemeld2 = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$uid."' ");
    $fetchIn = $getIngemeld2->fetch_assoc();

    $db->query("INSERT INTO gms_melding_koppel (mid, uid, naam, roepnummer, eenheid) VALUES (
    '".$mid."',
    '".$uid."',
    '".$fetchIn['naam']."',
    '".$fetchIn['roepnummer']."',
    '".$fetchIn['eenheid']."'
    )");
    $db->query("UPDATE ingemeld SET status = '5' WHERE uid = '".$uid."'");


}
//error_log('submitmelding.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

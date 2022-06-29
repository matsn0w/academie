<?php
include_once("class.database.php");
$uid = $db->real_escape_string($_GET['uid']);
$mkid = $db->real_escape_string($_GET['incid']);

$query = $db->query("UPDATE gms_ingemeld SET groep_id = '".$mkid."' WHERE uid = '".$uid."'");
if($query){
    echo 'suc6';
}else{
    echo'error';
}
//error_log('gesprek-mover.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

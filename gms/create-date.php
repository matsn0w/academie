<?php
include_once('includes/class.database.php');
$error = 0;
$getDate = $db->query("SELECT * FROM gms_datums");
while($fetchDate = $getDate->fetch_assoc()){

$date = date('Y-m-d');

if($fetchDate['date'] == $date){
    $error = 1;
}else{
    $error = 2;
}
}
if($error == 2){
    $currentdate = date('Y-m-d');
    $db->query("INSERT INTO gms_datums (date) VALUES ('".$currentdate."')");
    echo 'Aangemaakt';
}elseif($error == 1){
    echo 'bestaat al';
}elseif($error == 0){
    echo 'Niet ver gekomen';
}else{
    echo 'Onbekend';
}
    

?>
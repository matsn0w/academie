<?php
include_once("class.database.php");
    $melding = $db->real_escape_string($_POST['melding']);
    $meldinginfo = $db->real_escape_string($_POST['meldinginfo']);
    $locatie = $db->real_escape_string($_POST['locatie']);
    $prio = $db->real_escape_string($_POST['prio']);
    $district = $db->real_escape_string($_POST['district']);

    if(empty($melding)){
        echo 'Geen melding ingevult!';
    }else{
        $db->query("INSERT INTO gms_meldingen (mkid,melding,meldinginfo,locatie,prio,timestamp,door,status, porto) VALUES ('".$ingemeldFetch['groep_id']."','".$melding."', '".$meldinginfo."', '".$locatie."', '".$prio."', NOW(), '0', '0', 'NONE')");

    }
    //error_log('makemelding.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

<?php
include_once("class.database.php");
if(isset($_GET['type'])){
    $type = $db->real_escape_string($_GET['type']);
    if($type == 1){
        $type1 = 'Spraakaanvraag';
        $type2 = '<div class="spraakaanvraag">['.$ingemeldFetch['roepnummer'].'] doet een spraakaanvraag!</div>';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 2){
        $type1 = 'URGENT';
        $type2 = '<div class="assistentiecollega">['.$ingemeldFetch['roepnummer'].'] doet een spraakaanvraag <b>URGENT</b>!</div>';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time, urgent) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW(), 'ja')");
    }elseif($type == 3){
        $type1 = 'Code 4';
        $type2 = '<div class="koppelaanvraag">['.$ingemeldFetch['roepnummer'].'] meld Code 4!</div>';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 4){
        $type1 = 'Informatie opvragen';
        $type2 = '['.$ingemeldFetch['roepnummer'].'] wilt informatie opvragen!';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 5){
        $type1 = 'Noodknop!';
        $type2 = '<div class="assistentiecollega">['.$ingemeldFetch['roepnummer'].'] <b>Noodknop!</b></div>';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time, urgent) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW(), 'ja')");
    }elseif($type == 6){
        $type1 = 'Verzoek Politie';
        $type2 = '['.$ingemeldFetch['roepnummer'].'] wilt politie ter plaatse!';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 7){
        $type1 = 'Verzoek Brandweer';
        $type2 = '['.$ingemeldFetch['roepnummer'].'] wilt brandweer ter plaatse!';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 8){
        $type1 = 'Verzoek Ambulance';
        $type2 = '['.$ingemeldFetch['roepnummer'].'] wilt ambulance ter plaatse!';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }elseif($type == 9){
        $type1 = 'Verzoek sitrap';
        $type2 = '['.$ingemeldFetch['roepnummer'].'] wil een sitrap geven';
        $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$type1."', '".$type2."', '0', NOW())");
    }
    //error_log('spraak.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
}
?>

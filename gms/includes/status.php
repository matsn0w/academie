<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

$Ingemeldq = $db->query("SELECT * FROM gms_ingemeld");
$Ingemeld = $Ingemeldq->fetch_assoc();

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$userFetch['id']."'");
$userPortoID = $userPortoIDq->fetch_assoc();

if(isset($_GET['status'])){
    $status = $db->real_escape_string($_GET['status']);
    $db->query("UPDATE gms_ingemeld SET status = '".$status."' WHERE uid = '".$userFetch['id']."'");
    if($status == 1){
        $status1 = 'Beschikbaar';
        $status2 = '['.$ingemeldFetch['roepnummer'].'] Is beschikbaar voor meldingen!';
        $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['id']."', '".$status1."', '".$status2."', '0', NOW())");
        $db->query("DELETE FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");
        $Incidentengroepq = $db->query("SELECT * FROM gms_incidentgroepen WHERE id = '".$ingemeldFetch['groep_id']."'");
        while($Incidentengroep = $Incidentengroepq->fetch_assoc()){
            if($Incidentengroep['default_porto']){
              $ChannelName = $Incidentengroep['default_porto'];

              foreach ($tsServer->channelList() as $tsChannel) {
                try{
                  if($tsChannel['channel_name'] == $ChannelName){
                    $tsServer->clientGetByName($userPortoID['teamspeak'])->move($tsChannel->GetId());
                  }
                }
                catch(TeamSpeak3_Exception $e)
                {
                // print the error message returned by the server
                echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.$e->getMessage().'</div>';
                }
              }
            }
            else {
              echo "er is iets verkeerd gegaan! Error 1.";
            }
        }
    }elseif($status == 2){
        $status1 = 'Ter plaatse';
        $status2 = '['.$ingemeldFetch['roepnummer'].'] is Ter plaatse';
        $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");
    }elseif($status == 3){
        $status1 = 'Transport';
        $status2 = '['.$ingemeldFetch['roepnummer'].'] doet een Transportje';
        $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");
    }elseif($status == 4){
        $status1 = 'Tijdelijk';
        $status2 = '['.$ingemeldFetch['roepnummer'].'] is tijdelijk uit game!';
        $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['id']."', '".$status1."', '".$status2."', '0', NOW())");
        $ChannelName = $ChannelAFK;

        foreach ($tsServer->channelList() as $tsChannel) {
          try{
            if($tsChannel['channel_name'] == $ChannelName){
              $tsServer->clientGetByName($userPortoID['teamspeak'])->move($tsChannel->GetId());
            }
          }
          catch(TeamSpeak3_Exception $e)
          {
          // print the error message returned by the server
          echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.$e->getMessage().'</div>';
          }
        }
    }

}
//error_log('status.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

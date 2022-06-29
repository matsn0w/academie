<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$userFetch['id']."'");
$userPortoID = $userPortoIDq->fetch_assoc();

    $status1 = 'Tijdelijk!';
    $status2 = $userFetch['username'].' ['.$ingemeldFetch['roepnummer'].'] gaat tijdelijk (Code 9) uit-game!';

    $db->query("UPDATE gms_ingemeld SET status = '4' WHERE uid = '".$userFetch['id']."'");
    $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen,time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."','".$userFetch['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");
    $db->query("DELETE FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");

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
    //error_log('tijdelijk.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

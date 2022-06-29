<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

$district = $db->real_escape_string($_GET['district']);
$uid = $db->real_escape_string($_GET['uid']);

$Incidentengroepa = $db->query("SELECT * FROM gms_incidentgroepen");
$Incidentengroepb = $Incidentengroepa->fetch_assoc();

$Ingemeldq = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$uid."'");
$Ingemeld = $Ingemeldq->fetch_assoc();

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$uid."'");
$userPortoID = $userPortoIDq->fetch_assoc();


$status1 = 'Beschikbaar';
$status2 = '['.$Ingemeld['roepnummer'].'] Is beschikbaar voor meldingen!';
$query = $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen,time) VALUES ('".$uid."', '".$Ingemeld['groep_id']."','".$Ingemeld['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");
$query .= $db->query("UPDATE gms_ingemeld SET status = '1', district = '".$district."' WHERE uid = '".$uid."'");
    $Incidentengroepq = $db->query("SELECT * FROM gms_incidentgroepen WHERE id = '".$Ingemeld['groep_id']."'");
    while($Incidentengroep = $Incidentengroepq->fetch_assoc()){
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
    //error_log('set-district.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

?>

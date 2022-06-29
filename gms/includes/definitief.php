<?php
include_once('../includes/class.database.php');
require_once('TeamSpeak3/config.php');

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$userFetch['id']."'");
$userPortoID = $userPortoIDq->fetch_assoc();

    $status1 = 'Definitief!';
    $status2 = $userFetch['username'].' gaat definitief (Code 10) uit-game!';

    $huidigdatum = date('Y-m-d');
    $huidigtijd = date('H:i:s');
    $timea = date('Y-m-d H:i:s');

    if(strtotime($timea) >= strtotime($ingemeldFetch['ingemeld_date'])+300){
        $db->query("INSERT INTO gms_aanwezigheid (uid, status, date, time) VALUES
        ('".$userFetch['id']."',
        '1',
        '".$huidigdatum."',
        '".$huidigtijd."')
        ");
    }

    $db->query("INSERT INTO gms_log (uid, groep_id, eenheid, titel, bericht, gelezen, time) VALUES ('".$userFetch['id']."', '".$ingemeldFetch['groep_id']."', '".$ingemeldFetch['eenheid']."', '".$status1."', '".$status2."', '0', NOW())");
    $db->query("DELETE FROM gms_ingemeld WHERE uid = '".$userFetch['id']."'");
    $db->query("DELETE FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");
    $ChannelName = $ChannelAway;

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
    //error_log('definitief.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

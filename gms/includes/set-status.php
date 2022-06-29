<?php
include_once('../includes/class.database.php');
require_once('TeamSpeak3/config.php');

$status = $db->real_escape_string($_GET['status']);
$uid = $db->real_escape_string($_GET['uid']);
$mid = $db->real_escape_string($_GET['mid']);

$Ingemeldq = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$uid."'");
$Ingemeld = $Ingemeldq->fetch_assoc();

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$uid."'");
$userPortoID = $userPortoIDq->fetch_assoc();

if($status == '1' || $status == '2' || $status == '3' || $status == '4' || $status == '9'){

    if($status == '1'){
        $data = 1;
        $Query = $db->query("DELETE FROM gms_melding_koppel WHERE mid = '".$mid."' AND uid = '".$uid."'");
        $Query .= $db->query("UPDATE gms_ingemeld SET status = '".$data."'  WHERE uid = '".$uid."'");
        error_log('set-status.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
        $Incidentengroepq = $db->query("SELECT * FROM gms_incidentgroepen WHERE id = '".$Ingemeld['groep_id']."'");
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
    }elseif($status == '2'){
        $data = 0;
    }elseif($status == '3'){
        $data = 2;
    }elseif($status == '4'){
        $data = 3;
    }elseif($status == '9'){
        $data = 4;
        $db->query("DELETE FROM gms_melding_koppel WHERE mid = '".$mid."' AND uid = '".$uid."'");
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
        $updateQuery = $db->query("UPDATE gms_ingemeld SET status = '".$data."'  WHERE uid = '".$uid."'");

        if($updateQuery){
            echo 'Succes';
        }else{
            echo 'Error';
        }
}else{
    echo 'Er gaat iets fout';

}
//error_log('set-status.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

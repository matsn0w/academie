<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

    $grip = $db->real_escape_string($_POST['grip']);
    $uid = $db->real_escape_string($_POST['uid']);

    $userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$uid."'");
    $userPortoID = $userPortoIDq->fetch_assoc();

    $Ingemeldq = $db->query("SELECT * FROM gms_ingemeld");
    $Ingemeld = $Ingemeldq->fetch_assoc();

    $db->query("UPDATE gms_ingemeld SET status = '1' WHERE uid = '".$uid."'");
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
//error_log('submit-grip.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');
    $uid = $db->real_escape_string($_POST['uid']);

    $userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$uid."'");
    $userPortoID = $userPortoIDq->fetch_assoc();

    $db->query("DELETE FROM gms_ingemeld WHERE uid = '".$uid."'");
    //error_log('denygrip.php: '.mysqli_error($db) . "\n", 3, "error/error.log");

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

?>

<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

$porto_kanaal = $db->real_escape_string($_GET['porto_kanaal']);
$mid = $db->real_escape_string($_GET['mid']);
$uid = $db->real_escape_string($_GET['uid']);

$userKoppelIDq = $db->query("SELECT * FROM gms_melding_koppel WHERE mid = '".$mid."'");
$userKoppelID = $userKoppelIDq->fetch_assoc();

$userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$userKoppelID['uid']."'");
$userPortoID = $userPortoIDq->fetch_assoc();

$db->query("UPDATE gms_meldingen SET porto = '".$porto_kanaal."' WHERE id = '".$mid."'");
//error_log('setPrio.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
$ChannelName = $porto_kanaal;

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

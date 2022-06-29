<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

if(isset($_GET['melding'])){
    $mid = $db->real_escape_string($_GET['melding']);
    $uid = $db->real_escape_string($_GET['uid']);

    $userInfoq = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$uid."'");
    $userInfo = $userInfoq->fetch_assoc();

    $userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$uid."'");
    $userPortoID = $userPortoIDq->fetch_assoc();

    if(empty($mid)){
        echo 'Geen melding ID mee gegeven!';
    }else{
        $update = $db->query("INSERT INTO gms_melding_koppel (mid,uid,naam,roepnummer,eenheid) VALUES ('".$mid."', '".$uid."', '".$userInfo['naam']."', '".$userInfo['roepnummer']."', '".$userInfo['eenheid']."')");
        $update .= $db->query("UPDATE gms_ingemeld SET status = '0' WHERE uid = '".$uid."'");

        $getMeldingKanaal = $db->query("SELECT * FROM gms_meldingen WHERE id = '$mid' ORDER BY id");
        while($fetchMeldingKanaalID = $getMeldingKanaal->fetch_array()){
              $ChannelName = $fetchMeldingKanaalID['porto'];

              foreach ($tsServer->channelList() as $tsChannel) {
                try{
                  if($tsChannel['channel_name'] == $ChannelName){
                    $tsServer->clientGetByName($userPortoID['teamspeak'])->move($tsChannel->GetId());
                  }
                }
                catch(TeamSpeak3_Exception $e)
                {
                // print the error message returned by the server
                echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> <small>koppel-melding</small> '.$e->getMessage().'</div>';
                }
              }
        }
    }
}
//error_log('koppel-melding.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

<?php
require_once('TeamSpeak3.php');
/*
$host = '127.0.0.1';
$nameQuery = 'serveradmin';
$nameNickname = 'Meldkamer';
$password = '7hT1FfuE';
$portQuery = '10011';
$portServer = '9987';

//afk channel (code 9)
$ChannelAFK = 'AFK';
//afk channel (code 10)
$ChannelAway = 'Buitendienst';*/

$host = '192.168.2.108';
$nameQuery = 'serveradmin';
$nameNickname = 'Meldkamer';
$password = 'Syntax2018';
$portQuery = '10011';
$portServer = '9987';

//afk channel (code 9)
$ChannelAFK = 'AFK';
//afk channel (code 10)
$ChannelAway = 'Briefing Room';


try{
$tsServer = TeamSpeak3::factory("serverquery://".$nameQuery.":".$password."@".$host.":".$portQuery."/?server_port=".$portServer."&nickname=".urlencode($nameNickname));
}
catch(TeamSpeak3_Exception $e)
{
// print the error message returned by the server
echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.$e->getMessage().'</div>';
}

?>

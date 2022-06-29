<?php
include_once("class.database.php");

$getKoppel2 = $db->query("SELECT * FROM gms_melding_koppel WHERE uid = '".$userFetch['id']."'");
$fetchKoppel2 = $getKoppel2->fetch_assoc();
    $getMeldingInfo = $db->query("SELECT melding, prio FROM gms_meldingen WHERE id = '".$fetchKoppel2['mid']."'");
    $fetchMeldingInfo = $getMeldingInfo->fetch_assoc();
?>
<script type="text/javascript">
    function play_sound_melding() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'Radio_gms_beschikbaar.wav');
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.load();
        audioElement.play();
    }
</script>
<div onclick="play_sound_melding;">Melding: <?php if($fetchMeldingInfo['melding'] == ''){echo 'Geen';}else{$rest = substr($fetchMeldingInfo['melding'], 0,14);echo $rest."...";}?></div>

                                        <div>Status:
                                        <?php
                                        if($ingemeldFetch['status'] == 0){
                                            echo 'Onderweg';
                                        }elseif($ingemeldFetch['status'] == 1){
                                            echo 'Vrij';
                                        }elseif($ingemeldFetch['status'] == 2){
                                            echo 'TP';
                                        }elseif($ingemeldFetch['status'] == 3){
                                            echo 'Trans';
                                        }elseif($ingemeldFetch['status'] == 4){
                                            echo 'Code 9';
                                        }
                                        ?>
                                      </div>
                                        <div>Urgentie: <?php if($fetchMeldingInfo['prio'] == 'Prio 2B'){echo 'Prio 2';}elseif($fetchMeldingInfo['prio'] == ''){echo 'Geen';}else{echo $fetchMeldingInfo['prio'];} ?></div>

                                        <?php
                                          //error_log('getStatus-eenheid.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
                                         ?>

<?php
include_once("class.database.php");
require_once('TeamSpeak3/config.php');

    $getMeldingen = $db->query("SELECT * FROM gms_meldingen WHERE mkid = '".$ingemeldFetch['groep_id']."' ORDER BY id ASC");
    while($fetchMeldingen = $getMeldingen->fetch_assoc()){

?>
<div class="melding hovermelding cursor">
    <i class="rightfloat"><a class="pointer" onclick="delMelding(<?php echo $fetchMeldingen['id']; ?>)">X </a></i>

    <div data-id="<?php echo $fetchMeldingen['id']; ?>">

        [<b>Inc: <?php echo $fetchMeldingen['id']; ?></b>] <?php echo $fetchMeldingen['melding']; ?> <br />
        <B>Melder: </B> <?php if($fetchMeldingen['door'] == '0'){echo 'Meldkamer';}else{echo $fetchMeldingen['door'];} ?><br />
        <B>Melding Info:</B> <?php echo $fetchMeldingen['meldinginfo']; ?>


            <br /><b>Prio:</b> <form action="" method="POST">
                        <select onchange="setprio(this);" style="width:125px;" id="<?php echo $fetchMeldingen['id']; ?>" name="prio" class="form-control">
                                <option>Kies</option>
                                <option disabled>Politie</option>
                                <option value="Prio 1 MT" <?php if($fetchMeldingen['prio'] == 'Prio 1 MT'){echo 'selected';}?>>Prio 1 MT</option>
                                <option value="Prio 1 ZT" <?php if($fetchMeldingen['prio'] == 'Prio 1 ZT'){echo 'selected';}?>>Prio 1 ZT</option>
                                <option value="Prio 2" <?php if($fetchMeldingen['prio'] == 'Prio 2'){echo 'selected';}?>>Prio 2</option>
                                <option value="Prio 3" <?php if($fetchMeldingen['prio'] == 'Prio 3'){echo 'selected';}?>>Prio 3</option>
                                <option disabled>Ambulance</option>
                                <option value="A1" <?php if($fetchMeldingen['prio'] == 'A1'){echo 'selected';}?>>A1</option>
                                <option value="A2" <?php if($fetchMeldingen['prio'] == 'A2'){echo 'selected';}?>>A2</option>
                                <option value="B" <?php if($fetchMeldingen['prio'] == 'B'){echo 'selected';}?>>B</option>
                                <option disabled>Brandweer</option>
                                <option value="Prio 1" <?php if($fetchMeldingen['prio'] == 'Prio 1'){echo 'selected';}?>>Prio 1</option>
                                <option value="Prio 2B" <?php if($fetchMeldingen['prio'] == 'Prio 2B'){echo 'selected';}?>>Prio 2</option>
                        </select>

                    </form>

              <b>Porto:</b> <form action="" method="POST">
                          <select onchange="setporto(this);" style="width:225px;" id="<?php echo $fetchMeldingen['id']; ?>" name="porto_kanaal" class="form-control">
                              <option value="" disabled selected>Kies</option>
                                <option value="" disabled>Operationeel Centrum</option>
                                  <?php
                                  $filter = array('channel_name' => "by");
                                  try{
                                    foreach ($tsServer->channelList($filter) as $tsChannels) {
                                      try{
                                        if(!$tsChannels->getParent()->channelIsSpacer($tsChannels)){
                                          if($tsChannels->getInfo()) {
                                            if($fetchMeldingen['porto'] == $tsChannels['channel_name']){
                                              echo "<option value='".$tsChannels['channel_name']."' selected>".$tsChannels['channel_name']."</option>";
                                            }
                                            if($tsChannels['total_clients_family'] > 0){
                                              echo "<option value='".$tsChannels['channel_name']."'> In gebruik: ".$tsChannels['channel_name']."</option>";
                                            }
                                            else{
                                              echo "<option value='".$tsChannels['channel_name']."'>".$tsChannels['channel_name']."</option>";
                                            }
                                          }
                                        }
                                      }
                                      catch(TeamSpeak3_Exception $e)
                                      {
                                      // print the error message returned by the server
                                      echo '<option value="">Error! '.$e->getMessage().'</option>';                                      }
                                    }
                                  }
                                  catch(TeamSpeak3_Exception $e)
                                  {
                                    echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.$e->getMessage().'</div>';
                                  }
                                  ?>
                              <option value="" disabled>Rijkswaterstaat / ANWB</option>
                                <option value="RWS-01" <?php if($fetchMeldingen['porto'] == 'RWS-01'){echo 'selected';}?>>RWS-01</option>
                                <option value="ANWB-01" <?php if($fetchMeldingen['porto'] == 'ANWB-01'){echo 'selected';}?>>ANWB-01</option>
                          </select>

                      </form>

    </div>
    <i><small>Gekoppelde eenheden:</small></i><text style="float:right;"><a onclick="KoppelMelding();">Koppelen</a></text><br />
    <table width="100%">

        <?php
        $koppelQuery = $db->query("SELECT * FROM gms_melding_koppel WHERE mid = '".$fetchMeldingen['id']."'");
        while($koppelFetch = $koppelQuery->fetch_array()){
            $getGrip = $db->query("SELECT * FROM gms_ingemeld WHERE uid = '".$koppelFetch['uid']."'");
            $fetchGrip = $getGrip->fetch_assoc();
        ?>
        <tr>
            <td><?php
            if($fetchGrip['eenheid'] == 'burger'){
                echo 'Burger: '.$fetchGrip['naam'];
            }else{
                echo "[".$koppelFetch['roepnummer']."]";
            }
                ?></td>

            <td><?php
                    if($fetchGrip['status'] == '1'){echo 'Vrij';
                    }elseif($fetchGrip['status'] == '2'){echo '<div class="tp">TP</div>';
                    }elseif($fetchGrip['status'] == '3'){echo '<div class="transport">Transport</div>';
                    }elseif($fetchGrip['status'] == '4'){echo '<div class="code9">Code 9</div>';
                    }elseif($fetchGrip['status'] == '5'){echo '<div class="x">X</div>';
                    }elseif($fetchGrip['status'] == '0'){echo '<div class="onderweg">Onderweg</div>';}?></td>
            <!--<td><a onclick="openKoppelen();"><img src="<?php echo $site; ?>/img/up_arrow.png"></a></td>-->
            <td>
                <i style="cursor:pointer;" onclick="setstatus('1', <?php echo $koppelFetch['uid']; ?>, <?php echo $koppelFetch['mid']; ?>)"><img src="<?php echo $site; ?>/img/001.png"></i>
            </td>

            <td>
                <i style="cursor:pointer;" onclick="setstatus('2', <?php echo $koppelFetch['uid']; ?>, <?php echo $koppelFetch['mid']; ?>)"><img src="<?php echo $site; ?>/img/002.png"></i>
            </td>

            <td>
                <i style="cursor:pointer;" onclick="setstatus('3', <?php echo $koppelFetch['uid']; ?>, <?php echo $koppelFetch['mid']; ?>)"><img src="<?php echo $site; ?>/img/003.png"></i>
            </td>

            <td>
                <i style="cursor:pointer;" onclick="setstatus('4', <?php echo $koppelFetch['uid']; ?>, <?php echo $koppelFetch['mid']; ?>)"><img src="<?php echo $site; ?>/img/Car.png"></i>
            </td>

            <td>
                <i style="cursor:pointer;" onclick="setstatus('9', <?php echo $koppelFetch['uid']; ?>, <?php echo $koppelFetch['mid']; ?>)"><img src="<?php echo $site; ?>/img/009.png"></i>
            </td>
        </tr>
        <?php } ?>
    </table><br />
<B>Aantekeningen:</B><br />
    <?php
    $getAantekening = $db->query("SELECT * FROM gms_melding_aantekening WHERE mid = '".$fetchMeldingen['id']."'");
    while($fetchAantekening = $getAantekening->fetch_array()){
        echo $fetchAantekening['aantekening']. '<i onclick="deleteKladblok('.$fetchAantekening['id'].');" style="float:right;">X</i><br />';
    } ?>
</div>
<hr>
<?php }
//error_log('mk-meldingen.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

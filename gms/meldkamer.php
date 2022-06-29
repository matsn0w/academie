<?php
include_once("includes/class.database.php");
require_once('includes/TeamSpeak3/config.php');

if ($userFetch['eenheid'] == 'meldkamer' || $userFetch['reserve_centralist'] == '1') {
    $getGroepInc = $db->query("SELECT * FROM gms_incidentgroepen WHERE mkid = '" . $userFetch['id'] . "'");
    $countGroepInc = $getGroepInc->num_rows;
    if ($countGroepInc <= 0) {
        ?>
        <script>location.href = '<?php echo $site; ?>/meldkamernieuw.php';</script><?php
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SyntaxOnline | GMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="img/favicon.png">


    </head>

    <body>
    <!---<div class="sitrap-background" style="opacity:0.8;">
        <div class="sitrap" style="opacity:1.0;">
            Sitrapje maken
        </div>
    </div>-->
    <div id="menu">
        <div class="container-2" style="width:1250px;">
            <div class="tabbable" id="tabs-313115">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#panel-642482" data-toggle="tab">GMS</a>
                    </li>

                    <li>
                        <a href="#panel-44345" data-toggle="tab">Database</a>
                    </li>


                    <li>
                        <a href="#cleanup" data-toggle="tab">Leeg GMS</a>
                    </li>

                    <li>
                        <a href="#logout" data-toggle="tab">Loguit</a>
                    </li>

                    <li>
                        <a>Wachtwoord:</a>
                    </li>
                    <li>
                        <a><?php echo $fetchGroepInc['password']; ?></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
<div class="col-md-2 column" style="margin-top: 40px;">
  <div class="melding-title" data-toggle="collapse" data-parent="#panel-447787" href="#panel-element-583539">[<?php echo $fetchGroepInc['naam']; ?>] Eigen kanaal</div>
  <div class="melding column">
      <div id="panel-element-583539" class="panel-collapse">
      <?php
        if(isset($_POST['SetMKKanaal'])){

          $SelectMKq = $db->query("SELECT * FROM gms_incidentgroepen WHERE naam = '".$fetchGroepInc['naam']."'");
          $SelectMK = $SelectMKq->fetch_assoc();

          $userPortoIDq = $db->query("SELECT * FROM users WHERE id = '".$SelectMK['mkid']."'");
          $userPortoID = $userPortoIDq->fetch_assoc();

          $getMKIDq = $db->query("SELECT * FROM gms_incidentgroepen WHERE mkid = '".$userPortoID['id']."' ORDER BY id");
          while($getMKID = $getMKIDq->fetch_array()){
            if($getMKID){
              $ChannelName = $_POST['MKKanaal'];

              foreach ($tsServer->channelList() as $tsChannel) {

                if($tsChannel['channel_name'] == $ChannelName){
                  try{
                    $tsServer->clientGetByName($userPortoID['teamspeak'])->move($tsChannel->GetId());
                  }
                  catch(TeamSpeak3_Exception $e)
                  {
                  // print the error message returned by the server
                  echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.$e->getMessage().'</div>';
                  }
                }

              }
            }
          }
        }
      ?>
        <table style="width:250px">
          <tr>
            <th>Kanaal</th>
            <th>Zet</th>
          </tr>

          <tr>
          <form method="POST">
                <td>
                        <div class="form-group">
                          <select name="MKKanaal" class="form-control">
                            <option value="" disabled>Operationeel Centrum</option>
                            <?php
                            $filterOC = array('channel_name' => "OC #");
                              foreach ($tsServer->channelList($filterOC) as $tsChannels) {
                                try{
                                  if(!$tsChannels->getParent()->channelIsSpacer($tsChannels)){
                                    if($tsChannels->getInfo()) {
                                      echo "<option value='".$tsChannels['channel_name']."'>".$tsChannels['channel_name']."</option>";
                                    }
                                  }
                                }
                                catch(TeamSpeak3_Exception $e)
                                {
                                // print the error message returned by the server
                                echo '<option value="">Error! '.$e->getMessage().'</option>';                                }
                              }
                            ?>
                            <option value="" disabled>Bystand</option>
                            <?php
                              $filterBY = array('channel_name' => "BY");
                              foreach ($tsServer->channelList($filterBY) as $tsChannels) {
                                try{
                                  if(!$tsChannels->getParent()->channelIsSpacer($tsChannels)){
                                    if($tsChannels->getInfo()) {
                                      echo "<option value='".$tsChannels['channel_name']."'>".$tsChannels['channel_name']."</option>";
                                    }
                                  }
                                }
                                catch(TeamSpeak3_Exception $e)
                                {
                                // print the error message returned by the server
                                echo '<option value="">Error! '.$e->getMessage().'</option>';                                }
                              }
                            ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="SetMKKanaal">Gaan</button>
                        </div>
                </td>
            </form>
          </tr>

        </table>
      </div>
  </div>
  <div>
    <div class="melding-title-2 collapsed" data-toggle="collapse" style="margin-top: 10px;"
         data-parent="#panel-447773" href="#panel-element-483538">Melding maken
    </div>
  </div>
  <div class="melding column">
      <div id="panel-element-483538" class="panel-collapse">
          <div id="meldingmaken"></div>

      </div>
    </div>
  </div>
</div>

    <div class="container" style="width:1250px;">
        <div class="row clearfix">
            <div class="tabbable" id="tabs-313115">

                <div class="tab-content">
                    <?php
                    if (isset($_POST['logoutGesprek'])) {
                        $uid = $userFetch['id'];

                        $db->query("UPDATE gms_incidentgroepen SET mkid = '0' WHERE mkid = '" . $uid . "'");
                        ?>
                        <script>location.href = '<?php echo $site; ?>/meldkamernieuw.php';</script><?php
                    }
                    ?>
                    <div class="tab-pane" id="logout">
                        <h1>Loguit van Gespreksgroep.</h1>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-danger" name="logoutGesprek">Loguit</button>
                        </form>

                    </div>
                    <div class="tab-pane" id="cleanup">
                        <B>GMS leeg maken</B><br/>
                        Maak hier het GMS leeg voor een nieuwe surveillance<br/>
                        <br/>
                        <?php
                        if (isset($_POST['cleanup'])) {
                            $cleanup = $db->query("TRUNCATE TABLE gms_meldingen");
                            $cleanup .= $db->query("TRUNCATE TABLE gms_melding_aantekening");
                            $cleanup .= $db->query("TRUNCATE TABLE gms_melding_koppel");
                            $cleanup .= $db->query("TRUNCATE TABLE gms_ingemeld");
                            $cleanup .= $db->query("TRUNCATE TABLE gms_log");
                            $cleanup .= $db->query("ALTER TABLE gms_meldingen AUTO_INCREMENT = 1");
                            $cleanup .= $db->query("DELETE FROM gms_incidentgroepen WHERE id = '" . $fetchGroepInc['id'] . "'");

                            if ($cleanup) {
                                ?>
                                <script>location.href = '<?php echo $site; ?>/meldkamernieuw.php';</script><?php
                            } else {
                                echo 'Wooow, wat doe jij nu weer? Sloop je het systeem? Er ging iets mis!';
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="submit" class="btn btn-danger" name="cleanup" value="Maak Leeg">
                        </form>
                    </div>

                    <div class="tab-pane <?php if (!isset($_GET['dienst'])) {
                        echo 'active';
                    } ?>" id="panel-642482"><br/>
                        <div class="col-md-5 column">
                            <div class="panel-group" id="panel-447772">


                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447774"
                                     href="#panel-element-483539">Politie Eenheden
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-483539" class="panel-collapse">
                                        <table id="eenheid-beide" style="width:500px">

                                        </table>
                                    </div>
                                </div>

                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447775"
                                     href="#panel-element-483540">Brandweer Eenheden
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-483540" class="panel-collapse">
                                        <table id="eenheid-2" style="width:500px">

                                        </table>
                                    </div>
                                </div>


                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447776"
                                     href="#panel-element-483541">Ambulance Eenheden
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-483541" class="panel-collapse">
                                        <table id="eenheid-3" style="width:500px">

                                        </table>
                                    </div>
                                </div>

                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447776"
                                     href="#panel-element-48354122">Burger Eenheden
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-48354122" class="panel-collapse">
                                        <table id="eenheid-4" style="width:500px">

                                        </table>
                                    </div>
                                </div>

                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447777"
                                     href="#panel-element-483542">Eenheden op Status 9
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-483542" class="panel-collapse">
                                        <table id="code-9" style="width:500px;">

                                        </table>
                                    </div>
                                </div>

                                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447778"
                                     href="#panel-element-483543">Wachtrij
                                </div>
                                <div class="melding column">
                                    <div id="panel-element-483543" class="panel-collapse">
                                        <table id="accept" style="width:500px;">

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 column">


                            <div class="melding-title">Meldingen</div>
                            <div class="melding column">
                                <div id="melding-mk"></div>
                            </div>

                            <div class="melding-title">Kladblok</div>
                            <div class="melding column">
                                <div id="meldingkladblok"></div>
                                <div class="maak-aantekening">
                                    <form id="aantekening-form">
                                      <tr>
                                        <td><b>INC. ID:</b></td>
                                        <td>
                                          <select name="mid" id="mid" class="form-control" style="width:100px;">
                                              <option disabled selected>Geen</option>
                                              <?php
                                              $getMeldingID = $db->query("SELECT * FROM gms_meldingen WHERE mkid = '".$ingemeldFetch['groep_id']."' ORDER BY id");
                                              while($fetchMeldingID = $getMeldingID->fetch_array()){
                                              ?>
                                              <option value="<?php echo $fetchMeldingID['id']; ?>">Inc. <?php echo $fetchMeldingID['id']; ?></option>
                                              <?php } ?>
                                          </select>
                                        </td>
                                        <td><b>Aantekening:</b></td>
                                        <td><textarea class="form-control" id="aantekening" rows="3"></textarea></td>
                                        <td><i class="form-control aantekening-send" style="width:65px;" onclick="maakaantekening()">Maak</i></td>
                                      </tr>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="statusLock" style="height: auto;">
                              <div class="melding-title">Urgent</div>
                              <div class="melding column" style="height: auto;">
                                  <div id="urgent-mk"></div>
                              </div>
                          </div>
                            <div class="statusLock" style="height: auto;">
                                <div class="melding-title">Status van de eenheden</div>
                                <div class="melding column" style="height: auto;">
                                    <div id="status-mk"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="panel-44345">
                        <br>
                        <input class="form-control" style="width: 50%; float: left;" id="db_firstname" type="text"
                               placeholder="Voornaam">
                        <input class="form-control" style="width: 50%;" id="db_lastname" type="text"
                               placeholder="Achternaam">
                        <br>
                        <button class="btn btn-success" onclick="searchUser()" style="width: 100%;">Opzoeken
                        </button>

                        <h3 id="result_text">Zoeken...</h3>
                        <div id="result">
                        </div>
                    </div>

                    <div class="tab-pane" id="panel-843926">
                        <h1>Opmerkingen doorgeven aan de Leiding!</h1>
                        <?php
                        if (isset($_POST['sendopmerking'])) {
                            $date = $db->real_escape_string($_POST['date']);
                            $text = $db->real_escape_string($_POST['text']);

                            if (empty($date)) {
                                ?>
                                <script>alert('Geen datum ingevult!');</script><?php
                            } elseif (empty($text)) {
                            ?>
                                <script>alert('Geen opmerkingen ingevult!');</script><?php
                            } else {
                            $query = $db->query("INSERT INTO opmerkingen (uid, date, text) VALUES ('" . $userFetch['id'] . "', '" . $date . "', '" . $text . "')");
                            if ($query) {
                            ?>
                                <script>alert("Opmerking verzonden!");</script><?php
                            } else {
                            ?>
                                <script>alert("Er is iets misgegaan met het toevoegen van de opmerking! Probeer het later nog eens!");</script><?php
                            }
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <table width="650">
                                <tr>
                                    <td>Surveillance Datum:</td>
                                    <td><input type="text" name="date" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Opmerkingen:</td>
                                    <td><textarea name="text" class="form-control" rows="5"></textarea></td>
                                </tr>
                            </table>

                            <input type="submit" value="Verzend" name="sendopmerking" class="btn btn-primary">
                        </form>
                    </div>
                    <!------------------------------------------------>

                </div>
            </div>
            <!----------------->
        </div>
    </div>
    <div id="openable-chat" style="display:none;">
        <?php
        if (isset($_POST['clearChat'])) {
            $f = @fopen("log.html", "r+");
            if ($f !== false) {
                ftruncate($f, 0);
                fclose($f);

                $fp = fopen("log.html", 'a');
                fwrite($fp, "
                <b>" . $userFetch['username'] . "</b>: Heeft de chat geleegd! <div style=\"float:right;\">" . date("G:i:s") . "</div><br>");
                fclose($fp);

            }
        }
        ?>
        <form action="" method="post"><input type="submit" name="clearChat" value="Maak Leeg" class="btn btn-danger">
        </form>

        <div id="messages">
            <?php
            if (file_exists("log.html") && filesize("log.html") > 0) {
                $handle = fopen("log.html", "r");
                $contents = fread($handle, filesize("log.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
        </div>

        <br/>
        <div style="position:fixed;bottom:0;margin-bottom:35px;">
            <input type="text" id="usermsg"> <input type="submit" id="submitChat" class="btn btn-success" value="SEND">
        </div>

    </div>
    <div id="openable-chatbutton">CHAT</div>


    <div id="koppelDialog" title="Koppel Incidentkanaal" style="display:none;">

    </div>

    <div id="KoppelMelding" title="Koppel Melding" style="display:none;">

    </div>

    </body>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ion.sound.js"></script>
    <script type="text/javascript" src="js/ion.sound.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    </html>
<?php } else {
    header("Location: inmelden.php");
} ?>

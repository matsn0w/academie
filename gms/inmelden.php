<?php
include_once("includes/class.database.php");
if (isset($_SESSION['grip'])) {
    header("Location: eenheid.php");
} elseif (!isset($_SESSION['email'])) {
    header("Location: index.php");
} else {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Inmelden Meldkamer NowayRP</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $site2; ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

    <div class="container">
        <?php
        if (isset($_POST['submitGrip'])) {
            $naam = $userFetch['username'];
            $roepnummer = $db->real_escape_string($_POST['roepnummer']);
            $incgroep = $db->real_escape_string($_POST['incgroep']);
            $afdeling = $db->real_escape_string($_POST['afdeling']);
            $vrijw = $db->real_escape_string($_POST['vrijw']);
            $grip = "1";

            if (empty($roepnummer)) {
                echo 'Je bent je roepnummer vergeten!';
            } elseif (empty($afdeling)) {
                echo 'Je bent je afdeling vergeten!';
            } elseif ($incgroep == 0) {
                echo 'Je kan niet inmelden als er geen Incident Groep is';
            } else {
                $statustitel = 'Inmelding van: ' . $naam . ': ' . $roepnummer;
                $statusbericht = $roepnummer . ': ' . $naam . ' Meld zich in als ' . $afdeling . ' met Grip ' . $grip;
                $currentdate = date('Y-m-d H:i:s');
                $insertQuery = $db->query("INSERT INTO gms_ingemeld (uid,groep_id,naam,roepnummer,eenheid,vrijw,status,ingemeld_date) VALUES (
        '" . $userFetch['id'] . "',
        '" . $incgroep . "',
        '" . $naam . "',
        '" . $roepnummer . "',
        '" . $afdeling . "',
        '" . $vrijw . "',
        '5',
        '" . $currentdate . "'
        )");
                $insertQuery .= $db->query("INSERT INTO gms_log (uid,groep_id, eenheid, titel, bericht) VALUES ('" . $userFetch['id'] . "', '" . $incgroep . "','" . $userFetch['eenheid'] . "', '" . $statustitel . "', '" . $statusbericht . "')");
                $_SESSION['grip'] = $grip;
                ?>
                <script>location.href = '<?php echo $site; ?>/check.php';</script><?php

            }


        }
        ?>
        <form role="form" action="" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Naam</label>
                <input type="text" class="form-control" value="<?php echo $userFetch['username']; ?>"
                       id="exampleInputEmail1" disabled/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Incident Groep</label>
                <select name="incgroep" class="form-control">
                    <?php
                    $getGroep = $db->query("SELECT * FROM gms_incidentgroepen ORDER BY id");
                    while ($fetchGroep = $getGroep->fetch_array()) {
                        ?>
                        <option value="<?php echo $fetchGroep['id']; ?>"><?php echo $fetchGroep['naam']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Roepnummer
                    <small>(burger = 00)</small>
                </label>
                <input type="text" class="form-control" value="<?php echo $userFetch['roepnummer']; ?>" name="roepnummer" id="exampleInputPassword1"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Afdeling</label>
                <select name="afdeling" class="form-control">
                    <?php
                    $getEenheid = $db->query("SELECT * FROM gms_eenheden ORDER BY id");
                    while ($fetchEenheden = $getEenheid->fetch_array()) {
                        ?>
                        <option value="<?php echo $fetchEenheden['value']; ?>"><?php echo $fetchEenheden['naam']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Vrijwilliger</label>
                <select name="vrijw" class="form-control">
                    <option value="0">Geen</option>
                    <option value="brw">Vrijw. Brandweer</option>
                    <option value="ambu">Vrijw. Ambulance</option>
                    <option value="at">Vrijw. Arrestatie Team</option>
                    <option value="mmt">Vrijw. MMT</option>
                    <option value="duik">Vrijw. Duikteam</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Meld je in!" class="form-control btn-success" name="submitGrip">
            </div>
        </form>
        <?php
        if ($userFetch['eenheid'] == 'meldkamer' || $userFetch['reserve_centralist'] == '1') {
            ?>
          <div class="form-group">
            <button onClick="window.open('<?php echo $site; ?>/meldkamernieuw.php');"
                    class="form-control btn-primary">Voor meldkamer hier inloggen!
            </button>
          </div>
        <?php } ?>
        <div class="form-group">
          <button onClick="window.open('<?php echo $site; ?>/index.php');" class="form-control btn-primary">Open in een apart venster!</button>
        </div>
    </div> <!-- /container -->

    </body>
    </html>
<?php } ?>

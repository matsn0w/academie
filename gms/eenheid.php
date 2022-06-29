<?php
include_once("includes/class.database.php");
if (!isset($_SESSION['grip'])) {
    header("Location: inmelden.php");
} elseif ($ingemeldFetch['district'] == '0') {
    header("Location: check.php");
} else {

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

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/ion.sound.js"></script>
        <script type="text/javascript" src="js/ion.sound.min.js"></script>
        <script type="text/javascript" src="js/showPhp.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>

    </head>

    <body>
    <div class="container">
        <div class="checkingemeld"></div>
        <div class="row clearfix">

            <div class="button-container column">
                <div id="alerts"></div>
                <!--------------------------------------------------------------------------------------------------------->
                <div id="melding-maken">
                    <?php
                    if (isset($_POST['makeMelding'])) {
                        $melding = $db->real_escape_string($_POST['melding']);
                        $meldinginfo = $db->real_escape_string($_POST['meldinginfo']);
                        $locatie = $db->real_escape_string($_POST['locatie']);
                        $uid = $ingemeldFetch['roepnummer'];

                        if (empty($melding)) {
                            echo 'Je hebt geen melding ingevult';
                        } elseif (!$district == '2' || !$district == '3') {
                            echo 'Je hebt geen geldig district ingevult!';
                        } elseif (empty($meldinginfo)) {
                            echo 'Je hebt geen info ingevult';
                        } else {

                            $query = $db->query("INSERT INTO gms_meldingen (melding,meldinginfo,locatie,timestamp, door) VALUES ('" . $melding . "', '" . $meldinginfo . "', '" . $locatie . "', NOW(), '" . $uid . "')");
                            if ($query) {
                                ?>
                                <script>
                                    $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">De melding is verzonden</div>");
                                    setTimeout(function () {
                                        location.href = 'eenheid.php';
                                    }, 5000);
                                </script><?php
                            } else {
                            ?>
                                <script>
                                    $("#alerts").prepend("<div class=\"alert alert-dismissable alert-info\">Er ging iets mis!</div>");
                                    setTimeout(function () {
                                        location.href = 'eenheid.php';
                                    }, 5000);
                                </script><?php
                            }
                        }
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <div>
                                <label>Melding</label>
                                <?php include('selectmelding.php'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Meldinginfo</label>
                            <input type="text" name="meldinginfo" style="width:290px;" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Locatie</label>
                            <input type="text" name="locatie" style="width:290px;" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" style="width:100px;" class="form-control" value="Aanmaken"
                                   name="makeMelding">
                        </div>
                    </form>
                </div>
                <!--------------------------------------------------------------------------------------------------------->


                <div class="tabbable" id="tabs-500385">
                    <ul class="nav nav-tabs2">
                        <li class="active">
                            <a href="#panel-32590" data-toggle="tab">Status</a>
                        </li>
                        <li id="statustab">

                        </li>
                        <li>
                            <a href="#database" data-toggle="tab">Database</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-32590">

                            <div id="info">
                                Naam: <?php echo $ingemeldFetch['naam']; ?><br/>
                                Roepnr: <?php echo $ingemeldFetch['roepnummer']; ?><br/>
                                Eenheid: <?php echo $ingemeldFetch['eenheid']; ?><br/>
                            </div>
                            <div id="infoboxstatus" style="margin-right:10px;float:right;">

                            </div>

                            <div class="right">

                            </div>

                            <audio id="sound1" src="Radio_gms_beschikbaar.wav" preload="auto"></audio>
                            <audio id="sound2" src="LSES_Panic_Button_Sound_Effect.mp3" preload="auto"></audio>
                            <div class="btn-group" style="margin:0 auto;">
                                <button type="button" onclick="saveVrij(); document.getElementById('sound1').play()"
                                        id="vrij" class="button btn-success btn-large">VRIJ
                                </button>
                                <button type="button" onclick="saveTP(); document.getElementById('sound1').play()"
                                        id="tp" class="button btn-success btn-large">TP
                                </button>
                                <button type="button" onclick="saveTR(); document.getElementById('sound1').play()"
                                        class="button btn-success btn-large">TRANS
                                </button>
                                <button type="button" onclick="spraak(); document.getElementById('sound1').play()"
                                        class="button btn-success btn-large">SPRAAK
                                </button>

                                <button type="button" onclick="info() ; document.getElementById('sound1').play()"
                                        class="button btn-success btn-large">INFO. <br/>AANVRAAG
                                </button>

                                <button type="button" onclick="sitrap() ; document.getElementById('sound1').play()"
                                        class="button btn-info btn-large">SITRAP
                                </button>
                                <button type="button" onclick="toggleMelding() " class="button btn-info btn-large">
                                    MELDING
                                </button>

                                <button type="button" onclick="asscollega(); document.getElementById('sound2').play()"
                                        class="button btn-danger btn-large"><img src="img/noodknop.png"></button>
                                <button type="button" onclick="urgent() ; document.getElementById('sound1').play()"
                                        class="button btn-danger btn-large">URGENT
                                </button>


                                <button type="button" onclick="code4()  ; document.getElementById('sound1').play()"
                                        class="button btn-warning btn-large">CODE 4
                                </button>
                                <button type="button" onclick="tijdelijk()  ; document.getElementById('sound1').play()"
                                        class="button btn-warning btn-large">CODE 9
                                </button>
                                <button type="button" onclick="definitief()  ; document.getElementById('sound1').play()"
                                        class="button btn-warning btn-large">CODE 10
                                </button>

                                <button type="button"
                                        onclick="politieverzoek()  ; document.getElementById('sound1').play()"
                                        class="button btn-primary btn-large">VERZOEK<br/>POLITIE
                                </button>
                                <button type="button"
                                        onclick="brandweerverzoek()  ; document.getElementById('sound1').play()"
                                        class="button btn-primary btn-large">VERZOEK<br/>BRW
                                </button>
                                <button type="button"
                                        onclick="ambulanceverzoek()  ; document.getElementById('sound1').play()"
                                        class="button btn-primary btn-large">VERZOEK<br/>AMBU
                                </button>
                            </div>

                        </div>
                        <div class="tab-pane" id="panel-510268">
                            <p>
                            <h1>Huidige melding</h1>
                            <br/>
                            <div id="meldingen"></div>
                            <h1>Kladblok</h1>
                            <br/>
                            <div id="kladblok"></div>

                            </p>
                        </div>
                        <div class="tab-pane" id="database">
                            <br>
                            <input class="form-control" id="db_firstname" type="text" placeholder="Voornaam">
                            <input class="form-control" id="db_lastname" type="text" placeholder="Achternaam">
                            <br>
                            <button class="btn btn-success" onclick="searchUser()" style="width: 100%;">Opzoeken
                            </button>

                            <h3 id="result_text">Zoeken...</h3>
                            <div id="result">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    </html>
<?php } ?>

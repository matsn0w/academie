<?php
include_once("includes/class.database.php");
require_once('includes/TeamSpeak3/config.php');

if($userFetch['eenheid'] == 'meldkamer' || $userFetch['reserve_centralist'] == '1'){
    $getGroepInc = $db->query("SELECT * FROM gms_incidentgroepen WHERE mkid = '".$userFetch['id']."'");
    $fetchGroepInc = $getGroepInc->fetch_assoc();
    if($fetchGroepInc['mkid'] == $userFetch['id']){
        ?><script>location.href='<?php echo $site; ?>/meldkamer.php';</script><?php
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
    <div id="menu"><div class="container-2" style="width:1250px;"><div class="tabbable" id="tabs-313115">
				<ul class="nav nav-tabs">
				    <li class="active" >
						<a href="#kies" data-toggle="tab">Kiezen</a>
					</li>
                    <li>
                        <a href="#incgroepen" data-toggle="tab">Incidentgroepen</a>
                    </li>
                    <?php
                    $getGroepen = $db->query("SELECT * FROM gms_incidentgroepen ORDER BY id");
                    while($fetchGroepen = $getGroepen->fetch_array()){
                    ?>
                    <li>
                        <a href="#<?php echo $fetchGroepen['id']; ?>" data-toggle="tab"><?php echo $fetchGroepen['naam']; ?></a>
                    </li>
                    <?php } ?>

        </ul>
    </div></div></div>

<div class="container" style="width:1250px;">
	<div class="row clearfix">
        <div class="tabbable" id="tabs-313115">
            <?php
            if(isset($_POST['submit'])){
                $password = $db->real_escape_string($_POST['password']);
                $groepid = $db->real_escape_string($_POST['groepid']);

                    $getGroep2 = $db->query("SELECT * FROM gms_incidentgroepen WHERE id = '".$groepid."'");
                    $fetchGroep2 = $getGroep2->fetch_assoc();

                if($password != $fetchGroep2['password']){
                    echo 'Verkeerd Wachtwoord!';
                }else{
                    $query = $db->query("UPDATE gms_incidentgroepen SET mkid = '".$userFetch['id']."' WHERE id = '".$groepid."'");
                    if($query){
                        ?><script>location.href='<?php echo $site; ?>/meldkamer.php';</script><?php
                    }else{
                        echo 'Er ging iets mis!';
                    }
                }
            }
            ?>
            <div class="tab-content">
				<div class="tab-pane active" id="kies">

                    Kies hier de incidentgroep die je wilt besturen.<br />
                    Wil je meekijken druk dan op de knop bij de incidentgroep die jij wilt.

                </div>
                <?php
                    $getGroep = $db->query("SELECT * FROM gms_incidentgroepen ORDER BY id");
                    while($fetchGroep = $getGroep->fetch_array()){
                ?>
                <div class="tab-pane" id="<?php echo $fetchGroep['id']; ?>">

                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Wachtwoord:</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Inloggen">
                            <a onclick="location.href='<?php echo $site; ?>/meldkamerspectate.php?id=<?php echo $fetchGroep['id']; ?>';" class="btn btn-success">Meekijken</a>
                        </div>
                        <input type="hidden" name="groepid" value="<?php echo $fetchGroep['id']; ?>">

                    </form>

                </div>
                <?php } ?>
                <div class="tab-pane" id="incgroepen">
                <?php
                if(isset($_POST['makeGroep'])){
                    $naam = $db->real_escape_string($_POST['naam']);
                    $password = $db->real_escape_string($_POST['password']);
                    $default_porto2 = $db->real_escape_string($_POST['defaultporto']);

                    if(empty($naam)){
                        echo 'Je hebt geen naam ingevult!';
                    }else{
                        $query = $db->query("INSERT INTO gms_incidentgroepen (mkid,naam,password,default_porto) VALUES (
                        '".$userFetch['id']."',
                        '".$naam."',
                        '".$password."',
                        '".$default_porto2."'
                        )");
                        if($query){
                            ?><script>location.href='<?php echo $site; ?>/meldkamer.php';</script><?php
                        }else{
                            echo 'Er ging iets mis!';
                        }
                    }

                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Naam <small>(Voorbeeld: ESX/RP OC1-1 <?php echo date("d/m/Y"); ?>)</small></label>
                        <input type="text" name="naam" class="form-control" value="*** OC1-* <?php echo date("d/m/Y"); ?>">
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="text" value="<?php echo randomPassword(); ?>" name="password" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                      <label for="default_porto">Standaard Portokanaal (Word men naar toe gestuurd als ze weer bijvoorbeeld status 1 gaan.)</label>
                      <select name="defaultporto" class="form-control">
                        <option disabled selected>Geen</option>
                        <?php
                        $filter = array('channel_name' => "oc");

                        foreach ($tsServer->channelList($filter) as $tsChannels) {
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
                          echo '<option value="">Error! '.$e->getMessage().'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="makeGroep" value="Aanmaken" class="btn btn-danger">
                    </div>
                </form>
            </div>
            </div>
        </div>
        <!----------------->
    	</div>
</div>




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
<?php }else{ header("Location: inmelden.php"); }?>

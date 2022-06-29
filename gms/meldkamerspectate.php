<?php
include_once("includes/class.database.php");

if($userFetch['eenheid'] == 'meldkamer' || $userFetch['reserve_centralist'] == '1'){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Meldkamer systeem</title>
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
						<a href="#panel-642482" data-toggle="tab">GMS</a>
					</li>

        </ul>
    </div></div></div>
    
<div class="container" style="width:1250px;">
	<div class="row clearfix">
        <div class="tabbable" id="tabs-313115">

				<div class="tab-content">

<div class="tab-pane <?php if(!isset($_GET['dienst'])){echo 'active';}?>" id="panel-642482"><br />

		<div class="col-md-5 column">
            <div class="panel-group" id="panel-447772">
                
                

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447774" href="#panel-element-483539">Politie Eenheden</div>
                <div class="melding column">
                    <div id="panel-element-483539" class="panel-collapse">
                        <table id="eenheid-beide" style="width:500px">
                            
                        </table>
                    </div>
                </div>

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447775" href="#panel-element-483540">Brandweer Eenheden</div>
                <div class="melding column">
                    <div id="panel-element-483540" class="panel-collapse">
                        <table id="eenheid-2" style="width:500px">
                            
                        </table>
                    </div>
                </div>
                

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447776" href="#panel-element-483541">Ambulance Eenheden</div>
                <div class="melding column">
                    <div id="panel-element-483541" class="panel-collapse">
                        <table id="eenheid-3" style="width:500px">
                            
                        </table>
                    </div>
                </div>

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447776" href="#panel-element-48354122">Burger Eenheden</div>
                <div class="melding column">
                    <div id="panel-element-48354122" class="panel-collapse">
                        <table id="eenheid-4" style="width:500px">
                            
                        </table>
                    </div>
                </div>

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447777" href="#panel-element-483542">Eenheden uit Game</div>
                <div class="melding column">
                    <div id="panel-element-483542" class="panel-collapse">
                        <table id="code-9" style="width:500px;">
                            
                        </table>
                    </div>
                </div>

                <div class="melding-title" data-toggle="collapse" data-parent="#panel-447778" href="#panel-element-483543">Eenheden koppelen aan district</div>
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
                        <b>INC. ID:</b> <input type="number" name="mid" id="mid" class="form-control" style="width:100px;">
                        <b>Aantekening:</b>
                        <textarea class="form-control" id="aantekening" rows="3"></textarea>
                        <i class="form-control aantekening-send" style="width:65px;" onclick="maakaantekening()">Maak</i>
                    </form>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                    <div class="statusLock">
                    <div class="melding-title">Status van de eenheden</div>
                    <div class="melding column">
                        <div id="status-mk"></div>
                    </div>
                </div>
            </div>
            </div>
            
                
                <!------------------------------------------------>
            
		</div>
        </div>
        <!----------------->
    	</div>
</div>
    <div id="openable-chat" style="display:none;">
        <?php 
        if(isset($_POST['clearChat'])){
            $f = @fopen("log.html", "r+");
            if ($f !== false) {
                ftruncate($f, 0);
                fclose($f);
                
                $fp = fopen("log.html", 'a');
                fwrite($fp, "
                <b>".$userFetch['username']."</b>: Heeft de chat geleegd! <div style=\"float:right;\">".date("G:i:s")."</div><br>");
                fclose($fp);
                
            }
        }
        ?>
        <form action="" method="post"><input type="submit" name="clearChat" value="Maak Leeg" class="btn btn-danger"></form>
        
        <div id="messages">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $handle = fopen("log.html", "r");
                $contents = fread($handle, filesize("log.html"));
                fclose($handle);

                echo $contents;
            }
            ?>
        </div>

        <br />
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
<script>
$(function(){
    setInterval(function () {
    $("#melding-mk").load("includes/mk-meldingen.php");//insert the new messages into a div in your html        
        $("#status-mk").load("includes/mk-status.php?incid=<?php echo $_GET['id']; ?>");//insert the new messages into a div in your html
        $("#eenheid-beide").load("includes/eenheid-beide.php?incid=<?php echo $_GET['id']; ?>");//insert the new messages into a div in your html
        $("#eenheid-2").load("includes/eenheid-2.php?incid=<?php echo $_GET['id']; ?>");//insert the new messages into a div in your html
        $("#eenheid-3").load("includes/eenheid-3.php?incid=<?php echo $_GET['id']; ?>");//insert the new messages into a div in your html
        $("#eenheid-4").load("includes/eenheid-4.php");
        $("#accept").load("includes/give-district.php?incid=<?php echo $_GET['id']; ?>");
        
        $("#kladblok").load("includes/kladblok.php");//insert the new messages into a div in your html
        $("#code-9").load("includes/code-9.php?incid=<?php echo $_GET['id']; ?>");
        }, 3000);
});
</script>
</html>
<?php }else{ header("Location: inmelden.php"); }?>
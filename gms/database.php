<?php
include_once("includes/class.database.php");
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
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
</div> <!-- /container -->
<script src="js/scripts.js"></script>
</body>
</html>
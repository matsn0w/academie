<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Meldkamer 112Hulpdienstenonline.nl</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $site; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    if($sQuery = $db->query("SELECT salt FROM users WHERE email='".$db->real_escape_string($_POST['email'])."'")){
                        $sFetch = $sQuery->fetch_assoc();
                        if($lQuery = $db->query("SELECT id FROM users WHERE email='".$db->real_escape_string($_POST['email'])."' AND password='".crypt($_POST['password'], $sFetch['salt'])."'")){
                            if($lQuery->num_rows > 0){
                                $_SESSION['email'] = $_POST['email'];
                                ?><script>
                                window.location = '<?php echo $site; ?>/index.php';
                                </script><?php
                            }else{
                                echo "Je email of wachtwoord klopt niet.";
                            }
                        }else{
                            echo "Er is iets misgegaan. Foutmelding: ".$db->error;
                        }
                    }else{
                        echo "Er is iets misgegaan. Foutmelding: ".$db->error;
                    }
                }
                ?>
      <form action="" method="POST" class="form-signin">
        <h2 class="form-signin-heading">Login</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Wachtwoord</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>

        <input type="submit" name="submitLogin" class="btn btn-lg btn-primary btn-block" value="Log in">
      </form>

    </div> <!-- /container -->

  </body>
</html>

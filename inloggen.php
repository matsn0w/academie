 <?php
//Sign-up script
if(isset($_POST['SubmitReg'])){
    $naam = $db->real_escape_string($_POST['voornaam']);
    $achternaam = $db->real_escape_string($_POST['achternaam']);
    $email = $db->real_escape_string(strtolower($_POST['email']));
    $eenheid = $db->real_escape_string($_POST['eenheid']);
    $sollicitatie = $db->real_escape_string($_POST['sollicitatie']);
    if($aQuery = $db->query("SELECT * FROM aanmeldingen WHERE email='".$db->real_escape_string(strtolower($_POST['email']))."'")){
       $rowCount = $aQuery->num_rows;
      if($rowCount == 0){
        if(empty($naam)){
            echo 'Je bent vergeten een naam in te vullen';
        }elseif(empty($achternaam)){
            echo 'Je bent vergeten een achternaam in te vullen';
        }elseif(empty($email)){
            echo 'Je bent vergeten een email in te vullen';
        }elseif(empty($eenheid)){
            echo 'Je bent vergeten een eenheid te selecteren';
        }elseif(empty($sollicitatie)){
            echo 'Je bent vergeten om je sollicitatie te schrijven';
        }else{
            $insertQuery = $db->query("INSERT INTO aanmeldingen (naam,achternaam,email,afdeling, sollicitatie, accepted, date) VALUES (
            '".$naam."',
            '".$achternaam."',
            '".$email."',
            '".$eenheid."',
            '".$sollicitatie."',
            '0',
            NOW())");

            if($insertQuery){
                echo '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Succes!</strong> Bedankt voor het aanmelden! We zullen z.s.m. naar je aanmelding kijken.</div>';

                include_once("includes/PHPMailer/MailTemplates/registeermail.php");
                $uemail = $_POST['email'];

                if(isset($uemail))
                {
                  $to = $uemail;

                  if(isset($to))
                  {
                     $send_mail = send_mail($to);


                    if($send_mail === 'success')
                    {

                    }else{
                      echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 04</div>';
                    }



                  }else
                  {
                    echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 05</div>';
                  }

                }else
                {
                  echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 06</div>';
                }
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets fout gegaan bij het verzenden van je aanmeldingsformulier. Probeer het nogmaals! Errorcode: 01</div>';
            }
        }

      }
      else{
          echo '<div class="alert alert-warning alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> Het opgegeven email adres bestaat al in ons systeem!</div>';
      }
    }
}

//sign-in script
if(isset($_POST['login'])){
  if($lQuery = $db->query("SELECT id FROM aanmeldingen WHERE email='".$db->real_escape_string(strtolower($_POST['email']))."' AND accepted='0'")){
    if($lQuery->num_rows > 0){
      echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Je aanmeldingsformulier is nog niet verwerkt. Probeer het later nogmaals.</div>';
    }
    elseif($sQuery = $db->query("SELECT salt FROM users WHERE email='".$db->real_escape_string(strtolower($_POST['email']))."'")){
        $sFetch = $sQuery->fetch_assoc();
        if($lQuery = $db->query("SELECT * FROM users WHERE email='".$db->real_escape_string(strtolower($_POST['email']))."' AND password='".crypt($_POST['wachtwoord'], $sFetch['salt'])."'")) {
            if($lQuery->num_rows > 0){
                $_SESSION['email'] = $_POST['email'];
                ?><script>
                window.location = '<?php echo $site; ?>';
                </script><?php
            }
              if($lQuery = $db->query("SELECT * FROM aanmeldingen WHERE email='".$db->real_escape_string(strtolower($_POST['email']))."'")){
                 $rowCount = $lQuery->num_rows;
                if($rowCount = 0){
                  echo '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Het opgegeven email adres bestaat niet in ons systeem! Weet je zeker dat je al een account hebt aangemaakt?</div>';
                }
                else{
                    echo '<div class="alert alert-warning alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Warning!</strong> De opgegeven inlog gegevens zijn onjuist. Probeer het later nogmaals</div>';
                }
            }
          }
        }else{
            echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Errorcode: 02</div>';
        }
    }else{
      echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Errorcode: 03</div>';
    }
}
// Wachtwoord vergeten
if(isset($_POST['forgotpass']))
{
    include_once("includes/PHPMailer/MailTemplates/resetpassmail.php");
  	$uemail = $_POST['uemaill'];
  	$uemail = mysqli_real_escape_string($db, $uemail);

  	if(checkUser($uemail) == "true")
  	{
  		$userID = UserID($uemail);
  		$token = generateRandomString();

  		$query = mysqli_query($db, "INSERT INTO recovery_keys (userID, token) VALUES ('$userID', '$token') ");
  		if($query)
  		{
  			 $send_mail = send_mail($uemail, $token, $site);


  			if($send_mail === 'success')
  			{
          echo '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Succes!</strong> Er is een email naar het opgegeven adres gestuurd met een reset token.</div>';
  			}else{
          echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 04</div>';
  			}



  		}else
  		{
        echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 05</div>';
  		}

  	}else
  	{
      echo '<div class="alert alert-error alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Er is iets misgegaan. Code: 06</div>';
  	}
  }


?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hoogstad | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <link rel="icon" href="<?php echo $site; ?>/img/favicon.png" type="image/gif" sizes="64x64">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

<!--Message left -->
            <div class="col-md-6">
                <h2 class="font-bold">Welkom op: HoogStad Academie</h2>

                <p>
                    Hoogstad is het ledensysteem voor de SyntaxRP roleplay clan
                </p>

                <p>
                    Hierin kan je contact krijgen met je leiding/instructeur, je kan je eigen inbox bekijken voor berichten van je instructeur/leiding
                </p>

                <p>
					Druk op Meld Je aan
                </p>
            </div>

<!--Login Right -->
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="" method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="wachtwoord" class="form-control" placeholder="Wachtwoord" required>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b" name="login">Login</button>
                      </form>


                        <a href="#" onclick="document.getElementById(`id02`).style.display=`block`">
                            <small>Wachtwoord vergeten?</small>
                          </a>

                        <p class="text-muted text-center">
                            <small>Geen account?</small>
                        </p>
<!--Register pop-up -->
                        <a href="https://www.Hoogstad.nl/solliciteren.php" class="btn btn-sm btn-white btn-block">Meld je aan!</a>
                      </div>
                  </div>
                  <hr/>
                  <div class="row">
                      <div class="col-md-6">
                          Copyright http://www.hoogstad.be &copy; 2022
                      </div>
                      <div class="col-md-6 text-right">
                         <small></small>
                      </div>
                  </div>
                </div>
              </div>
                      <div id="id09" class="modalreg">
                            <span onclick="document.getElementById('id09').style.display='none'" class="closereg" title="Close">&times;</span>
                        <form class="modalreg-content" action="" method="post">
                            <h1><center>Sollicitatie formulier</center></h1>
                          <div class="containerreg">
                            <div class="form-group">
                    					<label for="name">Naam:</label>
                              <input type="text" name="voornaam" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                    				  <label for="achternaam">Achternaam:</label>
                              <input type="text" name="achternaam" class="form-control" id="achternaam" required>
                            </div>
                            <div class="form-group">
                    					<label for="email">E-mailadres:</label>
                              <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                    					<label for="afdeling">Voor welke afdeling solliciteert u?</label>
                              <select name="eenheid" class="form-control" id="afdeling" required>
                                <option value="" disabled selected>Kies</option>
                                <option value="nh">Politie</option>
                                <option value="mk">Meldkamer</option>
                                <option value="ambu">Ambulance</option>
                                <option value="brw">Brandweer</option>
                                <option value="kmar">Koninklijke Marechaussee</option>
                              </select>
                            </div>
                            <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
                            <script>tinymce.init({selector:'textarea'});</script>
                            <div class="form-group">
                              <label for="inputPassword3" class="form-label">Sollicitatie:</label>
                              <small>Let op: Wie, wat, waarom</small>
                              <textarea rows="18" cols="70" name="sollicitatie" class="form-control"></textarea>
                            </div>

                            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                            <div class="clearfix">
                              <button type="button" onclick="document.getElementById('id09').style.display='none'" class="cancelbtn">Cancel</button>
                              <button type="submit" name="SubmitReg" class="signupbtn" onclick="return confirm(`Weet u zeker dat u alles goed heeft ingevuld?`)">Verstuur!</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <script>
                      // Get the modal
                        var modal = document.getElementById(`id09`);

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                    <div id="id02" class="modalreg">
                          <span onclick="document.getElementById('id02').style.display='none'" class="closereg" title="Close">&times;</span>
                            	<div class="col-lg-4 col-lg-offset-4">


                                	<form class="modalreg-content" action="" method="post">
                                        <div class="containerreg">
                                            <h1><center>Wachtwoord vergeten</center> </h1>
                                          <div class="form-group">
                                            <label for="email">E-mailadres:</label>
                                            <input type="email" name="uemaill" class="form-control" id="email" placeholder="bijvoorbeeld: test@gmail.com" required>
                                          </div>
                                          <div class="clearfix">
                                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                                            <button type="submit" name="forgotpass" class="signupbtn">Verstuur!</button>
                                          </div>
                                        </div>
                        			</form>
                        		</div>
                    </div>
                  <script>
                    // Get the modal
                      var modal = document.getElementById(`id02`);

                      // When the user clicks anywhere outside of the modal, close it
                      window.onclick = function(event) {
                          if (event.target == modal) {
                              modal.style.display = "none";
                          }
                      }
                  </script>
                </div>

</body>

</html>

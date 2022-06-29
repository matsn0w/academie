<?php
if(isset($_GET['id'])){
$aanmeldingQ = $db->query("SELECT * FROM aanmeldingen WHERE id = '".$db->real_escape_string($_GET['id'])."'");
$aanmeldingF = $aanmeldingQ->fetch_assoc();
$password = $randompassword;
?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Aanmeldingen</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/leiding/aanmeldingen">Aanmeldingen</a>
                        </li>
                        <li class="active">
                            <strong>Aanmelding van <?php echo $aanmeldingF['naam']; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <script language="JavaScript" type="text/javascript">
              $(document).ready(function(){
                  $("a.delete").click(function(e){
                      if(!confirm('Are you sure?')){
                          e.preventDefault();
                          return false;
                      }
                      return true;
                  });
              });
            </script>
            <div class="col-xs-12">
                        <?php
                        $userQ = $db->query("SELECT * FROM users WHERE email = '".$aanmeldingF['email']."'");
                        $userF = $userQ->fetch_assoc();
                        if(isset($_POST['opslaan'])){
                            $username = $db->real_escape_string($_POST['username']);
                            $voornaam = $db->real_escape_string($_POST['voornaam']);
                            $achternaam = $db->real_escape_string($_POST['achternaam']);
                            $email = $db->real_escape_string($_POST['email']);
                            $eenheid = $db->real_escape_string($_POST['eenheid']);
                            $teamspeak = $db->real_escape_string($_POST['teamspeak']);
                            $roepnummer = $db->real_escape_string($_POST['roepnummer']);

                            $salt = generateSalt();
                            $password2 = crypt($password, $salt);

                            if(empty($email)){
                                ?><script>toastr.error('Je hebt geen email ingevult!', 'Oeps');</script><?php
                            }elseif(empty($username)){
                                ?><script>toastr.error('Je hebt geen gebruikersnaam ingevult!', 'Oeps');</script><?php
                            }else{




                                $query = $db->query("UPDATE `users` SET
                                  `username`= '".$username."',
                                  `password`='".$password2."',
                                  `salt`='".$salt."',
                                  `email`='".$email."',
                                  `eenheid`='".$eenheid."',
                                  `naam`='".$voornaam."',
                                  `achternaam`='".$achternaam."',
                                  `teamspeak`='".$teamspeak."',
                                  `roepnummer`='".$roepnummer."'
                                  WHERE email = '".$email."'");
                                $query .= $db->query("UPDATE `aanmeldingen` SET
                                  `naam`='".$voornaam."',
                                  `achternaam`='".$achternaam."',
                                  `email`='".$email."'
                                  WHERE id = '".$aanmeldingF['id']."'");

                                  if($query){
                                    ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                                  }else{
                                    ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                                  }
                                  echo "<script language='javascript'>window.location.href = '".$site."/leiding/aanmeldingen'</script>";
                            }

                        }
                        if(isset($_POST['accepteren'])){
                            $username = $db->real_escape_string($_POST['username']);
                            $voornaam = $db->real_escape_string($_POST['voornaam']);
                            $achternaam = $db->real_escape_string($_POST['achternaam']);
                            $email = $db->real_escape_string($_POST['email']);
                            $eenheid = $db->real_escape_string($_POST['eenheid']);
                            $teamspeak = $db->real_escape_string($_POST['teamspeak']);
                            $roepnummer = $db->real_escape_string($_POST['roepnummer']);

                            $salt = generateSalt();
                            $password2 = crypt($password, $salt);

                            if(empty($email)){
                                ?><script>toastr.error('Je hebt geen email ingevult!', 'Oeps');</script><?php
                            }elseif(empty($username)){
                                ?><script>toastr.error('Je hebt geen gebruikersnaam ingevult!', 'Oeps');</script><?php
                            }else{




                                $query = $db->query("INSERT INTO users (username,password,salt,email,eenheid,naam,achternaam,teamspeak,roepnummer) VALUES (
                                '".$username."',
                                '".$password2."',
                                '".$salt."',
                                '".$email."',
                                '".$eenheid."',
                                '".$voornaam."',
                                '".$achternaam."',
                                '".$teamspeak."',
                                '".$roepnummer."')");
error_log(date('l jS \of F Y h:i:s A').":"  . $query . "\n", 3, "pages/error/errors.log");
                                $query .= $db->query("UPDATE aanmeldingen SET accepted = '1' WHERE id = '".$aanmeldingF['id']."'");
                                $userA = $db->query("SELECT * FROM users WHERE email = '".$email."'");
                                $userB = $userA->fetch_assoc();
                                $query .= $db->query("INSERT INTO user_rank (uid,rank_id) VALUES ('".$userB['id']."', '1')");


                                include_once("includes/PHPMailer/MailTemplates/accepteerdmail.php");
                              	$uemail = $_POST['email'];

                              	if(isset($uemail))
                              	{
                              		$userID = $uemail;
                                  $username = $_POST['email'];
                                  $password3 = $password;

                              		if(isset($password3))
                              		{
                              			 $send_mail = send_mail($uemail, $username, $password3, $site);


                              			if($send_mail == 'success')
                              			{
                                      echo '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Gebruiker geaccepteerd</div>';
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
                                echo "<script language='javascript'>window.location.href = '".$site."/leiding/aanmeldingen'</script>";
                            }

                        }
                        if(isset($_POST['weigeren'])){
                            $db->query("UPDATE aanmeldingen SET accepted = '0' WHERE id = '".$aanmeldingF['id']."'");
                            $db->query("DELETE FROM users WHERE email = '".$aanmeldingF['email']."'");
                            echo '
                            <div class="alert alert-success alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4>Alert!</h4>
                                    Succesvol geweigerd
                            </div>
                            ';
                            echo "<script language='javascript'>window.location.href = '".$site."/leiding/aanmeldingen'</script>";
                        }
                        if(isset($_POST['delete'])){
                            $query = $db->query("DELETE FROM aanmeldingen WHERE id = '".$aanmeldingF['id']."'");
                            $query .= $db->query("DELETE FROM users WHERE id = '".$userF['id']."'");
                            $query .= $db->query("DELETE FROM user_rank WHERE uid = '".$userF['id']."'");
                            echo '
                            <div class="alert alert-success alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4>Alert!</h4>
                                    Succesvol geweigerd
                            </div>
                            ';
                            echo "<script language='javascript'>window.location.href = '".$site."/leiding/aanmeldingen'</script>";
                        }
                        ?>
                        <form action="" method="POST" class="form-horizontal" role="form">
                                    <div class="col-lg-6">

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Gebruikersnaam:</label>
                                            <input type="text" name="username" value="<?php echo $userF['username']; ?>" class="form-control" required/>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Naam:</label>
                                            <input type="text" name="voornaam" value="<?php echo $aanmeldingF['naam']; ?>" class="form-control" required/>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Achternaam:</label>
                                            <input type="text" name="achternaam" value="<?php echo $aanmeldingF['achternaam']; ?>" class="form-control" required/>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">E-mail:</label>
                                            <input type="email" name="email" value="<?php echo $aanmeldingF['email']; ?>" class="form-control" required/>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Eenheid:</label>
                                            <select name="eenheid" class="form-control">
                                    <option value="noodhulp" <?php if($aanmeldingF['afdeling'] == 'nh'){echo 'selected';} ?> >Noodhulp</option>
                                    <option value="kmar" <?php if($aanmeldingF['afdeling'] == 'kmar'){echo 'selected';} ?> >Koninklijke Marechaussee</option>
                                    <option value="meldkamer" <?php if($aanmeldingF['afdeling'] == 'mk'){echo 'selected';} ?>>Centralist</option>
                                    <option value="brandweer" <?php if($aanmeldingF['afdeling'] == 'brw'){echo 'selected';} ?>>Brandweer</option>
                                    <option value="ambulance" <?php if($aanmeldingF['afdeling'] == 'ambu'){echo 'selected';} ?>>Ambulance</option>
                                            </select>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Roepnummer:</label>
                                            <input type="text" name="roepnummer" value="<?php echo $userF['roepnummer']; ?>"  class="form-control"/>
                                    </div>

                                    <div class="form-group-lid">
                                         <label for="inputPassword3" class="form-label">Teamspeak:</label>
                                            <input type="text" name="teamspeak" value="<?php echo $userF['teamspeak']; ?>" class="form-control"/>
                                    </div><br>

                                    <div class="form-group-lid">
                                        <div class="margindown"></div>
                                        <?php
                                        if($aanmeldingF['accepted'] != 1){
                                            echo '<input type="submit" style="width:100px;" name="accepteren" value="Accepteren" class="btn-success btn" />';
                                        }else{
                                            echo '<input type="submit" style="width:100px;" name="opslaan" value="Opslaan" class="btn-success btn" />';
                                        }
                                        ?>
                                        <?php
                                        if($aanmeldingF['accepted'] != 0){
                                            echo '<input type="submit" style="width:100px;" name="weigeren" value="Weigeren" class="btn btn-danger" onclick="return confirm(`Weet u zeker dat u de gebruiker wilt weigeren?`)" />';
                                        }else{
                                            echo '<input type="submit" style="width:100px;" name="delete" value="Verwijderen" class="btn btn-danger" onclick="return confirm(`Weet u zeker dat u de gebruiker wilt verwijderen?`)" />';
                                        } ?>
                                    </div>

                    </div>
                                        <div class="col-lg-6">
                                          <label for="inputPassword3" class="form-label">Sollicitatie:</label>
                                          <div class="form-control" style="height: 380px" disabled><?php echo $aanmeldingF['sollicitatie']; ?></div>
                                        </div>
                        </p>
                </form>


                    </div>
                </div>
<?php }else{ echo '<h1>Je hebt geen id mee gegeven</h1>';}?>

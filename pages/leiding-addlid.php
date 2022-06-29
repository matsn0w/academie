<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>
           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/leiding/leden">Leden Beheer</a>
                        </li>
                        <li class="active">
                            <strong>Lid aanmaken</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">

                <div class="col-md-4">
                    <?php
                    if(isset($_POST['SubmitReg'])){
                        $naam = $db->real_escape_string($_POST['voornaam']);
                        $achternaam = $db->real_escape_string($_POST['achternaam']);
                        $email = $db->real_escape_string(strtolower($_POST['email']));
                        $eenheid = $db->real_escape_string($_POST['eenheid']);
                        if($aQuery = $db->query("SELECT * FROM aanmeldingen WHERE email='".$email."'")){
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
                            }else{
                                $insertQuery = $db->query("INSERT INTO aanmeldingen (naam,achternaam,email,afdeling,accepted, date) VALUES (
                                '".$naam."',
                                '".$achternaam."',
                                '".$email."',
                                '".$eenheid."',
                                '0',
                                NOW())");

                                if($insertQuery){
                                    echo '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Succes!</strong> Bedankt voor het aanmelden! We zullen z.s.m. naar je aanmelding kijken.</div>';

                                    include_once("includes/PHPMailer/MailTemplates/gebruikeraangemaaktmail.php");
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
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Naam</label>
                            <input type="text" name="voornaam"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input type="text" name="achternaam" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Eenheid</label>
                            <select name="eenheid" class="form-control">
                                <option value="nh">Noodhulp</option>
                                <option value="kmar">Koninklijke Marechaussee</option>
                                <option value="brw">Brandweer</option>
                                <option value="ambu">Ambulance</option>
                                <option value="mk">Meldkamer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Opslaan" class="btn btn-primary" name="SubmitReg">
                        </div>
                    </div>

            </div>

        </div>
<?php
}
?>

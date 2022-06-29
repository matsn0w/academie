            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Account Instellingen</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Mijn Account</a>
                        </li>
                        <li class="active">
                            <strong>Instellingen</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-6 .col-md-4">
                <h2>Account Informatie</h2>
                <?php
                if(isset($_POST['submitAccount'])){
                    $email = $db->real_escape_string($_POST['email']);
                    $avatar = $db->real_escape_string($_POST['avatar']);
                    $overmijzelf = $db->real_escape_string($_POST['overmij']);
                    $teamspeak = $db->real_escape_string($_POST['teamspeak']);

                    if(empty($email)){
                        ?><script>toastr.error("Geen Email ingevult!", "Oeps")</script><?php
                    }
                    if(empty($teamspeak)){
                        ?><script>toastr.error("Je hebt geen Teamspeak gebruikersnaam ingevuld!", "Oeps")</script><?php
                    }else{
                            $q1 = $db->query("UPDATE users SET email = '".$email."', avatar = '".$avatar."', overmijzelf = '".$overmijzelf."', teamspeak = '".$teamspeak."' WHERE id = '".$userFetch['id']."'");

                            if($q1){
                                ?>
                                <script language="javascript">
                                    window.location.href = "<?php echo $site; ?>/profiel/<?php echo $userFetch['id'];?>"
                                </script>
                                <?php
                            }else{
                                ?><script>toastr.error("Er is iets misgegaan met het updaten!", "Oeps")</script><?php
                            }
                        }


                    }
                ?>
                            <form class="form-horizontal" action="" method="POST">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email" placeholder="Email" name="email" value="<?php echo $userFetch['email']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Teamspeak</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="Tip: Kopieër je TeamSpeak naam vanaf onze TeamSpeak server, zo kun je nooit fout zitten!" name="teamspeak" value="<?php echo $userFetch['teamspeak']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Avatar</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="http://avatarlink.nl" name="avatar" value="<?php echo $userFetch['avatar']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Opslaan" name="submitAccount">
                                </div>

                              </div>
                              <div class="col-xs-6 .col-md-4">
                                <div>
                                  <br /><br />
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Over mijzelf:</label>
                                    <textarea class="form-control" name="overmij" rows="8" cols="5"><?php echo $userFetch['overmijzelf']; ?></textarea>
                                </div>
                              </div>
                            </form>

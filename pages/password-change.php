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
                <h2>Wachtwoord Wijzigen</h2>
                <?php
                if(isset($_POST['ChangePW'])){
                    $password = $db->real_escape_string($_POST['password']);
                    $password2 = $db->real_escape_string($_POST['password2']);

                        if(!empty($password)){
                            if($password != $password2){
                                ?><script>toastr.error("Je wachtwoorden komen niet overeen.", "Oeps")</script><?php
                            }else{
                                $salt = generateSalt();

                                $q2 = $db->query("UPDATE users SET password = '".crypt($_POST['password'], $salt)."', salt = '".$salt."' WHERE id = '".$userFetch['id']."'");
                                if($q2){
                                ?><script>toastr.success("Je hebt je instellingen aangepast!", "Succes!")</script><?php
                                $_SESSION = array();
                                session_destroy();
                                ?>
                                <script language="javascript">
                                    window.location.href = "<?php echo $site; ?>"
                                </script>
                                <?php
                            }else{
                                ?><script>toastr.error("Er is iets misgegaan met het updaten!", "Oeps")</script><?php
                            }
                            }
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
                    <label class="col-lg-2 control-label">Wachtwoord</label>
                    <div class="col-lg-10">
                        <input type="password" placeholder="Wachtwoord (Alleen invullen als je hem wilt veranderen!)" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Wachtwoord*</label>
                    <div class="col-lg-10">
                        <input type="password" placeholder="Wachtwoord (Alleen invullen als je hem wilt veranderen!)" name="password2" class="form-control">
                        <span class="help-block m-b-none">*Ter controle.</span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Opslaan" name="ChangePW">
                </div>
            </form>
        </div>

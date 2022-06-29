<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
if(isset($_GET['id'])){
    $getMember = $db->query("SELECT * FROM users WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $fetchLid = $getMember->fetch_assoc();

    $id = $db->real_escape_string($_GET['id']);
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
                            <strong><?php echo $fetchLid['username']; ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">


            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image" style="width:120px;float:left;">
                        <img src="<?php echo $fetchLid['avatar']; ?>" style="width:96px; height:96px; border-radius: 50%; margin:0 auto;" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info" style="margin-left: 120px;">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php echo $fetchLid['username']; ?>
                                </h2>
                                <h4><?php echo $fetchLid['eenheid']; ?></h4>
                                <small>
                                    <?php if(empty($fetchLid['overmijzelf'])){echo 'Niks ingevult over mijzelf!';}else{ echo $fetchLid['overmijzelf']; } ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row">
<!------------------------------------------------>

            <div class="tabbable" id="tabs-734993">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-826289" data-toggle="tab">Gegevens</a>
					</li>
                    <li>
                        <a href="#specialisatie" data-toggle="tab">Specialisatie's</a>
                    </li>

				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-826289">

                <!-------------------------------------------------->
                <div class="col-md-4">
                    <?php
                    if(isset($_POST['saveForm'])){
                        $naam = $db->real_escape_string($_POST['naam']);
                        $achternaam = $db->real_escape_string($_POST['achternaam']);
                        $email = $db->real_escape_string($_POST['email']);
                        $teamspeak = $db->real_escape_string($_POST['teamspeak']);
                        $eenheid = $db->real_escape_string($_POST['eenheid']);
                        $ingewerkt = $db->real_escape_string($_POST['ingewerkt']);
                        $roepnummer = $db->real_escape_string($_POST['roepnummer']);
                        $inactief = $db->real_escape_string($_POST['inactief']);
                        $opgesprek = $db->real_escape_string($_POST['opgesprek']);
                        $ingewerkt = $db->real_escape_string($_POST['ingewerkt']);
                        $reserve_centralist = $db->real_escape_string($_POST['reserve_centralist']);

                        if(empty($email)){
                            ?><script>toastr.error('Je hebt geen email ingevult!', 'Oeps');</script><?php
                        }else{

                            $query = $db->query("UPDATE users SET
                            naam = '".$naam."',
                            achternaam = '".$achternaam."',
                            email = '".$email."',
                            teamspeak = '".$teamspeak."',
                            eenheid = '".$eenheid."',
                            ingewerkt = '".$ingewerkt."',
                            roepnummer = '".$roepnummer."',
                            inactief = '".$inactief."',
                            opgesprek = '".$opgesprek."',
                            ingewerkt = '".$ingewerkt."',
                            reserve_centralist = '".$reserve_centralist."'  WHERE id = '".$id."'");

                            if($query){
                                ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }

                        }
                    }
                    if(isset($_POST['delUser'])){
                        $id = $db->real_escape_string($_GET['id']);

                        $q = $db->query("DELETE FROM users WHERE id = '".$id."'");
                        if($q){
                                ?><script>location.href='<?php echo $site; ?>/leiding/leden';</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }
                    }

                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Naam</label>
                            <input type="text" name="naam" value="<?php echo $fetchLid['naam']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input type="text" name="achternaam" value="<?php echo $fetchLid['achternaam']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" value="<?php echo $fetchLid['email']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Teamspeak</label>
                            <input type="text" name="teamspeak" value="<?php echo $fetchLid['teamspeak']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Eenheid</label>
                            <select name="eenheid" class="form-control">
                                <option value="noodhulp" <?php if($fetchLid['eenheid'] == 'noodhulp'){echo 'selected';} ?> >Politie</option>
                                <option value="brandweer" <?php if($fetchLid['eenheid'] == 'brandweer'){echo 'selected';} ?> >Brandweer</option>
                                <option value="ambulance" <?php if($fetchLid['eenheid'] == 'ambulance'){echo 'selected';} ?> >Ambulance</option>
                                <option value="meldkamer" <?php if($fetchLid['eenheid'] == 'meldkamer'){echo 'selected';} ?> >Meldkamer</option>
                                <option value="kmar" <?php if($fetchLid['eenheid'] == 'kmar'){echo 'selected';} ?> >Koninklijke Marechaussee</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Roepnummer</label>
                            <input type="text" name="roepnummer" value="<?php echo $fetchLid['roepnummer']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Reserve Centralist</label>
                            <select name="reserve_centralist" class="form-control">
                                <option value="0" <?php if($fetchLid['reserve_centralist'] == '0'){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['reserve_centralist'] == '1'){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>



                        <div class="form-group">
                            <input type="submit" value="Opslaan" class="btn btn-primary" name="saveForm">
                            <input type="submit" value="Verwijder" class="btn btn-danger" name="delUser">

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label>Inactief</label>
                            <select name="inactief" class="form-control">
                                <option value="0" <?php if($fetchLid['inactief'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['inactief'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Op Gesprek</label>
                            <select name="opgesprek" class="form-control">
                                <option value="0" <?php if($fetchLid['opgesprek'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['opgesprek'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ingewerkt</label>
                            <select name="ingewerkt" class="form-control">
                                <option value="0" <?php if($fetchLid['ingewerkt'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['ingewerkt'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <h2>Opmerkingen <?php echo $fetchLid['username']; ?></h2>
                    <?php
                    if(isset($_POST['save_opmerking'])){
                        $i_opmerking = $db->real_escape_string($_POST['i_opmerkingen']);
                        $l_opmerking = $db->real_escape_string($_POST['l_opmerkingen']);

                        $query = $db->query("UPDATE users SET i_opmerking = '".$i_opmerking."', l_opmerking = '".$l_opmerking."' WHERE id = '".$id."'");

                        if($query){
                                ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }

                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Leiding</label>
                            <textarea name="l_opmerkingen" rows="10" class="form-control"><?php echo $fetchLid['l_opmerking']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Instructeur</label>
                            <textarea name="i_opmerkingen" rows="10" class="form-control"><?php echo $fetchLid['i_opmerking']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="save_opmerking" value="Opslaan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
					</div>
                    <div class="tab-pane" id="specialisatie">
                        <?php
                        if(isset($_POST['saveSpecialisatie'])){
                            $id = $db->real_escape_string($_GET['id']);

                            $specialisatie = $_POST['specialisatie'];
                            $db->query("DELETE FROM specialisaties_gekoppeld WHERE uid ='".$fetchLid['id']."'");
                          if(is_array($specialisatie)){
                            foreach($specialisatie as $spec) {
                              if(isset($spec) == true){
                                  $query = $db->query("INSERT INTO specialisaties_gekoppeld (uid, sid) VALUES ('".$id."', '".$spec."')");
                              }
                            }
                            if($query){
                                ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }
                          }
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Specialisatie</label><br />

                                <?php
                                $getSpecialisatie = $db->query("SELECT * FROM specialisaties WHERE afdeling = '".$fetchLid['eenheid']."'");
                                while($fetchSpecialisatie = $getSpecialisatie->fetch_array()){
                                    $getGekoppeld = $db->query("SELECT * FROM specialisaties_gekoppeld WHERE sid = '".$fetchSpecialisatie['id']."' and uid ='".$fetchLid['id']."'");
                                    $fetchGekoppeld = $getGekoppeld->fetch_assoc();

                                ?>
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="radio" value="<?php echo $fetchSpecialisatie['id']; ?>" name="specialisatie[]" <?php if($fetchSpecialisatie['id'] == $fetchGekoppeld['sid']){echo'checked';} ?> > <?php echo $fetchSpecialisatie['naam']; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="">
                                <input type="submit" class="btn btn-primary" value="Opslaan!" name="saveSpecialisatie">
                            </div>
                        </form>
                    </div>

				</div>
</div>
            </div>

        </div>
<?php }
}
?>

<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
if(isset($_GET['id'])){
    $getMember = $db->query("SELECT * FROM users WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $fetchLid = $getMember->fetch_assoc();

    $id = $db->real_escape_string($_GET['id']);
?>
<style>
#delbutton {
    background: url(<?php echo $site; ?>/img/Delete.png);
    border: 0;
    display: block;
    height: 16px;
    width: 16px;
}
</style>
           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/instructeur/leden">Leden Beheer</a>
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

                <div class="tabbable" id="tabs-934993">
    				<ul class="nav nav-tabs">
    					<li class="active">
    						<a href="#panel-926289" data-toggle="tab">Gegevens</a>
    					</li>
              <li>
                  <a href="#instructeur-cijfers" data-toggle="tab">Cijfers</a>
              </li>
              <li>
                  <a href="#instructeur-specialisatie" data-toggle="tab">Specialisatie's</a>
              </li>

    				</ul>
    				<div class="tab-content">
    					<div class="tab-pane active" id="panel-926289">

                    <!-------------------------------------------------->
                <div class="col-md-4">
                    <?php
                    if(isset($_POST['saveForm'])){
                        $naam = $db->real_escape_string($_POST['naam']);
                        $achternaam = $db->real_escape_string($_POST['achternaam']);
                        $email = $db->real_escape_string($_POST['email']);
                        $teamspeak = $db->real_escape_string($_POST['teamspeak']);
                        $eenheid = $db->real_escape_string($_POST['eenheid']);
                        $roepnummer = $db->real_escape_string($_POST['roepnummer']);
                        $inactief = $db->real_escape_string($_POST['inactief']);
                        $reserve_centralist = $db->real_escape_string($_POST['reserve_centralist']);
                        $ingewerkt = $db->real_escape_string($_POST['ingewerkt']);


                        if(empty($roepnummer)){
                            ?><script>toastr.error('Je hebt geen roepnummer ingevult!', 'Oeps');</script><?php
                        }else{

                            $query = $db->query("UPDATE users SET
                            naam = '".$naam."',
                            achternaam = '".$achternaam."',
                            email = '".$email."',
                            teamspeak = '".$teamspeak."',
                            eenheid = '".$eenheid."',
                            roepnummer = '".$roepnummer."',
                            inactief = '".$inactief."',
                            ingewerkt = '".$ingewerkt."',
                            reserve_centralist = '".$reserve_centralist."'  WHERE id = '".$id."'");


                            if($query){
                                ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }

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
                                <option value="kmar" <?php if($fetchLid['eenheid'] == 'kmar'){echo 'selected';} ?> >Koninklijke Marechaussee</option>
                                <option value="brandweer" <?php if($fetchLid['eenheid'] == 'brandweer'){echo 'selected';} ?> >Brandweer</option>
                                <option value="ambulance" <?php if($fetchLid['eenheid'] == 'ambulance'){echo 'selected';} ?> >Ambulance</option>
                                <option value="meldkamer" <?php if($fetchLid['eenheid'] == 'meldkamer'){echo 'selected';} ?> >Meldkamer</option>
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
                            <label>Inactief</label>
                            <select name="inactief" class="form-control">
                                <option value="0" <?php if($fetchLid['inactief'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['inactief'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ingewerkt</label>
                            <select name="ingewerkt" class="form-control">
                                <option value="0" <?php if($fetchLid['ingewerkt'] == '0'){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['ingewerkt'] == '1'){echo 'selected';} ?>>Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Opslaan" class="btn btn-primary" name="saveForm">
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
          <!--Cijfers-->
          <div class="tab-pane" id="instructeur-cijfers">
            <div class="col-md-4" style="font-size:14px;">
                <div style="float:right;"><a href="<?php echo $site; ?>/instructeur/toevoegen/cijfer"><small>Toevoegen</small></a></div>
                <h2>Cijfers</h2>
                <?php
                if(isset($_POST['delCijfer'])){

                    $delQ = $db->query("DELETE FROM cijfers WHERE id = '".$db->real_escape_string($_POST['cijferID'])."'");

                    if($delQ){
                        ?><script>toastr.success('Succesvol Verwijderd!', 'Succes');</script><?php
                    }else{
                        ?><script>toastr.error('Er ging iets mis met het verwijderen!', 'Oeps');</script><?php
                    }

                }
                ?>

                <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Cijfer</th>
                        <th>Titel</th>
                        <th>X</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getCijfer = $db->query("SELECT * FROM cijfers WHERE uid = '".$id."'");
                    while($fetchCijfer = $getCijfer->fetch_array()){
                    ?>
                    <tr class=" <?php if($fetchCijfer['cijfer'] > '5.4'){echo 'success';}else{echo 'danger';} ?>">
                        <td><?php echo $fetchCijfer['cijfer']; ?></td>
                        <td><?php echo $fetchCijfer['title']; ?></td>
                        <form action="" method="POST">
                            <input type="text" style="display:none;" value="<?php echo $fetchCijfer['id']; ?>" name="cijferID">
                            <td><input type="submit" value="" id="delbutton" name="delCijfer"></td>
                        </form>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>

            </div>
          </div>
          <!--specialisatie-->
          <div class="tab-pane" id="instructeur-specialisatie">
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
<?php }
}
?>

<?php
if($vertrouwenspersoon != 1){
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
                            <a>Vertrouwenspersoon</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/vertrouwenspersoon/leden">Leden Beheer</a>
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

            <div class="tabbable" id="tabs-415180">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-883070" data-toggle="tab">Informatie</a>
					</li>
					<li>
						<a href="#panel-625451" data-toggle="tab">Problemen</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-883070">

            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">

                    <div class="profile-image" style="width:120px;float:left;">
                        <img src="<?php echo $fetchLid['avatar']; ?>" style="width:96px;" class="img-circle circle-border m-b-md" alt="profile">
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
                <div class="col-md-3">
                    <table class="table small m-b-xs">
                        <h3>Statistieken (binnenkort)</h3>
                        <tbody>
                        <tr>
                            <td>
                                <strong>142</strong> Projects
                            </td>
                            <td>
                                <strong>22</strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Tags
                            </td>
                            <td>
                                <strong>32</strong> Friends
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="row">

                <div class="col-md-4">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Naam</label>
                            <input type="text" name="naam" value="<?php echo $fetchLid['naam']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Achternaam</label>
                            <input type="text" name="achternaam" value="<?php echo $fetchLid['achternaam']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Leeftijd</label>
                            <input type="text" name="leeftijd" value="<?php echo $fetchLid['leeftijd']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Geboortedatum</label>
                            <input type="text" name="geboortedatum" value="<?php echo $fetchLid['geboortedatum']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" value="<?php echo $fetchLid['email']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Telefoon</label>
                            <input type="text" name="telefoon" value="<?php echo $fetchLid['telefoon']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Eenheid</label>
                            <select name="eenheid" class="form-control" disabled>
                                <option value="noodhulp" <?php if($fetchLid['eenheid'] == 'noodhulp'){echo 'selected';} ?> >Noodhulp</option>
                                <option value="brandweer" <?php if($fetchLid['eenheid'] == 'brandweer'){echo 'selected';} ?> >Brandweer</option>
                                <option value="ambulance" <?php if($fetchLid['eenheid'] == 'ambulance'){echo 'selected';} ?> >Ambulance</option>
                                <option value="meldkamer" <?php if($fetchLid['eenheid'] == 'meldkamer'){echo 'selected';} ?> >Meldkamer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Roepnummer</label>
                            <input type="text" name="roepnummer" value="<?php echo $fetchLid['roepnummer']; ?>" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Specialisatie</label>
                            <input type="text" name="specialisatie" value="<?php echo $fetchLid['specialisatie']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Bewijzen</label>
                            <input type="text" name="bewijzen" value="<?php echo $fetchLid['bewijzen']; ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Gedrag</label>
                            <select name="gamegedrag" class="form-control" disabled>
                                <option value="1" <?php if($fetchLid['gamegedrag'] == 1){echo 'selected';} ?> >Ruim Voldoende</option>
                                <option value="2" <?php if($fetchLid['gamegedrag'] == 2){echo 'selected';} ?> >Voldoende</option>
                                <option value="3" <?php if($fetchLid['gamegedrag'] == 3){echo 'selected';} ?> >Onvoldoende</option>
                                <option value="4" <?php if($fetchLid['gamegedrag'] == 4){echo 'selected';} ?> >Ruim Onvoldoende</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hoevaak online</label>
                            <select name="hoevaakonline" class="form-control" disabled>
                                <option value="1" <?php if($fetchLid['hoevaakonline'] == 1){echo 'selected';} ?> >Ruim Voldoende</option>
                                <option value="2" <?php if($fetchLid['hoevaakonline'] == 2){echo 'selected';} ?> >Voldoende</option>
                                <option value="3" <?php if($fetchLid['hoevaakonline'] == 3){echo 'selected';} ?> >Onvoldoende</option>
                                <option value="4" <?php if($fetchLid['hoevaakonline'] == 4){echo 'selected';} ?> >Ruim Onvoldoende</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Inactief</label>
                            <select name="inactief" class="form-control" disabled>
                                <option value="0" <?php if($fetchLid['inactief'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['inactief'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Andere clans</label>
                            <input type="text" name="andereclan" value="<?php echo $fetchLid['andereclan']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Op Gesprek</label>
                            <select name="opgesprek" class="form-control" disabled>
                                <option value="0" <?php if($fetchLid['opgesprek'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['opgesprek'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Games For Windows Live</label>
                            <input type="text" name="gfwl" value="<?php echo $fetchLid['gfwl']; ?>" class="form-control" disabled>
                        </div>

                    </form>
                </div>

                <div class="col-md-4">
                    <h2>Vertrouwenspersoon: <?php echo $fetchLid['username']; ?></h2>
                    <?php
                    if(isset($_POST['save_opmerking'])){
                        $v_opmerking = $db->real_escape_string($_POST['v_opmerkingen']);
                        $v_gesprek = $db->real_escape_string($_POST['vertrouw_gesprek']);

                        $query = $db->query("UPDATE users SET vertrouw_gesprek = '".$v_gesprek."', v_opmerkingen = '".$v_opmerking."' WHERE id = '".$id."'");

                        if($query){
                                ?><script>toastr.success('Succesvol geupdated!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }

                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Gesprekje gehad</label>
                            <select name="vertrouw_gesprek" class="form-control">
                                <option value="0" <?php if($fetchLid['vertrouw_gesprek'] == 0){echo 'selected';} ?> >Nee</option>
                                <option value="1" <?php if($fetchLid['vertrouw_gesprek'] == 1){echo 'selected';} ?> >Ja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Opmerkingen</label>
                            <textarea name="v_opmerkingen" rows="10" class="form-control"><?php echo $fetchLid['v_opmerkingen']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="save_opmerking" value="Opslaan" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
</div>
					<div class="tab-pane" id="panel-625451">
						<h1>Problemen</h1>

                        <?php
                        if(isset($_POST['delItem'])){
                            $id = $db->real_escape_string($_POST['id']);

                            $q = $db->query("DELETE FROM vertrouw_problemen WHERE id = '".$id."'");

                            if($q){
                                ?><script>toastr.success('Succesvol verwijderd!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het verwijderen!', 'Oeps');</script><?php
                            }
                        }
                        if(isset($_POST['editItem'])){
                            $id = $db->real_escape_string($_POST['id']);

                            ?><script>location.href='<?php echo $site; ?>/vertrouwenspersoon/aanpassen/probleem/<?php echo $id; ?>';</script><?php
                        }
                        ?>

                        <?php
                        $getProblem = $db->query("SELECT * FROM vertrouw_problemen WHERE p1 = '".$fetchLid['id']."' OR p2 = '".$fetchLid['id']."'");
                        while($fetchProblem = $getProblem->fetch_array()){
                            $p1User = $db->query("SELECT id, username FROM users WHERE id = '".$fetchProblem['p1']."'");
                            $p1Username = $p1User->fetch_assoc();

                            $p2User = $db->query("SELECT id, username FROM users WHERE id = '".$fetchProblem['p2']."'");
                            $p2Username = $p2User->fetch_assoc();
                        ?>
                        <div class="col-md-6">
                            <b>Persoon 1</b><br />
                            <?php echo $p1Username['username']; ?><br />
                            <br />
                            <b>Verklaring</b><br />
                            <?php echo $fetchProblem['p1verklaring']; ?><br />
                            <br />
                            <hr style="border-color:#CECECE;">

                        </div>
                        <div class="col-md-6">
                            <b>Persoon 2</b><br />
                            <?php echo $p2Username['username']; ?><br />
                            <br />
                            <b>Verklaring</b><br />
                            <?php echo $fetchProblem['p2verklaring']; ?><br />
                            <form action="" method="post">
                                <input type="text" style="display:none;" name="id" value="<?php echo $fetchProblem['id']; ?>">
                                <input type="submit" class="btn btn-danger" style="float:right;" name="delItem" value="X"> &nbsp; &nbsp;
                                <input type="submit"  class="btn btn-primary" style="float:right;" name="editItem" value="Aanpassen">
                            </form>
                            <hr style="border-color:#CECECE;">
                        </div>
                        <hr style="border-color:#CECECE;">
                        <?php
                        }
                        ?>
					</div>
				</div>
			</div>
        </div>
<?php }
}
?>

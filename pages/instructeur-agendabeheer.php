<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
if(isset($_GET['id'])){
$getAgenda = $db->query("SELECT * FROM agenda WHERE id = '".$db->real_escape_string($_GET['id'])."'");
$fetchAgenda = $getAgenda->fetch_assoc();
        $getUsername = $db->query("SELECT id, username FROM users WHERE id = '".$fetchAgenda['made_uid']."'");
        $fetchUsername = $getUsername->fetch_assoc();
?>


                <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Project detail</h2>
                    <ol class="breadcrumb" style="width:540px;">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/instructeur/agenda">Beheer Agenda</a>
                        </li>
                        <li class="active">
                            <strong>Agenda Aanpassen</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if(isset($_POST['verwijder'])){
                                        $query = $db->query("UPDATE agenda SET status = '1' WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                                        if($query){
                                            echo 'Succesvol een item verwijderd!';
                                        }else{
                                            echo 'Er is iets misgegaan!';
                                        }
                                    }
                                    ?>
                                    <div class="m-b-md">
                                        <form action="" method="post">
                                        <input type="submit" class="btn btn-white btn-xs pull-right" name="verwijder" value="Verwijderen">
                                        </form>
                                        <h2>Agenda: <?php echo $fetchAgenda['title']; ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><?php
    if($fetchAgenda['status'] == 0){
        echo '<span class="label label-primary">Actief</span>';
    }else{
        echo '<span class="label label-danger">Verwijderd</span>';
    } ?></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Gemaakt door:</dt> <dd><?php echo $fetchUsername['username']; ?></dd>
                                        <dt>Datum:</dt> <dd>  <?php
                                                                setlocale(LC_TIME, 'nld_nld');
                                                                echo strftime('%e %B %Y om %H:%M', strtotime($fetchAgenda['start']));
                                                                ?></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">

                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <?php
                                    if(isset($_POST['save'])){
                                        $title = $db->real_escape_string($_POST['titel']);
                                        $start = $db->real_escape_string($_POST['date']);
                                        $url = '';
                                        $afdeling = $db->real_escape_string($_POST['afdeling']);

                                        if(empty($title)){
                                            echo 'Vergeten een titel in te vullen!';
                                        }elseif(empty($start)){
                                            echo 'Vergeten een datum in te vullen!';
                                        }else{

                                            $query = $db->query("UPDATE agenda SET title = '".$title."', start = '".$start."', afdeling = '".$afdeling."' WHERE id = '".$db->real_escape_string($_GET['id'])."'");

                                            if($query){
                                                echo 'Succesvol opgeslagen';
                                            }else{
                                                echo 'Er is iets misgegaan! Email naar systeem@nnpdclan.nl';
                                            }

                                        }

                                    }
                                    ?>
                                    <form action="" method="POST">

                                        <div class="form-group">
                                            <label>Titel</label>
                                            <input type="text" name="titel" placeholder="Je moeder is een plopkoek" value="<?php echo $fetchAgenda['title']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group" id="datetimepicker1">
                                            <label>Datum</label>
                                            <input type="text" name="date" value="<?php echo $fetchAgenda['start']; ?>" data-format="dd/MM/yyyy hh:mm:ss" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Afdeling</label>
                                            <select name="afdeling" class="form-control">
                                                <option value="noodhulp" <?php if($fetchAgenda['afdeling'] == 'noodhulp'){echo 'selected';}?> >Noodhulp</option>
                                                <option value="ambulance" <?php if($fetchAgenda['afdeling'] == 'ambulance'){echo 'selected';}?> >Ambulance</option>
                                                <option value="kmar" <?php if($fetchAgenda['afdeling'] == 'kmar'){echo 'selected';}?> >Koninklijke Marechaussee</option>
                                                <option value="meldkamer" <?php if($fetchAgenda['afdeling'] == 'meldkamer'){echo 'selected';}?> >Meldkamer</option>
                                                <option value="all" <?php if($fetchAgenda['afdeling'] == 'all'){echo 'selected';}?> >Iedereen</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="save" class="btn btn-primary" value="Aanpassen">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
}
}
?>

<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
if(isset($_GET['id'])){
$getTraining = $db->query("SELECT * FROM trainingen WHERE id = '".$db->real_escape_string($_GET['id'])."'");
$fetchTraining = $getTraining->fetch_assoc();

?>


                <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Trainingen</h2>
                    <ol class="breadcrumb" style="width:540px;">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/instructeur/training">Trainingen</a>
                        </li>
                        <li class="active">
                            <strong>Training Aanpassen</strong>
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
                                        $query = $db->query("UPDATE trainingen SET status = '1' WHERE id = '".$db->real_escape_string($_GET['id'])."'");
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
                                        <h2>Agenda: <?php echo $fetchTraining['title']; ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt> <dd><?php 
    if($fetchTraining['status'] == 0){
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

                                        <dt>Voor:</dt> <dd><?php echo ucfirst($fetchTraining['eenheid']); ?></dd>
                                        <dt>Datum:</dt> <dd>  <?php 
                                                                setlocale(LC_TIME, 'nld_nld');
                                                                echo strftime('%e %B %Y om %H:%M', strtotime($fetchTraining['date']));
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
                                        $date = $db->real_escape_string($_POST['date']);
                                        $uitleg = $db->real_escape_string($_POST['uitleg']);
                                        
                                        if(empty($title)){
                                            echo 'Vergeten een titel in te vullen!';
                                        }elseif(empty($date)){
                                            echo 'Vergeten een datum in te vullen!';
                                        }else{
                                            
                                            $query = $db->query("UPDATE trainingen SET title = '".$title."', date = '".$date."', uitleg = '".$uitleg."' WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                                            
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
                                            <input type="text" name="titel" placeholder="Je moeder is een plopkoek" value="<?php echo $fetchTraining['title']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group" id="datetimepicker1">
                                            <label>Datum</label>
                                            <input type="text" name="date" value="<?php echo $fetchTraining['date']; ?>" data-format="dd/MM/yyyy hh:mm:ss" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Uitleg</label>
                                            <textarea name="uitleg" class="form-control"><?php echo $fetchTraining['uitleg']; ?></textarea>
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
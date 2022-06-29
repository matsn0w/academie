<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Agenda beheer</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $site; ?>/home">Home</a>
            </li>
            <li class="active">
                <strong>Training Aanvragen</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <h1>Training aanvragen.</h1>
            <?php
            if(isset($_POST['submitTraining'])){
                $soort = $db->real_escape_string($_POST['soort']);
                $uitleg = $db->real_escape_string($_POST['uitleg']);
                $chosendate = $db->real_escape_string($_POST['chosendate']);
                if(empty($uitleg)){
                    echo 'Je hebt geen uitleg ingevuld.';
                }elseif(empty($chosendate)){
                    echo 'Je hebt geen datum ingevuld.';
                }else{
                    $query = $db->query("INSERT INTO formtraining (uid,training,bericht,chosendate,date) VALUES (
                    '".$userFetch['id']."',
                    '".$soort."',
                    '".$uitleg."',
                    '".$chosendate."',
                    NOW()
                    )");
                    if($query){
                        echo 'Je trainingverzoek is binnen gekomen!';
                    }else{
                        echo 'Er ging iets mis met het verzenden van je formulier!';
                    }
                }
            }
            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Training Soort:</label>
                    <select class="form-control" name="soort" required>
                        <option value="1">Inwerk Training</option>
                        <option value="2">Specialisatie Training</option>
                        <option value="3">Promotie</option>
                        <option value="4">Overig</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Uitleg:</label>
                    <textarea class="form-control" name="uitleg" rows="5" cols="5" required></textarea>
                </div>
                <div class="form-group">
                    <label>Gewenste Datum:</label>
                    <input type="text" placeholder="21/6/2016 16:00" name="chosendate" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Aanvragen" class="btn btn-primary" name="submitTraining">
                </div>
            </form>
        </div>
    </div>
</div>

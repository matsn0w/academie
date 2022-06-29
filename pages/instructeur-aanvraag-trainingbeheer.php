<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Agenda beheer</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $site; ?>/home">Home</a>
            </li>
            <li>
                <a >Instructeur</a>
            </li>
            <li class="active">
                <strong>Training Aanvragen Bekijken</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <h1>Training aanvragen.</h1>


            <table class="table">
                <tr>
                    <th>Naam:</th>
                    <th>Soort:</th>
                    <th>Datum:</th>
                </tr>
                <?php
                $getAanvraag = $db->query("SELECT * FROM formtraining WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                $fetchAanvraag = $getAanvraag->fetch_array();
                    $getUser = $db->query("SELECT username, id FROM users WHERE id = '".$fetchAanvraag['uid']."'");
                    $fetchUsername = $getUser->fetch_assoc();
                ?>
                <tr>
                    <td><?php echo $fetchUsername['username']; ?></td>
                    <td><?php
                        if($fetchAanvraag['training'] == 1){
                            echo 'Inwerk Training';
                        }elseif($fetchAanvraag['training'] == 2){
                            echo 'Specialisatie Training';
                        }elseif($fetchAanvraag['training'] == 3){
                            echo 'Promotie Training';
                        }else{
                            echo 'Overig';
                        }

                        ?></td>
                    <td><?php echo $fetchAanvraag['date']; ?></td>

                </tr>
            </table>
            <b>Uitleg:</b><br />
            <?php echo $fetchAanvraag['bericht']; ?>

            <h1>Accepteren:</h1>
            <?php
            if(isset($_POST['AcceptTraining'])){
                $bericht = $db->real_escape_string($_POST['bericht']);
                $chosendate = $db->real_escape_string($_POST['chosendate']);

                if(empty($bericht)){
                    echo 'Je hebt geen bericht ingevuld';
                }elseif(empty($chosendate)){
                    echo 'Je hebt geen datum ingevuld!';
                }else{
                    $query = $db->query("INSERT INTO mailbox (uid_from,name_from,uid_to,title,bericht,date,categorie,important) VALUES (
                    '0',
                    'Instructeur',
                    '".$fetchAanvraag['uid']."',
                    'Training aanvraag: ".$chosendate."',
                    '".$bericht."',
                    NOW(),
                    '2',
                    '1'
                    )");
                    $query .= $db->query("UPDATE formtraining SET stat = '1' WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                    if($query){
                        echo 'Bericht Verzonden!';
                    }else{
                        echo 'Er ging iets mis!';
                    }
                }
            }
            if(isset($_POST['Afwijzen'])){
                $query = $db->query("DELETE FROM formtraining WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                $bericht = $db->real_escape_string($_POST['bericht']);
                $query .= $db->query("INSERT INTO mailbox (uid_from,name_from,uid_to,title,bericht,date,categorie,important) VALUES (
                    '0',
                    'Instructeur',
                    '".$fetchAanvraag['uid']."',
                    'Training aanvraag Afgewezen',
                    '".$bericht."',
                    NOW(),
                    '2',
                    '1'
                    )");
                    if($query){
                        echo 'Afgewezen!';
                    }else{
                        echo 'Er ging iets mis!';
                    }
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Bericht:</label>
                    <textarea class="form-control" name="bericht" rows="5" cols="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Datum:</label>
                    <input type="text" value="<?php echo $fetchAanvraag['chosendate']; ?>" name="chosendate" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Accepteren" class="btn btn-primary" name="AcceptTraining">
                    <input type="submit" value="Afwijzen" class="btn btn-danger" name="Afwijzen">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>

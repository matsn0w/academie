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
                $getAanvraag = $db->query("SELECT * FROM formtraining WHERE stat = '0' ORDER BY date");
                while($fetchAanvraag = $getAanvraag->fetch_array()){
                    $getUser = $db->query("SELECT username, id FROM users WHERE id = '".$fetchAanvraag['uid']."'");
                    $fetchUsername = $getUser->fetch_assoc();
                ?>
                <tr onclick="location.href='<?php echo $site; ?>/instructeur/aanvraag-beheer/<?php echo $fetchAanvraag['id']; ?>'">
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
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
}
?>

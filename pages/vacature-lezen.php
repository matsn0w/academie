<?php
$getAanvraag = $db->query("SELECT * FROM vacatures WHERE id = '".$db->real_escape_string($_GET['id'])."'");
$fetchAanvraag = $getAanvraag->fetch_array();
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Vacature Bekijken</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $site; ?>/home">Home</a>
            </li>
            <li>
                <a href="<?php echo $site; ?>/vacatures">Vacatures</a>
            </li>
            <li class="active">
                <strong>Vacature Bekijken</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <?php
            if($leiding == 1){
                if(isset($_POST['delVacature'])){
                    $id = $db->real_escape_string($_GET['id']);

                    $db->query("DELETE FROM vacatures WHERE id = '".$id."'");

                    ?><script>location.href='<?php echo $site; ?>/vacatures';</script><?php
                }
                if(isset($_POST['open'])){
                    $id = $db->real_escape_string($_GET['id']);

                    $db->query("UPDATE vacatures SET status = '1' WHERE id = '".$id."'");

                    ?><script>location.href='<?php echo $site; ?>/vacatures';</script><?php
                }
                if(isset($_POST['close'])){
                    $id = $db->real_escape_string($_GET['id']);

                    $db->query("UPDATE vacatures SET status = '0' WHERE id = '".$id."'");

                    ?><script>location.href='<?php echo $site; ?>/vacatures';</script><?php
                }
            ?>
            <form action="" method="post">
                <button type="submit" name="delVacature" class="btn btn-danger" style="float:right;margin-left:5px;">Verwijder</button> &nbsp;
                <?php if($fetchAanvraag['status'] == 1){?>
                <button type="submit" name="close" class="btn btn-danger" style="float:right;margin-left:5px;">Sluiten</button>
                <?php }else{ ?>
                <button type="submit" name="open" class="btn btn-success" style="float:right;">Openen</button>
                <?php } ?>
            </form>
            <?php } ?>
            <h1>Vacature Bekijken.</h1>
            <table class="table">
                <tr>
                    <th>Naam:</th>
                    <th>Datum:</th>
                </tr>

                <tr>
                    <td><?php echo $fetchAanvraag['titel']; ?></td>
                    <td><?php echo $fetchAanvraag['date']; ?></td>

                </tr>
            </table>
            <b>Uitleg:</b><br />
            <?php echo $fetchAanvraag['text']; ?>

            <h1>Reageren:</h1>
            <?php
            if(isset($_POST['AcceptTraining'])){
                $bericht = $db->real_escape_string($_POST['bericht']);

                if(empty($bericht)){
                    echo 'Je hebt geen bericht ingevuld';
                }else{
                    $query = $db->query("INSERT INTO vacature_reactie (uid,vacature,reactie,date) VALUES (
                    '".$userFetch['id']."',
                    '".$fetchAanvraag['titel']."',
                    '".$bericht."',
                    NOW()
                    )");

                    if($query){
                        echo 'Reactie verzonden!';
                    }else{
                        echo 'Er ging iets mis!';
                    }
                }
            }

            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Motivatie:</label>
                    <textarea class="form-control" name="bericht" rows="5" cols="5"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?php if($fetchAanvraag['status'] == 0 ){echo 'GESLOTEN!';}else{echo 'Verzend';}?>" class="btn btn-success" name="AcceptTraining" <?php if($fetchAanvraag['status'] == 0 ){echo 'disabled';}?> >
                </div>
            </form>
        </div>
    </div>
</div>

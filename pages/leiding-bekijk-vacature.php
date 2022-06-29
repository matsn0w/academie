<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
if(isset($_GET['id'])){
    $id = $db->real_escape_string($_GET['id']);
    $getContact = $db->query("SELECT * FROM vacature_reactie WHERE id = '".$id."'");
    $fetchContact = $getContact->fetch_assoc();

    $getVacatureq = $db->query("SELECT * FROM vacatures WHERE titel = '".$fetchContact['vacature']."'");
    $getVacature = $getVacatureq->fetch_assoc();

        $getUpdated = $db->query("SELECT id,username FROM users WHERE id = '".$fetchContact['uid']."'");
        $fetchUpdated = $getUpdated->fetch_assoc();
?>

                <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Vacature </h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Home</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/leiding/vacature">Vacature beheer</a>
                        </li>
                        <li class="active">
                            <strong>Vacature</strong>
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
                                    <div class="m-b-md">
                                        <?php
                                        if(isset($_POST['delForm'])){
                                            $q1 = $db->query("DELETE FROM vacature_reactie WHERE id = '".$id."'");
                                            if($q1){
                                                ?><script>toastr.success("Succesvol verwijderd!", "Yay")</script><?php
                                            }else{
                                                ?><script>toastr.error("Er ging iets mis met het verwijderen!", "Oeps")</script><?php
                                            }

                                        }
                                        ?>
                                        <form action="" method="post">
                                        <input type="submit" name="delForm" value="Verwijder" class="btn btn-white btn-xs pull-right">
                                        </form>
                                        <h2>Vacature: <?php echo $fetchContact['vacature']; ?></h2>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Datum:</dt> <dd>
                                          <?php echo $fetchContact['date']; ?>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Verzonden door:</dt> <dd><?php echo $fetchUpdated['username']; ?></dd>

                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Onderwerp:</dt> <dd>
                                          <?php echo $getVacature['text']; ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Vacature</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Beantwoorden</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <label><h2><?php echo $fetchContact['vacature']; ?></h2></label><br />
                                    <small><i>Door: </i><?php echo $fetchUpdated['username']; ?></small><br /><br />

                                    <p><b>Motivatie:</b><br />
                                        <?php echo $fetchContact['reactie']; ?>
                                    </p>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <?php
                                    if(isset($_POST['sendForm'])){
                                        $onderwerp = $db->real_escape_string($_POST['title']);
                                        $bericht = $db->real_escape_string($_POST['bericht']);

                                        if(empty($onderwerp)){
                                            ?><script>toastr.error("Je hebt geen onderwerp gekozen!", "Oeps")</script><?php
                                        }elseif(empty($bericht)){
                                            ?><script>toastr.error("Je hebt geen bericht gescheven!", "Oeps")</script><?php
                                        }else{
                                            $query = $db->query("INSERT INTO mailbox (uid_from, name_from,uid_to,title,bericht,date,categorie,important) VALUES (
                                            '0',
                                            'Leidinggevende',
                                            '".$fetchContact['uid']."',
                                            '".$onderwerp."',
                                            '".$bericht."',
                                            NOW(),
                                            '2',
                                            '1'
                                            )");


                                            if($query){
                                                ?><script>toastr.success("Bericht Verzonden!", "Succes!")</script><?php
                                            }else{
                                                ?><script>toastr.error("Er is iets misgegaan met het versturen!", "Oeps")</script><?php
                                            }


                                        }
                                    }
                                    ?>
                                    <div class="col-md-12">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            Onderwerp
                                            <input type="text" name="title" value="Vacature: <?php echo $fetchContact['vacature']; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            Bericht
                                            <textarea name="bericht" rows="20" class="form-control" placeholder="Typ hier je bericht, deze wordt verzonden onder de naam instructeur!"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Verzend" class="btn btn-primary" name="sendForm">
                                        </div>

                                    </form>
                                    </div>
                                </div>
                                </div>

                                </div>

                                </div>
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

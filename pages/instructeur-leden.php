<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{

if($nh == 1){
    $noodhulp = 'noodhulp';
}else{
    $noodhulp = '0';
}


if($brw == 1){
    $brandweer = 'brandweer';
}else{
    $brandweer = '0';
}

if($ambu == 1){
    $ambulance = 'ambulance';
}else{
    $ambulance = '0';
}

if($kmar == 1){
    $kmar = 'kmar';
}else{
    $kmar = '0';
}

if($mk == 1){
    $meldkamer = 'meldkamer';
}else{
    $meldkamer = '0';
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Leden</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Instructeur</a>
                        </li>
                        <li class="active">
                            <strong>Leden</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h2>Leden</h2>
                            <p>
                                Alle leden onder jou beheer.
                            </p>
                            <div class="input-group">
                                <input type="text" placeholder="Zoek lid " class="input form-control">
                                <span class="input-group-btn">
                                        <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Zoek</button>
                                </span>
                            </div>
                            <div class="clients-list">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <?php
                                                $getLeden = $db->query("SELECT * FROM users WHERE eenheid IN ('".$noodhulp."', '".$kmar."', '".$brandweer."', '".$ambulance."', '".$meldkamer."') ORDER BY username");
                                                $countLeden = $getLeden->num_rows;
                                                if($countLeden == 0){
                                                    echo '<br /><b>Geen leden onder jou beheer</b>';
                                                }
                                                while($fetchLeden = $getLeden->fetch_array()){
                                                ?>
                                                <tr>
                                                    <td class="client-avatar"><img alt="image" style="width:32px; height:32px; border-radius: 50%; margin:0 auto;" src="<?php echo $fetchLeden['avatar']; ?>"> </td>
                                                    <td><?php if(empty($fetchLeden['roepnummer'])){echo 'Geen';}else{echo $fetchLeden['roepnummer'];}; ?></td>

                                                    <td><a href="<?php echo $site; ?>/instructeur/lid/<?php echo $fetchLeden['id']; ?>" class="client-link"><?php echo $fetchLeden['username']; ?></a></td>

                                                    <td> <?php echo $fetchLeden['eenheid']; ?></td>
                                                    <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                    <td> <?php echo $fetchLeden['email']; ?></td>
                                                    <td class="client-status"><?php
                                                    if($fetchLeden['ingewerkt'] == 1){
                                                        echo '<span class="label label-primary">Ingewerkt</span></td>';
                                                    }else{
                                                        echo '<span class="label label-danger">Ingewerkt</span></td>';
                                                    }
                                                    ?>
                                                    <td class="client-status"><?php
                                                    if(!empty($fetchLeden['teamspeak'])){
                                                        echo '<span class="label label-primary">Porto</span><br />'.$fetchLeden['teamspeak'].'</td>';
                                                    }else{
                                                        echo '<span class="label label-danger">Porto</span></td>';
                                                    }
                                                    ?>
                                                    <td class="client-status"><?php
                                                    if($fetchLeden['inactief'] == 0){
                                                        echo '<span class="label label-primary">Actief</span></td>';
                                                    }else{
                                                        echo '<span class="label label-danger">Inactief</span></td>';
                                                    }
                                                    ?>

                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
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
<?php } ?>

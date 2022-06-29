<?php
if($vertrouwenspersoon != 1){
    echo 'Geen toegang!';
}else{
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Leden</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Vertrouwenspersoon</a>
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
                                                $getLeden = $db->query("SELECT * FROM users ORDER BY username");
                                                while($fetchLeden = $getLeden->fetch_array()){
                                                ?>
                                                <tr>
                                                    <td class="client-avatar"><img alt="image" style="height:25px;" src="<?php echo $fetchLeden['avatar']; ?>"> </td>
                                                    <td><a href="<?php echo $site; ?>/vertrouwenspersoon/lid/<?php echo $fetchLeden['id']; ?>" class="client-link"><?php echo $fetchLeden['username']; ?></a></td>
                                                    <?php
                                                    $vprobleem = $db->query("SELECT p1,p2 FROM vertrouw_problemen WHERE p1 = '".$fetchLeden['id']."' OR p2 = '".$fetchLeden['id']."'");
                                                    $vpfetch = $vprobleem->fetch_assoc();
                                                    if($vpfetch['p1'] == $fetchLeden['id'] || $vpfetch['p2'] == $fetchLeden['id']){
                                                        echo '<td><span class="label label-danger">Problemen</span></td>';
                                                    }else{
                                                        echo '<td><span class="label label-primary">Geen Problemen</span></td>';
                                                    }
                                                    ?>

                                                    <td> <?php
                                                    if($fetchLeden['vertrouw_gesprek'] == 1){
                                                        echo '<span class="label label-primary">Ja</span></td>';
                                                    }else{
                                                        echo '<span class="label label-danger">Nee</span></td>';
                                                    }
                                                    ?></td>
                                                    <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                    <td> <?php echo $fetchLeden['email']; ?></td>
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

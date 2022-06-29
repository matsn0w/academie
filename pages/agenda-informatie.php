<?php 
if(isset($_GET['id'])){
    $getTraining = $db->query("SELECT * FROM agenda WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $fetchTraining = $getTraining->fetch_assoc();
?>
<style>
#removebutton {
    background: url(<?php echo $site; ?>/img/Delete.png);
    border: 0;
    display: block;
    height: 16px;
    width: 16px;
}
</style>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Training Bekijken</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/">Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/agenda">Agenda</a>
                        </li>
                        <li class="active">
                            <strong>Agenda: <?php echo $fetchTraining['title']; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <!--<a href="#" class="btn btn-white btn-xs pull-right">Edit project</a> -->
                                        <h2><?php echo $fetchTraining['title']; ?></h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <?php
                                        if($fetchTraining['status'] == 0){
                                        ?>
                                        <dt>Status:</dt> <dd><span class="label label-primary">Actief</span></dd>
                                        <?php }else{ ?>
                                        <dt>Status:</dt> <dd><span class="label label-danger">Verlopen</span></dd>
                                        <?php } ?>
                                        <!--
                                        <dt>Status:</dt> <dd><span class="label label-primary">Geannuleerd</span></dd>
                                        -->
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Gemaakt door:</dt> <dd>
                                        <?php
                                        $getUsername = $db->query("SELECT username, id FROM users WHERE id = '".$fetchTraining['made_uid']."'");
                                        $fetchUsername = $getUsername->fetch_assoc();
                                        echo $fetchUsername['username'];
                                        ?>
                                        </dd>
                                        <dt>Datum:</dt> <dd>  <?php echo $fetchTraining['start']; ?></dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-1" data-toggle="tab">Berichten</a></li>
                                            <li class=""><a href="#tab-2" data-toggle="tab">Leden</a></li>
                                            <li class=""><a href="#tab-3" data-toggle="tab">Aanwezigheid</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php 
   ##-----------------------------------------------------------------
                                if(isset($_POST['aanwezig1'])){
                                    $aanwezig1 = $db->query("INSERT INTO agenda_aanwezig (aid, uid, type) VALUES ('".$db->real_escape_string($_GET['id'])."', '".$userFetch['id']."', '1') ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
                                if(isset($_POST['aanwezig2'])){
                                    $aanwezig1 = $db->query("INSERT INTO agenda_aanwezig (aid, uid, type) VALUES ('".$db->real_escape_string($_GET['id'])."', '".$userFetch['id']."', '2') ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
                                if(isset($_POST['aanwezig3'])){
                                    $aanwezig1 = $db->query("INSERT INTO agenda_aanwezig (aid, uid, type) VALUES ('".$db->real_escape_string($_GET['id'])."', '".$userFetch['id']."', '3') ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
    ##----------------------------------------------------------------
                                if(isset($_POST['updateaanwezig1'])){
                                    $aanwezig1 = $db->query("UPDATE agenda_aanwezig SET aid = '".$db->real_escape_string($_GET['id'])."', uid = '".$userFetch['id']."', type = '1' ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
                                if(isset($_POST['updateaanwezig2'])){
                                    $aanwezig1 = $db->query("UPDATE agenda_aanwezig SET aid = '".$db->real_escape_string($_GET['id'])."', uid = '".$userFetch['id']."', type = '2' ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
                                if(isset($_POST['updateaanwezig3'])){
                                    $aanwezig1 = $db->query("UPDATE agenda_aanwezig SET aid = '".$db->real_escape_string($_GET['id'])."', uid = '".$userFetch['id']."', type = '3' ");
                                    if($aanwezig1){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                }
    ##-------------------------------------------------------------------
                                if(isset($_POST['removeLid'])){
                                    $aid = $db->real_escape_string($_GET['id']);
                                    $uid = $db->real_escape_string($_POST['uid']);
                                    
                                    $removemember = $db->query("DELETE FROM agenda_aanwezig WHERE uid = '".$uid."' AND aid = '".$aid."'");
                                    if($removemember){
                                        echo 'Gelukt!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                    
                                }
                                ?>
                                <div class="panel-body">

                                <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="feed-activity-list">
                                        <?php 
                                        $getBerichten = $db->query("SELECT * FROM agenda_berichten WHERE tid = '".$db->real_escape_string($_GET['id'])."'");
                                        while($fetchBerichten = $getBerichten->fetch_array()){
                                            $getAvatar = $db->query("SELECT id, avatar,username FROM users WHERE id = '".$fetchBerichten['uid']."'");
                                            $fetchAvatar = $getAvatar->fetch_assoc();
                                        ?>
                                        <div class="feed-element">
                                            <a href="#" class="pull-left">
                                                <img alt="image" class="img-circle" src="<?php echo $fetchAvatar['avatar']; ?>">
                                            </a>
                                            <div class="media-body ">
                                                <small class="pull-right"><?php echo show_date($fetchBerichten['date']); ?></small>
                                                <strong><?php echo $fetchAvatar['username']; ?></strong> heeft een bericht geplaatst. <br>
                                                <small class="text-muted"><?php echo $fetchBerichten['date']; ?></small>
                                                
                                        <?php 
                                        if($leiding == 1){
                                            if(isset($_POST['delTime'])){
                                                $id = $db->real_escape_string($_POST['id']);
                                                
                                                $db->query("DELETE FROM agenda_berichten WHERE id = '".$id."'");
                                                ?><script>location.href='<?php echo $site; ?>/agenda/bekijk/<?php echo $db->real_escape_string($_GET['id']); ?>';</script><?php
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <input type="text" name="id" style="display:none;" value="<?php echo $fetchBerichten['id']; ?>">
                                            <input type="submit" style="    background: url(<?php echo $site; ?>/img/Delete.png);
    border: 0;
    display: block;
    height: 16px;
    width: 16px;" value="" name="delTime" style="float:right;">
                                        </form>
                                        <?php } ?>
                                                    
                                                
                                                <div class="well">
                                                    <?php echo $fetchBerichten['bericht']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        
                                    </div>
<!-------------------------------------------------------->

    <script src="<?php echo $site; ?>/js/plugins/summernote/summernote.min.js"></script>
    <link href="<?php echo $site; ?>/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<script>
$(document).ready(function(){
    $('.summernote').summernote();
    var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };
        var postForm = function() {
            var content = $('textarea[name="content"]').html($('.summernote').code());
        }

});
</script>

                <h2>
                    Maak bericht
                </h2>

                    <?php 
                    if(isset($_POST['sendMail'])){
                        $content = $db->real_escape_string($_POST['content']);
                        
                        if(empty($content)){
                            ?><script>toastr.error('Je hebt geen bericht ingevult!', 'Oeps');</script><?php
                        }else{
                            $query = $db->query("INSERT INTO agenda_berichten (tid,uid,bericht,date) VALUES (
                            '".$db->real_escape_string($_GET['id'])."',
                            '".$userFetch['id']."',
                            '".$content."',
                            NOW()
                            )");
                            if($query){
                                ?><script>toastr.success('Het bericht is verzonden!', 'Yay!');</script><?php
                            }else{
                                ?><script>toastr.error('Het bericht kon niet worden verstuurd!', 'Oeps');</script><?php
                            }
                        }
                    }
                    ?>
                    <form class="form-horizontal" id="postForm" method="POST" onsubmit="return postForm()">
                    <div class="mail-text h-200">
                        <textarea name="content" class="summernote"></textarea>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <input type="submit" name="sendMail" class="btn btn-sm btn-primary" value="Verzend">
                    </div>
                    </form>
                    </div>





                                <div class="tab-pane" id="tab-2">

                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Naam</th>
                                            <th>Eenheid</th>
                                            <th>Rang</th>
                                            <th>Aanwezig</th>
                                            <?php 
                                            if($leiding == 1 || $instructeur == 1){
                                            ?>
                                            <th>Verwijder</th>
                                            <?php } ?>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $getLeden = $db->query("SELECT * FROM agenda_aanwezig WHERE aid = '".$db->real_escape_string($_GET['id'])."'");
                                        while($fetchLeden = $getLeden->fetch_array()){
                                            $getUsername = $db->query("SELECT id,username,eenheid,rang FROM users WHERE id = '".$fetchLeden['uid']."'");
                                            $fetchUsername = $getUsername->fetch_assoc()
                                        
                                        ?>
                                        <tr class="
                                                <?php 
                                                if($fetchLeden['type'] == 1){
                                                    echo 'success';
                                                }elseif($fetchLeden['type'] == 2){
                                                    echo 'warning';
                                                }else{
                                                    echo 'danger';
                                                }
                                                ?>
                                                   ">
                                            <td>
                                               <?php echo $fetchUsername['username']; ?>
                                            </td>
                                            <td>
                                               <?php echo ucfirst($fetchUsername['eenheid']); ?>
                                            </td>
                                            <td>
                                                <?php echo $fetchUsername['rang']; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($fetchLeden['type'] == 1){
                                                    echo 'Aanwezig';
                                                }elseif($fetchLeden['type'] == 2){
                                                    echo 'Misschien';
                                                }else{
                                                    echo 'Afwezig';
                                                }
                                                ?>
                                            </td>
                                            <?php 
                                            if($leiding == 1 || $instructeur == 1){
                                            ?>
                                            <th>
                                                <form action="" method="post">
                                                    <input type="text" name="uid" value="<?php echo $fetchLeden['uid']; ?>" style="display:none;">
                                                    <input type="submit" value="" name="removeLid" id="removebutton">
                                                </form>
                                            </th>
                                            <?php } ?>

                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                    <div class="tab-pane" id="tab-3">
                                        <h1>Ben je aanwezig?</h1> 
                                        <form action="" method="post">
                                            <?php 
                                            $getAgendas = $db->query("SELECT * from agenda_aanwezig WHERE aid = '".$db->real_escape_string($_GET['id'])."' AND uid = '".$userFetch['id']."'");
                                            $countAgendas = $getAgendas->num_rows;
                                            if($countAgendas >= 1){
                                            ?>
                                            <input type="submit" name="updateaanwezig1" value="Aanwezig" class="btn btn-primary"> 
                                            <input type="submit" name="updateaanwezig2" value="Misschien" class="btn btn-warning"> 
                                            <input type="submit" name="updateaanwezig3" value="Afwezig" class="btn btn-danger"> 
                                            <?php
                                            }else{
                                            ?>
                                            <input type="submit" name="aanwezig1" value="Aanwezig" class="btn btn-primary"> 
                                            <input type="submit" name="aanwezig2" value="Misschien" class="btn btn-warning"> 
                                            <input type="submit" name="aanwezig3" value="Afwezig" class="btn btn-danger">
                                            <?php } ?>
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
            <!--<div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4>Project description</h4>
                    <img src="img/zender_logo.png" class="img-responsive">
                    <p class="small">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look
                        even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
                    </p>
                    <p class="small font-bold">
                        <span><i class="fa fa-circle text-warning"></i> High priority</span>
                    </p>
                    <h5>Project tag</h5>
                    <ul class="tag-list" style="padding: 0">
                        <li><a href=""><i class="fa fa-tag"></i> Zender</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Passages</a></li>
                        <li><a href=""><i class="fa fa-tag"></i> Variations</a></li>
                    </ul>
                    <h5>Project files</h5>
                    <ul class="list-unstyled project-files">
                        <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                        <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                        <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                        <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                    </ul>
                    <div class="text-center m-t-md">
                        <a href="#" class="btn btn-xs btn-primary">Add files</a>
                        <a href="#" class="btn btn-xs btn-primary">Report contact</a>

                    </div>
                </div>
            </div>
            -->
        </div>
<?php } ?>
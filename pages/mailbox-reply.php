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
<?php
if(isset($_GET['id'])){
    $id = $db->real_escape_string($_GET['id']);
?>
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="<?php echo $site; ?>/mailbox/bericht-maken">Verzend Mail</a>
                            <div class="space-25"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="<?php echo $site; ?>/mailbox"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning pull-right"><?php echo $emailCount; ?></span> </a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/bericht-maken"> <i class="fa fa-envelope-o"></i> Verzend Mail</a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/belangrijk"> <i class="fa fa-certificate"></i> Belangrijk <span class="label label-danger pull-right"><?php echo $emailCount2; ?></span></a></li>
                                <li><a href="<?php echo $site; ?>/mailbox/prullenbak"> <i class="fa fa-trash-o"></i> Prullenbak</a></li>
                            </ul>
                            <h5>Categorieën</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Leden </a></li>
                                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Instructeur</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-navy"></i> Leidinggevende</a></li>
                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Systeem Beheerder</a></li>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                    Maak Mail
                </h2>
            </div>
                <div class="mail-box">
<?php
$getMail = $db->query("SELECT * FROM mailbox WHERE id = '".$id."'");
$fetchMail = $getMail->fetch_assoc();
    $queryUser = $db->query("SELECT id,username FROM users WHERE id = '".$fetchMail['uid_from']."'");
    $getUser = $queryUser->fetch_assoc();
?>

                <div class="mail-body">
                    <?php
                    if(isset($_POST['sendMail'])){
                        $naar = $fetchMail['uid_from'];
                        $onderwerp = $db->real_escape_string($_POST['title']);
                        $content = $db->real_escape_string($_POST['content']);

                        if(empty($naar)){
                            ?><script>toastr.error('Je hebt geen goede ontvanger gekozen!', 'Oeps');</script><?php
                        }elseif(empty($onderwerp)){
                            ?><script>toastr.error('Je hebt geen onderwerp gekozen!', 'Oeps');</script><?php
                        }elseif(empty($content)){
                            ?><script>toastr.error('Je hebt geen bericht ingevult!', 'Oeps');</script><?php
                        }else{
                          $query = $db->query("INSERT INTO mailbox (uid_from,name_from,uid_to,title,bericht,date,categorie) VALUES (
                          '".$userFetch['id']."',
                          '".$userFetch['naam']."',
                          '".$naar."',
                          '".$onderwerp."',
                          '".$content."',
                          NOW(),
                          '1'
                          )");
                            if($query){
                                ?><script>location.href="<?php echo $site; ?>/mailbox";</script><?php
                            }else{
                                ?><script>toastr.error('Het bericht kon niet worden verstuurd!', 'Oeps');</script><?php
                            }
                        }
                    }
                    ?>
                    <form class="form-horizontal" id="postForm" method="POST" onsubmit="return postForm()">
                        <div class="form-group"><label class="col-sm-2 control-label">Naar:</label>

                            <div class="col-sm-10">
                            <input type="text" disabled class="form-control" value="<?php echo $getUser['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Onderwerp:</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value="RE: <?php echo $fetchMail['title']; ?>"></div>
                        </div>




                    <div class="mail-text h-200">

                        <textarea name="content" class="summernote"><br /><hr>Bericht van: <?php echo $getUser['username']; ?><br /> <?php echo $fetchMail['bericht']; ?></textarea>
<div class="clearfix"></div>
                        </div>
                    <div class="mail-body text-right tooltip-demo">
                        <input type="submit" name="sendMail" class="btn btn-sm btn-primary" value="Verzend">

                        <a href="<?php echo $site; ?>/mailbox" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Verwijder</a>
                    </div>
                    </form>
                    </div>
                    <div class="clearfix"></div>



                </div>
            </div>
        </div>
        </div>
<?php } ?>

<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>
    <script src="<?php echo $site; ?>/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="<?php echo $site; ?>/js/plugins/summernote/summernote.min.js"></script>
    <link href="<?php echo $site; ?>/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="<?php echo $site; ?>/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<script>
$(document).ready(function(){
    var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

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
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="<?php echo $site; ?>/mailbox/bericht-maken">Verzend Mail (EIGEN NAAM)</a>
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


                <div class="mail-body">
                    <?php
                    if(isset($_POST['sendMail'])){
                            $naar = $_POST['naar'];
                            $onderwerp = $db->real_escape_string($_POST['title']);
                            $content = $db->real_escape_string($_POST['content']);

                            if(empty($onderwerp)){
                                ?><script>toastr.error('Je hebt geen onderwerp gekozen!', 'Oeps');</script><?php
                            }elseif(empty($content)){
                                ?><script>toastr.error('Je hebt geen bericht ingevult!', 'Oeps');</script><?php
                            }else{
                                foreach ($naar as $n){
                                    $db->query("INSERT INTO mailbox (uid_from,name_from,uid_to,title,bericht,date,categorie) VALUES (
                                    '0',
                                    'Leiding',
                                    '".$n."',
                                    '".$onderwerp."',
                                    '".$content."',
                                    NOW(),
                                    '3'
                                    )");
                                }


                                    ?><script>location.href="<?php echo $site; ?>/leiding/send-mail";</script><?php

                            }
                    }
                    ?>
                    <form class="form-horizontal" id="postForm" method="POST" onsubmit="return postForm()">
                        <div class="form-group"><label class="col-sm-2 control-label">Naar:</label>

                            <div class="col-sm-10">
                            <div class="form-group">
                                <div class="input-group">
                                <select data-placeholder="Kies leden..." name="naar[]" class="chosen-select form-control" multiple style="width:350px;" tabindex="4">
                                    <?php
                                    $getUserlist = $db->query("SELECT * FROM users ORDER BY id");
                                    while($fetchUserlist = $getUserlist->fetch_array()){
                                    ?>
                                        <option value="<?php echo $fetchUserlist['id']; ?>"><?php echo $fetchUserlist['username']; ?></option>
                                    <?php } ?>

                                </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Onderwerp:</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="title" value=""></div>
                        </div>




                    <div class="mail-text h-200">

                        <textarea name="content" class="summernote"></textarea>
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

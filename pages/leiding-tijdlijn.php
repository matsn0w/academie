<?php
if($leiding != 1){
    echo 'Geen toegang!';
}else{
?>

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
        <div class="wrapper wrapper-content">
            
            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                    Maak Tijdlijn
                </h2>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <?php 
                    if(isset($_POST['sendMail'])){
                        $onderwerp = $db->real_escape_string($_POST['title']);
                        $content = $db->real_escape_string($_POST['content']);
                        
                        if(empty($onderwerp)){
                            ?><script>toastr.error('Je hebt geen onderwerp gekozen!', 'Oeps');</script><?php
                        }elseif(empty($content)){
                            ?><script>toastr.error('Je hebt geen bericht ingevult!', 'Oeps');</script><?php
                        }else{
                            $query = $db->query("INSERT INTO timeline (uid,title,bericht,date) VALUES (
                            '".$userFetch['id']."',
                            '".$onderwerp."',
                            '".$content."',
                            NOW()
                            )");
                            if($query){
                                ?><script>toastr.success('Het bericht is aangemaakt!', 'Yay!');</script><?php
                            }else{
                                ?><script>toastr.error('Het bericht kon niet worden verstuurd!', 'Oeps');</script><?php
                            }
                        }
                    }
                    ?>
                    <form class="form-horizontal" id="postForm" method="POST" onsubmit="return postForm()">
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
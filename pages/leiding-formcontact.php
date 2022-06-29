<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM extern_contact WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Formulier bekijken</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li>
                            <a>Leiding</a>
                        </li>
                        <li>
                            <a href="<?php echo $site; ?>/leiding/formulieren">Formulieren</a>
                        </li>
                        <li class="active">
                            <strong>Formulieren bekijken</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="tabbable" id="tabs-206608">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#info" data-toggle="tab">Informatie</a>
					</li>
					<li>
						<a href="#reageren" data-toggle="tab">Reageren</a>
					</li>
        </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <div class="margindown"></div>
            <?php
            $getContactq = $db->query("SELECT * FROM extern_contact WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();

            ?>
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Email</label>
                     <input type="email" value="<?php echo $getContact['email']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Bericht</label>
                     <div style="height: auto;" class="form-control" readonly><?php echo $getContact['message']; ?></div>
				</div>
                            <?php
                            if(isset($_POST['close'])){
                                $id = $db->real_escape_string($_GET['id']);

                                $query = $db->query("UPDATE extern_contact SET status = '1' WHERE id = '".$id."'");
                                if($query){
                                    ?><script>toastr.success('Het contactverzoek is gesloten!', 'Succes');</script><?php
                                }else{
                                    ?><script>toastr.error('Er ging iets mis met het verwerken van je aanvraag!', 'Oeps');</script><?php
                                }
                            }
                            if(isset($_POST['reopen'])){
                                $id = $db->real_escape_string($_GET['id']);

                                $query = $db->query("UPDATE extern_contact SET status = '0' WHERE id = '".$id."'");
                                if($query){
                                    ?><script>toastr.success('Het contactverzoek is gesloten!', 'Succes');</script><?php
                                }else{
                                    ?><script>toastr.error('Er ging iets mis met het verwerken van je aanvraag!', 'Oeps');</script><?php
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <?php if($getContact['status'] == 1){echo '<input type="submit" value="Heropen contact verzoek." name="reopen" class="btn btn-primary">';}?>
                                <input type="submit" value="Sluit contact verzoek." name="close" class="btn btn-danger">
                            </form>

                        </div>
                        <div class="tab-pane" id="reageren">
                            <div class="margindown"></div>
                            <?php
                            if(isset($_POST['submitContact'])){
                                $uemail = $getContact['email'];
                                $date = $getContact['date'];
                                $message = $getContact['message'];
                                $reply = $db->real_escape_string($_POST['bericht']);


                                include_once("includes/PHPMailer/MailTemplates/externcontactreply.php");
                                if(isset($uemail))
                                {
                                  $to = $uemail;

                                  if(isset($to))
                                  {
                                     $send_mail = send_mail($to, $date, $message, $reply);


                                    if($send_mail === 'success')
                                    {
                                     ?><script> alert('Verstuurd!');</script><?php
                                    }else{
                                     ?><script> alert('Er is iets misgegaan1');</script><?php
                                    }



                                  }else
                                  {
                                    ?><script> alert('Er is iets misgegaan2');</script><?php
                                  }

                                }else
                                {
                                  ?><script> alert('Er is iets misgegaan3');</script><?php
                                } 
                            }
                            ?>

                            <form action="" method="POST">
                                <div class="form-group">
                                     <label for="exampleInputEmail1">Bericht</label>
<textarea class="form-control" name="bericht" rows="10" required>
Beste <?php echo $getContact['naam'];?>, <br />
<br />
<b><i>Typ hier je bericht...</i></b><br />
<br />
Met vriendelijke groet,<br />
<br />
<?php echo $userFetch['username']; ?><br />
<?php
if($systeem == 1){
    echo 'Het bestuur <br />
          SyntaxOnline';
}else{
    echo 'Leidinggevende '.$userFetch['eenheid'].'<br />
          SyntaxOnline';
    
}
?>
</textarea>
                                </div>
                                <div class="form-group">
                                     <div class="margindown"></div>
                                     <input type="submit" class="btn btn-primary" name="submitContact">
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

                        </div>
                    </div>
<?php } ?>

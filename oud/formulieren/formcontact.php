<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM contact WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>              <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Contactformulier: <?php echo $formF['naam']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $site; ?>/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="<?php echo $site; ?>/formulieren">Formulieren</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Contact: <?php echo $formF['naam']; ?>
                            </li>
                        </ol>
                        
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
            $getContactq = $db->query("SELECT * FROM contact WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();
            
            ?>
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Achternaam</label>
                     <input type="text" value="<?php echo $getContact['achternaam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Email</label>
                     <input type="email" value="<?php echo $getContact['email']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Bericht</label>
                     <textarea class="form-control" rows="10" readonly><?php echo $getContact['bericht']; ?></textarea>
				</div>
			
                            
                        </div>
                        <div class="tab-pane" id="reageren">
                            <div class="margindown"></div>
                            <?php
                            if(isset($_POST['submitContact'])){
                                $onderwerp = $db->real_escape_string($_POST['onderwerp']);
                                $bericht = $db->real_escape_string($_POST['bericht']);
                                $email = $db->real_escape_string($getContact['email']);
                                
                                if(empty($onderwerp)){
                                    
                                }elseif(empty($bericht)){
                                    
                                }else{
                                    
                                    $headers	 = 'From: NNPDclan <info@nnpdclan.nl>' . "\r\n";
                                    $headers	.= 'Reply-To: NNPDclan <info@nnpdclan.nl>' . "\r\n";
                                    $headers	.= 'Return-Path: Mail-Error <errors@nnpdclan.nl>' . "\r\n";
                                    $headers	.= 'X-Mailer: PHP/' . phpversion() . "\r\n";
                                    $headers	.= 'X-Priority: Normal' . "\r\n";
                                    $headers	.= ($html) ? 'MIME-Version: 1.0' . "\r\n" : '';
                                    $headers	.= ($html) ? 'Content-type: text/html; charset=iso-8859-1' . "\r\n" : '';

                                    if(mail($email, $onderwerp, $bericht, $headers)){
                                        echo 'Succesvol verzonden!';
                                    }else{
                                        echo 'Er ging iets mis!';
                                    }
                                    
                                }
                                
                            }
                            ?>
                            
                            <form action="" method="POST">
                                <div class="form-group">
                                     <label for="exampleInputEmail1">Onderwerp</label>
                                     <input type="text" name="onderwerp" class="form-control">
                                </div>
                                <div class="form-group">
                                     <label for="exampleInputEmail1">Bericht</label>
                                     <textarea class="form-control" name="bericht" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                     <div class="margindown"></div>
                                     <input type="submit" class="form-control" name="submitContact">
                                </div>
                            </form>
                        </div>
                    </div>
                
                
                </div>
                        
                        </div>
                    </div>
<?php } ?>
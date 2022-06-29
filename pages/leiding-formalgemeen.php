<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM formalgemeen WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>              <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Algemeenformulier: <?php echo $formF['naam']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $site; ?>/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="<?php echo $site; ?>/formulieren">Formulieren</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Algemeen: <?php echo $formF['naam']; ?>
                            </li>
                        </ol>
    
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <div class="margindown"></div>
            <?php
            $getContactq = $db->query("SELECT * FROM formalgemeen WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();
            
            ?>
            <div class="col-lg-6">
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam + achternaam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?> <?php echo $getContact['achternaam']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Leeftijd:</label>
                     <input type="email" value="<?php echo $getContact['leeftijd']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Email</label>
                     <input type="email" value="<?php echo $getContact['email']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Onderwerp</label>
                     <input type="text" value="<?php echo $getContact['onderwerp']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Heeft u het naar uw zin in deze clan?</label>
                     <input type="text" value="<?php echo $getContact['vraag1']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Wat vindt u dat beter kan in deze clan?</label>
                     <input type="text" value="<?php echo $getContact['vraag2']; ?>" class="form-control" readonly>
				</div>
                            
                </div>      
                <div class="col-lg-6">
                            
                <div class="form-group">
					 <label for="exampleInputEmail1">Heeft u last van iemand of wordt u gepest?</label>
                     <input type="text" value="<?php echo $getContact['vraag3']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Is er iets wat u graag zou willen in deze clan?</label>
                     <input type="text" value="<?php echo $getContact['vraag4']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Is er iets wat u weg wilt in de clan?</label>
                     <input type="text" value="<?php echo $getContact['vraag5']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Heeft u ergens nog moeite mee?</label>
                     <input type="text" value="<?php echo $getContact['vraag6']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Heeft u ergens nog moeite mee?</label>
                     <input type="text" value="<?php echo $getContact['gesprek']; ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
					 <label for="exampleInputEmail1">Opmerkingen?</label>
                     <texarea class="form-control" readonly><?php echo $getContact['opmerkingen']; ?></texarea>
				</div>
			
                            
                        </div>
                    
                    </div>
                
                
                </div>
                        
                        </div>
                    </div>
<?php } ?>
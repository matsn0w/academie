<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM formpromotie WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>              <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Promotie formulier: <?php echo $formF['naam']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $site; ?>/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="<?php echo $site; ?>/formulieren">Formulieren</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Promotie Idee: <?php echo $formF['naam']; ?>
                            </li>
                        </ol>
    
                
                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <div class="margindown"></div>
            <?php
            $getContactq = $db->query("SELECT * FROM formpromotie WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();
            
            ?>
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam + achternaam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?> <?php echo $getContact['achternaam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Voor wie</label>
                     <input type="text" value="<?php echo $getContact['voor']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Datum</label>
                     <input type="text" value="<?php $dateconverted = strtotime( $getContact['date'] ); echo date( 'd-m-Y H:i:s', $dateconverted); ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Waarom</label>
                     <textarea class="form-control" rows="10" readonly><?php echo $getContact['waarom']; ?></textarea>
				</div>
			
                            
                        </div>
                    
                    </div>
                
                
                </div>
                        
                        </div>
                    </div>
<?php } ?>
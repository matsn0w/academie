<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM formklachten WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>              <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Kacht formulier: <?php echo $formF['naam']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo $site; ?>/home">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> <a href="<?php echo $site; ?>/formulieren">Formulieren</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Klacht: <?php echo $formF['naam']; ?>
                            </li>
                        </ol>
    
                
                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <div class="margindown"></div>
                           <?php if(isset($_POST['deleteLid'])){
                    
                    $deleteQuery = $db->query("DELETE FROM leden WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                    if($deleteQuery){
                        $_SESSION['success'] = 1;
                            ?><script>location.href='<?php echo $site; ?>/leden'</script><?php
                    }else{
                        $_SESSION['failed'] = 1;
                            ?><script>location.href='<?php echo $site; ?>/leden'</script><?php
                    }
                    
                }
                ?>
            <?php
            $getContactq = $db->query("SELECT * FROM formklachten WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();
            
            ?>
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Achternaam</label>
                     <input type="email" value="<?php echo $getContact['achternaam']; ?>" class="form-control" readonly>
				</div>
               
               <div class="form-group">
                     <label for="exampleInputEmail1">Tegen wie</label>
                     <input type="email" value="<?php echo $getContact['tegen']; ?>" class="form-control" readonly>
                </div>
                
				<div class="form-group">
					 <label for="exampleInputEmail1">Datum</label>
                     <input type="text" value="<?php $dateconverted = strtotime( $getContact['date'] ); echo date( 'd-m-Y H:i:s', $dateconverted); ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Klacht</label>
                     <textarea class="form-control" rows="10" readonly><?php echo $getContact['klacht']; ?></textarea>
				</div>
			    <?php
                if(isset($_POST['delForm'])){
                    
                    $deleteQuery = $db->query("DELETE FROM formpromotie WHERE 1 id = '".$db->real_escape_string($_GET['id'])."'");
                    if($deleteQuery){
                        $_SESSION['success'] = 1;
                            ?><script>location.href='<?php echo $site; ?>/leden'</script><?php
                    }else{
                        $_SESSION['failed'] = 1;
                            ?><script>location.href='<?php echo $site; ?>/leden'</script><?php
                    }
                    
                }
                ?>
                 
                <div class="form-group">
                    <input type="submit" name="delForm" class="btn btn-danger" value="Verwijder">
                </div>
                            
                        </div>
                    
                    </div>
                
                
                </div>
                        
                        </div>
                    </div>
<?php } ?>
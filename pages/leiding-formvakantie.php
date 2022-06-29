<?php
if(isset($_GET['id'])){
    $formQ = $db->query("SELECT * FROM formvakantie WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $formF = $formQ->fetch_assoc();
?>             <div class="row wrapper border-bottom white-bg page-heading">
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
                            <a href="<?php echo $site; ?>/formulieren">Formulieren</a>
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
                
                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <div class="margindown"></div>
                            <?php 
                            if(isset($_POST['delete'])){
                                $id = $db->real_escape_string($_GET['id']);
                                
                                $query = $db->query("DELETE FROM formvakantie WHERE id = '".$id."'");
                                if($query){
                                    ?><script>toastr.success('Succesvol verwijderd!', 'Succes');</script><?php
                                }else{
                                    ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <input type="submit" value="Verwijder" name="delete" class="form-control">
                            </form>
            <?php
            $getContactq = $db->query("SELECT * FROM formvakantie WHERE id = '".$db->real_escape_string($_GET['id'])."'");
            $getContact = $getContactq->fetch_assoc();
            
            ?>
				<div class="form-group">
					 <label for="exampleInputEmail1">Naam + Achternaam</label>
                     <input type="text" value="<?php echo $getContact['naam']; ?> <?php echo $getContact['achternaam']; ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Inactief Vanaf</label>
                     <input type="email" value="<?php $dateconverted = strtotime( $getContact['inactief'] ); echo date( 'd-m-Y', $dateconverted); ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Actief Vanaf</label>
                     <input type="text" value="<?php $dateconverted2 = strtotime( $getContact['actief'] ); echo date( 'd-m-Y', $dateconverted2); ?>" class="form-control" readonly>
				</div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Datum</label>
                    <input type="text" value="<?php $dateconverted3 = strtotime( $getContact['date'] ); echo date( 'd-m-Y H:i:s', $dateconverted3); ?>" class="form-control" readonly>
                </div>
				<div class="form-group">
					 <label for="exampleInputEmail1">Reden</label>
                     <textarea class="form-control" rows="10" readonly><?php echo $getContact['reden']; ?></textarea>
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
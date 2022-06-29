<h1>Problemen</h1>

                        <?php
                        if(isset($_POST['delItem'])){
                            $id = $db->real_escape_string($_POST['id']);

                            $q = $db->query("DELETE FROM vertrouw_problemen WHERE id = '".$id."'");

                            if($q){
                                ?><script>toastr.success('Succesvol verwijderd!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het verwijderen!', 'Oeps');</script><?php
                            }
                        }
                        if(isset($_POST['editItem'])){
                            $id = $db->real_escape_string($_GET['id']);
                            $verklaring1 = $db->real_escape_string($_POST['verklaring1']);
                            $verklaring2 = $db->real_escape_string($_POST['verklaring2']);

                            $query = $db->query("UPDATE vertrouw_problemen SET p1verklaring = '".$verklaring1."', p2verklaring = '".$verklaring2."' WHERE id = '".$id."'");

                            if($query){
                                ?><script>toastr.success('Succesvol geupdate!', 'Succes');</script><?php
                            }else{
                                ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                            }
                        }
                        ?>

                        <?php
                        $getProblem = $db->query("SELECT * FROM vertrouw_problemen WHERE id = '".$db->real_escape_string($_GET['id'])."'");
                        while($fetchProblem = $getProblem->fetch_array()){
                            $p1User = $db->query("SELECT id, username FROM users WHERE id = '".$fetchProblem['p1']."'");
                            $p1Username = $p1User->fetch_assoc();

                            $p2User = $db->query("SELECT id, username FROM users WHERE id = '".$fetchProblem['p2']."'");
                            $p2Username = $p2User->fetch_assoc();
                        ?>
                        <div class="col-md-6">
                            <form action="" method="post">
                            <b>Persoon 1</b><br />
                            <?php echo $p1Username['username']; ?><br />
                            <br />
                            <b>Verklaring</b><br />
                            <textarea name="verklaring1" class="form-control"><?php echo $fetchProblem['p1verklaring']; ?></textarea><br />
                            <br />
                            <hr style="border-color:#CECECE;">

                        </div>
                        <div class="col-md-6">
                            <b>Persoon 2</b><br />
                            <?php echo $p2Username['username']; ?><br />
                            <br />
                            <b>Verklaring</b><br />
                            <textarea name="verklaring2" class="form-control"><?php echo $fetchProblem['p2verklaring']; ?></textarea><br />

                                <input type="text" style="display:none;" name="id" value="<?php echo $fetchProblem['id']; ?>">
                                <input type="submit" class="btn btn-danger" style="float:right;" name="delItem" value="X"> &nbsp; &nbsp;
                                <input type="submit"  class="btn btn-primary" style="float:right;" name="editItem" value="Aanpassen">
                            </form>
                            <hr style="border-color:#CECECE;">
                        </div>
                        <hr style="border-color:#CECECE;">
                        <?php
                        }
                        ?>

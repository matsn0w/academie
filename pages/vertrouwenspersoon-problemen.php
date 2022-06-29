<?php
if($vertrouwenspersoon != 1){
    echo 'Geen toegang!';
}else{
?>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Leden</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Vertrouwenspersoon</a>
                        </li>
                        <li class="active">
                            <strong>Problemen</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-6">
                    <div class="ibox">
                        <div class="ibox-content">
                            <h2>Persoon 1</h2>
                            <?php
                            if(isset($_POST['sendProblem'])){
                                $p1 = $db->real_escape_string($_POST['p1']);
                                $p1verklaring = $db->real_escape_string($_POST['p1verklaring']);
                                $p2 = $db->real_escape_string($_POST['p2']);
                                $p2verklaring = $db->real_escape_string($_POST['p2verklaring']);


                                    $query = $db->query("INSERT INTO vertrouw_problemen (p1,p1verklaring,p2,p2verklaring,date) VALUES (
                                    '".$p1."',
                                    '".$p1verklaring."',
                                    '".$p2."',
                                    '".$p2verklaring."',
                                    NOW()
                                    )");

                                    if($query){
                                        ?><script>toastr.success('Succesvol aangemaakt!', 'Succes');</script><?php
                                    }else{
                                        ?><script>toastr.error('Er ging iets mis met het aanmaken!', 'Oeps');</script><?php
                                    }


                            }
                            ?>
                            <form action="" method="POST">

                                <div class="form-group">
                                    <label>Persoon 1</label>
                                    <select class="form-control" name="p1">
                                <?php
                                $getUserlist = $db->query("SELECT * FROM users ORDER BY id");
                                while($fetchUserlist = $getUserlist->fetch_array()){
                                ?>
                                <option value="<?php echo $fetchUserlist['id']; ?>"><?php echo $fetchUserlist['username']; ?></option>
                                <?php } ?>
                            </select>
                                </div>

                                <div class="form-group">
                                    <label>Persoon 1 Verklaring</label>
                                    <textarea class="form-control" name="p1verklaring"></textarea>
                                </div>

                                <div class="form-group">
                                <input type="submit" name="sendProblem" class="btn btn-primary">
                                </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="ibox">
                        <div class="ibox-content">
                                <h1>Persoon 2</h1>
                                <div class="form-group">
                                    <label>Persoon 2</label>
                                    <select class="form-control" name="p2">
                                <?php
                                $getUserlist = $db->query("SELECT * FROM users ORDER BY id");
                                while($fetchUserlist = $getUserlist->fetch_array()){
                                ?>
                                <option value="<?php echo $fetchUserlist['id']; ?>"><?php echo $fetchUserlist['username']; ?></option>
                                <?php } ?>
                            </select>
                                </div>

                                <div class="form-group">
                                    <label>Persoon 2 Verklaring</label>
                                    <textarea class="form-control" name="p2verklaring"></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php
                    if(isset($_POST['removeid'])){
                        $id = $db->real_escape_string($_POST['removeproblem']);

                        $removequery = $db->query("DELETE FROM vertrouw_problemen WHERE id = '".$id."'");
                        if($removequery){
                            echo 'Verwijderd!';
                        }else{
                            echo 'Er ging iets mis!';
                        }
                    }
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Persoon 1
                                </th>
                                <th>
                                    Persoon 1 Verklaring
                                </th>
                                <th>
                                    Persoon 2
                                </th>
                                <th>
                                    Persoon 2 Verklaring
                                </th>
                                <th>
                                    Verwijder
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getProbleem = $db->query("SELECT * FROM vertrouw_problemen ORDER BY status");
                            while($fetchProbleem = $getProbleem->fetch_array()){
                                $getUsername1 = $db->query("SELECT username FROM users WHERE id = '".$fetchProbleem['p1']."'");
                                $fetchUsername1 = $getUsername1->fetch_assoc();

                                $getUsername2 = $db->query("SELECT username FROM users WHERE id = '".$fetchProbleem['p2']."'");
                                $fetchUsername2 = $getUsername2->fetch_assoc();
                            ?>
                            <tr>
                                <td>
                                    <?php echo $fetchUsername1['username']; ?>
                                </td>
                                <td>
                                    <?php echo $fetchProbleem['p1verklaring']; ?>
                                </td>
                                <td>
                                    <?php echo $fetchUsername2['username']; ?>
                                </td>
                                <td>
                                    <?php echo $fetchProbleem['p2verklaring']; ?>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="text" name="removeproblem" value="<?php echo $fetchProbleem['id']; ?>" style="display:none;">
                                        <input type="submit" name="removeid" value="X" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php } ?>

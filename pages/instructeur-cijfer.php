<?php
if($instructeur != 1){
    echo 'Geen toegang!';
}else{
?>
<style>
input[type=submit] {
    background: url(<?php echo $site; ?>/img/Delete.png);
    border: 0;
    display: block;
    height: 16px;
    width: 16px;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Cijfer Toevoegen</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $site; ?>/home">Dashboard</a>
                        </li>
                        <li class="active">
                            <strong>Mijn Cijfers</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-xs-12">
                <br />
                Bekijk alle cijfers <br />
                <a href="<?php echo $site; ?>/instructeur/toevoegen/cijfer">Cijfer Toevoegen</a>
                <br />
                <?php
                if(isset($_POST['deleteCijfer'])){
                    $idFORM = $db->real_escape_string($_POST['formID']);
                    $q1 = $db->query("DELETE FROM cijfers WHERE id = '".$idFORM."'");
                    if($q1){
                            ?><script>location.href="<?php echo $site; ?>/instructeur/cijfer";</script><?php
                        }else{
                            ?><script>toastr.error('Het cijfer kon niet worden verwijderd!', 'Oeps');</script><?php
                        }
                }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Voor</th>
                            <th>Titel</th>
                            <th>Punten</th>
                            <th>Cijfer</th>
                            <th>X</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getCijfers = $db->query("SELECT * FROM cijfers ORDER BY id");
                        $countCijfer = $getCijfers->num_rows;
                        if($countCijfer <= 0){
                            echo '<tr><td></td><td>Geen cijfers gevonden!</td></tr>';
                        }
                        while($fetchCijfers = $getCijfers->fetch_array()){
                            $getUsername = $db->query("SELECT username, id FROM users WHERE id = '".$fetchCijfers['uid']."'");
                            $fetchUsername = $getUsername->fetch_assoc();
                        ?>
                        <tr class="<?php if($fetchCijfers['cijfer'] >= 5.5){echo 'success';}else{echo 'danger';} ?>">
                            <td><?php echo $fetchCijfers['id']; ?></td>
                            <td><?php echo $fetchUsername['username']; ?></td>
                            <td><?php echo $fetchCijfers['title']; ?></td>
                            <td><?php echo $fetchCijfers['punten']; ?></td>
                            <td><?php echo $fetchCijfers['cijfer']; ?></td>
                            <form action="" method="post">
                                <input type="text" name="formID" value="<?php echo $fetchCijfers['id']; ?>" style="display:none;">
                                <td><input type="submit" value="" name="deleteCijfer"></td>
                            </form>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
<?php } ?>

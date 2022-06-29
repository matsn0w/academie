<?php
if($systeem != 1){
    echo 'Geen toegang';
}else{
?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php
            if(isset($_POST['submit'])){
                $user = $db->real_escape_string($_POST['username']);
                $rank = $db->real_escape_string($_POST['rank']);

                if($user == 0){
                    echo 'Er ging iets mis!';
                }else{
                    $query = $db->query("INSERT INTO user_rank (uid, rank_id) VALUES ('".$user."', '".$rank."')");
                    if($query){
                        ?><script>toastr.success('Succesvol de rank gegeven!', 'Succes');</script><?php
                    }else{
                        ?><script>toastr.error('Er ging iets mis met het updaten!', 'Oeps');</script><?php
                    }
                }
            }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label>Gebruiker</label>
                    <select name="username" class="form-control">
                        <?php
                        $getUsernames = $db->query("SELECT username, id FROM users ORDER BY id");
                        while($fetchUser = $getUsernames->fetch_array()){
                        ?>
                        <option value="<?php echo $fetchUser['id']; ?>"><?php echo $fetchUser['username']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rank</label>
                    <select name="rank" class="form-control">
                        <?php
                        $getRanks = $db->query("SELECT * FROM ranks ORDER BY id");
                        while($fetchRanks = $getRanks->fetch_array()){
                        ?>
                        <option value="<?php echo $fetchRanks['id']; ?>"><?php echo $fetchRanks['naam']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Geef rank" class="btn btn-primary">
                </div>

            </form>
        </div>
        <div class="col-md-4"></div>
</div>
<?php
}
?>

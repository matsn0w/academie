  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
include_once("class.database.php");
?>
<a href="http://dutchroleplayforces.nl/drfonline/gms/includes/check-login.php">Ga terug!</a>
<table  class="table">
    <tr>
        <th>Gebruikersnaam</th>
        <th>Email</th>
        <th>Save</th>
        <th>Verwijder</th>
    </tr>
    <?php
    $getUsers = $db->query("SELECT * FROM users WHERE id = '".$db->real_escape_string($_GET['id'])."'");
    $fetchUsers = $getUsers->fetch_array();
    ?>
    <form action="" method="POST">
    <tr>
        <td><input type="text" name="username" class="form-control" value="<?php echo $fetchUsers['username']; ?>"></td>
        <td><input type="text" name="email" class="form-control" value="<?php echo $fetchUsers['email']; ?>"></td>
        <td><input type="submit" value="Opslaan" name="submitLid" class="btn btn-success"></td>
        <td><input type="submit" class="btn btn-danger" name="delUser" value="X"></td>
    </tr>
    </form>

</table>
<?php
if(isset($_POST['delUser'])){
    $id = $db->real_escape_string($_GET['id']);

    $delete = $db->query("DELETE FROM users WHERE id = '".$id."'");

    if($delete){
        echo 'Verwijderd!';
    }else{
        echo 'Er ging iets mis met het verwijderen!';
    }

}
if(isset($_POST['submitLid'])){
    $username = $db->real_escape_string($_POST['username']);
    $email = $db->real_escape_string($_POST['email']);
    $rank = $db->real_escape_string($_POST['rank']);

    if(empty($username)){
        echo 'Gebruikersnaam is leeg!';
    }elseif(empty($email)){
        echo 'Email is leeg!';
    }else{
        $update = $db->query("UPDATE users SET username = '".$username."', email = '".$email."', rank = '".$rank."' WHERE id = '".$db->real_escape_string($_GET['id'])."'");

        if($update){
            echo 'Geupdated! <a href="http://dutchroleplayforces.nl/drfonline/gms/includes/check-login.php">Ga terug!</a>';
        }else{
            echo 'Er ging iets mis met het updaten!';
        }
    }

}
?>

Ranks:<br />
<?php
$getRanks = $db->query("SELECT * FROM ranks ORDER BY id");
while($fetchRanks = $getRanks->fetch_array()){

    echo $fetchRanks['id'].' : '. $fetchRanks['naam']. '<br />';

}
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
//error_log('check-rank.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
 ?>

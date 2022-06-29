 <a href="http://dutchroleplayforces.nl/mijn/gms/">Ga terug!</a>
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
<div class="ledenbeheer" style="float:right;">
<table  class="table">
    <tr>
        <th>Gebruikersnaam</th>
        <th>Email</th>
        <th>Aanpassen</th>
    </tr>
    <?php
    $getUsers = $db->query("SELECT * FROM users ORDER BY id DESC");
    while($fetchUsers = $getUsers->fetch_array()){
    ?>
    <tr>
        <td><?php echo $fetchUsers['username']; ?></td>
        <td><?php echo $fetchUsers['email']; ?></td>
        <td><a href="check-rank.php?id=<?php echo $fetchUsers['id']; ?>">EDIT</a></td>
    </tr>
    <?php
    }
    ?>
</table>
</div>


<div class="lidaanmaken">
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $getName = $db->query("SELECT * FROM users");
        $getNameF = $getName->fetch_assoc();
        $error = NULL;
        if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email'])){
            $error = 1;
        }elseif(!filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = 2;
        }elseif($db->real_escape_string($_POST['username']) == $getNameF['username']){
            $error = 3;
        }elseif($db->real_escape_string($_POST['email']) == $getNameF['email']){
            $error = 4;
        }
        if($error == NULL){

            $salt = generateSalt();

            if($db->query("INSERT INTO `users` (`username`, `password`, `salt`, `email`) VALUES
            (
            '".$db->real_escape_string($_POST['username'])."',
            '".crypt($_POST['password'], $salt)."',
            '".$salt."',
            '".$db->real_escape_string($_POST['email'])."'
            )")){

                echo "Je bent geregistreerd!";


            }else{
                echo "Er is iets foutgegaan!";
            }
        }elseif($error == 1){
            echo "Je hebt niet alles ingevuld!";
        }elseif($error == 2){
            echo "Ongeldig e-mailadres";
        }elseif($error == 3){
            echo "Gebruikersnaam bestaat al";
        }elseif($error == 4){
            echo 'Email bestaat al';
        }
    }
    ?>

    <form action="" method="POST">
        <table width="500">
            <b>LETOP:</b> Geen spaties gebruiken!
            <tr><td>Gebruikersnaam</td><td> <input class="form-control" type="text" name="username"></td></tr>
            <tr><td>Wachtwoord</td><td> <input class="form-control" type="password" name="password"></td></tr>
            <tr><td>Email</td><td> <input class="form-control" type="text" name="email"></td></tr>
            <tr><td><input type="submit" style="width:120px;" class="btn btn-success" name="submit" value="Registreer!"></td></tr>
        </table>
    </form><br />
</div>
<?php
echo $database['user']. '<br />';
echo $database['password']. '<br />';
echo $database['database']. '<br />';
echo $database['host']. '<br />';

//error_log('check-login.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

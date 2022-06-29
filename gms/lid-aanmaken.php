<?php
include_once("includes/class.database.php");
if($userFetch['rank'] == 4){
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

            if($db->query("INSERT INTO `users` (`username`, `password`, `salt`, `email`, `rank`) VALUES
            (
            '".$db->real_escape_string($_POST['username'])."',
            '".crypt($_POST['password'], $salt)."',
            '".$salt."',
            '".$db->real_escape_string($_POST['email'])."',
            '".$db->real_escape_string($_POST['rank'])."'
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
            <tr><td>Rank</td><td><select name="rank">
                <option value="1">Eenheid</option>
                <option value="2">Centralist</option>
                <option value="3">Reserve/Eenheid</option>
                <option value="4">Instructeur</option>
                </select></td></tr>
            <tr><td><input type="submit" style="width:120px;" class="form-control" name="submit" value="Registreer!"></td></tr>
        </table>
    </form><br />
<?php }else{ ?>
Je hebt geen toestemming!
<?php } ?>

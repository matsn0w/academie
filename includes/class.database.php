<?php
$site = 'https://politie.hoogstad.be/academie';

$database['user'] = 'pvlo12';
$database['password'] = 'Autobot123*';
$database['database'] = 'academie2';
$database['host'] = '127.0.0.1';


@$db = new MySQLi($database['host'], $database['user'], $database['password'], $database['database']);

if($db->connect_error){
    echo "Whoops, Geen database connectie! Meld dit aan Armin!<br>";
    echo "Error:(".$db->connect_errno."): ".$db->connect_error;
}

// Saltgenerator
function generateSalt(){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*";
    $salt = NULL;
    for($i = 0; $i < 8; $i++){
        $salt .= $chars[mt_rand(0, 69)];
    }
    return $salt;
}

function generateRandomString($length = 20){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $string = NULL;
    for($i = 0; $i < $length; $i++){
        $string .= $chars[mt_rand(0, 61)];
    }
    return $string;
}

if(isset($_SESSION['email'])){

    $userQuery = $db->query("SELECT * FROM users WHERE email = '".$db->real_escape_string($_SESSION['email'])."'");
    $userFetch = $userQuery->fetch_assoc();
}

$ResetQuery = $db->query("SELECT * FROM users");
$ResetFetch = $ResetQuery->fetch_assoc();

$randompassword = generateRandomString();

?>

<?php
include_once("includes/class.database.php");

if(isset($_SESSION['email'])){
    header("Location: inmelden.php");
}else{
    include_once("login.php");
}

?>
<?php
//error_reporting(0);
session_start();
include_once("includes/class.database.php");
include_once("includes/class.ranks.php");
include_once("includes/class.functions.php");

if(!isset($_SESSION['email'])){
    include_once("inloggen.php");
}else{
    include_once("signedin.php");
}
?>

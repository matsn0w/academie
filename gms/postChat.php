<?php
include_once("includes/class.database.php");
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
    fwrite($fp, "
    <b>".$userFetch['username']."</b>: ".stripslashes(htmlspecialchars($text))." <div style=\"float:right;\">".date("G:i:s")."</div><br>");
    fclose($fp);
?>
<?php
include_once('../includes/class.database.php');
$content = $db->real_escape_string($_GET['content']);
$id = $db->real_escape_string($_GET['id']);

if($content == '1' || $content == '0'){

if($content == '1'){
    $data = '0';
}else{
    $data = '1';
}

        $updateQuery = $db->query("UPDATE gms_log SET gelezen = '".$data."' WHERE id = '".$id."'");

        if($updateQuery){
            echo 'Succes';
        }else{
            echo 'Error';
        }
}else{
    echo 'Er gaat iets fout';

}

//error_log('change-status.php: '.mysqli_error($db) . "\n", 3, "error/error.log");
?>

<?php
include("class.database.php");

$resultaat = $db->query("SELECT * FROM trainingen WHERE status = '0' ORDER BY id");
$arr = array();

while($fetch = $resultaat->fetch_assoc()){
    $arr[] = $fetch;
}
echo json_encode($arr);
?>
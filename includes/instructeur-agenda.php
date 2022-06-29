<?php
include_once("class.database.php");

$resultaat = $db->query("SELECT * FROM agenda WHERE status = '0' ORDER BY id");
$arr = array();

while($fetch = $resultaat->fetch_assoc()){
    $arr[] = $fetch;
}
echo json_encode($arr);

?>
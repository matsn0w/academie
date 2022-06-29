<?php
include_once("class.database.php");

$resultaat = $db->query("SELECT * FROM contact_in WHERE status = '1' OR status = '2' ORDER BY id");
$arr = array();

while($fetch = $resultaat->fetch_assoc()){
    $arr[] = $fetch;
}
echo json_encode($arr);

?>